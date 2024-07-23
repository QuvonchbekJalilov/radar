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

        return ProductResource::collection($carts);
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
        ]);

        $user = auth()->user();

        if ($user->hasCart($validated['product_id'])) {
            return response()->json([
                'success' => false,
                'message' => 'Product is already in cart'
            ], 400);
        }

        $user->carts()->attach($validated['product_id']);

        return response()->json([
            'success' => true,
            'message' => 'Product added to cart successfully'
        ]);
    }

    public function destroy($product_id)
    {
        $user = auth()->user();

        if ($user->hasCart($product_id)) {
            $user->carts()->detach($product_id);

            return response()->json(['success' => true, 'message' => 'Product removed from cart']);
        }

        return response()->json([
            'success' => false,
            'message' => "Product not found in the user's cart"
        ]);
    }
}
