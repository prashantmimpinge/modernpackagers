@extends('admin::layout')

@component('admin::components.page.header')
    @slot('title', trans('admin::resource.create', ['resource' => 'Query Product']))

    <li><a href="{{ route('query-product.index') }}">Query Product</a></li>
    <li class="active">{{ trans('admin::resource.create', ['resource' => 'Query Product']) }}</li>
@endcomponent

@section('content')
    <form method="POST" action="{{ route('query-product.store') }}" class="form-horizontal" id="flash-sale-create-form" novalidate>
        {{ csrf_field() }}
        <div class="" style="background: #fff;padding: 20px;">
            <div class="row">
                <div class="col-md-8">
                    <div class="form-group">
                        <label for="name" class="col-md-3 control-label text-left">Name<span class="m-l-5 text-red">*</span></label>
                        <div class="col-md-9">
                            <input name="name" class="form-control" id="name" value="" type="text" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="description" class="col-md-3 control-label text-left">Description</label>
                        <div class="col-md-9">
                            <textarea name="description" class="form-control" id="description"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="slug" class="col-md-3 control-label text-left">Slug<span class="m-l-5 text-red">*</span></label>
                        <div class="col-md-9">
                            <input name="slug" class="form-control" id="slug" value="" type="text" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="featured-image" class="col-md-3 control-label text-left">Featured Image<span class="m-l-5 text-red">*</span></label>
                        <div class="col-md-9">
                            <input name="featured_image" class="form-control" id="featured-image" value="" type="file" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class=" col-md-10">
                            <button type="submit" class="btn btn-primary" data-loading="">
                                Save
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection