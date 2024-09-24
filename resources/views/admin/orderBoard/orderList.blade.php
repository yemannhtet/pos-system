@extends('admin.layouts.master')

@section('content')
 <!-- Begin Page Content -->
 <div class="container-fluid">


    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="d-flex justify-content-between">
                <div class="">
                    <h6 class="m-0 font-weight-bold text-primary">Category List</h6>
                </div>
                <div class="">
                    <a href="#"><i class="fa-solid fa-plus"></i> Add Category</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>date</th>
                            <th>order code</th>
                            <th>user name </th>
                            <th>product name</th>
                            <th>price</th>
                            <th class="col-3">action</th>
                        </tr>
                    </thead>
                    <tbody class="text-dark">

                                @foreach ($order as $item )
                                <tr>
                                    <td>{{ \Carbon\Carbon::parse($item->order_date)->format('d-M-Y') }}</td>
                                        <td>{{ $item-> order_code}}</td>
                                        <td>{{ $item-> user_name}}</td>
                                        <td>{{ $item->product_name }}</td>
                                        <td>{{ $item->total_price}}</td>
                                        <td class="d-flex justify-content-arround">
                                                <button class="btn btn-sm btn-warning mr-2">Pending</button>
                                                <button class="btn btn-sm btn-success mr-2">success</button>
                                                <button class="btn btn-sm btn-danger mr-2">reject</button>
                                        </td>
                                    </tr>
                                @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->


@endsection
