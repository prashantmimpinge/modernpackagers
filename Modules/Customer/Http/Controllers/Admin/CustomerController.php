<?php

namespace Modules\Customer\Http\Controllers\Admin;

use Modules\Admin\Traits\HasCrudActions;
use Modules\Customer\Entities\FlashSale;
use Modules\Customer\Http\Requests\SaveFlashSaleRequest;

class CustomerController
{
    use HasCrudActions;

    /**
     * Model for the resource.
     *
     * @var string
     */
    protected $model = Customer::class;

    /**
     * Label of the resource.
     *
     * @var string
     */
    protected $label = 'customer::customers.customer';

    /**
     * View path of the resource.
     *
     * @var string
     */
    protected $viewPath = 'customer::admin.customers';

    /**
     * Form requests for the resource.
     *
     * @var array
     */
    protected $validation = SaveFlashSaleRequest::class;
}
