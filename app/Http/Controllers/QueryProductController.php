<?php

namespace FleetCart\Http\Controllers;

// use Exception;
// use FleetCart\Install\App;
// use FleetCart\Install\Store;
// use FleetCart\Install\Database;
// use FleetCart\Install\Requirement;
// use Illuminate\Routing\Controller;
// use FleetCart\Install\AdminAccount;
// use FleetCart\Http\Requests\InstallRequest;
// use Jackiedo\DotenvEditor\Facades\DotenvEditor;
// use FleetCart\Http\Middleware\RedirectIfInstalled;

use FleetCart\QueryProduct;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class QueryProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.query_product.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.query_product.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $query_product = QueryProduct::create($request->except('_token'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \FleetCart\QueryProduct  $queryProduct
     * @return \Illuminate\Http\Response
     */
    public function show(QueryProduct $queryProduct)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \FleetCart\QueryProduct  $queryProduct
     * @return \Illuminate\Http\Response
     */
    public function edit(QueryProduct $queryProduct)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \FleetCart\QueryProduct  $queryProduct
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, QueryProduct $queryProduct)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \FleetCart\QueryProduct  $queryProduct
     * @return \Illuminate\Http\Response
     */
    public function destroy(QueryProduct $queryProduct)
    {
        //
    }
}
