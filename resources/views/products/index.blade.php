@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="p-2 text-end">
                <a class="btn btn-primary" href="{{ route('products.create') }}">Add Product</a>
                <a href="{{ url('/') }}" class="btn btn-primary">Back</a>
            </div>
            <div class="card">
                <div class="card-header">{{ __('Products List') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <table id="datatable" class="display table table-sm">
                        <thead>
                        <tr>
                              <th style="width:5%;" >SL No</th>
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
                              <td style="width: 5%;">{{ ++$key }}</td>
                              <td> <img src="{{ asset('images/'.$product->image) }}" height="40" width="45">  </td>
                              <td>{{ optional($product->category)->category_name ?? 'null' }}</td>
                              <td>{{ $product->name}}</td>
                              <td>{{ $product->price}}</td>
                              <td>
                                  {{-- <form action="{{ route('products.status',$product->id) }}" method="post">
                                    @csrf
                                    @method('PUT')
                                          @if ($product->is_active == 0)
                                          <button type="submit" class="btn btn-danger">Deactive</button>
                                          @else
                                          <button type="submit" class="btn btn-success">active</button>
                                          @endif
                                  </form> --}}
                              </td>
                              <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('products.show', $product->id) }}"class="btn btn-sm btn-primary me-1"> <i class="fa fa-eye"></i></a>
                                        <a href="{{ route('products.edit', $product->id) }}" class="btn btn-sm btn-info me-1"> <i class="fa fa-edit"></i></a>
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
</div>
@endsection