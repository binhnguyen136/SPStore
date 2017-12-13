<?php

namespace App;

use App\Product;

class CartItem
{
	public $id;
	public $name;
	public $image;
	public $cost;
	public $quantity;

	public function __construct($id = null, $quantity = null){
		$product = Product::find($id); 
		if( $id !== null && $product !== null ){
			$this->id = $product->id;
			$this->name = $product->name;
			$this->image = $product->image;
			$this->cost = $product->cost;
		}else{
			$this->id = null;
			$this->name = null;
			$this->image = null;
			$this->cost = null;
			$this->quantity = null;
		}
		
		if( $this->id !== null ){
			$this->quantity = ( $quantity !== null ? $quantity : 1 );
		}else{
			$this->quantity = 0;
		}
	}

	public function increase( $num = null ){
		$this->quantity += ( $num !== null ? $num : 1 );
	}

	public function decrease( $num = null ){
		if($this->quantity >= $num)
			$this->quantity -= ( $num !== null ? $num : 1 );
		else 
			$this->quantity = 0;
	}
}