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

    /**
     * Display a listing of the cart items.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        $carts = auth()->user()->carts()->paginate(20);

        return ProductResource::collection($carts);
    }

    /**
     * Store a newly created item in the cart.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'nullable|integer|min:1',
        ]);

        $user = auth()->user();
        $quantity = $validated['quantity'] ?? 1;

        if ($user->hasCart($validated['product_id'])) {
            // Update quantity if product already in cart
            $user->carts()->updateExistingPivot($validated['product_id'], ['quantity' => $quantity]);
            return response()->json([
                'success' => true,
                'message' => 'Product quantity updated in cart successfully'
            ]);
        }

        $user->carts()->attach($validated['product_id'], ['quantity' => $quantity]);

        return response()->json([
            'success' => true,
            'message' => 'Product added to cart successfully'
        ]);
    }

    /**
     * Update the specified item quantity in the cart.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateCart(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $product_id = $validated['product_id'];
        $user = auth()->user();

        if ($user->hasCart($product_id)) {
            $user->carts()->updateExistingPivot($product_id, ['quantity' => $validated['quantity']]);

            return response()->json([
                'success' => true,
                'message' => 'Product quantity updated successfully'
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => "Product not found in the user's cart"
        ], 404);
    }

    /**
     * Remove the specified item from the cart.
     *
     * @param  int  $product_id
     * @return \Illuminate\Http\JsonResponse
     */
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
        ], 404);
    }
}
