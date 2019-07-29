<?php

namespace Webkul\Car\Repositories;

use Illuminate\Container\Container as App;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Event;
use Webkul\Core\Eloquent\Repository;
use Webkul\Car\Models\Car;
use Webkul\Car\Models\CarTranslation;
use Illuminate\Database\Eloquent\ModelNotFoundException;

/**
 * Car Reposotory
 *
 * @author    Jitendra Singh <jitendra@webkul.com>
 * @copyright 2018 Webkul Software Pvt Ltd (http://www.webkul.com)
 */
class CarRepository extends Repository
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(App $app)
    {
        parent::__construct($app);
    }

    /**
     * Specify Model class name
     *
     * @return mixed
     */
    public function model()
    {
        return 'Webkul\Car\Contracts\Car';
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function create(array $data)
    {
        Event::fire('catalog.car.create.before');

        if (isset($data['locale']) && $data['locale'] == 'all') {
            $model = app()->make($this->model());

            foreach (core()->getAllLocales() as $locale) {
                foreach ($model->translatedAttributes as $attribute) {
                    if (isset($data[$attribute])) {
                        $data[$locale->code][$attribute] = $data[$attribute];
                        $data[$locale->code]['locale_id'] = $locale->id;
                    }
                }
            }
        }

        $car = $this->model->create($data);

        $this->uploadImages($data, $car);

        Event::fire('catalog.car.create.after', $car);

        return $car;
    }

    /**
     * Specify Car tree
     *
     * @param integer $id
     * @return mixed
     */
    public function getCarTree($id = null)
    {
        return $id
            ? $this->model::orderBy('position', 'ASC')->where('id', '!=', $id)->get()->toTree()
            : $this->model::orderBy('position', 'ASC')->get()->toTree();
    }


    /**
     * Get root cars
     *
     * @return mixed
     */
    public function getRootCars()
    {
        return $this->getModel()->where('parent_id', NULL)->get();
    }

    /**
     * get visible Car tree
     *
     * @param integer $id
     * @return mixed
     */
    public function getVisibleCarTree($id = null)
    {
        static $cars = [];

        if(array_key_exists($id, $cars))
            return $cars[$id];

        return $cars[$id] = $id
                ? $this->model::orderBy('position', 'ASC')->where('status', 1)->descendantsOf($id)->toTree()
                : $this->model::orderBy('position', 'ASC')->where('status', 1)->get()->toTree();
    }

    /**
     * Checks slug is unique or not based on locale
     *
     * @param integer $id
     * @param string  $slug
     * @return boolean
     */
    public function isSlugUnique($id, $slug)
    {
        $exists = CarTranslation::where('car_id', '<>', $id)
            ->where('slug', $slug)
            ->limit(1)
            ->select(\DB::raw(1))
            ->exists();

        return $exists ? false : true;
    }

    /**
     * Retrive Car from slug
     *
     * @param string $slug
     * @return mixed
     */
    public function findBySlugOrFail($slug)
    {
        $car = $this->model->whereTranslation('slug', $slug)->first();

        if ($car) {
            return $car;
        }

        throw (new ModelNotFoundException)->setModel(
            get_class($this->model), $slug
        );
    }

    /**
     * @param array $data
     * @param $id
     * @param string $attribute
     * @return mixed
     */
    public function update(array $data, $id, $attribute = "id")
    {
        $car = $this->find($id);

        Event::fire('catalog.car.update.before', $id);

        $car->update($data);

        $this->uploadImages($data, $car);

        Event::fire('catalog.car.update.after', $id);

        return $car;
    }

    /**
     * @param $id
     * @return void
     */
    public function delete($id)
    {
        Event::fire('catalog.car.delete.before', $id);

        parent::delete($id);

        Event::fire('catalog.car.delete.after', $id);
    }

    /**
     * @param array $data
     * @param mixed $Car
     * @return void
     */
    public function uploadImages($data, $car, $type = "image")
    {
        if (isset($data[$type])) {
            $request = request();

            foreach ($data[$type] as $imageId => $image) {
                $file = $type . '.' . $imageId;
                $dir = 'Car/' . $car->id;

                if ($request->hasFile($file)) {
                    if ($car->{$type}) {
                        Storage::delete($car->{$type});
                    }

                    $car->{$type} = $request->file($file)->store($dir);
                    $car->save();
                }
            }
        } else {
            if ($car->{$type}) {
                Storage::delete($car->{$type});
            }

            $car->{$type} = null;
            $car->save();
        }
    }

    public function getPartial()
    {
        $cars = $this->model->all();
        $trimmed = array();

        foreach ($cars as $key => $car) {
            if ($car->name != null || $car->name != "") {
                $trimmed[$key] = [
                    'id' => $car->id,
                    'name' => $car->name
                ];
            }
        }

        return $trimmed;
    }
}