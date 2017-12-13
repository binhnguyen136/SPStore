<?php

namespace App;
use Illuminate\Http\Request;

use App\Product;
use App\CartItem;

class Cart 
{
	public $itemList;

	public $totalPrice;

	public function __construct(Cart $cart = null){
		if( $cart !== null ){
			$this->itemList = $cart->itemList;
			$this->totalPrice = $cart->totalPrice;
		}else{
			$this->itemList = array();
			$this->totalPrice = 0;
		}
	}

	public function add($id, $quantity = null){
		$product = Product::find($id);
		if($product){
			foreach( $this->itemList as $item ){
				if($item->id == $id){
					if($quantity != null) $item->increase($quantity);
					else $item->increase();
					$this->totalPrice += $quantity ? $item->cost*$quantity : $item->cost;
					return;
				}
			}

			$cartItem = new CartItem($id, $quantity);
			array_push( $this->itemList, $cartItem);
			$this->totalPrice += $quantity ? $cartItem->cost*$quantity : $cartItem->cost;
			
		}
	}

	public function remove($id, $quantity = null){
		$product = Product::find($id);
		if($product){
			foreach( $this->itemList as $key => $item ){

				if($item->id == $id){
					if($quantity != null) $item->decrease($quantity);
					else $item->decrease()
					$this->totalPrice -= $quantity ? $item->cost*$quantity : $item->cost;

					if($item->quantity < 1){
						unset($this->itemList[$key]);
					}

					return;
				}
				
			}
		}		
	}


}



