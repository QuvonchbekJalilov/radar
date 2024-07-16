<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

    public function index()
    {
        return auth()->user()->favorites()->paginate(20);
    }

    public function store(Request $request): JsonResponse
    {   
        auth()->user()->favorites()->attach($request->product_id);

        return response()->json([
            'success' => true,
            'message' => 'success'
        ]);
    }

    public function destroy($favorite_id)
    {
        if (auth()->user()->hasFavorite($favorite_id)) {
            auth()->user()->favorites()->detach($favorite_id);

            return response()->json(['success' => true]);
        }

        return response()->json([
            'success' => false,
            'message' => "favourite does not exist in this user"
        ]);
    }
}
