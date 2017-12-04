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
                        SELECT  product.id AS id,
                                product.name AS name,
                                product.image AS image,
                                product.image1 AS image1,
                                product.primary_cost AS primary_cost,
                                product.cost AS cost,
                                category.name AS cate_name
                        FROM products product 
                        JOIN categories category
                        ON product.cate_id = category.id
                        ORDER BY product.created_at DESC
                        LIMIT 7
                        '));
        
        $saleOffList = collect(DB::select('
                        SELECT  product.id AS id,
                                product.name AS name,
                                product.image AS image,
                                product.image1 AS image1,
                                product.primary_cost AS primary_cost,
                                product.cost AS cost,
                                category.name AS cate_name
                        FROM products product
                        JOIN categories category
                        ON product.cate_id = category.id
                        WHERE primary_cost > cost
                        ORDER BY product.created_at DESC
                        LIMIT 7
                        '));

        $cateParentList = Category::whereRaw('id = parent_id AND ordinal > 0')->orderBy('ordinal')->get();
        
        $productList = collect(DB::select('
                        SELECT  product.id AS id,
                                product.name AS name,
                                product.image AS image,
                                product.image1 AS image1,
                                product.primary_cost AS primary_cost,
                                product.cost AS cost,
                                category.id AS cate_id,
                                category.parent_id AS cate_parent_id
                        FROM products product
                        JOIN categories category 
                        ON product.cate_id = category.id 
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

    public function category($type){
    	$productList = Product::where('cat_id', $type)->get();
    	$productAno = Product::where('cat_id', '<>', $type)->paginate(3);
    	$cateList = Category::all();
    	$cateCurr = Category::where('id', $type)->first();
    	return view('page.category', compact('productList', 'productAno', 'cateList', 'cateCurr'));
    }


    public function getLogin(){

        return view('page.login');        
    }


    public function getProduct(Request $request){

        if($request->cate_id){
            $productList = Product::where('cate_id', $request->cate_id )->get();
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
            $product = Product::where('id', $request->product_id)->first();

            $cate = Category::findOrFail($product->cate_id);

            $relatedList = Product::where('cate_id', $product->cate_id)->where('id', '<>', $product->id)->limit(7)->get();

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

    public function getPicture(){
        $pictureList = Picture::paginate(20);

        $tagList = collect(DB::select('
                    SELECT DISTINCT content
                    FROM pictures
                '));

        return view('page.picture', ['pictureList' => $pictureList, 'tagList' => $tagList]);  
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



