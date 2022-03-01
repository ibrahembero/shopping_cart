<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Product;
use App\Cart;
use App\User;
use Session;

class ProductController extends Controller
{
    public function  __construct(){
        $this->middleware('auth');
    }
    public function getAllProducts(){
        $products = Product::select('id','name','price','description','flag')->get();
        return view('products.all',compact('products'));
    }
    // public function getDetail($id){
    //     $product = Product::find($id);
    //     return view('products.detail',compact('product'));
    // }
    public function addToCart(Request $request){
      
        $user = Auth::user();
        $product = Product::find($request->product_id);
        $product->update([
            'flag'=> $request->product_flag
        ]);
        if($request->session('status')){
            $cart = new Cart;
            $cart->user_id = $user->id;
            $cart->product_id =$request->product_id ;
            $cart->save();
            //return redirect('products');
            return response()->json([
            'status'=>true,
            'msg'=>'تم إضافة المنتج بنجاح',
        ]);

        }else{
            return redirect('login');
        }   
    }
    // return number of products in cart
    public static function cartItem(){
        $user = Auth::user();
        $userId = $user->id;
        return Cart::where('user_id',$userId)->count();
    }
    //
    public function removeFromCart(Request $request){
          $productCart = Cart::where('product_id',$request->product_id)->get();
          $removableProductID = $productCart[0]->id;
          $removableProduct = Cart::find($removableProductID);
          $product = Product::find($request->product_id);
          $product->update([
            'flag'=> $request->product_flag
           ]);
            $removableProduct->delete();
            return response()->json([
                'status'=>true,
                'msg'=>'Product is successfully deleted from Cart',
            ]);
    }
    ///////////add product
    public function addProduct(){
       return view('products.add');
    }
    //store product
    public function saveProduct(Request $request){
        $product = new Product();
        $product->name = $request->name;
        $product->price = $request->price;
        $product->category = $request->category;
        $product->description = $request->description;
        $product->gallery = $request->gallery;
 
        $product->save();
        //return redirect('products');
        if($product)
            return response()->json([
                'status'=>true,
                'msg'=>'Data is successfully saved'
            ]);
        else
            return response()->json([
                'status'=>false,
                'msg'=>'فشل الحفظ الرجاء المحاولة من جديد'
            ]);
    }
}
