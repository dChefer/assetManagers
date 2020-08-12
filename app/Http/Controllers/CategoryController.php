<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index(Request $request)
    {
        $name = $request->input('name') ?: null;

        $categories = Category::query()->when($name, function ($query, $name) {
            $query->where('name', 'like', "%$name%");
        })->paginate(3);

        return view('categories.index', [
            'categories' => $categories
        ]);
    }


    public function form()
    {
        return view('categories.form');
    }


    public function formUpdate(Category $category)
    {
        return view('categories.form', [
            'category' => $category
        ]);
    }


    public function store(Request $request)
    {
        $categoriesData = $request->all();

        Category::create($categoriesData);

        return redirect('category');
    }


    public function update(Request $request, Category $category)
    {
        $categoriesData = $request->post();

        $category->update($categoriesData);

        return redirect()->route('category', $request->query());
    }

    
    public function delete(Category $category)
    {
        $category->delete();

        return response()->json([]);
    }
}
