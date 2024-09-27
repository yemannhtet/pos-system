@extends('admin.layouts.master')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">


        <!-- DataTales Example -->
        <div class="card shadow mb-4 col-12">
            <div class="card-header py-3">
                <div class="">
                    <div class="d-flex justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Add Product</h6>
                        <a href="{{route('productList')}}" class="btn btn-primary">Back</a>
                    </div>
                </div>
            </div>
            <form action="{{ route('product#create') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col-3">
                            <img class="img-thumbnail" id="output" src="{{ asset('images/default.jpg') }}"
                                alt="">


                            <input type="file" name="image"
                                class="form-control mt-3 @error('image') is-invalid @enderror" name="" id=""
                                onchange="loadFile(event)"> @error('image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-9">
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">Name</label>
                                        <input type="text" name="name"
                                            class="form-control
                                            @error('name') is-invalid @enderror"
                                            id="exampleFormControlInput1"
                                            value="{{ old('name') }}"placeholder="Name...."> @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">Price</label>
                                        <input type="text" name="price"
                                            class="form-control -bottom-16 @error('price') is-invalid @enderror"
                                            id="exampleFormControlInput1"
                                            value="{{ old('price') }}"placeholder="Price..."> @error('price')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">Category Name</label>
                                        <select name="categoryName"
                                            class="form-control @error('categoryName') is-invalid @enderror" id="">
                                            <option value=""> Choose Category Name</option>
                                            @foreach ($categories as $item)
                                                <option value="{{ $item->id }}"
                                                    @if(old('categoryName') ==$item->id ) selected @endif>{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('categoryName')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror

                                    </div>
                                </div>
                                <div class="col">
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">Count</label>
                                        <input type="text" name="count"
                                            class="form-control @error('count') is-invalid @enderror"
                                            id="exampleFormControlInput1"  value="{{ old('count') }}"placeholder="Count..."> @error('count')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col mb-4">
                                    <label for="exampleFormControlInput1" class="form-label ">Description</label>
                                    <textarea class="form-control @error('description') is-invalid @enderror" id="" cols="30" rows="10"
                                        name="description" placeholder="Description"> {{ old('description') }}
                                            </textarea>
                                            @error('description')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                </div>

                            </div>

                            <input type="submit" value="Create" class="btn btn-primary">
                        </div>
                    </div>
                </div>
            </form>
        </div>

    </div>
    <!-- /.container-fluid -->
@endsection
