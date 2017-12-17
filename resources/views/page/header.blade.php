<header id="header" class="awe-menubar-header">
    <nav class="awemenu-nav headroom" data-responsive-width="1200">
        <div class="container">
            <div class="awemenu-container">

                <div class="navbar-header">
                    <ul class="navbar-icons">


                        <li class="menubar-account">
                            <a class="awemenu-icon">
                                <i class="icon icon-user-circle"></i>
                                <span class="awe-hidden-text">Account</span>
                            </a>

                            <ul class="submenu megamenu">
                                <li>
                                    <div class="container-fluid">
                                        <div class="header-account">
                                            @if( Auth::check() )
                                            <div class="header-account-avatar">
                                                <a href="index.html#" title="">
                                                    <img src="{{ asset('img/samples/avatars/customers/2.jpg') }}" alt="" class="img-circle">
                                                </a>
                                            </div>

                                            <div class="header-account-username">
                                                <h4><a href="">{{ Auth::user()->name ? Auth::user()->name : Auth::user()->email }}</a></h4>
                                            </div>

                                            <ul>
                                                <li><a href="">Account Infomation</a>
                                                </li>
                                                <li><a href="{{ url('logout') }}">Logout</a>
                                                </li>
                                            </ul>

                                            @else
                                            <ul>
                                                <li><a href="{{ url('login') }}">Log in</a>
                                                </li>
                                                <li><a href="{{ url('register') }}">Register</a>
                                                </li>
                                            </ul>

                                            @endif
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </li>

                        <li class="menubar-cart">
                            <a class="awemenu-icon menu-shopping-cart" >
                                <i class="icon icon-shopping-bag"></i>
                                <span class="awe-hidden-text">Cart</span>
                                @if( isset($itemCount) && $itemCount > 0 )
                                <span class="cart-number" id="count">{{ $itemCount }}</span>
                                @else
                                <span id="count"></span>
                                @endif
                            </a>

                            <ul class="submenu megamenu">
                                <li>
                                    <div class="container-fluid" id="cart">

                                        <ul class="whishlist" >
                                        @if( isset($itemList) )
                                        @foreach( $itemList as $item )
                                            <li>
                                                <div class="whishlist-item">
                                                    <div class="product-image">
                                                        <a href="{{ url('product?product_id=' . $item->id) }}" title="">
                                                            <img src="{{ asset('img/products/' . $item->image) }}" style="max-width: 54px; height: auto">
                                                        </a>
                                                    </div>

                                                    <div class="product-body">
                                                        <div class="whishlist-name">
                                                            <h3 style="font-weight: 700; text-transform: capitalize;">
                                                                <a href="{{ url('product?product_id=' . $item->id) }}" title="">{{ $item->name }}</a>
                                                            </h3>
                                                        </div>

                                                        <div class="whishlist-price">
                                                            <span>Price:</span>
                                                            <strong> ${{ $item->cost }}</strong>
                                                        </div>

                                                        <div class="whishlist-quantity">
                                                            <span>Quantity:</span>
                                                            <span>{{ $item->quantity }}</span>
                                                        </div>
                                                    </div>
                                                </div>

                                                <a class="remove" onclick="removeCart('{{ $item->id }}')">
                                                    <i class="icon icon-remove"></i>
                                                </a>
                                            </li>
                                        @endforeach
                                        @endif
                                        </ul>

                                        <div class="menu-cart-total">
                                            <span>Total</span>
                                            <span class="price" id="total"> ${{ isset($totalPrice) ? $totalPrice : 0 }}</span>
                                        </div>

                                        <div class="cart-action">
                                            <a href="{{ url('checkout') }}" title="" class="btn btn-lg btn-dark btn-outline btn-block">View all cart</a>
                                            <a href="{{ url('checkout') }}" class="btn btn-lg btn-primary btn-block hidden">Proceed To Checkout</a>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </li>


                    </ul>

                    <ul class="navbar-search">
                        <li>
                            <a href="index.html#" title="" class="awemenu-icon awe-menubar-search" id="open-search-form">
                                <span class="sr-only">Search</span>
                                <span class="icon icon-search"></span>
                            </a>

                            <div class="menubar-search-form" id="menubar-search-form">
                                <form action="#" method="GET">
                                    <input type="text" name="s" class="form-control" placeholder="Search your entry here...">
                                    <div class="menubar-search-buttons">
                                        <button type="submit" class="btn btn-sm btn-white">Search</button>
                                        <button type="button" class="btn btn-sm btn-white" id="close-search-form">
                                            <span class="icon icon-remove"></span>
                                        </button>
                                    </div>
                                </form>
                            </div>
                            <!-- /.menubar-search-form -->
                        </li>
                    </ul>

                </div>

                <div class="awe-logo">
                    <a href="{{ url('/') }}" title="">
                        <img src="img/logo.png" alt="">
                    </a>
                </div>
                <!-- /.awe-logo -->


                <ul class="awemenu awemenu-right">
    

                    @foreach($cateParentList as $cateParent)
                    <li class="awemenu-item">
                        <a href="{{ url('product?cate_id=' . $cateParent->id) }}" title="">
                            <span>{{ $cateParent->name }}</span>
                        </a>

                        @if($cateListCount[$cateParent->id] > 0)
                        <ul class="awemenu-submenu awemenu-megamenu"  data-animation="fadeup">
                            <li class="awemenu-megamenu-item">
                                <div class="container-fluid">
                                    <div class="awemenu-megamenu-wrapper">
                                        <div class="row" style="display: flex;">
                                            <?php 
                                                $num = ($cateListCount[$cateParent->id]%3==0 ? intval($cateListCount[$cateParent->id]/3) : intval($cateListCount[$cateParent->id]/3) + 1);
                                                $i = 0;
                                                $render = 0;
                                                $step = 0;
                                            ?>
                                            <script type="text/javascript">console.log({{$num}})</script>
                                           @for($j=0; $j<$num; $j++)
                                            <div class="col-lg-3" style="width: 100%">
                                                <ul class="sublist">
                                                <?php $step = 0 ?>
                                                @while($render < $cateListCount[$cateParent->id] && $step < 3)
                                                    @if($cateList[$i]->parent_id == $cateParent->id)
                                                        <li>
                                                            <a href="{{ url('product?cate_id=' . $cateList[$i]->id) }}" style="text-transform: capitalize;">{{ $cateList[$i]->name }}</a>
                                                        </li>                                                                
                                                        <?php $render++; $step++ ?>
                                                    @endif
                                                    <?php $i++ ?>
                                                @endwhile
                                                </ul>
                                            </div>                                                        
                                           @endfor

                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                        @endif
                        
                    </li>                            
                    @endforeach

                </ul>
                <!-- /.awemenu -->
            </div>
        </div>
        <!-- /.container -->

    </nav>
    <!-- /.awe-menubar -->
</header>
<!-- /.awe-menubar-header -->