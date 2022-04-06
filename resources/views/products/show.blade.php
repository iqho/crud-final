@extends('layouts.app')

@section('title','Show Product')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <a href="{{ route('products.index') }}" class="btn btn-success mb-3">Back</a>

            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary" style="width:70%;">
                        <div class="card-header justify-content-center">
                            <h3 class="card-title">Show Product Data</h3>
                        </div>

                        <div class="row g-0">

                            <div class="col-2 p-2">
                                <strong>Name :</strong>
                            </div>
                            <div class="col-10 p-2">
                                {{ $product->name }}
                            </div>

                            <div class="col-2 p-2">
                                <strong>Category Name :</strong>
                            </div>
                            <div class="col-10 p-2">
                                {{ $product->category->category_name }}
                            </div>

                            <div class="col-2 p-2">
                                <strong>Price :</strong>
                            </div>
                            <div class="col-10 p-2">
                                {{ $product->price }}
                            </div>

                            <div class="col-2 p-2">
                                <strong>Description :</strong>
                            </div>
                            <div class="col-10 p-2">
                                {{ $product->description }}
                            </div>

                            <div class="col-2 p-2">
                                <strong>Image :</strong>
                            </div>
                            <div class="col-10 p-2">
                                @if ($product->image && (file_exists(public_path('product-images/'. $product->image ))))
                                  <img src="{{ asset('product-images/'.$product->image) }}" height="250" width="400">
                                @else
                                  <small>No Image</small>
                                @endif
                            </div>
                        </div>
                    </div>  <!-- /.card -->
                </div>
            </div>
        </div>
    </div>
@endsection
