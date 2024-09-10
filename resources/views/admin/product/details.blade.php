@extends('admin.layouts.master')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">


        <!-- DataTales Example -->
        <div class="card shadow mb-4 col-12">
            <div class="card-header py-3">
                <div class="">
                    <div class="">
                        <h6 class="m-0 font-weight-bold text-primary">Add Product</h6>
                    </div>
                </div>
            </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-3">
                            <img class="img-thumbnail" id="output" src="{{ asset('images/'.$data->image) }}"
                                alt="">
                        </div>
                        <div class="col-9">
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">Name</label>
                                            <h3>{{ $data->name }}</h3>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">Price</label>
                                        <h3>{{ $data->price }}</h3>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">Category Name</label>
                                        <h3>{{ $data->category_name }}</h3>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">Count</label>
                                        <h3>{{ $data->count }}</h3>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col mb-4">
                                    <label for="exampleFormControlInput1" class="form-label ">Description</label>
                                    <h3>{{ $data->description }}</h3>
                                </div>

                            </div>

                            <a href="{{route('productList')}}"><input type="button" value="Back" class="btn btn-primary"></a>
                        </div>
                    </div>
                </div>

        </div>

    </div>
    <!-- /.container-fluid -->
@endsection
