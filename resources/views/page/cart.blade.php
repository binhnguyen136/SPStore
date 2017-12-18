<ul class="whishlist">
@foreach( $cart as $item ) 
	<li>
        <div class="whishlist-item">
            <div class="product-image">
                <a href="#" title="">
                    <img src="{{ asset('img/products/' . $item->image) }}" style="max-width: 54px; height: auto">
                </a>
            </div>

            <div class="product-body">
                <div class="whishlist-name">
                    <h3 style="font-weight: 700; text-transform: capitalize;">
                    	<a href="" title="">{{ $item->name }}</a>
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
</ul>
<div class="menu-cart-total">
    <span>Total</span>
    <span class="price" id="total"> ${{ isset($totalPrice) ? $totalPrice : 0 }}</span>
</div>

<div class="cart-action">
    <a href="{{ url('checkout') }}" title="" class="btn btn-lg btn-dark btn-outline btn-block">View all cart</a>
</div>

<div data-count="{{ count($cart) }}" id="data-count"></div>





