<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function category()
    {
        $categories = Category::all();

        return $this->response($categories);
    }

    public function brand()
    {
        $brands = Brand::all();

        return $this->response($brands);
    }
    public function product()
    {
        $products = Product::paginate(20);
        return $this->response($products);
    }


    public function productCategory($category)
    {
        $products = Product::where('category_id', $category)->paginate(20);
        return $this->response($products);
    }
}
