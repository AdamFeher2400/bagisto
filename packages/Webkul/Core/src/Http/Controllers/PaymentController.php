<?php

namespace Webkul\Core\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Webkul\Core\Repositories\PaymentRepository as Payment;

/**
 * Payment controller for managing the payment controls.
 *
 * @author    Prashant Singh <prashant.singh852@webkul.com> @prashant-webkul
 * @copyright 2018 Webkul Software Pvt Ltd (http://www.webkul.com)
 */
class PaymentController extends Controller
{
    /**
     * Contains route related configuration
     *
     * @var array
     */
    protected $_config;

    /**
     * PaymentRepository object
     * Object
     */
    protected $payment;

    /**
     * Create a new controller instance.
     *
     * @param  \Webkul\Core\Repositories\PaymentRepository $payment
     * @return void
     */
    public function __construct(Payment $payment)
    {
        $this->payment = $payment;

        $this->_config = request('_config');
    }

    /**
     * Loads the index for the payments settings.
     *
     * @return mixed
     */
    public function index()
    {
        return view($this->_config['view']);
    }

    /**
     * Loads the form for creating payment.
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
            'image.*'  => 'required|mimes:jpeg,bmp,png,jpg'
        ]);

        $result = $this->payment->save(request()->all());

        if ($result)
            session()->flash('success', trans('admin::app.appsettings.payment.created-success'));
        else
            session()->flash('success', trans('admin::app.appsettings.payment.created-fail'));

        return redirect()->route($this->_config['redirect']);
    }

    /**
     * Edit the previously created payment item.
     *
     * @return mixed
     */
    public function edit($id)
    {
        $payment = $this->payment->findOrFail($id);

        return view($this->_config['view'])->with('payment', $payment);
    }

    /**
     * Edit the previously created payment item.
     *
     * @return response
     */
    public function update($id)
    {
        $this->validate(request(), [
            'name' => 'string|required',
            'image.*'  => 'sometimes|mimes:jpeg,bmp,png,jpg'
        ]);

        $result = $this->payment->updateItem(request()->all(), $id);

        if ($result) {
            session()->flash('success', trans('admin::app.appsettings.payment.update-success'));
        } else {
            session()->flash('error', trans('admin::app.appsettings.payment.update-fail'));
        }

        return redirect()->route($this->_config['redirect']);
    }

    /**
     * Delete a payment item and preserve the last one from deleting
     *
     * @return mixed
     */
    public function destroy($id)
    {
        $payment = $this->payment->findOrFail($id);

        try {
            $this->payment->delete($id);

            session()->flash('success', trans('admin::app.response.delete-success', ['name' => 'Payment']));

            return response()->json(['message' => true], 200);
        } catch(\Exception $e) {
            session()->flash('error', trans('admin::app.response.delete-failed', ['name' => 'Payment']));
        }

        return response()->json(['message' => false], 400);
    }
}