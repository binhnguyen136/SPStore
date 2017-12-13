@extends('page.master')
@section('content')
<div id="main">

    <div class="main-header background background-image-heading-product">
        <div class="container">
            <h1>Product</h1>
        </div>
    </div>


    <div id="breadcrumb">
        <div class="container">
            <ol class="breadcrumb">
                <li><a href="{{ url('/') }}">Home</a>
                </li>
                <li><a href="{{ url('product?cate_id=' . $cate->id) }}">{{ $cate->name }}</a>
                </li>
                <li class="active"><span>{{ $product->name }}</span></li>
            </ol>

        </div>
    </div>


    <div class="container">

        <div class="row">
            <div class="col-md-6">
                <div class="product-slider-wrapper thumbs-bottom">

                    <div class="swiper-container product-slider-main">
                        <div class="swiper-wrapper">

                            <div class="swiper-slide">
                                <div class="easyzoom easyzoom--overlay">
                                    <a href="{{ asset('img/products/' . $product->image ) }}" title="">
                                        <img src="{{ asset('img/products/' . $product->image ) }}" alt="">
                                    </a>
                                </div>
                            </div>

                            <div class="swiper-slide">
                                <div class="easyzoom easyzoom--overlay">
                                    <a href="{{ asset('img/products/' . $product->image1 ) }}" title="">
                                        <img src="{{ asset('img/products/' . $product->image1 ) }}" alt="">
                                    </a>
                                </div>
                            </div>

                            <div class="swiper-slide">
                                <div class="easyzoom easyzoom--overlay">
                                    <a href="{{ asset('img/products/' . $product->image2 ) }}" title="">
                                        <img src="{{ asset('img/products/' . $product->image2 ) }}" alt="">
                                    </a>
                                </div>
                            </div>

                            <div class="swiper-slide">
                                <div class="easyzoom easyzoom--overlay">
                                    <a href="{{ asset('img/products/' . $product->image3 ) }}" title="">
                                        <img src="{{ asset('img/products/' . $product->image3 ) }}" alt="">
                                    </a>
                                </div>
                            </div>

                        </div>

                        <div class="swiper-button-prev"><i class="fa fa-chevron-left"></i>
                        </div>
                        <div class="swiper-button-next"><i class="fa fa-chevron-right"></i>
                        </div>
                    </div>
                    <!-- /.swiper-container -->

                    <div class="swiper-container product-slider-thumbs">
                        <div class="swiper-wrapper">


                            <div class="swiper-slide">
                                <img src="{{ asset('img/products/' . $product->image ) }}" alt="">
                            </div>

                            <div class="swiper-slide">
                                <img src="{{ asset('img/products/' . $product->image1 ) }}" alt="">
                            </div>

                            <div class="swiper-slide">
                                <img src="{{ asset('img/products/' . $product->image2 ) }}" alt="">
                            </div>

                            <div class="swiper-slide">
                                <img src="{{ asset('img/products/' . $product->image3 ) }}" alt="">
                            </div>

                        </div>
                    </div>
                    <!-- /.swiper-container -->

                </div>
                <!-- /.product-slider-wrapper -->
            </div>

            <div class="col-md-6">

                <div class="product-details-wrapper">
                    <h2 class="product-name">
                        <a href="product-detail.html#" title=" Gin Lane Greenport Cotton Shirt">{{$product->name}}</a>
                    </h2>
                    <!-- /.product-name -->

                    <div class="product-status">
                        <span>In Stock</span>
                        <span>-</span>
                        <small>SKU: 12345678</small>
                    </div>
                    <!-- /.product-status -->

                    <div class="product-stars">
                        <span class="rating">
                <span class="star"></span>
                        <span class="star"></span>
                        <span class="star"></span>
                        <span class=""></span>
                        <span class=""></span>
                        </span>
                    </div>
                    <!-- /.product-stars -->

                    <div class="product-description">
                        <p>{{$product->detail}}</p>
                    </div>
                    <!-- /.product-description -->

                    <div class="product-features">
                        <h3>Special Features:</h3>

                        <ul>
                            <li>1914 translation by H. Rackham</li>
                            <li>The standard Lorem Ipsum passage, used since the 1500s</li>
                            <li>Section 1.10.33 of "de Finibus Bonorum et Malorum</li>
                        </ul>
                    </div>
                    <!-- /.product-features -->

                    <div class="product-actions-wrapper">
                        <form action="product-quick-view.html" method="POST">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="p_color">Color</label>
                                        <select name="p_color" id="p_color" class="form-control">
                                            <option value="">Blue</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="p_size">Size</label>
                                        <select name="p_size" id="p_size" class="form-control">
                                            <option value="">XL</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="p_qty">Qty</label>
                                        <select name="p_qty" id="p_qty" class="form-control">
                                            <option value="">1</option>
                                            <option value="">2</option>
                                            <option value="">3</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <!-- /.form -->

                        <div class="product-list-actions">
                            <span class="product-price">
                                <span class="amount">${{ $product->cost }}</span>
                                @if($product->cost < $product->primary_cost)
                                    <del class="amount">${{ $product->primary_cost }}</del>
                                @endif
                            </span>
                            <!-- /.product-price -->

                            <button class="btn btn-lg btn-primary" onclick="addToCart('{{ $product->id }}')">Add to cart</button>
                        </div>
                        <!-- /.product-list-actions -->
                    </div>
                    <!-- /.product-actions-wrapper -->

                    <div class="product-meta">
                        <span class="product-category">
                <span>Category:</span>
                        <a href="product-detail.html#" title="">{{$cate->name}}</a>
                        </span>

                        <span>-</span>

                        <span class="product-tags">
                <span>Tags:</span>
                        <a href="product-detail.html#" title="">Jacket</a>
                        </span>
                    </div>
                    <!-- /.product-meta -->
                </div>
                <!-- /.product-details-wrapper -->
            </div>
        </div>

        <div class="product-socials">
            <ul class="list-socials">

                <li><a href="product-detail.html#" data-toggle="tooltip" title="Twitter"><i class="icon icon-twitter"></i></a>
                </li>
                <li><a href="product-detail.html#" data-toggle="tooltip" title="Facebook"><i class="icon icon-facebook"></i></a>
                </li>
                <li><a href="product-detail.html#" data-toggle="tooltip" title="Dot-Dot"><i class="icon icon-dot-dot"></i></a>
                </li>
                <li><a href="product-detail.html#" data-toggle="tooltip" title="Google+"><i class="icon icon-google-plus"></i></a>
                </li>
                <li><a href="product-detail.html#" data-toggle="tooltip" title="Pinterest"><i class="icon icon-pinterest"></i></a>
                </li>

            </ul>
        </div>
        <!-- /.product-socials -->


        @if( $relatedList->count() > 0)
        <div class="relared-products">
            <div class="section-header center" style="margin-top: 50px">
                <h2>Related products</h2>
            </div>

            <div class="products owl-carousel" data-items="4">

                @foreach( $relatedList as $product)
                    <div class="product product-grid">
                        <div class="product-media">
                            <div class="product-thumbnail">
                                <a href="product-fullwidth.html" title="">
                                    <img src="{{ asset('img/products/' . $product->image ) }}" alt="" class="current">
                                    <img src="{{ asset('img/products/' . $product->image1 ) }}" alt="">
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
        </div>
        <!-- /.relared-products -->
        @endif
        
    </div>

    <script>
        $(function() { aweProductRender(true); });
    </script>
</div>
@stop