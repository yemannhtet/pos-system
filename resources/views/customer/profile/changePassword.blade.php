@extends('customer.layouts.master')

@section('content')

   <!-- Begin Page Content -->
   <div class="container-fluid" style="margin-top: 15%;">


    <!-- DataTales Example -->
    <div class="card shadow mb-4 col-5 offset-3">
        <div class="card-header py-3">
            <div class="">
                <div class="">
                    <h6 class="m-0 font-weight-bold text-primary">Password Change Page</h6>
                </div>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('userPasswordChange') }}" method="post">
                @csrf

                <div class="mb-3">
                    <label for="oldPassword" class="form-label">Old Password</label>

                    <input
                        type="password"
                        id="oldPassword"
                        class="form-control @error('oldPassword') is-invalid @enderror"
                        name="oldPassword"
                        value="{{ old('oldPassword') }}"
                    >

                    @error('oldPassword')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="newPassword" class="form-label">New Password</label>

                    <input
                        type="password"
                        id="newPassword"
                        class="form-control @error('newPassword') is-invalid @enderror"
                        name="newPassword"
                        value="{{ old('newPassword') }}"
                    >

                    @error('newPassword')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="confirmPassword" class="form-label">Confirm Password</label>

                    <input
                        type="password"
                        id="confirmPassword"
                        class="form-control @error('confirmPassword') is-invalid @enderror"
                        name="confirmPassword"
                        value="{{ old('confirmPassword') }}"
                    >

                    @error('confirmPassword')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <input type="submit" value="Update" class="btn btn-primary">
            </form>

        </div>
    </div>

</div>
<!-- /.container-fluid -->


@endsection
