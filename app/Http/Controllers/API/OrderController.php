<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\OrderResource;
use App\Models\Order;
use App\Models\Product;
use App\Models\User_address;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function placeOrder(Request $request)
    {
        $request->validate([
            'address_id' => 'nullable|exists:user_addresses,id',
            'products' => 'required|array',
            'products.*.id' => 'required|exists:products,id',
            'products.*.quantity' => 'required|integer|min:1',
            'payment_method' => 'required|string',
            'shipping_method' => 'required|string',
        ]);

        $user = Auth::user();

        if (!$user->addresses) {
            return $this->error('Please enter address.');
        }

        DB::beginTransaction();

        try {
            $address = $user->addresses()->first();
            $order = new Order([
                'user_id' => $user->id,
                'user_address_id' => $address->id,
                'total_amount' => 0, // Will calculate total amount below
                'payment_method' => $request->payment_method,
                'shipping_method' => $request->shipping_method,
                'payment_status' => "to'lanmagan",
                'shipping_status' => 'yetkazilmoqda',
                'status' => 'new',
                'order_date' => now(),
            ]);

            $order->save();

            $totalAmount = 0;
            foreach ($request->products as $productData) {
                $product = Product::find($productData['id']);
                $quantity = $productData['quantity'];

                // Check if there is enough stock
                if ($product->stock < $quantity) {
                    DB::rollBack();
                    return response()->json(['message' => "Not enough stock for product {$product->name}"], 400);
                }

                // Calculate total amount
                $totalAmount += $product->price * $quantity;

                // Attach product to order and adjust stock
                $order->products()->attach($product->id, ['quantity' => $quantity]);

                // Decrease product stock
                $product->stock -= $quantity;
                $product->save();
            }

            // Update order total amount
            $order->total_amount = $totalAmount;
            $order->save();

            DB::commit();

            return new OrderResource($order);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => 'Failed to place order.', 'error' => $e->getMessage()], 500);
        }
    }


    public function getOrder($id)
    {
        $order = Order::with('products', 'user', 'address')->findOrFail($id);

        return response()->json(['order' => $order], 200);
    }

    public function getUserOrders()
    {
        $user = Auth::user();
        $orders = $user->orders()->with('address', 'products', 'address')->get();

        return response()->json(['orders' => $orders], 200);
    }

    public function cancelOrder($id)
    {
        $order = Order::findOrFail($id);
        if ($order->user_id != Auth::id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $order->status = 'cancelled';
        $order->save();

        return response()->json(['message' => 'Order cancelled successfully.'], 200);
    }
}
