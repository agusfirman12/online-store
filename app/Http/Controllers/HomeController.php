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
            $cart->quantity = 0;
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
        $cart_detile = CartDetile::where('cart_id', $carts->id)->get();
        $carts->total_price = $carts->total_price + ($product->price * $request->quantity);
        $carts->quantity = count($cart_detile);
        $carts->update();

        return redirect('/')->with('success', 'Product Added To Cart');
    }

    public function checkout(){
        $carts = Cart::where('user_id', Auth::user()->id)->where('status', 0)->first();
        if (!empty($carts) && $carts->total_price > 0) {
            $cart_detiles = CartDetile::where('cart_id', $carts->id)->get();
            return view('home.checkout', compact('carts', 'cart_detiles'));
        }
        return redirect('/')->with('warning', 'Cart Empty');
    }

    public function deleteCart($id){
            // Get the cart for the authenticated user where status is 0
    $cart = Cart::where('user_id', Auth::user()->id)->where('status', 0)->first();
    
    if ($cart) {
        // Find the cart detail to be deleted by its id
        $cart_detile = CartDetile::where('id', $id)->where('cart_id', $cart->id)->first();

        if ($cart_detile) {
            // Subtract the total price of the cart detail from the cart's total price
            $cart->total_price -= $cart_detile->price_total;
            $cart->save(); // Save the updated cart

            // Delete the cart detail
            $cart_detile->delete();

            if ($cart->total_price <= 0) {
                return redirect('/')->with('deleted', 'cart is empty');
            }

            return redirect('/checkout')->with('deleted', 'Product Deleted');
        } else {
            return redirect('/checkout')->with('error', 'Cart detail not found.');
        }
    } else {
        return redirect('/checkout')->with('error', 'Cart not found.');
    }
    }

    public function confirmCheckout(){
        $carts = Cart::where('user_id', Auth::user()->id)->where('status', 0)->first();
        $carts->status = 1;
        $carts->update();
        return redirect('/')->with('successCheckout', 'Checkout Success');
    }

    public function search(Request $request){
        $search = $request->search;
        $products = Product::where('name', 'like', '%'.$search.'%')->get();
        return view('home.search', compact('products'));
    }
}
