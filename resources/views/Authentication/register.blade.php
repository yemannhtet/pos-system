@extends('Authentication.layouts.master')
@section('content')
    <div class="container">

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-6 offset-3">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
                            </div>
                            <form class="user" method="POST" action="{{ route('register') }}">
                                @csrf
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-user
                                        @error('name')
                                    is-invalid
                                  @enderror "
                                        placeholder="Name" name="name" value="{{ old('name') }}">
                                    @error('name')
                                        <small class="invalid text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <input type="email" class="form-control form-control-user
                                        @error('email')
                                        is-invalid
                                        @enderror"
                                        placeholder="Email Address" name="email" value="{{ old('email') }}">
                                    @error('email')
                                        <small class="invalid text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-user
                                        @error('phone')
                                    is-invalid
                                  @enderror"
                                        placeholder="Enter Your Phone Number" name="phone" value="{{ old('phone') }}">
                                    @error('phone')
                                        <small class="invalid text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-user
                                        @error('address')
                                    is-invalid
                                  @enderror"
                                        placeholder="Fill your Address" name="address" value="{{ old('address') }}">
                                    @error('address')
                                        <small class="invalid text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="password" class="form-control form-control-user
                                            @error('password')
                                            is-invalid
                                           @enderror"
                                            id="exampleInputPassword" placeholder="Password" name="password"
                                            value="{{ old('password') }}"> @error('password')
                                            <small class="invalid text-danger">{{ $message }}</small>
                                            @enderror
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="password" class="form-control form-control-user
                                            @error('password_confirmation')
                                             is-invalid
                                             @enderror"
                                            id="exampleRepeatPassword" placeholder="Confirm Your Password"
                                            name="password_confirmation" value="{{ old('password_confirmation') }}">
                                            @error('password_confirmation')
                                            <small class="invalid text-danger">{{ $message }}</small>
                                            @enderror
                                    </div>
                                </div>
                                <input type="submit" value="Register Account" class="btn btn-primary btn-block btn-user">
                                <hr>
                            </form>
                            <hr>
                            <div class="text-center">
                                <a class="small" href="{{ route('userlogin') }}">Already have an account? Login!</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
