<?php

namespace Webkul\Core\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Webkul\Core\Contracts\EsseGroup as EsseGroupContract;

class EsseGroup extends Model implements EsseGroupContract
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'essegroup';

    protected $fillable = [
        'content'
    ];

}