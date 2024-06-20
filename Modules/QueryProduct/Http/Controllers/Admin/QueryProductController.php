<?php

namespace Modules\QueryProduct\Http\Controllers\Admin;

use Modules\Admin\Traits\HasCrudActions;
use Modules\QueryProduct\Entities\QueryProduct;
use Modules\QueryProduct\Http\Requests\SaveQueryProductRequest;

class QueryProductController
{
    use HasCrudActions;

    /**
     * Model for the resource.
     *
     * @var string
     */
    protected $model = QueryProduct::class;

    /**
     * Label of the resource.
     *
     * @var string
     */
    protected $label = 'queryproduct::query_product.flash_sale';

    /**
     * View path of the resource.
     *
     * @var string
     */
    protected $viewPath = 'queryproduct::admin.query_product';

    /**
     * Form requests for the resource.
     *
     * @var array
     */
    protected $validation = SaveQueryProductRequest::class;
}
