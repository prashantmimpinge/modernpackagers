<?php

namespace Modules\QueryProduct\Providers;

use Modules\Support\Traits\AddsAsset;
use Illuminate\Support\ServiceProvider;
use Modules\Admin\Ui\Facades\TabManager;
use Modules\QueryProduct\Admin\QueryProductTabs;

class QueryProductServiceProvider extends ServiceProvider
{
    use AddsAsset;

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        TabManager::register('flash_sales', QueryProductTabs::class);

        $this->addAdminAssets('admin.flash_sales.(create|edit)', ['admin.media.js', 'admin.queryproduct.js']);
    }
}
