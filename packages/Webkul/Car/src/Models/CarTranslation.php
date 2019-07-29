<?php

namespace Webkul\Car\Models;

use Illuminate\Database\Eloquent\Model;
use Webkul\Car\Contracts\CarTranslation as CarTranslationContract;

class CarTranslation extends Model implements CarTranslationContract
{
    public $timestamps = false;

    protected $fillable = ['name', 'description', 'slug', 'meta_title', 'meta_description', 'meta_keywords', 'locale_id'];
}