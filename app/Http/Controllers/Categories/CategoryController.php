<?php

namespace App\Http\Controllers\Categories;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Database\QueryException;
use App\Http\Requests\CategoryStoreRequest;

class CategoryController extends Controller
{
    private $_getColumns = (['id', 'category_name', 'is_active']);

    public function index()
    {
        $viewBag['categories'] = Category::get($this->_getColumns);

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

    public function store(CategoryStoreRequest $request)
    {
        try {

            $category = new Category();

            $category->category_name = $request->category_name;

            $category->save();

        } catch (QueryException $e) {
            return back()->withErrors(['errors' => $e->getMessage()]);
        }

        return redirect()->route('categories.index')->with('status', 'Category has been created successfully.');
    }

    public function update(CategoryStoreRequest $request, Category $category)
    {
        try {

            $category->category_name = $request->category_name;

            $category->update();

        } catch (QueryException $e) {
            return back()->withErrors(['errors' => $e->getMessage()]);
        }

        return redirect()->route('categories.index')->with('status', 'Category has been updated successfully.');
    }

    public function destroy(Category $category)
    {
        try{
        $products = Product::where('category_id', $category->id)->count();

        if($products > 0){
            Product::whereCategoryId($category->id)->update(['category_id' => null]);
        }

        $category->delete();

        }
        catch (QueryException $e) {
            return back()->withErrors(['errors' => $e->getMessage()]);
        }

        return redirect()->route('categories.index')->with('status','Category has been deleted successfully !');
    }

    public function changeStatus(Category $category)
    {
        if ($category->is_active == 1){
            $category->is_active = 0;
        }
        else {
            $category->is_active = 1;
        }

        $category->update();

        return redirect()->route('categories.index')->with('status','Category active status has been changed successfully !');
    }
}
