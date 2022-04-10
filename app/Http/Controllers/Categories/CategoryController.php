<?php

namespace App\Http\Controllers\Categories;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    private $getColumns = (['id', 'category_name', 'is_active']);

    public function index()
    {
        $viewBag['categories'] = Category::get($this->getColumns);

        return view('categories.index', $viewBag);
    }

    public function create()
    {
        return view('categories.create');
    }

    public function edit(Category $category)
    {
        $viewBag['category'] = $category;

        return view('categories.edit', $viewBag);
    }

    public function store(Request $request)
    {
        try {
            $category = new Category();

            $category->category_name = $request->category_name;

            $category->save();

        } catch (QueryException $e) {
            return back()->withErrors(['errors' => $e->getMessage()]);
        }

        return redirect()->route('categories.index')->with('status', 'Category has been Created Successfully.');
    }

    public function update(Request $request, Category $category)
    {
        try {

            $category->category_name = $request->category_name;
            $category->update();

        } catch (QueryException $e) {
            return back()->withErrors(['errors' => $e->getMessage()]);
        }

        return redirect()->route('categories.index')->with('status', 'Category has been Updated Successfully.');
    }

    public function destroy(Category $category)
    {
       $category->delete();
        return redirect()->route('categories.index')->with('status','Category has been Deleted Successfully !');
    }

    public function changeStatus(Category $category)
    {
        if ($category->is_active == 1){
            $category->is_active = 0;
        } else {
            $category->is_active = 1;
        }

        $category->update();

        return redirect()->route('categories.index')->with('status','Category Active Status has been Changed Successfully !');
    }
}
