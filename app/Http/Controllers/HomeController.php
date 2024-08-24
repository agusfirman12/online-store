<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use App\Models\CartDetile;
use Illuminate\Http\Request;
use App\Models\ProductCategory;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Expr\Empty_;

class HomeController extends Controller
{
    public function index()
    {
        $products = Product::all();
        $categories = ProductCategory::all();
        return view('home.home', compact('products', 'categories'));
    }

    public function detileProduct($id){
        $product = Product::find($id);
        return view('home.detileProduct', compact('product'));
    }

    public function addtocart(Request $request, $id){
        $product = Product::where('id', $id)->first();

        if($product->stock < $request->quantity){
            return redirect('/')->with('warning', 'Stock Not Available');
        }

        $check_cart = Cart::where('user_id', Auth::user()->id)->where('status', 0)->first();
        
        if(empty($check_cart)){
            
            $cart = new Cart();
            $cart->user_id = Auth::user()->id;
            $cart->product_id = $id;
            $cart->quantity = $request->quantity;
            $cart->status = 0;
            $cart->total_price = 0;
            $cart->save();
        }

        $new_cart = Cart::where('user_id', Auth::user()->id)->where('status', 0)->first();
        
        $check_cart_detile = CartDetile::where('cart_id', $new_cart->id)->where('product_id', $product->id)->first();
        if(empty($check_cart_detile)){     
            $cart_detile = new CartDetile();
            $cart_detile->cart_id = $new_cart->id;
            $cart_detile->product_id = $product->id;
            $cart_detile->total = $request->quantity;
            $cart_detile->price_total = $product->price * $request->quantity;
            $cart_detile->save();
        }else{
            $cart_detile = CartDetile::where('cart_id', $new_cart->id)->where('product_id', $product->id)->first();
            $cart_detile->total = $cart_detile->total + $request->quantity;
            $new_price_cart_detile = $cart_detile->price_total + ($product->price * $request->quantity);
            $cart_detile->price_total = $cart_detile->price_total + $new_price_cart_detile;
            $cart_detile->update();
        }

        $carts = Cart::where('user_id', Auth::user()->id)->where('status', 0)->first();
        $carts->total_price = $carts->total_price + ($product->price * $request->quantity);
        $carts->update();

        return redirect('/')->with('success', 'Product Added To Cart');
    }

    public function checkout(){
        $carts = Cart::where('user_id', Auth::user()->id)->where('status', 0)->first();
        if (!empty($carts)) {
            $cart_detiles = CartDetile::where('cart_id', $carts->id)->get();
            return view('home.checkout', compact('carts', 'cart_detiles'));
        }
        return redirect('/')->with('warning', 'Cart Empty');
    }

    public function deleteCart($id){
        CartDetile::destroy($id);
        return redirect('/checkout')->with('deleted', 'Product Deleted');
    }

    public function confirmCheckout(){
        $carts = Cart::where('user_id', Auth::user()->id)->where('status', 0)->first();
        $carts->status = 1;
        $carts->update();
        return redirect('/')->with('success', 'Checkout Success');
    }
}
