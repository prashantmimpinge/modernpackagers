<?php

namespace Modules\QueryProduct\Admin;

use Modules\Admin\Ui\Tab;
use Modules\Admin\Ui\Tabs;

class QueryProductTabs extends Tabs
{
    /**
     * Indicate that submit button should add offset class.
     *
     * @var bool
     */
    protected $buttonOffset = false;

    public function make()
    {
        $this->group('query_product_information', trans('queryproduct::query_products.tabs.group.query_product_information'))
            ->active()
            ->add($this->products())
            ->add($this->settings());
    }

    private function products()
    {
        return tap(new Tab('products', trans('queryproduct::query_products.tabs.products')), function (Tab $tab) {
            $tab->active();
            $tab->weight(5);

            $tab->fields([
                'products.*.product_id',
                'products.*.end_date',
                'products.*.price',
                'products.*.quantity',
            ]);

            $tab->view('queryproduct::admin.query_products.tabs.products');
        });
    }

    private function settings()
    {
        return tap(new Tab('settings', trans('queryproduct::query_products.tabs.settings')), function (Tab $tab) {
            $tab->weight(10);
            $tab->fields(['campaign_name']);
            $tab->view('queryproduct::admin.query_products.tabs.settings');
        });
    }
}
