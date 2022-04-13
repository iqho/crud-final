<?php

namespace App\Http\Controllers\Products;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Database\QueryException;
use App\Http\Requests\ProductStoreRequest;
use App\Http\Requests\ProductUpdateRequest;

class ProductController extends Controller
{
    private $_getColumns = (['id', 'name', 'category_id', 'price', 'image', 'is_active']);

    public function index()
    {
        $viewBag['products'] = Product::idDescending()->get($this->_getColumns);

        return view('products.index', $viewBag);
    }

    public function create()
    {
        $viewBag['categories'] = $this->_getCategories();

        return view('products.create', $viewBag);
    }

    public function store(ProductStoreRequest $request)
    {
        try {
            $imageName = NULL;

            if($request->hasFile('image')){
                $image = $request->file('image');
                $imageName = $this->_getFileName($image->getClientOriginalExtension());
                $image->move(public_path('product-images'), $imageName);
            }

            $product = new Product();

            $product->name = $request->name;
            $product->image = $imageName;
            $product->description = $request->description;
            $product->price = $request->price;
            $product->category_id = $request->category_id;
            $product->is_active = $request->is_active ? 1 : 0;

            $product->save();

        } catch (QueryException $e) {
            return back()->withErrors(['errors' => $e->getMessage()]);
        }

      return redirect('products')->with('status','Product has been Created Successfully !');
    }

    public function show(Product $product)
    {
        $viewBag['product'] = $product;

        return view('products.show', $viewBag);
    }

    public function edit(Product $product)
    {
        $viewBag['product'] = $product;
        $viewBag['categories'] = $this->_getCategories();

        return view('products.edit', $viewBag);
    }

    public function update(ProductUpdateRequest $request, Product $product)
    {

        try {

            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = $this->_getFileName($image->getClientOriginalExtension());
                $image->move(public_path('product-images'), $imageName);

                if ($product->image !== NULL) {
                    if (file_exists(public_path('product-images/'. $product->image ))) {
                        unlink(public_path('product-images/'. $product->image ));
                    }
                }

                $product->image = $imageName;
            }

            $product->name = $request->name;
            $product->description = $request->description;
            $product->category_id = $request->category_id;
            $product->price = $request->price;
            $product->is_active = $request->is_active ? 1 : 0;

            $product->update();

        } catch (QueryException $e) {
            return back()->withErrors(['errors' => $e->getMessage()]);
        }

        return redirect()->route('products.index')->with('status', 'Product has been Updated Successfully.');
    }

    public function destroy(Product $product)
    {
        $image = $product->image;

        if($image){
            if (file_exists(public_path('product-images/'. $product->image ))) {
                unlink(public_path('product-images/'. $product->image ));
            }
        }

       $product->delete();

        return redirect('products')->with('status','Product has been Deleted Successfully !');
    }

    public function changeStatus(Product $product)
    {
        if ($product->is_active == 1){
            $product->is_active = 0;
        } else {
            $product->is_active = 1;
        }

        $product->update();

        return redirect('products')->with('status','Product Active Status has been Changed Successfully !');
    }

    // Get Categories
    private function _getCategories(){
        return Category::active()->get(['id', 'category_name']);
    }

    // Get File Name
    private function _getFileName($fileExtension){

        // Image name format is - p-05042022121515.jpg
        return 'p-'. date("dmYhis") . '.' . $fileExtension;
    }

}

