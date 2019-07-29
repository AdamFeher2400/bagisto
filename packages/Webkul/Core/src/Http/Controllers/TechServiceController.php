<?php

namespace Webkul\Core\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Webkul\Core\Repositories\TechServiceRepository as TechService;

/**
 * TechService controller for managing the techservice controls.
 *
 * @author    Prashant Singh <prashant.singh852@webkul.com> @prashant-webkul
 * @copyright 2018 Webkul Software Pvt Ltd (http://www.webkul.com)
 */
class TechServiceController extends Controller
{
    /**
     * Contains route related configuration
     *
     * @var array
     */
    protected $_config;

    /**
     * TechServiceRepository object
     * Object
     */
    protected $techservice;

    /**
     * Create a new controller instance.
     *
     * @param  \Webkul\Core\Repositories\TechServiceRepository $techservice
     * @return void
     */
    public function __construct(TechService $techservice)
    {
        $this->techservice = $techservice;

        $this->_config = request('_config');
    }

    /**
     * Loads the index for the techservices settings.
     *
     * @return mixed
     */
    public function index()
    {
        return view($this->_config['view']);
    }

    /**
     * Loads the form for creating techservice.
     *
     * @return mixed
     */
    public function create()
    {
        return view($this->_config['view']);
    }

    /**
     * Creates the new sider item.
     *
     * @return response
     */
    public function store()
    {
        $this->validate(request(), [
            'name' => 'string|required',
            'address' => 'string|required',
            'tel' => 'string|required',
            'mobile' => 'string|required',
            'country' => 'string|required',
            'city' => 'string|required',
        ]);

        $result = $this->techservice->save(request()->all());

        if ($result)
            session()->flash('success', trans('admin::app.appsettings.techservice.created-success'));
        else
            session()->flash('success', trans('admin::app.appsettings.techservice.created-fail'));

        return redirect()->route($this->_config['redirect']);
    }

    /**
     * Edit the previously created techservice item.
     *
     * @return mixed
     */
    public function edit($id)
    {
        $techservice = $this->techservice->findOrFail($id);

        return view($this->_config['view'])->with('techservice', $techservice);
    }

    /**
     * Edit the previously created techservice item.
     *
     * @return response
     */
    public function update($id)
    {
        $this->validate(request(), [
            'name' => 'string|required',
            'address' => 'string|required',
            'tel' => 'string|required',
            'mobile' => 'string|required',
            'country' => 'string|required',
            'city' => 'string|required',
        ]);

        $result = $this->techservice->updateItem(request()->all(), $id);

        if ($result) {
            session()->flash('success', trans('admin::app.appsettings.techservice.update-success'));
        } else {
            session()->flash('error', trans('admin::app.appsettings.techservice.update-fail'));
        }

        return redirect()->route($this->_config['redirect']);
    }

    /**
     * Delete a techservice item and preserve the last one from deleting
     *
     * @return mixed
     */
    public function destroy($id)
    {
        $techservice = $this->techservice->findOrFail($id);

        try {
            $this->techservice->delete($id);

            session()->flash('success', trans('admin::app.response.delete-success', ['name' => 'TechService']));

            return response()->json(['message' => true], 200);
        } catch(\Exception $e) {
            session()->flash('error', trans('admin::app.response.delete-failed', ['name' => 'TechService']));
        }

        return response()->json(['message' => false], 400);
    }
}