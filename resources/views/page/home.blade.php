@extends('page.master')
@section('content')
<div id="main">
    <section>
        <div class="main-slider-wrapper">
            <div class="main-slider owl-carousel owl-carousel-inset">


                @foreach( $slideList as $slide )
                <div class="main-slider-item">
                    <div class="main-slider-image">
                        <img src="{{ asset('img/slides/' . $slide->image) }}" alt="">
                    </div>

                    <div class="main-slider-text">

                        <div class="fp-table">
                            <div class="fp-table-cell center">
                                <div class="container">
                                    <h3 class="small">{{ $slide->title }}</h3>
                                    <h2 class="small"><?php echo html_entity_decode($slide->content) ?></h2>

                                    <div class="button">
                                        <a href="index.html#" class="btn btn-lg btn-primary margin-right-15">View now</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                @endforeach

            </div>
        </div>

        <script>
            $(function() {  aweMainSlider(); });
        </script>

    </section>
    <!-- /section -->


    <section class="border-bottom">
        <div class="container">
            <div class="policy-wrapper">

                <div class="row">

                    <div class="col-md-4 col-sm-4 col-xs-8">
                        <div class="policy">
                            <div class="policy-icon">
                                <i class="icon icon-dolar-circle"></i>
                            </div>

                            <div class="policy-text">
                                <h4>100% Money back</h4>
                                <p>Guarantee</p>
                            </div>
                        </div>
                        <!-- /.policy -->
                    </div>

                    <div class="col-md-4 col-sm-4 col-xs-8">
                        <div class="policy">
                            <div class="policy-icon">
                                <i class="icon icon-car"></i>
                            </div>

                            <div class="policy-text">
                                <h4>Free shipping</h4>
                                <p>On order over 500$</p>
                            </div>
                        </div>
                        <!-- /.policy -->
                    </div>

                    <div class="col-md-4 col-sm-4 col-xs-8">
                        <div class="policy">
                            <div class="policy-icon">
                                <i class="icon icon-telephone"></i>
                            </div>

                            <div class="policy-text">
                                <h4>24-hour</h4>
                                <p>active support</p>
                            </div>
                        </div>
                        <!-- /.policy -->
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.policy-wrapper -->
        </div>
        <!-- /.container -->
    </section>
    <!-- /section -->

    <section>
        <div class="container">
            <div class="padding-vertical-50">

                <div class="section-header center">
                    <h2 class="margin-bottom-20">SHOP CATEGORIES</h2>
                    <p>Best of category shop for you</p>
                </div>
                <!-- /.section-header -->

                <div class="cate-section-gutter-wrapper">
                    <div class="row">
                        <div class="col-md-4 col-sm-4">

                            <div class="cate-section-gutter cate-overlay">
                                <div class="category-text">
                                    <h3>CLOTHING</h3>
                                    <p>Lorem Ipsum is simply dummy text of the printing</p>
                                    <a href="index3.html#" title="" class="btn btn-dark btn-outline">VIEW ALL</a>
                                </div>

                                <div class="awe-media block">
                                    <div class="awe-media-image">
                                        <a href="index3.html#" title="">
                                            <img src="img/samples/collections/categories/collection-category-2.jpg" alt="">
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <!-- /.cate-section-gutter -->

                        </div>

                        <div class="col-md-4 col-sm-4">

                            <div class="cate-section-gutter cate-overlay">
                                <div class="awe-media block">
                                    <div class="awe-media-image">
                                        <a href="index3.html#" title="">
                                            <img src="img/samples/collections/categories/collection-category-1.jpg" alt="">
                                        </a>
                                    </div>
                                </div>

                                <div class="category-text">
                                    <h3>SHOES</h3>
                                    <p>Lorem Ipsum is simply dummy text of the printing</p>
                                    <a href="index3.html#" title="" class="btn btn-dark btn-outline">VIEW ALL</a>
                                </div>
                            </div>
                            <!-- /.cate-section-gutter -->

                        </div>

                        <div class="col-md-4 col-sm-4">

                            <div class="cate-section-gutter cate-overlay">
                                <div class="awe-media block">
                                    <div class="awe-media-image">
                                        <a href="index3.html#" title="">
                                            <img src="img/samples/collections/categories/collection-category-3.jpg" alt="">
                                        </a>
                                    </div>
                                </div>

                                <div class="category-text">
                                    <h3>ACCESSORIES</h3>
                                    <p>Lorem Ipsum is simply dummy text of the printing</p>
                                    <a href="index3.html#" title="" class="btn btn-dark btn-outline">VIEW ALL</a>
                                </div>
                            </div>
                            <!-- /.cate-section-gutter -->

                        </div>
                    </div>
                    <!-- /.row -->
                </div>

            </div>
        </div>
    </section>
    <!-- /section -->

    <div class="container">
        <div class="divider"></div>
    </div>

    <section style="width: 95%; padding: 0 15px; margin: 0 auto;">
        <div class="container">
            <div class="padding-vertical-50" style="padding-bottom: 0px !important">

                <div class="arrivals">
                    <div class="section-header center">
                        <h2>New Arrivals</h2>
                    </div>
                    <!-- /.section-header -->

                    <div class="products owl-carousel" data-items="4">

                    @foreach( $productList as $product)
                        <div class="product product-grid">
                            <div class="product-media">
                                <div class="product-thumbnail">
                                    <a href="product-fullwidth.html" title="">
                                        <img src="{{ asset('img/products/' . $product->image) }}" alt="" class="current">
                                        <img src="{{ asset('img/products/' . $product->image1) }}" alt="">
                                    </a>
                                </div>
                                <!-- /.product-thumbnail -->

                            </div>
                            <!-- /.product-media -->

                            <div class="product-body">
                                <h2 class="product-name">
                                    <a href="{{ url('product?product_id=' . $product->id ) }}" title="Gin Lane Greenport Cotton Shirt" style="color: #999">
                                        {{ $product->name }}
                                    </a>
                                </h2>
                                <!-- /.product-product -->

                                <div class="product-price" style="text-align: center;">

                                    <span class="amount">${{ $product->cost }}</span>
                                    @if( $product->cost < $product->primary_cost )
                                    <br>
                                    <del class="amount">${{ $product->primary_cost }}</del>
                                    @endif
                                </div>
                                <div style="text-align: center;">
                                    <input type="button" class="btn btn-lg btn-dark btn-outline" id="add_to_cart"
                                        value="Add to cart" onclick="addToCart('{{ $product->id }}')" 
                                    />
                                </div>
                                <!-- /.product-price -->
                            </div>
                            <!-- /.product-body -->
                        </div>
                        <!-- /.product -->
                    @endforeach

                    </div>
                    <!-- /.products -->
                </div>
                <!-- /.arrivals -->

            </div>
        </div>
        <!-- /.container -->
    </section>
    <!-- /section -->

    <div class="container">
        <div class="divider"></div>
    </div>

    @if( $saleOffList->count() > 0 )
    <section style="width: 95%; padding: 0 15px; margin: 0 auto;">
        <div class="container">
            <div class="padding-vertical-50" style="padding-bottom: 0px !important">

                <div class="arrivals">
                    <div class="section-header center">
                        <h2>SALE OFF ITEMS</h2>
                    </div>
                    <!-- /.section-header -->

                    <div class="products owl-carousel" data-items="4">

                    @foreach( $saleOffList as $product)
                        <div class="product product-grid">
                            <div class="product-media">
                                <div class="product-thumbnail">
                                        <img src="{{ asset('img/products/' . $product->image) }}" alt="" class="current">
                                        <img src="{{ asset('img/products/' . $product->image1) }}" alt="">
                                </div>
                                <!-- /.product-thumbnail -->

                            </div>
                            <!-- /.product-media -->

                            <div class="product-body">
                                <h2 class="product-name">
                                    <a href="{{ url('product?product_id=' . $product->id ) }}" title="Gin Lane Greenport Cotton Shirt" style="color: #999">
                                        {{ $product->name }}
                                    </a>
                                </h2>
                                <!-- /.product-product -->

                                <div class="product-price" style="text-align: center;">

                                    <span class="amount">${{ $product->cost }}</span>
                                    @if( $product->cost < $product->primary_cost )
                                    <br>
                                    <del class="amount">${{ $product->primary_cost }}</del>
                                    @endif
                                </div>
                                <div style="text-align: center;">
                                    <input type="button"  class="btn btn-lg btn-dark btn-outline"
                                        value="Add to cart" onclick="addToCart('{{ $product->id }}')"
                                    />
                                </div>
                                <!-- /.product-price -->
                            </div>
                            <!-- /.product-body -->
                        </div>
                        <!-- /.product -->
                    @endforeach

                    </div>
                    <!-- /.products -->
                </div>
                <!-- /.arrivals -->

            </div>
        </div>
        <!-- /.container -->
    </section>
    <!-- /section -->
    @endif

    <section class="background background-color-dark background-image-section-customers-say">
        <div class="container">
            <div class="padding-top-60">
                <div class="section-header center">
                    <h2>Customer Say</h2>
                </div>
                <!-- /.section-header -->

                <div class="section-customers">
                    <div class="row">
                        <div class="col-md-8 col-md-offset-2">
                            <div class="customers-carousel owl-carousel" id="customers-carousel" data-toggle="carousel" data-dots="true" data-nav="0">
                                <div class="center">
                                    <h4>Natasha Roson</h4>
                                    <p>“There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable. If
                                        you are going to use a passage of Lorem Ipsum“</p>
                                </div>
                                <!-- /.center -->

                                <div class="center">
                                    <h4>Natasha Roson</h4>
                                    <p>“There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable. If
                                        you are going to use a passage of Lorem Ipsum“</p>
                                </div>
                                <!-- /.center -->

                                <div class="center">
                                    <h4>Natasha Roson</h4>
                                    <p>“There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable. If
                                        you are going to use a passage of Lorem Ipsum“</p>
                                </div>
                                <!-- /.center -->
                            </div>
                            <!-- /.customers-say-carousel -->
                        </div>
                    </div>
                </div>
                <!-- /.section-content -->
            </div>
        </div>
        <!-- /.container -->

        <div class="section-brands">
            <div class="container">
                <div class="brands-carousel owl-carousel" id="brands-carousel">


                    <div class="center">
                        <img src="img/samples/brands/brand-1.png" alt="">
                    </div>
                    <!-- /.center -->

                    <div class="center">
                        <img src="img/samples/brands/brand-2.png" alt="">
                    </div>
                    <!-- /.center -->

                    <div class="center">
                        <img src="img/samples/brands/brand-3.png" alt="">
                    </div>
                    <!-- /.center -->

                    <div class="center">
                        <img src="img/samples/brands/brand-4.png" alt="">
                    </div>
                    <!-- /.center -->



                    <div class="center">
                        <img src="img/samples/brands/brand-1.png" alt="">
                    </div>
                    <!-- /.center -->

                    <div class="center">
                        <img src="img/samples/brands/brand-2.png" alt="">
                    </div>
                    <!-- /.center -->

                    <div class="center">
                        <img src="img/samples/brands/brand-3.png" alt="">
                    </div>
                    <!-- /.center -->

                    <div class="center">
                        <img src="img/samples/brands/brand-4.png" alt="">
                    </div>
                    <!-- /.center -->


                </div>
                <!-- /.brands-carousel -->
            </div>
            <!-- /.container -->
        </div>
        <!-- /.section-brands -->

    </section>
    <!-- /section -->
    <section>
        <div class="container">

            <div class="section-header center" style="margin-top: 50px">
                <h2>Gallery</h2>
            </div>

            <div class="row grid">

            @foreach( $pictureList as $picture )
                <div class="grid-item type-accessories col-md-3 col-sm-3 col-xs-12">

                    <div class="awe-media margin-bottom-30">
                        <div class="awe-media-header">
                            <div class="awe-media-image">
                                <img src="{{ asset('img/pictures/' . $picture->image ) }}" alt="">
                            </div>

                            <div class="awe-media-hover">
                                <a href="portfolio-main-stylepicture-grid.html#" class="profolio-content-text">
                                    <h2 class="upper">{{ $picture->content }}</h2>
                                    <p>Accessories / Hats</p>

                                    <span class="icon-next">
                                <i class="icon icon-arrow-next"></i>
                            </span>
                                </a>
                            </div>
                            <!-- /.awe-media-hover -->

                        </div>
                    </div>
                    <!-- /.awe-media -->
                </div>
            @endforeach

            </div>
            <!-- /.row -->

            <div class="center">
                <a href="{{ url('picture') }}" class="btn btn-lg btn-dark btn-outline">
                    <span>View All</span>
                </a>
            </div>
            <!-- /.center -->

        </div>
        <!-- /.container -->

    </section>
    <!--/section-->

</div>
@stop





