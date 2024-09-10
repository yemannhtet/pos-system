@extends('admin.layouts.master')

@section('content')
    <div class="container-fluid">


        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div class="d-flex justify-content-between">
                    <div class="">
                        <form action="{{ route('productList') }}" method="">
                            <div class="input-group mb-3">
                                <input type="text" name="searchKey" class="form-control " placeholder="Product Name.."
                                   >
                                <button class="btn btn-outline-primary " type="submit" id="button-addon2"><i
                                        class="fa-solid fa-magnifying-glass"></i></button>
                            </div>
                        </form>
                    </div>
                    <div class="">
                        <a href="{{ route('ProductCreate') }}"><i class="fa-solid fa-plus"></i> Add Product</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive  text-center">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th class="col-1">Image</th>
                                <th>Price</th>
                                <th>Stock</th>
                                <th class="col-2">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $p)
                                <tr>
                                    <td>{{ $p->name }}</td>
                                    <td><img class="img-thumbnail " src="{{ asset('images/' . $p->image) }}" alt="">
                                    </td>
                                    <td>{{ $p->price }}(MMK)</td>
                                    <td>{{ $p->count }}</td>
                                    <td>
                                        <form action=""></form>
                                        <a href="{{ route('ProductDetails', $p->id) }}" class="btn btn-outline-primary"><i
                                                class="fa-solid fa-circle-info"></i></i></a>
                                        <a href="{{ route('ProductEdit', $p->id) }}" class="btn btn-outline-success"><i
                                                class="fa-solid fa-pen-to-square"></i></a>
                                        <a href="{{ route('ProductDelete', $p->id) }}" class="btn btn-outline-danger"><i
                                                class="fa-solid fa-trash"></i></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <span class="d-flex justify-content-end">
                        {{ $products->links('pagination::bootstrap-5') }}
                    </span>
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->
@endsection
