@extends('page.master')
@section('content')
<div id="main">

    <div class="main-header background background-image-heading-checkout">
        <div class="container">
            <h1>Checkout</h1>
        </div>
    </div>


    <div id="breadcrumb">
        <div class="container">
            <ol class="breadcrumb">
                <li><a href="checkout.html#">Home</a>
                </li>
                <li class="active"><span>Checkout</span>
                </li>
            </ol>

        </div>
    </div>


    <form action="{{ url('checkout') }}" method="POST">
        {{ csrf_field() }}
        <div class="checkout-wrapper">
            <div class="container">
                @if (Session::has('success'))
                    <div class="alert alert-info">{{ Session::get('success') }}</div>
                @endif
                <div class="text-alert">
                    <p>Returning customer? <a href="{{ url('login') }}">Click here to login</a>
                    </p>
                </div>
                <!-- /.text-alert -->

                <div class="row">
                    <div class="col-md-6">
                        <h2>Billing Details</h2>

                        @if ($errors->any())
                        <div class="help-block">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                        <!-- /.form-group -->
                        <div class="form-group">
                            <label for="first_name">Name <sup>*</sup>
                            </label>
                            <input type="text" class="form-control dark" id="name" name="name" value="{{ Auth::check() ? Auth::user()->name : 'Your name'}}">
                        </div>

                        <!-- /.form-group -->

                        <div class="form-group">
                            <label for="address">Address<sup>*</sup></label>
                            <input type="text" class="form-control dark" id="address" name="address" value="{{ Auth::check() ? Auth::user()->address : 'Street Address'}}">
                        </div>
                        <!-- /.form-group -->


                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email_address">Email Address <sup>*</sup>
                                    </label>
                                    <input type="text" class="form-control dark" id="email_address" name="email" value="{{ Auth::check() ? Auth::user()->email : 'Email Address'}}">
                                </div>
                                <!-- /.form-group -->
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="phone">Phone <sup>*</sup>
                                    </label>
                                    <input type="text" class="form-control dark" id="phone" name="phone" value="{{ Auth::check() ? Auth::user()->phone : 'Phone number'}}">
                                </div>
                                <!-- /.form-group -->
                            </div>
                        </div>

                        <!-- /.form-group -->

                    </div>

                    <div class="col-md-6">
                        <div class="payment-right" id="payment">
                            <h2>Your payment details</h2>

                            <div class="payment-detail-wrapper">
                                @if( isset($itemList) && count($itemList) > 0)
                                <ul class="cart-list">

                                    @foreach( $itemList as $item )
                                    <li>
                                        <div class="cart-item">
                                            <div class="product-image">
                                                <a href="{{ url('product?product_id=' . $item->id) }}" title="">
                                                    <img src="{{ asset('img/products/' . $item->image) }}" 
                                                    style="max-width: 70px; height: auto">
                                                </a>
                                            </div>

                                            <div class="product-body">
                                                <div class="product-name">
                                                    <h3 style="font-weight: 700; text-transform: capitalize;">
                                                        <a href="{{ url('product?product_id=' . $item->id) }}" title="">{{ $item->name }}</a>
                                                    </h3>
                                                </div>

                                                <div class="whishlist-quantity" style="color: #898989; font-size: 12px">
                                                    <span>Quantity:</span>
                                                    <span>{{ $item->quantity }}</span>
                                                </div>

                                                <div class="product-price">
                                                    <span>${{ $item->cost }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /.cart-item -->

                                        <a class="remove-cart" onclick="removeCheckOut('{{ $item->id }}')">
                                            <span class="icon icon-remove"></span>
                                        </a>
                                    </li>
                                    @endforeach

                                </ul>
                                @else
                                <div>
                                    You don't have any product in cart
                                </div>
                                @endif
                                <!-- /.cart-list -->
                            </div>
                            <!-- /.payment-detail-wrapper -->
                            


                            <div class="cart-total">
                                <table>
                                    <tbody>
                                        <tr class="cart-subtotal">
                                            <th>Cart Subtotal:</th>
                                            <td><span class="amount">${{ isset($totalPrice) ? $totalPrice : 0 }}</span>
                                            </td>
                                        </tr>
                                        <tr class="shipping">
                                            <th>Shipping:</th>
                                            <td>Free Shipping</td>
                                        </tr>
                                        <tr class="order-total">
                                            <th>Order Total:</th>
                                            <td><strong><span class="amount">${{ isset($totalPrice) ? $totalPrice : 0 }}</span></strong> 
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.cart-total -->

                            <div class="cart-checkboxes">
                                
                                <!-- /.checkbox -->

                                <div class="checkbox">
                                    <label>
                                        <input type="radio" name="payment" value="1">
                                        <span>Ship COD</span>
                                    </label>
                                </div>
                                <!-- /.checkbox -->

                                <div class="checkbox">
                                    <label>
                                        <input type="radio" name="payment" value="2">
                                        <span>Credit Card</span>
                                    </label>

                                    <ul class="list-payments list-inline">
                                        <li>
                                            <a href="checkout.html#" title="">
                                                <img src="img/payments/american-express.png" alt="">
                                            </a>
                                        </li>

                                        <li>
                                            <a href="checkout.html#" title="">
                                                <img src="img/payments/mastercard.png" alt="">
                                            </a>
                                        </li>

                                        <li>
                                            <a href="checkout.html#" title="">
                                                <img src="img/payments/moneybookers.png" alt="">
                                            </a>
                                        </li>

                                        <li>
                                            <a href="checkout.html#" title="">
                                                <img src="img/payments/paypal.png" alt="">
                                            </a>
                                        </li>

                                        <li>
                                            <a href="checkout.html#" title="">
                                                <img src="img/payments/visa.png" alt="">
                                            </a>
                                        </li>

                                        <li>
                                            <a href="checkout.html#" title="">
                                                <img src="img/payments/2chekout.png" alt="">
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <!-- /.checkbox -->
                            </div>
                            <!-- /.cart-checkboxes -->

                            <div class="wc-proceed-to-checkout">
                                <button class="btn btn-lg btn-primary" type="submit">Check out</button>
                            </div>
                            <!-- /.wc-proceed-to-checkout -->

                        </div>
                    </div>
                </div>
            </div>
            <!-- /.container -->
        </div>
        <!-- /.checkout-wrapper -->
    </form>

</div>
<script type="text/javascript">

    var removeCheckOut = id => {
        removeCart(id);
        refreshCheckOut();
    }

    var refreshCheckOut = () => {

        $.ajax({
            type: 'get',
            url: 'refresh-checkout',
            success: function(response){
                $('#payment').html(response);
            }
        });


    } 

</script>
@stop


