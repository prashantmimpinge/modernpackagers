<div class="container mt-5">
    <h2 class="mb-4 title-pro cat-title">All Categories</h2>
    <div class="row">
        <!-- Large Image on Left -->
        <div class="col-lg-6 col-md-12">
            <div class="category-card pack-img">
                <img src="{{ v(Theme::url('public/images/cat-img-01.png')) }}" alt="Shop Image">
                <div class="category_text fast-food">
                    <h5>Fast Food Packaging</h5>
                    <a href="{{ route('categories.products.index', ['category' => 'fast-food']) }}" class="btn">Shop Now</a>
                </div>
            </div>
        </div>
        <!-- Smaller Categories on Right -->
        <div class="col-lg-6 col-md-12 bakerybox">
            
            <div class="category-card">
                <img src="{{ v(Theme::url('public/images/cat-img-02.png')) }}" alt="Bakery Box"> 
                <div class="category_text bakery-title">
                    <h5>Bakery Box</h5>
                    <a href="{{ route('categories.products.index', ['category' => 'bakery-box']) }}" class="btn">Shop Now</a>
                </div>
            </div>
        
            <div class="category-card com-box">
                <img src="{{ v(Theme::url('public/images/cat-img-03.png')) }}" alt="E-Commerce Boxes">
                <div class="category_text box-com"> <h5>E-Commerce Boxes</h5>
                <a href="{{ route('categories.products.index', ['category' => 'e-commerce-boxes;%20ecommerce%20box;%20courier;%20amazon;%20online']) }}" class="btn">Shop Now</a></div>
            </div>
        </div>
    </div>
                
    <div class="row mt-4 fruit-row">
        <div class="col-lg-4 col-md-4">
            <div class="category-card">
                <img src="{{ v(Theme::url('public/images/cat-img-04.png')) }}" alt="Fruit Box Packaging">
                <div class="category_text fruit-box"> <h5>Fruit Box Packaging</h5>
                <span><a href="{{ route('categories.products.index', ['category' => 'fruit-box-packaging']) }}" class="btn">Shop Now</a></span></div>
            </div>
        </div>
        <div class="col-lg-4 col-md-4">
            <div class="category-card">
                <img src="{{ v(Theme::url('public/images/cat-img-05.png')) }}" alt="Restaurant Plastic Packaging"> 
                <div class="category_text rest-rant"> <h5>Restaurant Plastic Packaging</h5>
                <a href="{{ route('categories.products.index', ['category' => 'restaurant-plastic-packaging']) }}" class="btn">Shop Now</a> </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-4">
            <div class="category-card">
                <img src="{{ v(Theme::url('public/images/cat-img-06.png')) }}" alt="Carry Bags"> 
                <div class="category_text fruit-box"> <h5>Carry Bags</h5>
                <a href="{{ route('categories.products.index', ['category' => 'carry-bags']) }}" class="btn">Shop Now</a></div>
            </div>
        </div>
    </div>
</div>