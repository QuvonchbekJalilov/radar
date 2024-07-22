<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

    public function index()
    {
        $carts = auth()->user()->carts()->paginate(20);

        return ProductResource::collection($carts);    }

    public function store(Request $request): JsonResponse
    {
        $product = Product::find($request->product_id);

        if (!$product) {
            return response()->json([
                'success' => false,
                'message' => 'Product does not exist'
            ], 404);
        }

        auth()->user()->carts()->attach($request->product_id);

        return response()->json([
            'success' => true,
            'message' => 'success'
        ]);
    }


    public function destroy($cart_id)
    {
        if (auth()->user()->hasCart($cart_id)) {
            auth()->user()->carts()->detach($cart_id);

            return response()->json(['success' => true]);
        }

        return response()->json([
            'success' => false,
            'message' => "Cart does not exist in this user"
        ]);
    }
}
