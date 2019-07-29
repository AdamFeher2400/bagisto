<?php

namespace Webkul\Core\Repositories;

use Illuminate\Container\Container as App;
use Webkul\Core\Eloquent\Repository;
use Storage;

/**
 * TechService Reposotory
 *
 * @author    Prashant Singh <prashant.singh852@webkul.com>
 * @copyright 2018 Webkul Software Pvt Ltd (http://www.webkul.com)
 */
class TechServiceRepository extends Repository
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
        return 'Webkul\Core\Contracts\TechService';
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function save(array $data)
    {
        return $this->create($data);
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function updateItem(array $data, $id)
    {
        $this->update($data, $id);

        return true;
    }

    /**
     * Delete a techservice item and delete the image from the disk or where ever it is
     *
     * @return Boolean
     */
    public function destroy($id) {

        $techserviceItem = $this->find($id);

        return $this->model->destroy($id);
    }
}