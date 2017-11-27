                            <h2>Your payment details</h2>

                            <div class="payment-detail-wrapper">
                                @if( $itemList )
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
                            

                            <div class="alert alert-dark">
                                <p>You have a coupon? <strong><a href="checkout.html#" title="">Click here to enter your code</a></strong>
                                </p>
                            </div>
                            <!-- /.alert -->

                            <div class="cart-total">
                                <table>
                                    <tbody>
                                        <tr class="cart-subtotal">
                                            <th>Cart Subtotal:</th>
                                            <td><span class="amount">${{ isset($totalPrice)? $totalPrice : 0 }}</span>
                                            </td>
                                        </tr>
                                        <tr class="shipping">
                                            <th>Shipping:</th>
                                            <td>Free Shipping</td>
                                        </tr>
                                        <tr class="order-total">
                                            <th>Order Total:</th>
                                            <td><strong><span class="amount">${{ isset($totalPrice)? $totalPrice : 0 }}</span></strong> 
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.cart-total -->

                            <div class="cart-checkboxes">

                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" value="">
                                        <span>Direct Bank Transfer</span>
                                    </label>

                                    <p>Make your payment directly into our bank account. Please use your Order ID as the payment reference. Your order won’t be shipped until the funds have cleared in our account.</p>
                                </div>
                                <!-- /.checkbox -->

                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" value="">
                                        <span>Cheque Payment</span>
                                    </label>
                                </div>
                                <!-- /.checkbox -->

                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" value="">
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
                                <button class="btn btn-lg btn-primary">Check out</button>
                            </div>
                            <!-- /.wc-proceed-to-checkout -->
