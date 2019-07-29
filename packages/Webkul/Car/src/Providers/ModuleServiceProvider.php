<?php

namespace Webkul\Car\Providers;

use Konekt\Concord\BaseModuleServiceProvider;

class ModuleServiceProvider extends BaseModuleServiceProvider
{
    protected $models = [
        \Webkul\Car\Models\Car::class,
        \Webkul\Car\Models\CarTranslation::class,
    ];
}