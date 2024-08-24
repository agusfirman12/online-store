<?php

namespace App\Http\Controllers\API;

use App\Models\Cart;
use App\Models\Product;
use App\Models\CartDetile;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index(){
        $cart = Cart::where('user_id', Auth::user()->id)->where('status', 0)->first();
        if(!empty($cart)){
            $cart_detiles = CartDetile::where('cart_id', $cart->id)->get();
            return response()->json([
                'cart' => $cart,
                'cart detiles' => $cart_detiles
            ], 200);
        }
        return response()->json(['warning' => 'Cart Empty'], 400);
    }
    public function store(Request $request, $id){
                // Find the product by ID
        $product = Product::find($id);

        if (!$product) {
            return response()->json(['error' => 'Product not found.'], 404);
        }

        // Check if the requested quantity is available in stock
        if ($product->stock < $request->quantity) {
            return response()->json(['warning' => 'Stock Not Available'], 400);
        }

        // Find or create a cart for the user
        $cart = Cart::firstOrCreate(
            ['user_id' => Auth::user()->id, 'status' => 0],
            ['total_price' => 0],
            ['quantity' => 1],
            ['produdct_id' => $product->id]
        );

        // Check if the product is already in the cart
        $cartDetail = CartDetile::where('cart_id', $cart->id)->where('product_id', $product->id)->first();

        if (!$cartDetail) {
            // If not, create a new cart detail
            $cartDetail = new CartDetile();
            $cartDetail->cart_id = $cart->id;
            $cartDetail->product_id = $product->id;
            $cartDetail->total = $request->quantity;
            $cartDetail->price_total = $product->price * $request->quantity;
            $cartDetail->save();
        } else {
            // If it exists, update the quantity and total price
            $cartDetail->total += $request->quantity;
            $cartDetail->price_total += $product->price * $request->quantity;
            $cartDetail->update();
        }

        // Update the cart's total price
        $cart->total_price += $product->price * $request->quantity;
        $cart->update();

        return response()->json(['message' => 'Product added to cart successfully.', 'cart detail' => $cartDetail], 200);
    }

    public function destroy($id){
        CartDetile::destroy($id);
        return response()->json(['success' => true, 'message' => 'Product Deleted'], 200);
    }

    public function checkout(){
        $carts = Cart::where('user_id', Auth::user()->id)->where('status', 0)->first();
        $carts->status = 1;
        $carts->update();
        return response()->json(['success' => true, 'message' => 'Checkout Success'], 200);
    }
}
