<?php

namespace Webkul\Core\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Webkul\Core\Repositories\BannerRepository as Banner;

/**
 * Banner controller for managing the banner controls.
 *
 * @author    Prashant Singh <prashant.singh852@webkul.com> @prashant-webkul
 * @copyright 2018 Webkul Software Pvt Ltd (http://www.webkul.com)
 */
class BannerController extends Controller
{
    /**
     * Contains route related configuration
     *
     * @var array
     */
    protected $_config;

    /**
     * BannerRepository object
     * Object
     */
    protected $banner;

    /**
     * Create a new controller instance.
     *
     * @param  \Webkul\Core\Repositories\BannerRepository $banner
     * @return void
     */
    public function __construct(Banner $banner)
    {
        $this->banner = $banner;

        $this->_config = request('_config');
    }

    /**
     * Loads the index for the banners settings.
     *
     * @return mixed
     */
    public function index()
    {
        return view($this->_config['view']);
    }

    /**
     * Loads the form for creating banner.
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
            'title' => 'string|required',
            'image.*'  => 'required|mimes:jpeg,bmp,png,jpg'
        ]);

        $result = $this->banner->save(request()->all());

        if ($result)
            session()->flash('success', trans('admin::app.appsettings.banner.created-success'));
        else
            session()->flash('success', trans('admin::app.appsettings.banner.created-fail'));

        return redirect()->route($this->_config['redirect']);
    }

    /**
     * Edit the previously created banner item.
     *
     * @return mixed
     */
    public function edit($id)
    {
        $banner = $this->banner->findOrFail($id);

        return view($this->_config['view'])->with('banner', $banner);
    }

    /**
     * Edit the previously created banner item.
     *
     * @return response
     */
    public function update($id)
    {
        $this->validate(request(), [
            'title' => 'string|required',
            'image.*'  => 'sometimes|mimes:jpeg,bmp,png,jpg'
        ]);

        $result = $this->banner->updateItem(request()->all(), $id);

        if ($result) {
            session()->flash('success', trans('admin::app.appsettings.banner.update-success'));
        } else {
            session()->flash('error', trans('admin::app.appsettings.banner.update-fail'));
        }

        return redirect()->route($this->_config['redirect']);
    }

    /**
     * Delete a banner item and preserve the last one from deleting
     *
     * @return mixed
     */
    public function destroy($id)
    {
        $banner = $this->banner->findOrFail($id);

        try {
            $this->banner->delete($id);

            session()->flash('success', trans('admin::app.response.delete-success', ['name' => 'Banner']));

            return response()->json(['message' => true], 200);
        } catch(\Exception $e) {
            session()->flash('error', trans('admin::app.response.delete-failed', ['name' => 'Banner']));
        }

        return response()->json(['message' => false], 400);
    }
}