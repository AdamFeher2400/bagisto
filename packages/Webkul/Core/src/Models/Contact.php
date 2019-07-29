<?php

namespace Webkul\Core\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Webkul\Core\Contracts\Contact as ContactContract;

class Contact extends Model implements ContactContract
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'contacts';

    protected $fillable = [
        'name', 'address', 'tel', 'fax', 'domain', 'email'
    ];
}