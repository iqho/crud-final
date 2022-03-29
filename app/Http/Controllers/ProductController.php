<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Database\QueryException;
use App\Http\Requests\ProductStoreRequest;
use App\Http\Requests\ProductUpdateRequest;

class ProductController extends Controller
{
    public function index()
    {
        $viewBag['products'] = Product::get(['id', 'name', 'category_id', 'price', 'image', 'is_active']);
        $viewBag['categories'] = Category::get(['id', 'category_name']);

        return view('products.index', $viewBag);
    }

    public function create()
    {
        $viewBag['categories'] = Category::where('is_active', 1)->get(['id', 'category_name']);

        return view('products.create', $viewBag);
    }

    public function store(ProductStoreRequest $request)
    {
        try {
            $image = $request->image;

            if($image){
                $imageName = uniqid() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('images'), $imageName);
            }
            else{
                $imageName = Null;
            }

            $product= new Product();
            $product->category_id = $request->category_id;
            $product->name = $request->name;
            $product->price = $request->price;
            $product->image = $imageName;
            $product->description = $request->description;
            $product->save();

        }catch (QueryException $e) {
            $errorCode = $e->errorInfo[1];
            if ($errorCode == 1062) {
                return redirect()->back()->withErrors(['errors' => 'This product name already exits under selected category']);
            } else {
                return redirect()->back()->withErrors(['errors' => 'Unable to process request.Error:' . $e->getMessage()]);
            }
        }

      return redirect('products')->with('status','Product Created Successfully !');
    }

    public function show(Product $product)
    {
        $viewBag['product'] = $product;

        return view('products.show', $viewBag);
    }

    public function edit(Product $product)
    {
        $viewBag['product'] = $product;
        $viewBag['categories'] = Category::where('is_active', 1)->get(['id', 'category_name']);

        return view('products.edit', $viewBag);
    }

    public function update(ProductUpdateRequest $request, Product $product)
    {
        try {
            $image = $request->file('image');

            if ($image) {
                $imageName = uniqid() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('images'), $imageName);

                if ($product->image !== null) {
                    File::delete(public_path('images/'. $product->image ));
                }
                $product->image = $imageName;
            }

            $product->name = $request->name;
            $product->description = $request->description;
            $product->category_id = $request->category_id;
            $product->price = $request->price;

            $product->update();

        } catch (QueryException $e) {
            $errorCode = $e->errorInfo[1];
            if ($errorCode == 1062) {
                return redirect()->back()->withErrors(['errors' => 'This product name already exits under selected category']);
            } else {
                return redirect()->back()->withErrors(['errors' => 'Unable to process request.Error:' . $e->getMessage()]);
            }
        }

        return redirect()->route('products.index')->with('status', 'Product Updated Successfully.');
    }

    public function destroy(Product $product)
    {
        $image=$product->image;
        if($image){
            File::delete(public_path('images/'. $image ));
        }

       $product->delete();

        return redirect('products')->with('status','Product Delete Successfully !');
    }

    public function changeStatus(Request $request)
    {
        $product = Product::find($request->product_id);
        $product->is_active = $request->status;
        $product->save();

        return response()->json(['success' => 'Product Active Status Change Successfully.']);
    }

}
