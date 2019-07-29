<?php

namespace Webkul\Core\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Webkul\Core\Contracts\ProdTechService as ProdTechServiceContract;

class ProdTechService extends Model implements ProdTechServiceContract
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'prodtechservices';

    protected $fillable = [
        'customer_id', 'brand', 'model', 'arrival', 'return', 'status', 'techservice_id'
    ];
}