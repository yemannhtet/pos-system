@extends('Authentication.layouts.master')
@section('content')
    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 offset-3">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                                    </div>
                                    <form class="user" method="POST" action="{{ route('login') }}">
                                        @csrf
                                        <div class="form-group">
                                            <input type="email" class="form-control form-control-user  @error('email')
                                                is-invalid
                                              @enderror"
                                                placeholder="Enter Email Address..." name="email"
                                                value="{{ old('email') }}">
                                            @error('email')
                                                <small class="is-invalid text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user @error('email')
                                            is-invalid
                                             @enderror"
                                                name="password" value="{{ old('password') }}" placeholder="Enter Your Password">
                                            @error('email')
                                                <small class="is-invalid  text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>

                                        <input type="submit" value="Login" class="btn btn-primary btn-block btn-user">
                                        <hr>
                                        <a href="{{ url('/auth/google/redirect') }}"
                                            class="btn btn-success text-white btn-user btn-block">
                                            <i class="fa-brands fa-google"></i></i> Login with Google
                                        </a>
                                        <a href="{{ url('/auth/github/redirect') }}"
                                            class="btn bg-dark btn-user btn-block text-white">
                                            <i class="fa-brands fa-github"></i></i></i> Login with Github
                                        </a>
                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="{{ route('userRegister') }}">Create an Account!</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>
@endsection
