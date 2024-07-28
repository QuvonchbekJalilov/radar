<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Category;
use App\Policies\CategoryPolicy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BannerController extends Controller
{

    public function index()
    {
        $banners = Banner::with('category')->get();
        return view('admin.banner.index', compact('banners'));
    }

    
    public function create()
    {
        $categories = Category::all();
        return view('admin.banner.create', compact('categories'));
    }

    
    public function store(Request $request)
    {
        $data = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('images/banners', 'public');
        }

        Banner::create($data);

        return redirect()->route('banners.index')->with('success', 'Banner yaratildi');
    }

    
    public function show(Banner $banner)
    {
        return view('admin.banner.show', compact('banner'));
    }

    
    public function edit(Banner $banner)
    {
        $categories = Category::all();
        return view('admin.banner.edit', compact('banner', 'categories'));
    }

    
    public function update(Request $request, Banner $banner)
    {
        $data = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        if ($request->hasFile('image')) {
            // Delete the old image
            if ($banner->image) {
                Storage::disk('public')->delete($banner->image);
            }

            // Store the new image
            $data['image'] = $request->file('image')->store('images/categories', 'public');
        }

        $banner->update($data);

        return redirect()->route('banners.index')->with('success', 'Banner muvaffaqiyatli tahrirlandi');
    }

    
    public function destroy(Banner $banner)
    {
        if ($banner->image){
            Storage::delete($banner->image);
        }

        $banner->delete();
        return redirect()->back()->with('success', 'Banner muvaffaqiyatli o\'chirildi');
    }
}
