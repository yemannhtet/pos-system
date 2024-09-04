@extends('admin.layouts.master')

@section('content')
<div class="container-fluid">


    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="d-flex justify-content-between">
                <div class="">
                    <h6 class="m-0 font-weight-bold text-primary">Product List</h6>
                </div>
                <div class="">
                    <a href="{{route('ProductCreate') }}"><i class="fa-solid fa-plus"></i> Add Product</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Image</th>
                            <th>Price</th>
                            <th>Stock</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                            @foreach ( $products as $p )
                            <tr>
                                <td>{{ $p->name }}</td>
                                <td class="col-2"><img style="height: 150px;" class="img-thumbnail " src="{{ asset('images/'.$p->image) }}" alt=""></td>
                                <td>{{ $p->price }}</td>
                                <td>{{ $p->count }}</td>
                                <td>
                                    <a href="" class="btn btn-outline-primary"><i class="fa-solid fa-circle-info"></i></i></a>
                                    <a href="" class="btn btn-outline-success"><i class="fa-solid fa-pen-to-square"></i></a>
                                    <a href="" class="btn btn-outline-danger"><i class="fa-solid fa-trash"></i></i></a>
                                </td>
                            </tr>
                            @endforeach


                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

@endsection
