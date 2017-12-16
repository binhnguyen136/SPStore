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

    <!--
    <div class="container">
        <div class="divider"></div>
    </div>
    -->

    <section style="width: 95%; padding: 0 15px; margin: 0 auto;">
        <div class="container">
            <div class="padding-vertical-50" style="padding-bottom: 0px !important">

                <div class="arrivals">
                    <div class="section-header center">
                        <h2>New Items</h2>
                    </div>
                    <!-- /.section-header -->

                    <div class="products owl-carousel" data-items="5">

                    @foreach( $newItemList as $product)
                        <div class="product product-grid">
                            <div class="product-media">
                                <div class="product-thumbnail">
                                    <a href="{{ url('product?product_id=' . $product->id ) }}" title="">
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
                                        value="Add to cart" onclick="addToCart('{{ $product->id }}')" />
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

    @foreach( $cateParentList as $cate )
    <section style="width: 95%; padding: 0 15px; margin: 0 auto;">
        <div class="container">
            <div class="padding-vertical-50" style="padding-bottom: 0px !important">

                <div class="arrivals">
                    <div class="section-header center">
                        <h2>{{ $cate->name }}</h2>
                    </div>
                    <!-- /.section-header -->

                    <div class="products owl-carousel" data-items="5">

                    <?php $count = 0 ?>
                    @foreach( $productList as $product)
                        @if( $product->cate_parent_id == $cate->id && $count++ <= 7)
                        <div class="product product-grid">
                            <div class="product-media">
                                <div class="product-thumbnail">
                                    <a href="{{ url('product?product_id=' . $product->id ) }}" title="">
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
                        @endif
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
    @endforeach

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


</div>
@if(isset($queryException))
<script type="text/javascript">
    alert('{{ $queryException }}');
</script>
@endif
@stop





