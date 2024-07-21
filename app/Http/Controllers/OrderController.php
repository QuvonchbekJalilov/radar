<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use App\Models\User_address;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Order::orderBy('id', 'DESC')->paginate(20);

        return view('admin.order.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::all();
        $products = Product::all();
        $userAddresses = User_address::all();

        return view('admin.order.create', compact('users', 'products', 'userAddresses'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'user_address_id' => 'required|exists:user_addresses,id',
            'total_amount' => 'required|numeric', // Adjust validation as per your needs
            'payment_method' => 'nullable|string',
            'shipping_method' => 'nullable|string',
            'payment_status' => 'nullable|string',
            'shipping_status' => 'nullable|string',
            'status' => 'required|string',
            'order_date' => 'nullable|date',
            'product_ids' => 'required|array',
            'product_ids.*' => 'required|exists:products,id',
        ]);

        // Create Order
        $order = Order::create([
            'user_id' => $request->user_id,
            'user_address_id' => $request->user_address_id,
            'total_amount' => $request->total_amount,
            'payment_method' => $request->payment_method,
            'shipping_method' => $request->shipping_method,
            'payment_status' => $request->payment_status,
            'shipping_status' => $request->shipping_status,
            'status' => $request->status,
            'order_date' => $request->order_date,
        ]);

        // Attach Products to Order
        foreach ($request->product_ids as $productId) {
            // Adjust quantity handling if needed
            $order->products()->attach($productId, ['quantity' => 1]); // Default quantity
        }

        return redirect()->route('order.index')->with('success', 'Order created successfully.');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $order = Order::find($id);
        return view('admin.order.show', compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $order = Order::findOrFail($id);
        $users = User::all();
        $products = Product::all();
        $userAddresses = User_address::all();
        $address = User_address::findOrFail($order->user_address_id);


        return view('admin.order.edit', compact('order', 'users', 'products', 'address', 'userAddresses'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'user_address_id' => 'required|exists:user_addresses,id',
            'total_amount' => 'required|numeric', // Adjust validation as per your needs
            'payment_method' => 'nullable|string',
            'shipping_method' => 'nullable|string',
            'payment_status' => 'nullable|string',
            'shipping_status' => 'nullable|string',
            'status' => 'required|string',
            'order_date' => 'nullable|date',
            'product_ids' => 'required|array',
            'product_ids.*' => 'required|exists:products,id',
        ]);

        $order = Order::findOrFail($id);

        $order->update([
            'user_id' => $request->user_id,
            'user_address_id' => $request->user_address_id,
            'total_amount' => $request->total_amount,
            'payment_method' => $request->payment_method,
            'shipping_method' => $request->shipping_method,
            'payment_status' => $request->payment_status,
            'shipping_status' => $request->shipping_status,
            'status' => $request->status,
            'order_date' => $request->order_date,
        ]);

        // Sync Products to Order
        $order->products()->sync($request->product_ids);

        return redirect()->route('order.index')->with('success', 'Order updated successfully.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $order = Order::find($id);
        $order->delete();

        return redirect()->back();
    }

    public function data(Request $request)
    {
        $lang = $request->input('lang', 'uz'); // Default to 'uz' if no language is provided
        $columnName = "name_{$lang}";

        if ($request->ajax()) {
            $data = Order::with(['user', 'products'])
                ->select(['id', 'user_id', 'total_amount', 'payment_status', 'shipping_status']);

            return DataTables::of($data)
                ->addColumn('user_first_name', function ($order) {
                    return $order->user ? $order->user->first_name : 'N/A';
                })
                ->addColumn('products', function ($order) use ($columnName) {
                    return $order->products->pluck($columnName)->implode(', ');
                })
                ->addColumn('actions', function ($order) {
                    $editUrl = route('order.edit', ['order' => $order->id]);
                    $showUrl = route('order.show', ['order' => $order->id]);
                    $deleteUrl = route('order.destroy', ['order' => $order->id]);

                    return '
                <a href="' . $editUrl . '" class="icon-container"><i class="mdi mdi-book-edit-outline fs-3"></i></a>
                <a href="' . $showUrl . '" class="icon-container"><i class="mdi mdi-eye fs-3"></i></a>
                <form action="' . $deleteUrl . '" method="POST" style="display: inline;" onsubmit="return confirm(\'Ochirishga ruxsat berasizmi\')">
                    ' . csrf_field() . '
                    ' . method_field('DELETE') . '
                    <button type="submit" style="border: none; background: none; cursor: pointer;" class="icon-container"><i class="mdi mdi-trash-can-outline fs-3" style="color: #346ee0;"></i></button>
                </form>
            ';
                })
                ->filterColumn('user_first_name', function ($query, $keyword) {
                    $query->whereHas('user', function ($query) use ($keyword) {
                        $query->where('first_name', 'like', "%{$keyword}%");
                    });
                })
                ->filterColumn('products', function ($query, $keyword) use ($columnName) {
                    $query->whereHas('products', function ($query) use ($columnName, $keyword) {
                        $query->where($columnName, 'like', "%{$keyword}%");
                    });
                })
                ->rawColumns(['actions'])
                ->make(true);
        }

        return null; // Return null or handle non-AJAX requests accordingly
    }



    public function updatePaymentStatus(Request $request)
    {
        $order = Order::findOrFail($request->id);
        $order->payment_status = $request->payment_status;
        $order->save();

        return response()->json(['success' => true]);
    }

    public function updateShippingStatus(Request $request)
    {
        $order = Order::findOrFail($request->id);
        $order->shipping_status = $request->shipping_status;
        $order->save();

        return response()->json(['success' => true]);
    }
}
