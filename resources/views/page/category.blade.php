@extends('page.master')
@section('content')
<div id="main">

    <div class="main-header background background-image-heading-products">
        <div class="container">
            <h1>Products Grid</h1>
        </div>
    </div>


    <div id="breadcrumb">
        <div class="container">
            <ol class="breadcrumb">
                <li><a href="{{ url('/') }}">Home</a>
                </li>
                <li class="active"><span>{{ $cate->name }}</span>
                </li>
            </ol>

        </div>
    </div>


    <div class="container">
       <div class="row">
          <div class="col-md-9 col-md-push-3">
             <div class="product-header-actions">
                <form action="product-grid.html" method="POST" class="form-inline">
                   <div class="row">
                      <div class="col-md-4 col-sm-6">
                         <div class="view-icons">
                            <a href="products-grid.html#" class="view-icon active"><span class="icon icon-th"></span></a>
                            <a href="products-grid.html#" class="view-icon "><span class="icon icon-th-list"></span></a>
                         </div>
                         <div class="view-count">
                            <span class="text-muted">Item 1 to 9 of 30 Items</span>
                         </div>
                      </div>
                      <div class="col-md-8 col-sm-6 col-xs-12">
                         <div class="form-show-sort">
                            <div class="form-group pull-left">
                               <label for="p_show">Show</label>
                               <select name="p_show" id="p_show" class="form-control input-sm">
                                  <option value="">10</option>
                                  <option value="">25</option>
                                  <option value="">50</option>
                               </select>
                               <strong>per page</strong>
                            </div>
                            <!-- /.form-group -->
                            <div class="form-group pull-right text-right">
                               <label for="p_sort_by">Sort By</label>
                               <select name="p_sort_by" id="p_sort_by" class="form-control input-sm">
                                  <option value="">Lastest</option>
                                  <option value="">Recommend</option>
                               </select>
                            </div>
                            <!-- /.form-group -->
                         </div>
                      </div>
                   </div>
                   <!-- /.row -->
                </form>
             </div>
             <!-- /.product-header-actions -->
             <div class="products products-grid-wrapper">
                <div class="row">

                    @foreach( $productList as $product )
                     <div class="col-md-3 col-sm-3 col-xs-12">
                        @if( $product->cost < $product->primary_cost )
                        <div class="product product-grid" style="margin-bottom: 10px">
                        @else
                        <div class="product product-grid">
                        @endif
                           <div class="product-media">
                              <div class="product-thumbnail">
                                 <img src="{{ asset('img/products/' . $product->image ) }}" alt="" class="current">
                                 <img src="{{ asset('img/products/' . $product->image1 ) }}" alt="">
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
                     </div>
                   @endforeach

                </div>
                <!-- /.row -->
             </div>
             <!-- /.products -->

             <!-- pagination -->

             <!-- ./pagination -->
          </div>
          <!-- /.col-* -->
          <div class="col-md-3 col-md-pull-9">
             <div id="shop-widgets-filters" class="shop-widgets-filters">
                <div id="widget-area" class="widget-area">
                   <div class="widget woocommerce widget_product_categories">
                      @foreach( $cateParentList as $parentCat )
                      @if( $parentCat->id === $cate->parent_id )
                      <h3 class="widget-title">{{ $parentCat->name }}</h3>

                      <ul>
                         <li class="active"><a href="{{ url('product?cate_id=' .$parentCat->id) }}" title="">All Items</a>
                         </li>
                         @foreach( $cateList as $cat )
                         @if( $cat->parent_id == $parentCat->id )
                         <li><a href="{{ url('product?cate_id=' .$cat->id) }}" title="">{{ $cat->name }}</a>
                         </li>
                         @endif
                         @endforeach
                      </ul>

                      @endif
                      @endforeach                      
                   </div>

                </div>
             </div>
             <div id="open-filters">
                <i class="fa fa-filter"></i>
                <span>Filter</span>
             </div>
          </div>
          <!-- /.col-* -->
       </div>
       <!-- /.row -->
    </div>
    <!-- /.container -->

    <script type="text/javascript">
        $(function() { aweProductSidebar(); });
    </script>

</div>
@stop