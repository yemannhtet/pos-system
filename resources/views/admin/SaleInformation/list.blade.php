@extends('admin.layouts.master')

@section('content')
 <!-- Begin Page Content -->
 <div class="container-fluid">


    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="d-flex justify-content-between">
                <div class="">
                    <h6 class="m-0 font-weight-bold text-primary">Sale List</h6>
                </div>

            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Product Images</th>
                            <th>Product Name</th>
                            <th>User Name </th>
                            <th >Date</th>
                            <th >Count</th>
                            <th >Amount</th>
                            <th >Order-code</th>
                        </tr>
                    </thead>
                    <tbody class="text-dark">

                                @foreach ($order as $item )
                                <tr>
                                        <td><img src="{{asset('images/'.$item->product_image)}}" alt="" class="img-thumbnail" style="height: 100px;"></td>
                                        <td>{{$item->product_name}}</td>
                                        <td>{{$item->user_name}}</td>
                                        <td>{{ \Carbon\Carbon::parse($item->order_date)->format('d-M-Y') }}</td>
                                        <td>{{$item->order_count}}</td>
                                        <td>{{$item->total_price}}</td>
                                        <td>{{$item->order_code}}</td>
                                    </tr>
                                @endforeach

                    </tbody>
                </table>
                <span class="d-flex justify-content-end">
                    {{-- {{ $order->links('pagination::bootstrap-5') }} --}}
                </span>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->
@endsection

