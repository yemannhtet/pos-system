@extends('admin.layouts.master')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">


        <!-- DataTales Example -->
        <div class="card shadow mb-4 col-12">
            <div class="card-header py-3">
                <div class="">
                    <div class="">
                        <h6 class="m-0 font-weight-bold text-primary">ADMIN PROFILE</h6>
                    </div>
                </div>
            </div>
            <form action="{{ route('profileUpdate') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col-3">
                            <input type="hidden" name="oldImage" value="{{auth()->user()->profile}}">
                                @if (auth()->user()->profile == null )
                                <img class="img-profile rounded-circle img-thumbnail" id="output"
                                src="{{ asset('admin/img/images.png') }}">
                                @else
                                <img class="img-profile rounded-circle img-thumbnail" id="output"
                                src="{{ asset('adminProfile/'.auth()->user()->profile) }}">
                                @endif
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
                                            @if (auth()->user()->provider != 'simple') disabled @endif
                                            class="form-control
                                        @error('name') is-invalid @enderror"
                                            id="exampleFormControlInput1"
                                            value="{{ old('name', auth()->user()->name == null ? auth()->user()->nickname : auth()->user()->name) }}"
                                            placeholder="Name....">
                                        @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">Email</label>
                                        <input type="email" name="email"
                                            @if (auth()->user()->provider != 'simple') disabled @endif
                                            class="form-control -bottom-16 @error('email') is-invalid @enderror"
                                            id="exampleFormControlInput1"
                                            value="{{ old('email', auth()->user()->email) }}"placeholder="Email...">
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">Phone</label>
                                        <input type="phone" name="phone"
                                            class="form-control @error('phone') is-invalid @enderror"
                                            id="exampleFormControlInput1"
                                            value="{{ old('phone', auth()->user()->phone) }}"placeholder="09xxx...">
                                        @error('phone')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">Address</label>
                                        <input type="text" name="address"
                                            class="form-control @error('address') is-invalid @enderror"
                                            id="exampleFormControlInput1"
                                            value="{{ old('address', auth()->user()->address) }}"placeholder="Address...">
                                        @error('address')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-3 d-flex ">
                                @if (auth()->user()->provider == 'simple')
                                    <div class="col">
                                        <a class="btn btn-primary form-control"
                                            href="{{ route('passwordChangePage') }}">Change Password</a>
                                    </div>
                                @endif
                                <div class="col">
                                    <input type="submit" value="Update" class="btn btn-primary form-control ">
                                </div>

                            </div>
                        </div>


                    </div>
                </div>
        </div>
        </form>
    </div>

    </div>
    <!-- /.container-fluid -->
@endsection
