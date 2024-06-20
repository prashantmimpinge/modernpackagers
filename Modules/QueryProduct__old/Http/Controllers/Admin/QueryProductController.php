<?php

namespace Modules\QueryProduct\Http\Controllers\Admin;

use Modules\QueryProduct\Entities\QueryProduct;
use Modules\Admin\Traits\HasCrudActions;
// use Modules\Product\Http\Requests\SaveProductRequest;

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
    protected $label = 'queryproduct::query-products.product';

    /**
     * View path of the resource.
     *
     * @var string
     */
    protected $viewPath = 'queryproduct::admin.query-products';

    /**
     * Form requests for the resource.
     *
     * @var array|string
     */
    // protected $validation = SaveProductRequest::class;
}
