<header class="header header-2 header-intro-clearance">
    <div class="header-top">
        <div class="container">
            <div class="header-col">
                <p>Welcome to Modern Packagers</p>
            </div>

        </div>
    </div><!-- End .header-top -->

    <div class="header-middle">
        <div class="container">
            <div class="header-left">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"> <i class="icon-bars"></i></span>
            </button>
                
                <a href="{{ route('home') }}" class="logo">
                    <img src="{{ v(Theme::url('public/images/logo.png')) }}" alt="Logo">
                </a>
            </div><!-- End .header-left -->
            <div class="header-right">
            <div class="header-search-r">
                <div class="header-search header-search-extended header-search-visible header-search-no-radius d-none d-lg-block">
                    <a href="#" class="search-toggle" role="button"><i class="icon-search"></i></a>
                    <form action="#" method="get">
                        <div class="header-search-wrapper search-wrapper-wide">
                            
                            <input type="search" class="form-control" name="q" id="q" placeholder="What are you looking for?" required>
                            <button class="btn btn-primary" type="submit"><i class="icon-search"></i></button>
                        </div><!-- End .header-search-wrapper -->
                    </form>
                </div><!-- End .header-search -->
            </div>

                <div class="wishlist">
                    <a href="{{ route('account.wishlist.index') }}" title="Wishlist">
                        <div class="icon">
                            <i class="icon-heart-o"></i>
                        </div>
                    </a>
                </div><!-- End .compare-dropdown -->

                <div class="dropdown cart-dropdown">
                    <a href="#" class="dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static">
                        <div class="icon">
                            <i class="icon-shopping-cart"></i>
                            <span class="cart-count" v-text="cart.quantity"></span>
                        </div>
                    </a>
                </div><!-- End .cart-dropdown -->
                <!-- @auth
                    <li>
                        <a href="{{ route('account.dashboard.index') }}">
                            <i class="las la-user"></i>
                            {{ trans('storefront::layout.account') }}
                        </a>
                    </li>
                @else
                    <li>
                        <a href="{{ route('login') }}">
                            <i class="las la-sign-in-alt"></i>
                            {{ trans('storefront::layout.login') }}
                        </a>
                    </li>
                @endauth -->
                <div class="account">
                    <a href="{{ route('account.dashboard.index') }}" title="My account">
                        <div class="icon">
                            <i class="icon-user"></i>
                        </div>
                    </a>
                </div><!-- End .compare-dropdown -->
                
            </div><!-- End .header-right -->
        </div><!-- End .container -->
    </div><!-- End .header-middle -->

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="header-bottom sticky-header collapse navbar-collapse" id="navbarNav">
            <div class="container">
                <div class="header-nav navbar-nav">
                    <nav class="main-nav">
                        <ul class="menu sf-arrows">
                            @if ($categoryMenu->menus()->isNotEmpty())
                                @foreach ($categoryMenu->menus() as $menu)
                                    @include('public.layout.navigation.newmenu', ['type' => 'category_menu'])
                                @endforeach
                            @endif
                            
                            <li>
                                <a href="#" class="sf-with-ul">Customized Packaging</a>
                            </li>
                        </ul><!-- End .menu -->
                    </nav><!-- End .main-nav -->
                </div><!-- End .header-center -->

            </div><!-- End .container -->
        </div><!-- End .header-bottom -->
    </nav>
</header><!-- End .header -->