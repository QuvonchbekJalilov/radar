<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use Yajra\DataTables\DataTables;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BrandController extends Controller
{

    public function index()
    {
        $brands = Brand::paginate(20);
        return view('admin.brand.index', compact('brands'));
    }


    public function create()
    {
        return view('admin.brand.create');
    }


    public function store(Request $request)
    {
        $data = $request->all();

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('images/brands', 'public');
        }

        Brand::create($data);

        return redirect()->route('brands.index')->with('success', "Kategoriya ma'lumoti saqlandi");
    }

    public function show(Brand $brand)
    {
        return view('admin.brand.show', compact('brand'));
    }

    public function edit(Brand $brand)
    {
        return view('admin.brand.edit', compact('brand'));
    }

    public function update(Request $request, Brand $brand)
    {
        $data = $request->all();

        if ($request->hasFile('image')) {
            // Delete the old image
            if ($brand->image) {
                Storage::disk('public')->delete($brand->image);
            }

            // Store the new image
            $data['image'] = $request->file('image')->store('images/brands', 'public');
        }

        $brand->update($data);

        return redirect()->route('brands.index')->with('success', "Kategoriya ma'lumoti tahrirlandi");
    }


    public function destroy(Brand $brand)
    {
        if ($brand->image) {
            Storage::disk('public')->delete($brand->image);
        }
        $brand->delete();

        return redirect()->back()->with('success', "Kategoriya Muvafaqiyatli o'chirildi");
    }
}
