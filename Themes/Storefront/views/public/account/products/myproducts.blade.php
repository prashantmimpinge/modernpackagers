@extends('public.account.layout')

@section('title', trans('storefront::account.pages.my_products'))

@section('account_breadcrumb')
    <li class="active">{{ trans('storefront::account.pages.my_products') }}</li>
@endsection

@section('panel')
    <div class="panel">
        <div class="panel-header">
            <h4>{{ trans('storefront::account.pages.my_products') }}</h4>
        </div>
    </div>
@endsection
