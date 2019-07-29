<?php

namespace Webkul\Core\Repositories;

use Illuminate\Container\Container as App;
use Webkul\Core\Eloquent\Repository;
use Storage;

/**
 * Payment Reposotory
 *
 * @author    Prashant Singh <prashant.singh852@webkul.com>
 * @copyright 2018 Webkul Software Pvt Ltd (http://www.webkul.com)
 */
class PaymentRepository extends Repository
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
        return 'Webkul\Core\Contracts\Payment';
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function save(array $data)
    {
        $dir = 'payment_images';

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
        $dir = 'payment_images';

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
            $paymentItem = $this->find($id);

            $deleted = Storage::delete($paymentItem->path);

            $data['path'] = $uploaded;
        } else {
            unset($data['image']);
        }

        $this->update($data, $id);

        return true;
    }

    /**
     * Delete a payment item and delete the image from the disk or where ever it is
     *
     * @return Boolean
     */
    public function destroy($id) {

        $paymentItem = $this->find($id);

        $paymentItemImage = $paymentItem->path;

        Storage::delete($paymentItemImage);

        return $this->model->destroy($id);
    }
}