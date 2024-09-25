@extends('customer.layouts.master')
@section('content')

<!-- Single Page Header start -->
<div class="container-fluid page-header py-5">
    <h1 class="text-center text-white display-6">Payment Page</h1>
    <ol class="breadcrumb justify-content-center mb-0">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item"><a href="#">Pages</a></li>
        <li class="breadcrumb-item active text-white">Payment  Page</li>
    </ol>
</div>
<!-- order Page Start -->
<style>
    body {
        background-color: #f8f9fa;
    }
    .card-container {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
    }
    .payment-card, .payment-details {
        border-radius: 20px;
        box-shadow: 0px 8px 20px rgba(0, 0, 0, 0.1);
    }
        .payment-methods {
            background-color: white;
            padding: 30px;
        }
        .payment-details {
        background-color: #ffffff; /* White background for contrast */
        color: #333; /* Dark text for readability */
        padding: 30px;
        border-radius: 20px;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
    }
    .account-info {
        background-color: #f8f9fa; /* Light grey background for account cards */
        color: #333;
        border-radius: 15px;
        transition: transform 0.2s, box-shadow 0.2s;
        padding: 20px;
        border: 1px solid #e0e0e0; /* Subtle border */
    }
    .account-info:hover {
        transform: translateY(-3px); /* Subtle lift effect on hover */
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
    }
    .account-name {

        font-weight: bold;

        color: #82c408;
    }
    .text-muted {
        color: #fff8f8; /* Muted text color for account details */
    }
    .flex-container {
    display: flex;
    align-items: center; /* Aligns items vertically centered */
}

.flex-container label {
    font-weight: bold;
    font-size: 13px/* Optional: Make the label bold */
}
.flex-container span{
    font-size: 11px;
    font-weight: blod;
}

</style>

<div class="container card-container mt-4">
    <div class="row">
        <!-- Payment Details Card -->
        <div class="col-lg-11 mb-4">
            <div class="payment-details text-center">
                <h6 class="mb-4">ငွေပေးချေမှုအကောင့်အချက်အလက်များ</h6>
                <div class="row">
                    @foreach ($payment as $item)
                    <div class="col-md-6 mb-4"> <!-- Two items in one row -->
                        <div class="account-info p-3 border rounded shadow-sm">
                            <div class="mb-1 flex-container">
                                <label>Account Name:</label>
                                <span class="account-name">{{$item->account_name}}</span>
                            </div>
                            <div class="mb-1 flex-container">
                                <label>Account Number:</label>
                                <span>{{$item->account_number}}</span>
                            </div>
                            <div class="mb-1 flex-container">
                                <label>Account Type:</label>
                                <span>{{$item->type}}</span>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>


        <!-- Payment Methods Card -->
        <div class="col-lg-6">
            <div class="payment-card payment-methods">
                <h5 class="text-primary">Payment Methods</h5>
                <form action="{{ route('orderProduct')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row g-3">

                        <div class="col-md-6">
                            <label for="name" class="form-label" >နာမည်</label>
                            <input type="text" class="form-control" id="name" placeholder="နာမည်ဖြည့်ပါ" name="name">
                        </div>
                        <div class="col-md-6">
                            <label for="mobile" class="form-label" >ဖုန်းနံပါတ်</label>
                            <input type="text" class="form-control" id="mobile" placeholder="09xxxxxxx" name="phone">
                        </div>
                        <div class="col-6">
                            <label  class="form-label">ငွေပေးချေမှုစနစ် </label>
                                 <select class="form-select  mb-3" aria-label=".form-select-lg example" name="payment_type">
                                        @foreach ($payment as $item )
                                        <option value="">{{$item->type}}</option>
                                        @endforeach
                                    </Select>
                        </div>
                        <div class="col-md-6">
                                <input type="hidden" name="order_code" value="{{ $orderProduct[0]['order_code'] }}">
                            <label for="order_number" class="form-label">အော်ဒါနံပါတ်</label>
                            <input type="text" class="form-control" id="order_number" placeholder="" value="{{ $orderProduct[0]['order_code'] }}" disabled  >
                        </div>
                        <div class="col-12">
                            <label for="order_number" class="form-label" >ကျသင့်‌ငွေ</label>
                            <input type="hidden" name="total" value="{{ $total}} ">
                            <input type="text" class="form-control" id="order_number" placeholder="" value="{{ $total }} (contains delivary fees)" disabled name="total">
                        </div>
                        <div class="col-12 mb-3">
                            <label for="fileUpload" class="form-label">ငွေလွှဲပြေစာ</label>
                            <input type="file" class="form-control" name="payslip">
                        </div>
                        <div class="col-12">
                            <button   class="btn border-secondary rounded-pill px-2 py-2 text-primary text-uppercase mb-4 form-control"
                                type="submit">Order Product</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</form>

</div>

<!-- Cart Page End -->
@endsection
