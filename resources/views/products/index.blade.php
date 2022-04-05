@extends('layouts.app')

@section('title','Products')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="p-2 text-end">
            <a class="btn btn-primary" href="{{ route('products.create') }}">Add Product</a>
        </div>
        <div class="card">
            <div class="card-header"><h5>Products List</h5></div>

            <div class="card-body">

                @if (session('status'))
                    <div class="row">
                        <div class="col-12 alert alert-success text-center" id="success" role="alert">
                            {{ session('status') }}
                        </div>
                    </div>
                @endif
               
                <table id="datatable" class="display table table-sm">
                    <thead>
                        <tr>
                            <th>SL</th>
                            <th>Image</th>
                            <th>Category</th>
                            <th>Name</th>
                            <th>Price</th>
                            <th>Active Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($products as  $key => $product)
                            <tr>
                                <td>{{ ++$key }}</td>
                                <td>
                                    @if ($product->image)
                                        <img src="{{ asset('product-images/'.$product->image) }}" height="25" width="40">
                                    @else
                                        <small>No Image</small>
                                    @endif
                                </td>
                                <td>{{ optional($product->category)->category_name ?? 'null' }}</td>
                                <td>{{ $product->name}}</td>
                                <td>{{ $product->price}}</td>
                                <td>

                                @if ($product->is_active == 1)
                                <form action="{{ route('products.changeStatus', $product->id) }}" method="post">
                                    @csrf
                                    @method('GET')

                                    <button type="submit" class="btn btn-success">Active</button>
                                </form>
                                @else
                                <form action="{{ route('products.changeStatus', $product->id) }}" method="post">
                                    @csrf
                                    @method('GET')

                                    <button type="submit" class="btn btn-danger">Inactive</button>
                                </form>
                                @endif
                                
                                </td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('products.show', $product->id) }}"class="btn btn-primary me-1"> <i class="fa fa-eye"></i></a>
                                        <a href="{{ route('products.edit', $product->id) }}" class="btn btn-info me-1"> <i class="fa fa-edit"></i></a>
                                        <form action="{{ route('products.destroy', $product->id) }}" method="post">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit" class="btn btn-danger" onclick="return confirm('Delete entry?')"><i class="fa fa-trash"></i></button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    <script>
        // Hide Flash Message After 5 Second
        $(document).ready(function(){
            $("#success").delay(5000).slideUp(300);
        });
    </script>
@endpush
