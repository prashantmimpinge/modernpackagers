<?php

namespace Modules\Page\Http\Controllers;

class HomeController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('public.home.index');
    }
    public function customizedpackaging()
    {
        return view('public.customizedpackaging.index');
    }
}
