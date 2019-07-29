<?php

namespace Webkul\Core\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Webkul\Core\Repositories\ContactRepository as Contact;

/**
 * Contact controller for managing the contact controls.
 *
 * @author    Prashant Singh <prashant.singh852@webkul.com> @prashant-webkul
 * @copyright 2018 Webkul Software Pvt Ltd (http://www.webkul.com)
 */
class ContactController extends Controller
{
    /**
     * Contains route related configuration
     *
     * @var array
     */
    protected $_config;

    /**
     * ContactRepository object
     * Object
     */
    protected $contact;

    /**
     * Create a new controller instance.
     *
     * @param  \Webkul\Core\Repositories\ContactRepository $contact
     * @return void
     */
    public function __construct(Contact $contact)
    {
        $this->contact = $contact;

        $this->_config = request('_config');
    }

    /**
     * Loads the index for the contacts settings.
     *
     * @return mixed
     */
    public function index()
    {
        return view($this->_config['view']);
    }

    /**
     * Loads the form for creating contact.
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
            'fax' => 'string|required',
            'domain' => 'string|required',
            'email' => 'string|required',
        ]);

        $result = $this->contact->save(request()->all());

        if ($result)
            session()->flash('success', trans('admin::app.appsettings.contact.created-success'));
        else
            session()->flash('success', trans('admin::app.appsettings.contact.created-fail'));

        return redirect()->route($this->_config['redirect']);
    }

    /**
     * Edit the previously created contact item.
     *
     * @return mixed
     */
    public function edit($id)
    {
        $contact = $this->contact->findOrFail($id);

        return view($this->_config['view'])->with('contact', $contact);
    }

    /**
     * Edit the previously created contact item.
     *
     * @return response
     */
    public function update($id)
    {
        $this->validate(request(), [
            'name' => 'string|required',
            'address' => 'string|required',
            'tel' => 'string|required',
            'fax' => 'string|required',
            'domain' => 'string|required',
            'email' => 'string|required',
        ]);

        $result = $this->contact->updateItem(request()->all(), $id);

        if ($result) {
            session()->flash('success', trans('admin::app.appsettings.contact.update-success'));
        } else {
            session()->flash('error', trans('admin::app.appsettings.contact.update-fail'));
        }

        return redirect()->route($this->_config['redirect']);
    }

    /**
     * Delete a contact item and preserve the last one from deleting
     *
     * @return mixed
     */
    public function destroy($id)
    {
        $contact = $this->contact->findOrFail($id);

        try {
            $this->contact->delete($id);

            session()->flash('success', trans('admin::app.response.delete-success', ['name' => 'Contact']));

            return response()->json(['message' => true], 200);
        } catch(\Exception $e) {
            session()->flash('error', trans('admin::app.response.delete-failed', ['name' => 'Contact']));
        }

        return response()->json(['message' => false], 400);
    }
}