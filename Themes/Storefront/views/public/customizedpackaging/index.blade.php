@extends('public.layout')

@section('title', setting('store_tagline'))

@section('content')
@includeUnless(is_null($slider), 'public.customizedpackaging.sections.slider')
<div class="customizepackaging-front">
    <div class="container">

        <div id="section1">
            <div class="welcome">
                <h2>WELCOME TO</h2>
                <h1>MODERN PACKAGERS</h1>
            </div>

            <section class="section-profile">
                <div class="row">
                    <div class="column1">
                        <img src="/storage/media/S.UPENDER-SINGH.png" width="170" height="190" alt="">
                        <h3>S.UPENDER SINGH</h3>
                        <p>Managing Director</p>
                    </div>
                    <div class="column2">
                        <h2>Introduction</h2>
                        <p>These products are highly demanded in different industries for diverse packaging applications.
                            We manufacture these products by making use of superior quality material with the help of
                            sophisticated technology in compliance with standard operating Procedures and quality benchmark. </p>
                        <p>These products are known for their features like smooth finish,tear resistance,high strength,water
                            proof and durability. Further, these products are available in various designs, sizes and shapes as
                            per the specific requirements of our clients. Apart from this, we are also engaged in providing
                            Packaging Box Designing Services and digital printing services to our clients.</p>
                    </div>
                </div>
            </section>

        </div>
        <!-- Introduction Ends -->

        <div id="section_quote">
            <section class="section-quote">
                    <h5 style="text-align:center;padding:0 15px">Get a quote for your Custom Printed Packaging Requirement for your business. <a href="https://docs.google.com/forms/d/e/1FAIpQLSfaFL2JoErF0KUlY_k3yZ3zOLlmM5n_VEAH_DmD7s4m2fHAkw/viewform?usp=sf_link" target="_blank">Click here and fill the form</a>, we will get back to you.
                    </h5>
                    <!-- <a href="https://docs.google.com/forms/d/e/1FAIpQLSfaFL2JoErF0KUlY_k3yZ3zOLlmM5n_VEAH_DmD7s4m2fHAkw/viewform?usp=sf_link" target="_blank" class="btn btn-primary" style="background-color: #000;">
                        Get Quote
                    </a> -->
            </section>

        </div>

        <div id="section2">
            <div class="welcome">
                <h1>Consumer Packaging</h1>
            </div>
            <div class="product-list">
                <div class="gallery">

                    <div class="thumbnail"><a href="#"><img src="/storage/media/printed-corrugated-box.jpg" alt="" class="cards"></a>

                        <h4><a href="https://docs.google.com/forms/d/e/1FAIpQLSfaFL2JoErF0KUlY_k3yZ3zOLlmM5n_VEAH_DmD7s4m2fHAkw/viewform?usp=sf_link">Printed Corrugated Boxes</a></h4>
                        <p>One of our finest products are printed corrugated boxes with which are suitable for heavy and
                            breakable products to be displayed on shelf at a retail outlet. Top Face displays the brand and
                            product while the rest corrugated layers add to the strength of the material.</p>
                    </div>

                    <div class="thumbnail"> <a href="#"><img src="/storage/media/monocarton.jpg" alt="" class="cards"></a>
                        <h4><a href="https://docs.google.com/forms/d/e/1FAIpQLSfaFL2JoErF0KUlY_k3yZ3zOLlmM5n_VEAH_DmD7s4m2fHAkw/viewform?usp=sf_link">Mono Cartons</a></h4>
                        <p>These are single layered box either of fine board or duplex board with printing and post printing
                            effects suitable for light and small products.</p>
                    </div>

                    <div class="thumbnail"> <a href="#"><img src="/storage/media/Shopping-Carry-bags.jpg" alt="" class="cards"></a>
                        <h4><a href="https://docs.google.com/forms/d/e/1FAIpQLSfaFL2JoErF0KUlY_k3yZ3zOLlmM5n_VEAH_DmD7s4m2fHAkw/viewform?usp=sf_link">Shopping Carry bags</a>
                        </h4>
                        <p>Eco friendly yet modern Paper bags are inline with the latest style and trend suitable for carrying
                            products sold at a retail outlet. These paper bags not only helps in carrying products but also helps in
                            branding</p>
                    </div>

                    <div class="thumbnail"> <a href="#"><img src="/storage/media/display-boxes.jpg" alt="" class="cards"></a>
                        <h4><a href="https://docs.google.com/forms/d/e/1FAIpQLSfaFL2JoErF0KUlY_k3yZ3zOLlmM5n_VEAH_DmD7s4m2fHAkw/viewform?usp=sf_link">Display Stands</a></h4>
                        <p>Corrugated Display stands are light and of low cost then MDF and metal display stands. They are
                            easily foldable and can be stored easily after making in bulk</p>
                    </div>
                </div>
            </div>
        </div>
        <div id="section3">
            <div class="welcome">
                <h1>Marketing Literature</h1>
            </div>
            <div class="product-list">
                <div class="gallery">
                    <div class="thumbnail"><a href="#"><img src="/storage/media/pemplat.jpg" alt="" class="cards"></a>
                        <h4><a href="https://docs.google.com/forms/d/e/1FAIpQLSfaFL2JoErF0KUlY_k3yZ3zOLlmM5n_VEAH_DmD7s4m2fHAkw/viewform?usp=sf_link">Pamphlets</a></h4>
                        <p>Promotional material like pamphlets can be made with inhouse designing and delivered at fast
                            delivery.</p>
                    </div>
                    <div class="thumbnail"> <a href="#"><img src="/storage/media/3fold-brochers.jpg" alt="" class="cards"></a>
                        <h4><a href="https://docs.google.com/forms/d/e/1FAIpQLSfaFL2JoErF0KUlY_k3yZ3zOLlmM5n_VEAH_DmD7s4m2fHAkw/viewform?usp=sf_link">3 Fold Brochures</a></h4>
                        <p>From restaurant menu to product catalogue, 3 fold brochure can help reduce the cost from binding
                            brochures and suitable for quick production and disbursal</p>
                    </div>
                    <div class="thumbnail"><a href="#"><img src="/storage/media/carporate-brocture.jpg" alt="" class="cards"></a>
                        <h4><a href="https://docs.google.com/forms/d/e/1FAIpQLSfaFL2JoErF0KUlY_k3yZ3zOLlmM5n_VEAH_DmD7s4m2fHAkw/viewform?usp=sf_link">Corporate Brochures</a></h4>
                        <p>High Quality Corporate brochures with post press special effects like embossing, spot uv, leaf
                            printing, thermal lamination etc.</p>
                    </div>

                    <div class="thumbnail"> <a href="#"><img src="/storage/media/stikars.jpg" alt="" class="cards"></a>
                        <h4><a href="https://docs.google.com/forms/d/e/1FAIpQLSfaFL2JoErF0KUlY_k3yZ3zOLlmM5n_VEAH_DmD7s4m2fHAkw/viewform?usp=sf_link">Posters Stickers</a></h4>
                        <p>Stickers are really helpful in branding and displaying information at various packaging. They are
                            suitable for branding on non printed and standard packaging items.</p>
                    </div>
                </div>
            </div>
        </div>
        <div id="section4">
            <div class="welcome">
                <h1>Industrial Packaging</h1>
            </div>
            <div class="product-list">
                <div class="gallery">
                    <div class="thumbnail"><a href="#"><img src="/storage/media/master-cartons.jpg" alt="" class="cards"></a>
                        <h4><a href="https://docs.google.com/forms/d/e/1FAIpQLSfaFL2JoErF0KUlY_k3yZ3zOLlmM5n_VEAH_DmD7s4m2fHAkw/viewform?usp=sf_link">Master Cartons</a></h4>
                        <p>Outer cartons are required to ship the material through transport from one place to other across the region or countries. They keep the inner cartons and packing safe from damage and pilferage.</p>
                    </div>
                    <div class="thumbnail"> <a href="#"><img src="/storage/media/sapreator.png" alt="" class="cards"></a>
                        <h4><a href="https://docs.google.com/forms/d/e/1FAIpQLSfaFL2JoErF0KUlY_k3yZ3zOLlmM5n_VEAH_DmD7s4m2fHAkw/viewform?usp=sf_link">Corner and Separators</a></h4>
                        <p>Corners are used to add to the corner strength of the carton while stacking cartons one above the
                            other when the weight inside the carton is very high and you want to avoid damage to below cartons
                            from weight above them While separators helps packing brittle items like glass packing etc.</p>
                    </div>
                    <div class="thumbnail"> <a href="#"><img src="/storage/media/rool.png" alt="" class="cards"></a>
                        <h4><a href="https://docs.google.com/forms/d/e/1FAIpQLSfaFL2JoErF0KUlY_k3yZ3zOLlmM5n_VEAH_DmD7s4m2fHAkw/viewform?usp=sf_link">Coruugated Rolls</a></h4>
                        <p>Cheapest way to pack things to avoid scratches, wear and tear etc during transportation</p>
                    </div>
                    <div class="thumbnail"> <a href="#"><img src="/storage/media/HDPE-Cartons.png" alt="" class="cards"></a>
                        <h4><a href="https://docs.google.com/forms/d/e/1FAIpQLSfaFL2JoErF0KUlY_k3yZ3zOLlmM5n_VEAH_DmD7s4m2fHAkw/viewform?usp=sf_link">HDPE Cartons</a></h4>
                        <p>These are used to pack heavy duty products and there shipment. HDPE layer at the top adds great resistance against wear and tear and breakage</p>
                    </div>
                </div>
            </div>
        </div>

        <div id="section5">
            <div class="welcome">
                <h1>Brand Boxes</h1>
            </div>
            <div class="product-list">
                <div class="gallery">
                    <div class="center">
                        <h4>Brand Boxes are beautiful double sided printed shipping boxes specially used for ecommerce of branded products or corporate product offerings or Corporate Giftings. They add special aesthetic value by providing personal messages at the inside and adds to the pleasant experience for the end user.</h4>
                    </div>
                    <div class="thumbnail"><a href="#"><img src="/storage/media/brand-box02.jpg" alt="" class="cards"></a>
                        <h4><a href="https://docs.google.com/forms/d/e/1FAIpQLSfaFL2JoErF0KUlY_k3yZ3zOLlmM5n_VEAH_DmD7s4m2fHAkw/viewform?usp=sf_link">Star Products</a></h4>
                    </div>

                    <div class="thumbnail"> <a href="#"><img src="/storage/media/ela-brand-box.jpg" alt="" class="cards"></a>
                        <h4><a href="https://docs.google.com/forms/d/e/1FAIpQLSfaFL2JoErF0KUlY_k3yZ3zOLlmM5n_VEAH_DmD7s4m2fHAkw/viewform?usp=sf_link">Star Products</a></h4>
                    </div>

                    <div class="thumbnail"> <a href="#"><img src="/storage/media/brand-box03.jpg" alt="" class="cards"></a>
                        <h4><a href="https://docs.google.com/forms/d/e/1FAIpQLSfaFL2JoErF0KUlY_k3yZ3zOLlmM5n_VEAH_DmD7s4m2fHAkw/viewform?usp=sf_link">Star Products</a></h4>
                    </div>
                    <div class="thumbnail"> <a href="#"><img src="/storage/media/brand-box01.jpg" alt="" class="cards"></a>
                        <h4><a href="https://docs.google.com/forms/d/e/1FAIpQLSfaFL2JoErF0KUlY_k3yZ3zOLlmM5n_VEAH_DmD7s4m2fHAkw/viewform?usp=sf_link">Star Products</a></h4>
                    </div>
                </div>
            </div>
        </div>
        <div id="section6">
            <div class="welcome">
                <h1>English Board Packing and Puzzle Games</h1>
            </div>
            <div class="product-list">

                <div class="gallery">

                    <div class="thumbnail"><a href="#"><img src="/storage/media/puzzal-game01.jpg" alt="" class="cards"></a>

                        <h4><a href="https://docs.google.com/forms/d/e/1FAIpQLSfaFL2JoErF0KUlY_k3yZ3zOLlmM5n_VEAH_DmD7s4m2fHAkw/viewform?usp=sf_link">Puzzle for Kids</a></h4>
                        <p>We specialize in making hard board puzzles which are a beautiful way of learning for small kids.</p>
                    </div>

                    <div class="thumbnail"> <a href="#"><img src="/storage/media/puzzal-game02.jpg" alt="" class="cards"></a>
                        <h4><a href="https://docs.google.com/forms/d/e/1FAIpQLSfaFL2JoErF0KUlY_k3yZ3zOLlmM5n_VEAH_DmD7s4m2fHAkw/viewform?usp=sf_link">Puzzle for Kids</a></h4>
                        <p>hard bord puzzle game they need to be safe and harmless. Kids are prone to swallow some items, so it would help if the products contain organic materials.</p>
                    </div>

                    <div class="thumbnail"> <a href="#"><img src="/storage/media/Customized-Boxes.jpg" alt="" class="cards"></a>
                        <h4><a href="https://docs.google.com/forms/d/e/1FAIpQLSfaFL2JoErF0KUlY_k3yZ3zOLlmM5n_VEAH_DmD7s4m2fHAkw/viewform?usp=sf_link">English Board</a></h4>
                        <p>We have started making English board boutique luxury packing boxes for elite products and brands.
                            These are suitable for an elite consumer target segments who are looking for niche products in each category</p>
                    </div>

                    <div class="thumbnail"> <a href="#"><img src="/storage/media/puzzal-box.jpg" alt="" class="cards"></a>
                        <h4><a href="https://docs.google.com/forms/d/e/1FAIpQLSfaFL2JoErF0KUlY_k3yZ3zOLlmM5n_VEAH_DmD7s4m2fHAkw/viewform?usp=sf_link">Puzzle Boxes</a></h4>
                        <p>hard bord puzzle game they need to be safe and harmless. Kids are prone to swallow some items, so it would help if the products contain organic materials.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection