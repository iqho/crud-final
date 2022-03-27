<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Product;
use App\Models\Category;

class ProductController extends Controller
{
    public function index()
    {
        $data['products'] = Product::get(['id', 'name', 'category_id', 'price', 'image', 'is_active']);
        $data['categories'] = Category::get(['id', 'category_name']);

        return view('products.index', $data);
    }

    public function create()
    {
        $data['categories'] = Category::where('is_active', 1)->get(['id', 'category_name']);

        return view('products.create', $data);
    }

    public function store(Request $request)
    {
        $photo = $request->image;
        $photoname = uniqid() . '.' . $photo->getClientOriginalExtension();
        $request->image->move(public_path('images'), $photoname);

        $product= new Product();
          $product->category_id = $request->category_id;
          $product->name = $request->name;
          $product->price = $request->price;
          $product->image = $photoname;
          $product->description = $request->description;
          $product->save();
    
      return redirect('products')->with('status','Product Created');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
