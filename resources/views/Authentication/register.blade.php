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
                        <form class="user"  method="POST" action="{{ route('register') }}">
                            @csrf
                            <div class="form-group">
                                    <input type="text" class="form-control form-control-user"
                                        placeholder="Name" name="name" value="{{ old('name') }}">
                            </div>
                            <div class="form-group">
                                <input type="email" class="form-control form-control-user" id="exampleInputEmail"
                                    placeholder="Email Address" name="email" value="{{ old('email') }}">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control form-control-user"
                                    placeholder="Enter Your Phone Number" name="phone" value="{{ old('phone') }}">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control form-control-user"
                                    placeholder="Fill your Address" name="address" value="{{ old('address') }}">
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <input type="password" class="form-control form-control-user"
                                        id="exampleInputPassword" placeholder="Password" name="password" value="{{ old('password') }}">
                                </div>
                                <div class="col-sm-6">
                                    <input type="password" class="form-control form-control-user"
                                        id="exampleRepeatPassword" placeholder="Repeat Password" name="password_confirmation" value="{{ old('password_confirmation') }}">
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
