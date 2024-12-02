
    <div class="icon-orders">
        <div class="container">
            <div class="row">
                <div class="col-sm-6 col-lg-4">
                    <div class="icon-box icon-box-side">
                        <span class="icon-box-icon text-dark">
                            <img src="{{ v(Theme::url('public/images/free.png')) }}"> 
                        </span>
                        <div class="icon-box-content">
                            <h3 class="icon-box-title">FREE AND FAST DELIVERY</h3><!-- End .icon-box-title -->
                            <p>Free delivery for all orders over ₹140</p>
                        </div><!-- End .icon-box-content -->
                    </div><!-- End .icon-box -->
                </div><!-- End .col-sm-6 col-lg-3 -->
                <div class="col-sm-6 col-lg-4">
                    <div class="icon-box icon-box-side">
                        <span class="icon-box-icon text-dark">
                            <img src="{{ v(Theme::url('public/images/services.png')) }}">
                        </span>

                        <div class="icon-box-content">
                            <h3 class="icon-box-title">24/7 CUSTOMER SERVICE</h3><!-- End .icon-box-title -->
                            <p>Friendly 24/7 customer support</p>
                        </div><!-- End .icon-box-content -->
                    </div><!-- End .icon-box -->
                </div><!-- End .col-sm-6 col-lg-3 -->

                <div class="col-sm-6 col-lg-4">
                    <div class="icon-box icon-box-side">
                        <span class="icon-box-icon text-dark">
                            <img src="{{ v(Theme::url('public/images/mony-back.png')) }}">
                        </span>

                        <div class="icon-box-content">
                            <h3 class="icon-box-title">MONEY BACK GUARANTEE</h3><!-- End .icon-box-title -->
                            <p>We return money within 30 days</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main><!-- End .main -->
<!-- Footer -->
<footer class="footer">
    <div class="container">
	
        <div class="row">
            <!-- Contact Us -->
            <div class="col-md-3 pr-right">
                <h5>{{ trans('storefront::layout.contact_us') }}</h5>
                @if (setting('store_phone'))
                    <p><span><i class="fa-solid fa-phone"></i></span> {{ setting('store_phone') }}</p>
                @endif
                @if (setting('store_email'))
                    <p><span><i class="fa-solid fa-envelope"></i></span>{{ setting('store_email') }}</p>
                @endif
                @if (setting('storefront_address'))
                    <p><span><i class="fa-solid fa-location-dot"></i></span>{{ setting('storefront_address') }}</p>
                @endif
            </div>
            <!-- Account -->
            <div class="col-md-3">
                <h5>Account</h5>
                <ul class="list-unstyled">
                    <li><a href="{{ route('account.dashboard.index') }}">
                        {{ trans('storefront::account.pages.dashboard') }}
                    </a></li>
                    <li><a href="{{ route('login') }}">Login / Register</a></li>
                    <li><a href="#">Cart</a></li>
                    <li><a href="{{ route('account.wishlist.index') }}">Wishlist</a></li>
                    <li><a href="#">Shop</a></li>
                </ul>
            </div>
            <!-- Quick Link -->
            <div class="col-md-3">
                <h5>Quick Link</h5>
                <ul class="list-unstyled">
                    <li><a href="{{ url('terms-and-conditions') }}">Terms And Conditions</a></li>
                    <li><a href="{{ url('privacy') }}">Privacy Policy</a></li>
                    <li><a href="#">FAQ</a></li>
                    <li><a href="{{ route('contact.create') }}">Contact</a></li>
                </ul>
            </div>
            <!-- Company Information -->
            <div class="col-md-3">
                <h5>Company Information</h5>
                <ul class="list-unstyled">
                    <li><a href="{{ url('profile') }}">About Us</a></li>
                    <li><a href="#">Blog</a></li>
                    <li><a href="#">Sitemap</a></li>
                </ul>
                <div class="social-links">
                    <a href="#"><i class="bi bi-facebook"></i></a>
                    <a href="#"><i class="bi bi-twitter"></i></a>
                    <a href="#"><i class="bi bi-instagram"></i></a>
                    <a href="#"><i class="bi bi-linkedin"></i></a>
                </div>
            </div>
        </div>
        <div class="text-center mt-3 copyright">
            &copy; Copyright modernpackagers 2024. All rights reserved.
        </div>
    </div>
</footer>