<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Product;
use App\Models\Category;

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

    public function store(Request $request)
    {
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

      return redirect('products')->with('status','Product Created Successfully !');
    }

    public function show(Product $product)
    {
        //
    }

    public function edit(Product $product)
    {
        $viewBag['product'] = $product;
        $viewBag['categories'] = Category::where('is_active', 1)->get(['id', 'category_name']);
        return view('products.edit',$viewBag);
    }

    public function update(Request $request, Product $product)
    {
        //
    }

    public function destroy(Product $product)
    {
        $image=$product->image;
        if($image){          
            unlink(public_path('images/'. $image ));
        }
       $product->delete();
        
        return redirect('products')->with('status','Product Delete Successfully !');
    }
   
}
