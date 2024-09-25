@extends('customer.layouts.master')
@section('content')

<!-- Single Page Header start -->
<div class="container-fluid page-header py-5">
    <h1 class="text-center text-white display-6">Order Details Page</h1>
    <ol class="breadcrumb justify-content-center mb-0">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item"><a href="#">Pages</a></li>
        <li class="breadcrumb-item active text-white">Order Details Page</li>
    </ol>
</div>
<!-- order Page Start -->
<div class="container-fluid py-5" >
    <a href="{{ route('orderList')}}"><button class="btn btn-primary mb-3 ms-3"><i class="fa fa-arrow-left"></i> back</button></a>

    <div class="container py-5">
        <div class="table-responsive">
            <table class="table" id="dataTable">
                <thead>
                    <tr>
                        <th scope="col">Image</th>
                        <th scope="col">Names</th>
                        <th scope="col">Count</th>
                        <th scope="col">Price</th>
                        <th scope="col">Total Price</th>
                    </tr>
                </thead>
                <tbody>
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
</div>
<!-- Cart Page End -->
@endsection
