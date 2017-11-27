<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Session;
use App\Cart;
use App\Category;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        
        view()->composer(['page.header', 'page.category'], function($view){
            $cateParentList = Category::whereRaw('id = parent_id AND ordinal > 0')->orderBy('ordinal')->get();
            $cateListCount = array();
            foreach ($cateParentList as $cateParent) {
                $list = Category::whereRaw('parent_id = ' . $cateParent->id . ' AND id != ' . $cateParent->id . ' AND ordinal != 0')->get();
                $cateListCount[$cateParent->id] = $list->count();            
            }

            $cateList = json_decode(json_encode(Category::whereRaw('id != parent_id AND ordinal > 0')->orderBy('ordinal')->get()));
            
            $view->with(['cateParentList' => $cateParentList, 'cateList' => $cateList, 'cateListCount' => $cateListCount]);
        });
        
        view()->composer(['page.header', 'page.checkout'],function($view){
            if(Session::has('cart')){
                $oldCart = Session::get('cart');
                $cart = new Cart($oldCart);
                $view->with(['itemList'=> $cart->itemList,'itemCount' => count($cart->itemList),'totalPrice'=>$cart->totalPrice]);
            }
        
        });

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
