<?php

namespace Webkul\API\Http\Controllers\Shop;

use Illuminate\Http\Request;
use Webkul\Core\Repositories\EsseGroupRepository;
use Webkul\API\Http\Resources\Core\EsseGroup as EsseGroupResource;

/**
 * EsseGroup controller
 *
 * @author    Jitendra Singh <jitendra@webkul.com>
 * @copyright 2018 Webkul Software Pvt Ltd (http://www.webkul.com)
 */
class EsseGroupController extends Controller
{
    /**
     * EsseGroupRepository object
     *
     * @var array
     */
    protected $essegroupRepository;

    /**
     * Create a new controller instance.
     *
     * @param  Webkul\EsseGroup\Repositories\EsseGroupRepository $essegroupRepository
     * @return void
     */
    public function __construct(EsseGroupRepository $essegroupRepository)
    {
        $this->essegroupRepository = $essegroupRepository;
    }

    /**
     * Returns a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json([
            'data' => $this->essegroupRepository->orderBy('created_at', 'desc')->first()
        ]);
    }
}
