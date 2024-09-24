@extends('customer.layouts.master')
@section('content')
<!-- Single Page Header start -->
<div class="container-fluid page-header py-5">
    <h1 class="text-center text-white display-6">Cart</h1>
    <ol class="breadcrumb justify-content-center mb-0">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item"><a href="#">Pages</a></li>
        <li class="breadcrumb-item active text-white">Cart</li>
    </ol>
</div>
<!-- Single Page Header End -->
    <!-- Cart Page Start -->
    <div class="container-fluid py-5">
        <div class="container py-5">
            <div class="table-responsive">
                <table class="table" id="dataTable">
                    <thead>
                        <tr>
                            <th scope="col">Products</th>
                            <th scope="col">Name</th>
                            <th scope="col">Price</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Total</th>
                            <th scope="col">Handle</th>
                        </tr>
                    </thead>
                    <input type="hidden" class="userId" value="{{auth()->user()->id}}">
                    <tbody>
                        @foreach ($cart as $item )

                        <tr>
                            <input type="hidden" class="product_id" value="{{$item->product_id}}">
                            <th scope="row">
                                <div class="d-flex align-items-center">
                                    <img src="{{ asset('images/'.$item->image) }}" class="img-fluid me-5 rounded-circle"
                                        style="width: 80px; height: 80px;" alt="">
                                </div>
                            </th>
                            <td>
                                <p class="mb-0 mt-4">{{$item->name}}</p>
                            </td>
                            <td>
                                <p class="mb-0 mt-4" id="price">{{$item->price}}</p>
                            </td>
                            <td>
                                <div class="input-group quantity mt-4" style="width: 100px;">
                                    <div class="input-group-btn">
                                        <button class="btn btn-sm btn-minus rounded-circle bg-light border">
                                            <i class="fa fa-minus"></i>
                                        </button>
                                    </div>
                                    <input type="text" class="form-control form-control-sm text-center border-0" id="qty"
                                        value="{{$item->qty}}">
                                    <div class="input-group-btn">
                                        <button class="btn btn-sm btn-plus rounded-circle bg-light border">
                                            <i class="fa fa-plus"></i>
                                        </button>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <p class="mb-0 mt-4" id="eachProductTotal">{{ $item->price * $item->qty }}MMK
                                </p>
                            </td>
                            <td>
                                <input type="hidden" id="cartId" value="{{$item->id}}">
                                <button class="btn btn-md rounded-circle bg-light border mt-4 btn-remove">
                                    <i class="fa fa-times text-danger"></i>
                                </button>
                            </td>

                        </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
            <div class="row g-4 justify-content-end">
                <div class="col-8"></div>
                <div class="col-sm-8 col-md-7 col-lg-6 col-xl-4">
                    <div class="bg-light rounded">
                        <div class="p-4">
                            <h1 class="display-6 mb-4">Cart <span class="fw-normal">Total</span></h1>
                            <div class="d-flex justify-content-between mb-4">
                                <h5 class="mb-0 me-4">Subtotal:</h5>
                                <p class="mb-0" id="subTotal">{{$totalPrice}} mmk</p>
                            </div>
                            <div class="d-flex justify-content-between">
                                <h5 class="mb-0 me-4">Shipping</h5>
                                <div class="">
                                    <p class="mb-0">1000 mmk</p>
                                </div>
                            </div>
                            <p class="mb-0 text-end">City transportation fee</p>
                        </div>

                        <div class="py-4 mb-4  border-bottom d-flex justify-content-between">
                            <h5 class="mb-0 ps-4 me-4">Total</h5>
                            <p class="mb-0 pe-4" id="finalFee">{{$totalPrice + 1000}} mmk</p>
                        </div>
                        <div class="py-4 mb-4  border-bottom d-flex justify-content-between">
                            <div class="mb-0 ps-4 me-4" style="font-size:18px; font-weight:600; color:#46585a;">
                                Payment Type
                            </div>
                            <div class="mb-0 pe-4">
                                <select name="paymentType" id="" class="form-control mb-3 ">

                                    @foreach ($payment as $item )
                                        <option value="{{$item->id}}">{{$item->type}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <button id="checkOut"  class="btn border-secondary rounded-pill px-4 py-3 text-primary text-uppercase mb-4 ms-4"
                            type="button">Proceed Checkout</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Cart Page End -->
@endsection
@section('js-section')
<script>
$(document).ready(function() {
    $('.btn-plus, .btn-minus').click(function() {
        // When plus or minus icon is clicked
        var $parentNode = $(this).closest("tr");
        var price = parseFloat($parentNode.find("#price").text().replace("mmk", "").trim());
        var qty = parseInt($parentNode.find("#qty").val(), 10) || 0; // Default to 0 if not a number

        // Update total price based on the current quantity value
        var totalPrice = (price * qty);
        $parentNode.find("#eachProductTotal").html(totalPrice + " mmk");

        finalCalculation(); // Update the final calculation after updating each product total
    });
    $('.btn-remove').click(function() {
    var $parentNode = $(this).closest("tr");
    var cartId = parseFloat($parentNode.find("#cartId").val(), 10) || 0;

    var deleteData = {
        'cartId': cartId
    };

    $.ajax({
    type: 'GET',
    url: 'remove/cart',
    data: deleteData,
    dataType: 'json',
    success: function(response) {
        if (response.message === 'success') {
            location.reload();
        }
    },
    error: function(xhr, status, error) {
        console.error("An error occurred: " + error); // Handle errors
    }
});

});

    function finalCalculation() {
        var totalPrice = 0;

        $("#dataTable tbody tr").each(function() {
            var productTotal = $(this).find("#eachProductTotal").text().replace("mmk", "").trim();
            totalPrice += parseFloat(productTotal) || 0; // Use parseFloat and handle NaN
        });

        $("#subTotal").html(totalPrice + " mmk");
        $("#finalFee").html((totalPrice + 1000 )+ " mmk");
    }
});

$('#checkOut').click(function() {
    let orderList = [];
    let orderCode = Math.floor(Math.random() * 100000000);
    let userId = $(".userId").val();
    let totalPrice = $("#finalFee").text().replace("mmk","").trim();


    $("#dataTable tbody tr").each(function(item, row) {
        let productId = $(row).find('.product_id').val();
        let qty = $(row).find('#qty').val();

        orderList.push({
            'user_id': userId,
            'product_id': productId,
            'ordercode': 'KOSHWE' + orderCode,
            'total_price': totalPrice,
            'qty': qty
        });
    });

    $.ajax({
    type: 'GET',
    url: 'order',
    data: Object.assign({},orderList),
    dataType: 'json',
    success: function(response) {

        if (response.message === 'success') {
            location.href = "/customer/shop";
        }
    }
});

});






  </script>
@endsection
