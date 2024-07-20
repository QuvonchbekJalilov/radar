<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Gallery;
use App\Models\Order;
use App\Models\Specification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\DataTables;

class ProductController extends Controller
{

    public function index()
    {
        $products = Product::all();
        return view('admin.product.index', compact('products'));
    }


    public function create()
    {
        $categories = Category::all();
        $brands = Brand::all();
        return view('admin.product.create', compact('categories','brands'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
        }

        // Create the product
        $product = Product::create([
            'category_id' => $request->category_id,
            'brand_id' => $request->brand_id,
            'name_uz' => $request->name_uz,
            'name_ru' => $request->name_ru,
            'name_en' => $request->name_en,
            'description_uz' => $request->description_uz,
            'description_ru' => $request->description_ru,
            'description_en' => $request->description_en,
            'price' => $request->price,
            'stock' => $request->stock,
            'image' => $imagePath ?? null,
            'status' => $request->status,
        ]);

        // Store gallery images
        if ($request->hasFile('gallery_images')) {
            foreach ($request->file('gallery_images') as $galleryImage) {
                $galleryImagePath = $galleryImage->store('gallery', 'public');
                Gallery::create([
                    'product_id' => $product->id,
                    'image' => $galleryImagePath,
                ]);
            }
        }

        if ($request->specifications) {
            foreach ($request['specifications'] as $specData) {
                $specification = new Specification($specData);
                $product->specifications()->save($specification);
            }
        }

        return redirect()->route('product.index')->with('success', 'Mahsulot muvaffaqiyatli qo\'shildi!');
    }


    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return view('admin.product.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {

        $categories = Category::all();
        $brands = Brand::all();
        return view('admin.product.edit', compact('product', 'categories', 'brands'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        // Update the main product image if a new one is uploaded
        if ($request->hasFile('image')) {
            // Delete the old image
            Storage::disk('public')->delete($product->image);

            // Store the new image
            $imagePath = $request->file('image')->store('images', 'public');
            $product->image = $imagePath;
        }

        // Update the product details
        $product->update([
            'category_id' => $request->category_id,
            'brand_id' => $request->brand_id,
            'name_uz' => $request->name_uz,
            'name_ru' => $request->name_ru,
            'name_en' => $request->name_en,
            'description_uz' => $request->description_uz,
            'description_ru' => $request->description_ru,
            'description_en' => $request->description_en,
            'price' => $request->price,
            'stock' => $request->stock,
            'status' => $request->status,
        ]);

        // Store new gallery images if any
        if ($request->hasFile('gallery_images')) {
            $product->galleries()->delete(); // Delete existing galleries if needed

            foreach ($request->file('gallery_images') as $galleryImage) {
                $galleryImagePath = $galleryImage->store('gallery', 'public');
                Gallery::create([
                    'product_id' => $product->id,
                    'image' => $galleryImagePath,
                ]);
            }
        }


        if ($request->specifications) {
            $product->specifications()->delete(); // Delete existing specifications if needed

            foreach ($request->specifications as $specData) {
                $specification = new Specification($specData);
                $product->specifications()->save($specification);
            }
        }

        return redirect()->route('product.index')->with('success', 'Mahsulot muvaffaqiyatli tahrirlandi!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        // Delete associated galleries and specifications
        $product->galleries()->delete();
        $product->specifications()->delete();

        // Delete the product itself
        $product->delete();
        if($product->image){
            Storage::delete($product->image);
        }

        foreach($product->galleries() as $gallery){
            Storage::delete($gallery->image);
        }

        return redirect()->route('product.index')->with('success', 'Product successfully deleted!');
    }
    public function getData(Request $request)
    {
        $lang = $request->input('lang', 'uz'); // Default to 'uz' if no language is provided
        $columnName = "name_{$lang}";

        if ($request->ajax()) {
            $data = Product::select(['id', $columnName . ' as name', 'price', 'image']);

            return DataTables::of($data)
                ->addColumn('image', function ($product) {
                    return   $product->image;
                })
                ->addColumn('actions', function ($product) {
                    $editUrl = route('product.edit', ['product' => $product->id]);
                    $showUrl = route('product.show', ['product' => $product->id]);
                    $deleteUrl = route('product.destroy', ['product' => $product->id]);

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
                ->filterColumn('name', function ($query, $keyword) use ($columnName) {
                    $query->where($columnName, 'like', "%{$keyword}%");
                })
                ->rawColumns(['image', 'actions'])
                ->make(true);
        }
    }
}
