<?php

namespace Webkul\Core\Repositories;

use Illuminate\Container\Container as App;
use Webkul\Core\Eloquent\Repository;
use Storage;

/**
 * News Reposotory
 *
 * @author    Prashant Singh <prashant.singh852@webkul.com>
 * @copyright 2018 Webkul Software Pvt Ltd (http://www.webkul.com)
 */
class NewsRepository extends Repository
{
    public function __construct(
        App $app
    )
    {

        parent::__construct($app);
    }

    /**
     * Specify Model class name
     *
     * @return mixed
     */
    function model()
    {
        return 'Webkul\Core\Contracts\News';
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function save(array $data)
    {
        $dir = 'news_images';

        $uploaded = false;
        $image = false;

        if (isset($data['image'])) {
            $image = $first = array_first($data['image'], function ($value, $key) {
                if ($value)
                    return $value;
                else
                    return false;
            });
        }

        if ($image != false) {
            $uploaded = $image->store($dir);

            unset($data['image'], $data['_token']);
        }

        if ($uploaded) {
            $data['path'] = $uploaded;
        } else {
            unset($data['image']);
        }

        return $this->create($data);
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function updateItem(array $data, $id)
    {
        $dir = 'news_images';

        $uploaded = false;
        $image = false;

        if (isset($data['image'])) {
            $image = $first = array_first($data['image'], function ($value, $key) {
                if ($value)
                    return $value;
                else
                    return false;
            });
        }

        if ($image != false) {
            $uploaded = $image->store($dir);

            unset($data['image'], $data['_token']);
        }

        if ($uploaded) {
            $newsItem = $this->find($id);

            $deleted = Storage::delete($newsItem->path);

            $data['path'] = $uploaded;
        } else {
            unset($data['image']);
        }

        $this->update($data, $id);

        return true;
    }

    /**
     * Delete a news item and delete the image from the disk or where ever it is
     *
     * @return Boolean
     */
    public function destroy($id) {

        $newsItem = $this->find($id);

        $newsItemImage = $newsItem->path;

        Storage::delete($newsItemImage);

        return $this->model->destroy($id);
    }
}