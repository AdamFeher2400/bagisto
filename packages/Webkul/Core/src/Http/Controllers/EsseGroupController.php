<?php

namespace Webkul\Core\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Webkul\Core\Repositories\EsseGroupRepository as EsseGroup;

/**
 * EsseGroup controller for managing the banner controls.
 *
 * @author    Prashant Singh <prashant.singh852@webkul.com> @prashant-webkul
 * @copyright 2018 Webkul Software Pvt Ltd (http://www.webkul.com)
 */
class EsseGroupController extends Controller
{
    /**
     * Contains route related configuration
     *
     * @var array
     */
    protected $_config;

    /**
     * EsseGroupRepository object
     * Object
     */
    protected $essegroup;

    /**
     * Create a new controller instance.
     *
     * @param  \Webkul\Core\Repositories\EsseGroupRepository $essegroup
     * @return void
     */
    public function __construct(EsseGroup $essegroup)
    {
        $this->essegroup = $essegroup;

        $this->_config = request('_config');
    }

    /**
     * Loads the index for the essegroup settings.
     *
     * @return mixed
     */
    public function index()
    {
        $essegroup = $this->essegroup->orderBy('created_at', 'desc')->first();
        return view($this->_config['view'])->with('essegroup', $essegroup);
    }

    /**
     * Creates the new essegroup item.
     *
     * @return response
     */
    public function store()
    {
        $this->validate(request(), [
            'content' => 'string|required'
        ]);

        $result = $this->essegroup->save(request()->all());

        if ($result)
            session()->flash('success', trans('admin::app.appsettings.essegroup.created-success'));
        else
            session()->flash('success', trans('admin::app.appsettings.essegroup.created-fail'));

        return redirect()->route($this->_config['redirect']);
    }
}