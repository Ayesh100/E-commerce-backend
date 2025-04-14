<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notification;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    // Fetch only unread notifications for the authenticated customer
    public function index()
    {
        $customer = auth()->user(); // Get logged-in customer

        $notifications = Notification::where('customer_id', $customer->id)
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json($notifications);
    }

    // Mark a notification as read
    public function markAsRead($id)
    {
        $notification = Notification::where('id', $id)
            ->where('customer_id', auth()->id()) // Ensure the customer owns this notification
            ->first();

        if (!$notification) {
            return response()->json(['message' => 'Notification not found'], 404);
        }

        $notification->update(['is_read' => true]);

        return response()->json(['message' => 'Notification marked as read']);
    }

    public function deleteNotification($id)
    {
        $notification = Notification::where('id', $id)
            ->where('customer_id', auth()->id()) // Ensure the customer owns this notification
            ->first();

        if (!$notification) {
            return response()->json(['message' => 'Notification not found'], 404);
        }

        $notification->delete();

        return response()->json(['message' => 'Notification deleted successfully']);
    }

    public function showNotification($id)
    {
        $notification = Notification::where('id', $id)
            ->where('customer_id', auth()->id())
            ->first();

        if (!$notification) {
            return response()->json(['message' => 'Notification not found'], 404);
        }

        $order = Order::with('orderItems.product')->where('id', $notification->order_id)->first();

        if (!$order) {
            return response()->json(['message' => 'Order not found'], 404);
        }

        return response()->json([
            'order' => [
                'id' => $order->id,
                'total_price' => $order->total_price,
                'created_at' => $order->created_at->toDateTimeString(),
                'status' => $order->status,
            ],
            'items' => $order->orderItems->map(function ($item) {
                return [
                    'id' => $item->id,
                    'product_name' => $item->product->product_name,
                    'product_img' => $item->product->product_img,
                    'quantity' => $item->quantity,
                    'price' => $item->price,
                ];
            })
        ]);
    }
}
