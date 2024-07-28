<?php

namespace App\Http\Controllers;

use App\Models\Discount;
use App\Models\Product;
use Illuminate\Http\Request;

class DiscountController extends Controller
{
    
    public function index()
    {
        $discounts = Discount::with('product')->get();
        return view('admin.discounts.index', compact('discounts'));
    }

    
    public function create()
    {
        $products = Product::all();
        return view('admin.discounts.create', compact('products'));
    }

    
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'name' => 'required|string|max:255',
            'percentage' => 'nullable|numeric|min:0|max:100',
            'sum' => 'nullable|numeric|min:0',
            'from' => 'required|date',
            'to' => 'required|date|after_or_equal:from',
        ]);

        Discount::create($request->all());

        return redirect()->route('discounts.index')->with('success', 'Discount created successfully.');
    }

    
    public function show(Discount $discount)
    {
        return view('admin.discounts.show', compact('discount'));
    }

    
    public function edit(Discount $discount)
    {
        $products = Product::all();
        return view('admin.discounts.edit', compact('discount', 'products'));
    }

    
    public function update(Request $request, Discount $discount)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'name' => 'required|string|max:255',
            'percentage' => 'nullable|numeric|min:0|max:100',
            'sum' => 'nullable|numeric|min:0',
            'from' => 'required|date',
            'to' => 'required|date|after_or_equal:from',
        ]);

        $discount->update($request->all());

        return redirect()->route('discounts.index')->with('success', 'Discount updated successfully.');
    }

    /**
     * Remove the specified discount from storage.
     */
    public function destroy(Discount $discount)
    {
        $discount->delete();
        return redirect()->route('discounts.index')->with('success', 'Discount deleted successfully.');
    }
}
