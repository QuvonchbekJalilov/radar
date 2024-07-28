<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\BannerResource;
use App\Http\Resources\BrandResource;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\ProductResource;
use App\Models\Banner;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function category()
    {
        $categories = Category::all();
        return $this->response(CategoryResource::collection($categories));
    }

    public function banner(){
        $banners = Banner::all();

        return $this->response(BannerResource::collection($banners));
    }

    public function brand()
    {
        $brands = Brand::all();

        return $this->response(BrandResource::collection($brands));
    }
    public function product()
    {
        $products = Product::paginate(20);
        return $this->response(ProductResource::collection($products));
    }


    public function productCategory($category)
    {
        $products = Product::where('category_id', $category)->paginate(20);
        return $this->response(ProductResource::collection($products));
    }

    public function singleProduct($id){

        $product = Product::findOrFail($id);
        return $this->response(new ProductResource($product));
    }
}
