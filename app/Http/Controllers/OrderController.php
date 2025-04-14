<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use App\Models\Notification; // Import your custom Notification model
use App\Events\NewNotificationEvent;



class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('orderItems.product')->orderBy('id', 'DESC')->paginate(8);
        return view('admin.orders.index', compact('orders'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required|string',
            'address' => 'required|string',
            'city' => 'required|string',
            'zip_code' => 'required|string',
            'payment_method' => 'required|in:cod',
        ]);

        $customer = Auth::user(); // Ensure user is authenticated
        $cartItems = Cart::where('customer_id', $customer->id)->get();

        if ($cartItems->isEmpty()) {
            return response()->json(['message' => 'Cart is empty'], 400);
        }

        $totalPrice = $cartItems->sum(fn($item) => $item->product->product_price * $item->quantity);

        $order = Order::create([
            'customer_id' => $customer->id,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'city' => $request->city,
            'zip_code' => $request->zip_code,
            'payment_method' => 'cod',
            'total_price' => $totalPrice,
        ]);

        foreach ($cartItems as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item->product_id,
                'quantity' => $item->quantity,
                'price' => $item->product->product_price,
            ]);
        }

        // Clear the cart after order is placed
        Cart::where('customer_id', $customer->id)->delete();

        $notification = Notification::create([
            'customer_id' => $customer->id,
            'order_id'    => $order->id, // Now storing the order ID properly
            'message'     => 'Your order #' . $order->id . ' has been placed successfully.',
            'is_read'     => false,
        ]);

        // event(new NewNotificationEvent($notification));

        return response()->json(['message' => 'Order placed successfully'], 201);
    }

    public function getCustomerOrders(Request $request)
    {
        $customer = auth()->user();

        $orders = Order::where('customer_id', $customer->id)
            ->with('orderItems.product')
            ->orderBy('created_at', 'desc')
            ->paginate(7);

        return response()->json([
            'orders' => $orders->items(),
            'totalPages' => $orders->lastPage(),
        ]);
    }

    public function edit(Request $request, Order $order)
    {
        // Validate and update status...
        $order->status = $request->status;
        $order->save();

        return response()->json(['message' => 'Order status updated successfully'], 200);
    }
    public function search(Request $request)
    {
        $query = Order::with('orderItems.product')->orderBy('id', 'DESC');

    if ($request->has('search') && $request->search !== null) {
        $query->where('id', $request->search);
    }

    $orders = $query->paginate(8);

        return view('admin.orders.search', compact('orders'));
    }
}
