<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Product;
use App\Category;
use App\Slide;
use App\Cart;

use DB;
use Session;

class MyController extends Controller
{
    public function index(){
        
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

    	return view('page.home', 
                    compact('slideList',
                            'cateParentList',
                            'productList',  
                            'newItemList', 
                            'saleOffList'
                            )
        );
    }



    public function getLogin(){

        return view('page.login');        
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
            $cart->add($request->id);
            Session::put('cart', $cart);
            return view('page.cart', ['cart' => $cart->itemList, 'totalPrice' => $cart->totalPrice]);
        }else{
            return;
        }
    }

    public function getRemoveCart(Request $request){
        if( isset($request->id) ){
            $cart = ( Session::has('cart') ? new Cart(Session::get('cart')) : new Cart() );
            $cart->remove($request->id);
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
    }

}



