<?php

namespace Webkul\Core\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Webkul\Core\Repositories\NewsRepository as News;

/**
 * News controller for managing the news controls.
 *
 * @author    Prashant Singh <prashant.singh852@webkul.com> @prashant-webkul
 * @copyright 2018 Webkul Software Pvt Ltd (http://www.webkul.com)
 */
class NewsController extends Controller
{
    /**
     * Contains route related configuration
     *
     * @var array
     */
    protected $_config;

    /**
     * NewsRepository object
     * Object
     */
    protected $news;

    /**
     * Create a new controller instance.
     *
     * @param  \Webkul\Core\Repositories\NewsRepository $news
     * @return void
     */
    public function __construct(News $news)
    {
        $this->news = $news;

        $this->_config = request('_config');
    }

    /**
     * Loads the index for the news settings.
     *
     * @return mixed
     */
    public function index()
    {
        return view($this->_config['view']);
    }

    /**
     * Loads the form for creating news.
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

        $result = $this->news->save(request()->all());

        if ($result)
            session()->flash('success', trans('admin::app.appsettings.news.created-success'));
        else
            session()->flash('success', trans('admin::app.appsettings.news.created-fail'));

        return redirect()->route($this->_config['redirect']);
    }

    /**
     * Edit the previously created news item.
     *
     * @return mixed
     */
    public function edit($id)
    {
        $news = $this->news->findOrFail($id);

        return view($this->_config['view'])->with('news', $news);
    }

    /**
     * Edit the previously created news item.
     *
     * @return response
     */
    public function update($id)
    {
        $this->validate(request(), [
            'title' => 'string|required',
            'image.*'  => 'sometimes|mimes:jpeg,bmp,png,jpg'
        ]);

        $result = $this->news->updateItem(request()->all(), $id);

        if ($result) {
            session()->flash('success', trans('admin::app.appsettings.news.update-success'));
        } else {
            session()->flash('error', trans('admin::app.appsettings.news.update-fail'));
        }

        return redirect()->route($this->_config['redirect']);
    }

    /**
     * Delete a news item and preserve the last one from deleting
     *
     * @return mixed
     */
    public function destroy($id)
    {
        $news = $this->news->findOrFail($id);

        try {
            $this->news->delete($id);

            session()->flash('success', trans('admin::app.response.delete-success', ['name' => 'News']));

            return response()->json(['message' => true], 200);
        } catch(\Exception $e) {
            session()->flash('error', trans('admin::app.response.delete-failed', ['name' => 'News']));
        }

        return response()->json(['message' => false], 400);
    }
}