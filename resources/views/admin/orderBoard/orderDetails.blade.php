@extends('admin.layouts.master')

@section('content')
 <!-- Begin Page Content -->
 <div class="container-fluid">

    <a href="{{ route('adminOrderList')}}"><button class="btn btn-primary mb-3"><i class="fa fa-arrow-left"></i> back</button></a>

    <div class="card shadow mb-4 col-5">
           <div class="card-header py-3 mt-2">
                <div class="d-flex justify-content-between">
                    <div class="">
                        <h6 class="m-0 font-weight-bold text-primary">Customer Info</h6>
                   </div>
                </div>
            </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-5"><i class="fa fa-file-signature"></i> Name   :  :</div>
                        <div class="col-5">{{$order[0]->customer_name}}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-5"><i class="fa fa-barcode"></i> Order Code  :  :</div>
                        <div class="col-5">{{$order[0]->order_code}}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-5"><i class="fa fa-calendar-days"></i> Order Date   :  :</div>
                        <div class="col-5"> {{ \Carbon\Carbon::parse($order[0]->order_date)->format('d-M-Y') }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-5">Total Price  :  :</div>
                        <div class="col-5">{{$totalPrice + 1000}}  MMK <i class="fa fa-money-bill"></i><br>
                            <small class="text-danger">Contain Delivery Charges</small>
                        </div>
                    </div>
                </div>
    </div>
    </div>
    <!-- DataTales Example -->
    <div class="card shadow" style="margin-left: 20px; margin-right:20px;">
        <div class="card-header py-3">
            <div class="d-flex justify-content-between">
                <div class="">
                    <h6 class="m-0 font-weight-bold text-primary">Category List</h6>
                </div>

            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive text-center">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th class="col-2">Image</th>
                            <th>Name</th>
                            <th>Count</th>
                            <th>Price</th>
                            <th>Total Price</th>
                        </tr>
                    </thead>
                    <tbody class="text-dark">
                        @foreach ($order as $item)
                            <tr>
                                <td><img src="{{ asset('images/' . $item->product_image) }}" alt="" class="img-thumbnail" style="height: 65px;"></td>
                                <td>{{ $item->product_name }}</td>
                                <td>{{ $item->order_count }}</td>
                                <td>{{ $item->product_price }}</td>
                                <td>{{ $item->order_count * $item->product_price }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

<!-- /.container-fluid -->


@endsection
