<?php

namespace Webkul\Core\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Webkul\Core\Contracts\TechService as TechServiceContract;

class TechService extends Model implements TechServiceContract
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'techservices';

    protected $fillable = [
        'name', 'address', 'tel', 'mobile', 'country', 'city'
    ];
}