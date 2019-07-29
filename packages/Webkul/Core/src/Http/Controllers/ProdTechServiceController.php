<?php

namespace Webkul\Core\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Webkul\Core\Repositories\ProdTechServiceRepository as ProdTechService;
use Webkul\Customer\Repositories\CustomerRepository  as Customer;
use Webkul\Core\Repositories\TechServiceRepository as TechService;

/**
 * ProdTechService controller for managing the prodtechservice controls.
 *
 * @author    Prashant Singh <prashant.singh852@webkul.com> @prashant-webkul
 * @copyright 2018 Webkul Software Pvt Ltd (http://www.webkul.com)
 */
class ProdTechServiceController extends Controller
{
    /**
     * Contains route related configuration
     *
     * @var array
     */
    protected $_config;

    /**
     * ProdTechServiceRepository object
     * Object
     */
    protected $prodtechservice;

    /**
     * CustomerRepository Object
     * 
     * @var array
     */
    protected $customer;

    /**
     * TechServiceRepository Object
     * 
     * @var array
     */
    protected $techservice;

    /**
     * Create a new controller instance.
     *
     * @param  \Webkul\Core\Repositories\ProdTechServiceRepository          $prodtechservice
     * @param  \Webkul\Customer\Repositories\CustomerRepository             $customer
     * @param  \Webkul\TechService\Repositories\TechServiceRepository       $techservice
     * @return void
     */
    public function __construct(
        ProdTechService $prodtechservice,
        Customer $customer,
        TechService $techservice
    )
    {
        $this->prodtechservice = $prodtechservice;
        $this->customer = $customer;
        $this->techservice = $techservice;

        $this->_config = request('_config');
    }

    /**
     * Loads the index for the prodtechservice settings.
     *
     * @return mixed
     */
    public function index()
    {
        return view($this->_config['view']);
    }

    /**
     * Loads the form for creating prodtechservice.
     *
     * @return mixed
     */
    public function create()
    {

        $customers = $this->customer->all();
        $techservices = $this->techservice->all();
        $statuses = Array
                (
                    "0" => Array("key" => 0, "name" => "Arrived"),
                    "1" => Array("key" => '', "name" => "Returned")
                );

        return view($this->_config['view'], compact('customers', 'techservices', 'statuses'));
    }

    /**
     * Creates the new sider item.
     *
     * @return response
     */
    public function store()
    {
        $this->validate(request(), [
            'customer_id' => 'integer|required',
            'brand' => 'string|required',
            'model' => 'string|required',
            'arrival' => 'date',
            'return' => 'date',
            'status' => 'string|required',
            'techservice_id' => 'integer|required'
        ]);

        $result = $this->prodtechservice->save(request()->all());

        if ($result)
            session()->flash('success', trans('admin::app.appsettings.prodtechservice.created-success'));
        else
            session()->flash('success', trans('admin::app.appsettings.prodtechservice.created-fail'));

        return redirect()->route($this->_config['redirect']);
    }

    /**
     * Edit the previously created prodtechservice item.
     *
     * @return mixed
     */
    public function edit($id)
    {
        $prodtechservice = $this->prodtechservice->findOrFail($id);

        $customers = $this->customer->all();
        $techservices = $this->techservice->all();
        $statuses = Array
                (
                    "0" => Array("key" => 0, "name" => "Arrived"),
                    "1" => Array("key" => '', "name" => "Returned")
                );

        return view($this->_config['view'], compact('prodtechservice', 'customers', 'techservices', 'statuses'));
    }

    /**
     * Edit the previously created prodtechservice item.
     *
     * @return response
     */
    public function update($id)
    {
        $this->validate(request(), [
            'customer_id' => 'integer|required',
            'brand' => 'string|required',
            'model' => 'string|required',
            'arrival' => 'date',
            'return' => 'date',
            'status' => 'string|required',
            'techservice_id' => 'integer|required'
        ]);

        $result = $this->prodtechservice->updateItem(request()->all(), $id);

        if ($result) {
            session()->flash('success', trans('admin::app.appsettings.prodtechservice.update-success'));
        } else {
            session()->flash('error', trans('admin::app.appsettings.prodtechservice.update-fail'));
        }

        return redirect()->route($this->_config['redirect']);
    }

    /**
     * Delete a prodtechservice item and preserve the last one from deleting
     *
     * @return mixed
     */
    public function destroy($id)
    {
        $prodtechservice = $this->prodtechservice->findOrFail($id);

        try {
            $this->prodtechservice->delete($id);

            session()->flash('success', trans('admin::app.response.delete-success', ['name' => 'ProdTechService']));

            return response()->json(['message' => true], 200);
        } catch(\Exception $e) {
            session()->flash('error', trans('admin::app.response.delete-failed', ['name' => 'ProdTechService']));
        }

        return response()->json(['message' => false], 400);
    }
}