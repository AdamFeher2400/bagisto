<?php

namespace Webkul\Core\Providers;

use Konekt\Concord\BaseModuleServiceProvider;

class ModuleServiceProvider extends BaseModuleServiceProvider
{
    protected $models = [
        \Webkul\Core\Models\Banner::class,
        \Webkul\Core\Models\News::class,
        \Webkul\Core\Models\EsseGroup::class,
        \Webkul\Core\Models\TechService::class,
        \Webkul\Core\Models\ProdTechService::class,
        \Webkul\Core\Models\Payment::class,
        \Webkul\Core\Models\Contact::class,
        \Webkul\Core\Models\Channel::class,
        \Webkul\Core\Models\CoreConfig::class,
        \Webkul\Core\Models\Country::class,
        \Webkul\Core\Models\CountryState::class,
        \Webkul\Core\Models\Currency::class,
        \Webkul\Core\Models\CurrencyExchangeRate::class,
        \Webkul\Core\Models\Locale::class,
        \Webkul\Core\Models\Slider::class,
        \Webkul\Core\Models\SubscribersList::class
    ];
}