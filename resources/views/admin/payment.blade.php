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
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label ">Account Number</label>
                                <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Account Number...">
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Payment Type</label>
                                    <select name="" id="" class="form-control">
                                        <option value="">KPAY</option>
                                        <option value="">KBZ BANKING</option>
                                        <option value="">CBPAY</option>
                                        <option value="">CB BANKING</option>
                                        <option value="">AYA PAY</option>
                                        <option value="">AYA BANKING</option>
                                        <option value="">WAVE PAY</option>
                                    </select>
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Acoount Name</label>
                                <input type="text   " class="form-control" id="exampleFormControlInput1" placeholder="Account Name.....">
                            </div>

                            <input type="submit" value="ADD " class="btn btn-primary">
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
                                <th>Account Number</th>
                                <th>Payment Type</th>
                                <th>Account Name</th>
                                <th class="col-4">Action</th>
                            </tr>
                        </thead>
                        <tbody>

                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>
                                        <form action=""></form>
                                        <a href="" class="btn btn-outline-primary"><i
                                                class="fa-solid fa-circle-info"></i></i></a>
                                        <a href="" class="btn btn-outline-success"><i
                                                class="fa-solid fa-pen-to-square"></i></a>
                                        <a href="" class="btn btn-outline-danger"><i
                                                class="fa-solid fa-trash"></i></i></a>
                                    </td>
                                </tr>

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
