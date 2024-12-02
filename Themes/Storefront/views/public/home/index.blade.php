@extends('public.layout')

@section('title', setting('store_tagline'))

@section('content')
    @include('public.home.sections.slider')
    <div class="container my-5 flash-saple">
        <div class="row mt-5">
            <div class="d-flex justify-content-between align-items-center">
                <h2 class="title-pro">Best Sellers</h2>
                <a href="#" class="btn btn-danger rounded">View All</a>
            </div>
            @if (setting('storefront_product_tabs_2_section_enabled'))
                <product-tabs-two :data="{{ json_encode($tabProductsTwo) }}"></product-tabs-two>
            @endif
        </div>
    </div>
    @include('public.home.sections.banner')
    @include('public.home.sections.categories')

    <!-- @if (setting('storefront_featured_categories_section_enabled'))
        <featured-categories :data="{{ json_encode($featuredCategories) }}"></featured-categories>
    @endif -->

    <!-- @if (setting('storefront_features_section_enabled'))
        <home-features :features="{{ json_encode($features) }}"></home-features>
    @endif -->

    @if (setting('storefront_product_tabs_1_section_enabled'))
        <product-tabs-one :data="{{ json_encode($productTabsOne) }}"></product-tabs-one>
    @endif

    <!-- @if (setting('storefront_top_brands_section_enabled') && $topBrands->isNotEmpty())
        <top-brands :top-brands="{{ json_encode($topBrands) }}"></top-brands>
    @endif

    @if (setting('storefront_flash_sale_and_vertical_products_section_enabled'))
        <flash-sale-and-vertical-products :data="{{ json_encode($flashSaleAndVerticalProducts) }}"></flash-sale-and-vertical-products>
    @endif

    @if (setting('storefront_two_column_banners_enabled'))
        <banner-two-column :data="{{ json_encode($twoColumnBanners) }}"></banner-two-column>
    @endif

    @if (setting('storefront_product_grid_section_enabled'))
        <product-grid :data="{{ json_encode($productGrid) }}"></product-grid>
    @endif

    @if (setting('storefront_three_column_banners_enabled'))
        <banner-three-column :data="{{ json_encode($threeColumnBanners) }}"></banner-three-column>
    @endif

    @if (setting('storefront_product_tabs_2_section_enabled'))
        <product-tabs-two :data="{{ json_encode($tabProductsTwo) }}"></product-tabs-two>
    @endif

    @if (setting('storefront_one_column_banner_enabled'))
        <banner-one-column :banner="{{ json_encode($oneColumnBanner) }}"></banner-one-column>
    @endif -->
@endsection
