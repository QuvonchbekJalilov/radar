<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use Yajra\DataTables\DataTables;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{

    public function index()
    {
        $categories = Category::paginate(20);
        return view('admin.category.index', compact('categories'));
    }


    public function create()
    {
        return view('admin.category.create');
    }


    public function store(StoreCategoryRequest $request)
    {
        $data = $request->all();

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('images/categories', 'public');
        }

        Category::create($data);

        return redirect()->route('category.index')->with('success', "Kategoriya ma'lumoti saqlandi");
    }

    public function show(Category $category)
    {
        return view('admin.category.show', compact('category'));
    }

    public function edit(Category $category)
    {
        return view('admin.category.edit', compact('category'));
    }

    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $data = $request->all();

        if ($request->hasFile('image')) {
            // Delete the old image
            if ($category->image) {
                Storage::disk('public')->delete($category->image);
            }

            // Store the new image
            $data['image'] = $request->file('image')->store('images/categories', 'public');
        }

        $category->update($data);

        return redirect()->route('category.index')->with('success', "Kategoriya ma'lumoti tahrirlandi");
    }


    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->back()->with('success', "Kategoriya Muvafaqiyatli o'chirildi");
    }

    public function search(Request $request)
    {
        $search = $request->input('search');

        $categories = Category::where('name_uz', 'like', "%$search%")
            ->orWhere('name_ru', 'like', "%$search%")
            ->orWhere('name_en', 'like', "%$search%")
            ->get();

        return response()->json(['categories' => $categories]);
    }

    public function getData(Request $request)
    {
        $lang = $request->input('lang', 'uz'); // Default to 'uz' if no language is provided
        $columnName = "name_{$lang}";

        $data = Category::select(['id', $columnName . ' as name']);

        return DataTables::of($data)
            ->addColumn('actions', function ($row) {
                $editUrl = route('category.edit', ['category' => $row->id]);
                $showUrl = route('category.show', ['category' => $row->id]);
                $deleteUrl = route('category.destroy', ['category' => $row->id]);

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
            ->rawColumns(['actions'])
            ->make(true);
    }
}
