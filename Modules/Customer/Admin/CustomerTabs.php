<?php

namespace Modules\Customer\Admin;

use Modules\Admin\Ui\Tab;
use Modules\Admin\Ui\Tabs;

class CustomerTabs extends Tabs
{
    /**
     * Indicate that submit button should add offset class.
     *
     * @var bool
     */
    protected $buttonOffset = false;

    public function make()
    {
        $this->group('customer_information', trans('customer::customers.tabs.group.customer_information'))
            ->active()
            ->add($this->products())
            ->add($this->settings());
    }

    private function products()
    {
        return tap(new Tab('products', trans('customer::customers.tabs.products')), function (Tab $tab) {
            $tab->active();
            $tab->weight(5);

            $tab->fields([
                'products.*.product_id',
                'products.*.end_date',
                'products.*.price',
                'products.*.quantity',
            ]);

            $tab->view('customer::admin.customers.tabs.products');
        });
    }

    private function settings()
    {
        return tap(new Tab('settings', trans('customer::customers.tabs.settings')), function (Tab $tab) {
            $tab->weight(10);
            $tab->fields(['campaign_name']);
            $tab->view('customer::admin.customers.tabs.settings');
        });
    }
}
