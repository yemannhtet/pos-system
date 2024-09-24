@extends('customer.layouts.master')
@section('content')

<!-- Single Page Header start -->
<div class="container-fluid page-header py-5">
    <h1 class="text-center text-white display-6">Order List Page</h1>
    <ol class="breadcrumb justify-content-center mb-0">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item"><a href="#">Pages</a></li>
        <li class="breadcrumb-item active text-white">Order List Page</li>
    </ol>
</div>
<!-- order Page Start -->
<div class="container-fluid py-5" >
    <div class="container py-5">
        <div class="table-responsive">
            <table class="table" id="dataTable">
                <thead>
                    <tr>
                        <th scope="col">Order Code </th>
                        <th scope="col">Date</th>
                        <th scope="col">Price</th>
                        <th scope="col">Order Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($order as $o)
                    <tr>
                            <td >
                                <p class="mb-0 mt-4">{{$o->order_code}}</p>
                            </td>
                            <td >
                                <p class="mb-0 mt-4">   {{ $o->created_at->format('d -M-Y ') }}
                                </p>
                            </td>
                            <td >
                                <p class="mb-0 mt-4">{{$o->total_price}}mmk</p>
                            </td>
                            <td >
                                <p class="mb-0 mt-4">
                                    @if ($o->status == 0)
                                        <button class="btn btn-sm btn-secondary">pending</button>
                                        @elseif($o->status == 1)
                                        <button class="btn btn-sm btn-primary">success</button>
                                        @elseif($o->status == 2)
                                        <button class="btn btn-sm btn-danger">reject</button>
                                    @endif
                                </p>
                            </td>
                    </tr>
                    @endforeach

                </tbody>
            </table>
        </div>

    </div>
</div>
<!-- Cart Page End -->
@endsection
