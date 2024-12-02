<?php

namespace Modules\Customer\Providers;

use Modules\Support\Traits\AddsAsset;
use Illuminate\Support\ServiceProvider;
use Modules\Admin\Ui\Facades\TabManager;
use Modules\Customer\Admin\CustomerTabs;

class CustomerServiceProvider extends ServiceProvider
{
    use AddsAsset;

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        TabManager::register('customer', CustomerTabs::class);

        // $this->addAdminAssets('admin.flash_sales.(create|edit)', ['admin.media.js', 'admin.flashsale.js']);
    }
}
