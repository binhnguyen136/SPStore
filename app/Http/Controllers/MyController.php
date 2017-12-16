<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests;

use App\Product;
use App\Category;
use App\Slide;
use App\Cart;

use URL;
use DB;
use Session;

class MyController extends Controller
{
    private $queryException;

    public function __construct(){}

    public function update_cart_session($cart_id){
        // add cart from db to session('cart')
        $old_cart = collect(DB::select('CALL `cart_item_find_cartid`(' . $cart_id . ')'));

        $cart = new Cart(Session::get('cart'));
        foreach($old_cart as $item){
            $cart->add($item->product_id, $item->quantity);
        }
        Session::put('cart', $cart);

        //dd($old_cart);
        //update current cart into db
        try{
            DB::select('CALL `clear_cart_items`('. $cart_id . ')');

            foreach($cart->itemList as $item)
            {
                DB::select('CALL `cart_item_insert`('.$cart_id.','.$item->id.','.$item->quantity.')');
            }   
        }catch(\Illuminate\Database\QueryException $e){
            $this->queryException = $e->errorInfo[2];

            DB::select('CALL `clear_cart_items`('. $cart_id . ')');
            foreach($old_cart as $item)
            {
                DB::select('CALL `cart_item_insert`('.$item->cart_id.','.$item->id.','.$item->quantity.')');
            }   
        }        
    }

    public function process_cart(){
        if(Auth::check())
        {   
            $user_id = Auth::user()->id;
            $cart = collect(DB::select('CALL `cart_find_userid`('.$user_id.')'))->first();

            if(Session::has('cart')){
                if( count($cart) == 0 ){
                    $oldCart = Session::get('cart');
                    $cart = new Cart($oldCart);
                    
                    try
                    {
                        DB::select('CALL `cart_insert`('.$user_id.','.$cart->totalPrice.')');
                        $_cart = collect(DB::select('CALL `cart_find_userid`('.$user_id.')'))->first();
                        foreach($cart->itemList as $item)
                        {
                            DB::select('CALL `cart_item_insert`('.$_cart->id.','.$item->id.','.$item->quantity.')');
                        }
                    }catch(\Illuminate\Database\QueryException $e)
                    {
                        $_cart = collect(DB::select('CALL `cart_find_userid`('.$user_id.')'))->first();
                        DB::select('CALL `clear_cart_items`('. $_cart->id . ')');
                        $this->queryException = $e->errorInfo[2];
                    }
                }
                else {
                    //Case people loged in and already had a cart store in database
                    $this->update_cart_session($cart->id);
                }
            }
            else if(count($cart) != 0){
                $this->update_cart_session($cart->id);
            } // Case people loged in and wanna get cart from db without session cart
        }
    }

    public function index(){

        $str_cmpr = url('/') . '/login';
        if(url()->previous() == $str_cmpr) {
            $this->process_cart();
        }

        $slideList = DB::table('slides')->orderBy('ordinal', 'asc')->get();
        
        //$productList = DB::table('products')->orderBy('created_at')->limit(7)->get();
        
        $newItemList = collect(DB::select('
                        CALL `new_items_list`();
                        '));
        
        $saleOffList = collect(DB::select('
                        CALL `sale_off_list`();
                        '));

        $cateParentList = collect(DB::select('CALL `user_cate_parent_list`();'));

        $productList = collect(DB::select('
                        CALL `product_all`();
                        '));

        $queryException = $this->queryException;

    	return view('page.home', 
                    compact('slideList',
                            'cateParentList',
                            'productList',  
                            'newItemList', 
                            'saleOffList',
                            'queryException'
                            )
        );
    }

    public function getProduct(Request $request){
        if($request->cate_id){
            $query = 'CALL product_List(' . $request->cate_id . ')';

            $productList = collect(DB::select($query));
            // dd($productList);
            $cate = Category::findOrFail($request->cate_id);

            if( $productList->count() == 0 ){
                /*...*/
            }

            return view('page.category', 
                        compact(
                            'productList',
                            'cate'
                            )
            );  
        }

        if($request->product_id){
            $query1 = 'CALL `product`(' . $request->product_id . ')';
            $product = collect(DB::select($query1))->first();

            $cate = Category::findOrFail($product->cate_id);
            $query2 = 'CALL `related_List`('.$product->cate_id.','.$product->id.')';
            // $relatedList = Product::where('cate_id', $product->cate_id)->where('id', '<>', $product->id)->limit(7)->get();
            $relatedList = collect(DB::select($query2));

            return view('page.product', 
                        compact(
                            'product',
                            'cate',
                            'relatedList'
                            )
            );  
        }
        
        return redirect('/');
        
    }

    public function getCheckout(){

        return view('page.checkout');  
    }

    public function getContact(){
        return view('page.contact');  
    }
    public function getAddToCart(Request $request){
        if( isset($request->id) ){
            $cart = ( Session::has('cart') ? new Cart(Session::get('cart')) : new Cart() );
            $cart->add($request->id, $request->quantity);
            Session::put('cart', $cart);
            return view('page.cart', ['cart' => $cart->itemList, 'totalPrice' => $cart->totalPrice]);
        }else{
            return;
        }
    }

    public function getRemoveCart(Request $request){
        if( isset($request->id) ){
            $cart = ( Session::has('cart') ? new Cart(Session::get('cart')) : new Cart() );
            $cart->remove($request->id, $request->quantity);
            Session::put('cart', $cart);
            return view('page.cart', ['cart' => $cart->itemList, 'totalPrice' => $cart->totalPrice]);
        }else{
            return;
        }        
    }

    public function refreshCheckout (Request $request){
        if( Session::has('cart')){
            $cart = new Cart(Session::get('cart'));
            return view('page.cart_checkout', ['itemList' => $cart->itemList, 'totalPrice' => $cart->totalPrice]);
        }else{
            return;
        }
    }

    public function destroySession(){
        Session::flush();
        return redirect()->back();
    }

}



