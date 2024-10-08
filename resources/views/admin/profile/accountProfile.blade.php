@extends('admin.layouts.master')


@section('content')
<style>
    .profile-card {
    border-radius: 15px;
    max-width: 400px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.profile-card h6 {
    font-size: 1rem;
}

.edit-btn {
    border: none;
    font-size: 1.2rem;
}

.edit-btn i {
    color: #6c757d;
}

hr {
    margin: 1.5rem 0;
}

form label {
    font-weight: 500;
}

form .text-primary {
    cursor: pointer;
}

button[type="submit"] {
    background-color: #007bff;
    border: none;
    padding: 0.75rem;
    border-radius: 5px;
    font-size: 1rem;
}

</style>
    <!-- Begin Page Content -->
    <div class="container-fluid">


        <div class="container mt-5 d-flex justify-content-center">
            <div class="card profile-card p-4">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center">
                        @if ( $account->profile == null )
                        <img class="img-profile rounded-circle img-thumbnail" id="output"
                        src="{{ asset('admin/img/images.png') }}"  class="rounded-circle" width="50">
                        @else
                        <img class="img-profile rounded-circle img-thumbnail" id="output"
                        src="{{ asset('adminProfile/'.auth()->user()->profile) }}"  class="rounded-circle" width="50">
                        @endif
                        <div class="ms-4 mr-2">
                            <h6 class="mb-0">@if ($account->name == null)
                                {{ $account->nickname}}
                                @else
                                {{ $account->name}}
                            @endif</h6>
                            <p class="text-muted small mb-0">{{ $account->email}}</p>
                        </div>
                    </div>
                </div>
                <hr>
                <form>
                    <div class="row mb-3">
                        <label class="col-4 fw-bold">Name</label>
                        <div class="col-8">@if ($account->name == null)
                            {{ $account->nickname}}
                            @else
                            {{ $account->name}}
                        @endif</div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-4 fw-bold">Email account</label>
                        <div class="col-8">{{ $account->email}}</div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-4 fw-bold">Mobile number</label>
                        <div class="col-8 text-primary">{{ $account->phone == null ? '....' : $account->phone}}</div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-4 fw-bold">Location</label>
                        <div class="col-8">{{ $account->address == null ? '....' : $account->address}}</div>
                    </div>
                    <a  href="{{ route('adminOrderList')}}"   class="btn btn-primary w-100">Back ToOrder Page</a>
                </form>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->
@endsection


