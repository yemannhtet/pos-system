@extends('admin.layouts.master')

@section('content')

   <!-- Begin Page Content -->
   <div class="container-fluid">


    <!-- DataTales Example -->
    <div class="card shadow mb-4 col-5">
        <div class="card-header py-3">
            <div class="">
                <div class="">
                    <h6 class="m-0 font-weight-bold text-primary">Add New Admin</h6>
                </div>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('createAdmin') }}" method="post">
                @csrf

                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>

                    <input
                        type="text"
                        id="name"
                        class="form-control @error('name') is-invalid @enderror"
                        name="name"
                        value="{{ old('name') }}"
                        placeholder="Name..."
                    >

                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>

                    <input
                        type="email"
                        class="form-control @error('email') is-invalid @enderror"
                        name="email"
                        id="email"
                        value="{{ old('email') }}"
                        placeholder="Email..."
                    >

                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>

                    <input
                        type="password"
                        class="form-control @error('password') is-invalid @enderror"
                        name="password"
                        id="password"
                        value="{{ old('password') }}"
                        placeholder="Password..."
                    >

                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="confirm_password" class="form-label">Confirm Password</label>

                    <input
                        type="password"
                        class="form-control @error('confirm_password') is-invalid @enderror"
                        name="confirm_password"
                        id="confirm_password"
                        value="{{ old('confirm_password') }}"
                        placeholder="Confirm Password..."
                    >

                    @error('confirm_password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <input type="submit" value="Create" class="btn btn-primary">
            </form>

        </div>
    </div>

</div>
<!-- /.container-fluid -->


@endsection
