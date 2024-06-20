@extends('admin::layout')

@component('admin::components.page.header')
    @slot('title', 'Query Products')

    <li class="active">Query Products</li>
@endcomponent

@component('admin::components.page.index_table')
    @slot('buttons', ['create'])
    @slot('resource', 'flash_sales')
    @slot('name', trans('flashsale::flash_sales.flash_sale'))

    @component('admin::components.table')
        @slot('thead')
            <tr>
                @include('admin::partials.table.select_all')

                <th>{{ trans('admin::admin.table.id') }}</th>
                <th>Name</th>
                <th data-sort>{{ trans('admin::admin.table.created') }}</th>
            </tr>
        @endslot
    @endcomponent
@endcomponent



@push('scripts')
    <script>
        DataTable.setRoutes('#flash_sales-table .table', {
            index: '{{ "query-product.index" }}',
        });

        new DataTable('#transactions-table .table', {
            columns: [
                { data: 'id' },
                { data: 'name' },
                { data: 'created', name: 'created_at' },
            ],
        });
    </script>
@endpush