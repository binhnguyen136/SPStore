<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Product;
use App\Category;
use App\Slide;

use Auth;

use File;

use DB;

use Storage;

class AdminController extends Controller
{

    public function __construct(){
        $this->middleware('admin', ['except' => 'logout']);
    }

    public function index(){
    	return view('admin.home');
    }

    public function logout(){
        Auth::guard('admin')->logout();
        return redirect('admin/login');
    }

    public function getInfo(){
        if(File::exists(storage_path() . '/app/public/info')){
            $info = json_decode(Storage::get('public/info'));
        	return view('admin.info', compact('info'));
        }
        else{
            $info = '';
            Storage::put('public/info', json_encode($info));
            return view('admin.info');            
        }
    }

    public function postInfo(Request $request){
        $info = array(
            'title' => $request->title,
            'phoneNumber' => $request->phoneNumber,
            'email' => $request->email,
            'address' => $request->address,
            'webUrl' => $request->webUrl,
            'webName' => $request->webName,
            'image' => $request->image->getClientOriginalName()
        );

        $tmp = json_decode(Storage::get('public/info'));
        if($tmp->image != $request->image){
            $request->file('image')->move(public_path('/img/info'), $request->file('image')->getClientOriginalName());
            File::delete( 'img/info/' . $tmp->image );
        }

        Storage::put('public/info', json_encode($info));

        return redirect()->back();
    }

    public function getNav(){
        $cateParentList = collect(DB::select('CALL `admin_cate_parent_list`();'));
        $cateParentCount = $cateParentList->count();
        $cateList = array();
        $cateListCount = array();
        //dd($cateParentList);

        foreach ($cateParentList as $cateParent) {
            //$list = Category::whereRaw('parent_id = ' . $cateParent->cate_id . ' AND id != ' . $cateParent->cate_id )->get();
            $list = collect(DB::select('CALL `list_categories_ID`('.$cateParent->cate_id.')'));
            $cateListCount[$cateParent->cate_id] = $list->count();
            $cateList[$cateParent->cate_id] = json_decode(json_encode($list));
        }

        //dd($cateList);

        return view('admin.nav', compact('cateParentList', 'cateParentCount', 'cateList', 'cateListCount'));
    }

    public function postNav(){
        return redirect()->back();
    }

    public function getEditNav(Request $request){
        //$tempt= 'CALL `category_id`('.$request->id.')';
        //$cate = collect(DB::select($tempt))->first();

        $cate = Category::find($request->id);
        if($cate->ordinal != $request->ordinal)
            $cate->ordinal = $request->ordinal;
        $cate->save();
        return redirect()->back();
    }

    public function getSlide(){
        $slideList = Slide::paginate(5);
        $slideListCount = Slide::all()->count();
    	return view('admin.slide', compact('slideList', 'slideListCount'));
    }

    public function postSlide(Request $request){
        $this->validate($request, [
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'title' => 'required',
            'content' => 'required',
            'link' => 'required',
            'ordinal' => 'required|numeric'
        ]);

        $request->file('image')->move(public_path('/img/slides'), $request->file('image')->getClientOriginalName());

        $slide = new Slide;

        $slide->image = $request->image->getClientOriginalName();
        $slide->title = $request->title;
        $slide->link = $request->link;
        $slide->content = $request->content;
        $slide->ordinal = $request->ordinal;

        $slide->save();

        return redirect()->back();
    }

    public function getRemoveSlide($id){
        $image = Slide::find($id)->image;
        
        Slide::destroy($id);

        if(Slide::where('image', $image)->get()->isEmpty())
             File::delete( 'img/slides/' . $image );
        
    }

    public function postEditSlide(Request $request){
        $this->validate($request, [
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
            ]);
        $slide = Slide::find($request->editId);

        if($request->editImage){
            $img = $slide->image;
            $slide->image = $request->editImage->getClientOriginalName();
            $request->file('editImage')->move(public_path('/img/slides'), $request->file('editImage')->getClientOriginalName());
        }

        if($request->editTitle) $slide->title = $request->editTitle;
        if($request->editLink) $slide->link = $request->editLink;
        if($request->editContent) $slide->content = $request->editContent;
        if($request->editOrdinal) $slide->ordinal = $request->editOrdinal;

        $slide->save();

        if(isset($img) && call(DB::select('CALL `slide`('.$img.');'))->isEmpty())
            File::delete( 'img/slides/' . $img);

        return redirect()->back();

    }

    public function getCategory(){
        $cateList = collect(DB::select('CALL `list_categories`();'));
        //dd($cateList);
    	return view('admin.category', compact('cateList'));
    }

    public function postCategory(Request $request){
        $this->validate($request, [
            'name' => 'required',
            'parent_id' => 'required'
        ]);

        $cate = new Category;

        $cate->name = $request->name;

        if($request->parent_id == 0){
            $next_id = DB::select("SHOW TABLE STATUS LIKE 'categories'");
            $cate->parent_id = $next_id[0]->Auto_increment;
        }
        else
            $cate->parent_id = $request->parent_id;
        $cate->ordinal = 0;

        $cate->save();

        return redirect()->back();
    }

    public function postEditCategory(Request $request){
        $cate = Category::find($request->cat_id);
        

        if($request->cat_name)
            $cate->name = $request->cat_name;
        if($request->cat_parent)
            $cate->parent_id = $request->cat_parent;;
        $cate->save();

        return redirect()->back();      
    }

    public function getRemoveCategory($id){
        //Category::where('parent_id', $id)->where('id', '!=', $id)->get()
        //Product::where('cate_id', $id)->get()->isEmpty()
        //viết cho Product::where
        if(collect(DB::select('CALL `products_cate_id`('.$id.')'))->isEmpty() && collect(DB::select('CALL `list_categories_ID`('.$id.');'))->isEmpty()){
            Category::destroy($id);
            return redirect()->back();
        }
        else
            return redirect()->back()->withErrors('Can\'t remove category being used');
    }

    public function getProduct(){
        if(request()->has('cate_id')){
            $productList = Product::where('cate_id', request('cate_id'))->paginate(5)->appends('cate_id', request('cate_id'));
        }
        else
            $productList = Product::paginate(5);
        $cateList = Category::whereRaw('id != parent_id')->get();
        $cate_id = request('cate_id');
    	
        return view('admin.product', compact('productList', 'cateList', 'cate_id'));
    }

    public function postProduct(Request $request){
        $this->validate($request, [
            'name' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'image1' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'image2' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'image3' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'cate_id' => 'required',
            'detail' => 'required',
            'primary_cost' => 'required|numeric',
            'cost' => 'required|numeric'
        ]);

        for($i=0; $i<=3; $i++){
            if($i == 0) $i = "";
            $image = $request->file('image' . $i);
            $filename = $image->getClientOriginalName();
            $destinationPath = public_path('/img/products');

            $image->move($destinationPath, $filename);
        }

        $product = new Product;
        $product->id = $request->id;
        $product->name = $request->name;
        $product->image = $request->image->getClientOriginalName();
        $product->image1 = $request->image1->getClientOriginalName();
        $product->image2 = $request->image2->getClientOriginalName();
        $product->image3 = $request->image3->getClientOriginalName();
        $product->cate_id = $request->cate_id;
        $product->detail = $request->detail;
        $product->primary_cost = $request->primary_cost;
        $product->cost = $request->cost;

        $product->save();

        return redirect()->back();

    }

    public function getRemoveProduct($id){
        $product = Product::find($id);
        $image = $product->image;
        $image1 = $product->image1;
        $image2 = $product->image2;
        $image3 = $product->image3;

        Product::destroy($id);

        if(Product::where('image', $image)->orWhere('image1', $image)->orWhere('image2', $image)->orWhere('image3', $image)->get()->isEmpty())
            File::delete( 'img/products/' . $image ); 
 
        if(Product::where('image', $image1)->orWhere('image1', $image1)->orWhere('image2', $image1)->orWhere('image3', $image1)->get()->isEmpty())
            File::delete( 'img/products/' . $image1 );   

        if(Product::where('image', $image2)->orWhere('image1', $image2)->orWhere('image2', $image2)->orWhere('image3', $image2)->get()->isEmpty())
            File::delete( 'img/products/' . $image2 );       

        if(Product::where('image', $image3)->orWhere('image1', $image3)->orWhere('image2', $image3)->orWhere('image3', $image3)->get()->isEmpty())
            File::delete( 'img/products/' . $image3 );  

    }

    public function postEditProduct(Request $request){
        $this->validate($request, [
            'editImage' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'editImage1' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'editImage2' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'editImage3' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $product = Product::find($request->editId);

        $tmp_img = ''; $tmp_img_1 = ''; $tmp_img_2 = ''; $tmp_img_3 ='';

        if($request->editImage){
            $tmp_img = $product->image;
            $product->image = $request->editImage->getClientOriginalName();
            $request->file('editImage')->move(public_path('/img/products'), $request->file('editImage')->getClientOriginalName());
        }
        
        if($request->editImage1){
            $tmp_img_1 = $product->image1;
            $product->image1 = $request->editImage1->getClientOriginalName();
            $request->file('editImage1')->move(public_path('/img/products'), $request->file('editImage1')->getClientOriginalName());
        }
        if($request->editImage2){ 
            $tmp_img_2 = $product->image2;
            $product->image2 = $request->editImage2->getClientOriginalName();
            $request->file('editImage2')->move(public_path('/img/products'), $request->file('editImage2')->getClientOriginalName());
        }
        if($request->editImage3){
            $tmp_img_3 = $product->image3;
            $product->image3 = $request->editImage3->getClientOriginalName();
            $request->file('editImage3')->move(public_path('/img/products'), $request->file('editImage3')->getClientOriginalName());
        }
    
        if($request->editName != $product->name) $product->name = $request->editName;
        if($request->editCateId != $product->cate_id) $product->cate_id = $request->editCateId;
        if($request->editDetail != $product->detail) $product->detail = $request->editDetail;
        if($request->editPrimary_cost != $product->primary_cost) $product->primary_cost = $request->editPrimary_cost;
        if($request->editCost != $product->cost) $product->cost = $request->editCost;

        $product->save();

        if($tmp_img !== '' && Product::where('image', $tmp_img)->orWhere('image1', $tmp_img)->orWhere('image2', $tmp_img)->orWhere('image3', $tmp_img)->get()->isEmpty())
            File::delete( 'img/products/' . $tmp_img ); 
 
        if($tmp_img_1 !== '' && Product::where('image', $tmp_img_1)->orWhere('image1', $tmp_img_1)->orWhere('image2', $tmp_img_1)->orWhere('image3', $tmp_img_1)->get()->isEmpty())
            File::delete( 'img/products/' . $tmp_img_1 );   

        if($tmp_img_2 !== '' && Product::where('image', $tmp_img_2)->orWhere('image1', $tmp_img_2)->orWhere('image2', $tmp_img_2)->orWhere('image3', $tmp_img_2)->get()->isEmpty())
            File::delete( 'img/products/' . $tmp_img_2 );       

        if($tmp_img_3 !== '' && Product::where('image', $tmp_img_3)->orWhere('image1', $tmp_img_3)->orWhere('image2', $tmp_img_3)->orWhere('image3', $tmp_img_3)->get()->isEmpty())
            File::delete( 'img/products/' . $tmp_img_3 );             

        return redirect()->back();

    }

    public function getPicture(){
        $pictureList = Picture::paginate(5);

    	return view('admin.picture', compact('pictureList'));
    }

    public function postPicture(Request $request){
        $this->validate($request, [
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'content' => 'required'
        ]);

        $picture = new Picture;

        $request->file('image')->move(public_path('/img/pictures'), $request->file('image')->getClientOriginalName());
        $picture->image = $request->image->getClientOriginalName();
        $picture->content = $request->content;

        $picture->save();

        return redirect()->back();

    }

    public function getRemovePicture($id){
        $image = Picture::find($id)->image;
        Picture::destroy($id);

        if(Picture::where('image', $image)->get()->isEmpty())
            File::delete('img/pictures/' . $image);
    }

    public function getEditPicture(Request $request){
        $this->validate($request, [
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        $picture = Picture::find($request->editId);

        if($request->editImage) {
            $image = $picture->image;
            $picture->image = $request->file('editImage')->getClientOriginalName();
            $request->file('editImage')->move(public_path('img/pictures'), $request->file('editImage')->getClientOriginalName());
        }
        if($request->editContent) $picture->content = $request->editContent;

        $picture->save();

        if(isset($image) && Picture::where('image', $image)->get()->isEmpty())
            File::delete('img/pictures/' . $image);

        return redirect()->back();

    }

    public function profile(){
    	return view('admin.profile');
    }

    public function cart(){
    	return view('admin.cart');
    }
    
}
