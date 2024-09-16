@extends('admin.layouts.master')

@section('content')
<div class="row">
<div class="col-lg-4">
                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4 ">
                        <div class="card-header py-3">
                            <div class="">
                                <div class="">
                                    <h6 class="m-0 font-weight-bold text-primary">Add Payment Method</h6>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('paymentStore') }}" method="POST">
                                @csrf
                                <label>Account Number:</label>
                                <input type="text" name="account_number" placeholder="Account Number"  required  class="form-control">

                                <label>Payment Type:</label>
                                <input type="text" name="type" placeholder="Payment Type" required class="form-control">

                                <label>Account Name:</label>
                                <input type="text" name="account_name" placeholder="Account Name" required class="form-control ">

                                <button type="submit" class="btn btn-primary mt-3">Add</button>
                            </form>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->
</div>
<div class="col-8">
        <!-- DataTales Example -->
        <div class="card shadow">
            <div class="card-header ">
                <h6 class="m-0 font-weight-bold text-primary">Payment List</h6>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive  text-center">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Payment Type</th>
                                <th>Account Number</th>
                                <th>Account Name</th>
                                <th class="col-2">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($payments as $payment)
                            <tr>
                                <td>{{ $payment->id }}</td>
                                <td>{{ $payment->type }}</td>
                                <td>{{ $payment->account_number }}</td>
                                <td>{{ $payment->account_name }}</td>
                                <td>
                                    <form action="{{ route('paymentDelete', $payment->id) }}" method="POST" onsubmit="return confirm('Are you sure?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger"><i
                                            class="fa-solid fa-trash"></i></i></button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <span class="d-flex justify-content-end">

                    </span>
                </div>
            </div>
        </div>

    </div>
</div>
</div>
@endsection
