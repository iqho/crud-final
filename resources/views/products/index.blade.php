@extends('layouts.app')

@section('title','Products')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="p-2 text-end">
                    <a class="btn btn-primary" href="{{ route('products.create') }}">Add Product</a>
                </div>
                <div class="card">
                    <div class="card-header">{{ __('Products List') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" id="success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <div id="successMessage" class="alert alert-success alert-dismissible fade show p-2 text-center" role="alert" style="display: none; max-width:400px; margin:0 auto">
                        </div>

                        <table id="datatable" class="display table table-sm">
                            <thead>
                                <tr>
                                    <th style="width:5%;" >SL</th>
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
                                        <td> 
                                            @if ($product->image)
                                                <img src="{{ asset('images/'.$product->image) }}" height="25" width="40">
                                            @else
                                                <small>No Image</small>
                                            @endif  
                                        </td>
                                        <td>{{ optional($product->category)->category_name ?? 'null' }}</td>
                                        <td>{{ $product->name}}</td>
                                        <td>{{ $product->price}}</td>
                                        <td>
                                            <input data-id="{{$product->id}}" class="toggle-class" type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Active" data-off="Inactive" {{ $product->is_active ? 'checked' : '' }}>
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

@push('scripts')
    <script>
        $(function() {
            $('.toggle-class').change(function() {
                var status = $(this).prop('checked') == true ? 1 : 0;
                var product_id = $(this).data('id');
                $.ajax({
                    type: "GET",
                    dataType: "json",
                    url: '{{ route('product.changeStatus') }}',
                    data: {'status': status, 'product_id': product_id},
                    success: function(data){
                        $("#successMessage").html(data.success).show().delay(3000).fadeOut(400);;
                    }
                });
            })
        })

        // Hide Flash Message After 5 Second
        $(document).ready(function(){
            $("#success").delay(5000).slideUp(300);
        });
    </script>
@endpush


Rokon