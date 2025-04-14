<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Cart;

class CartController extends Controller
{
    public function addToCart(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $customer = auth('api_customers')->user(); // Get the authenticated customer

        if (!$customer) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $cartItem = Cart::where('customer_id', $customer->id)
        ->where('product_id', $request->product_id)
        ->first();
    
        if ($cartItem) {
            $cartItem->update(['quantity' => $cartItem->quantity + $request->quantity]);
        } else {
            $cartItem = Cart::create([
                'customer_id' => $customer->id,
                'product_id' => $request->product_id,
                'quantity' => $request->quantity // Ensure correct quantity
            ]);
        }

        return response()->json(['message' => 'Item added to cart', 'cart' => $cartItem], 201);
    }

    public function getCart()
    {
        $customer = auth('api_customers')->user();
        $cartItems = Cart::where('customer_id', $customer->id)->with('product')->get();
        return response()->json($cartItems);
    }

    public function removeFromCart($id)
    {
        $customer = auth('api_customers')->user();
        Cart::where('id', $id)->where('customer_id', $customer->id)->delete();
        return response()->json(['message' => 'Item removed']);
    }

    public function getCartCount()
    {
        $customer = auth('api_customers')->user();
        if (!$customer) {
            return response()->json(['count' => 0]);
        }

        $cartCount = Cart::where('customer_id', $customer->id)->sum('quantity');
        return response()->json(['count' => $cartCount]);
    }
    public function updateQuantity(Request $request, $id)
    {
        $cartItem = Cart::find($id);

        if (!$cartItem) {
            return response()->json(['message' => 'Item not found'], 404);
        }

        $cartItem->quantity = $request->quantity;
        $cartItem->save();

        return response()->json(['message' => 'Quantity updated successfully']);
    }

}
