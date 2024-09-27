<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Models\PaySlipHistory;
use App\Http\Controllers\Controller;

class OrderBoardController extends Controller
{
    //order list page
    public function adminOrderList(){

        $order = Order::select('orders.created_at as order_date','users.id as user_id','orders.status','orders.id as order_id','orders.order_code','orders.total_price','users.name as user_name','products.name as product_name')
                                    ->leftJoin('products','orders.product_id','products.id')
                                    ->leftJoin('users','orders.user_id','users.id')
                                    ->groupBy( 'orders.order_code')
                                    ->orderBy( 'orders.created_at','desc')
                                    ->paginate(5);
        return view('admin.orderBoard.orderList',compact('order'));
    }

    public function adminOrderDetails($orderCode){

        $order = Order::select('users.name as customer_name','users.phone as user_phone','products.image as product_image','products.name as product_name','products.price as product_price','orders.count as order_count','orders.created_at as order_date','orders.order_code')
        ->leftJoin('products','orders.product_id','products.id')
        ->leftJoin('users','orders.user_id','users.id')
        ->where('orders.order_code',$orderCode)
        ->paginate(3);

        $paySlip = PaySlipHistory::select('pay_slip_histories.*','payments.type as payment_name')
                                                    ->LeftJoin('payments','pay_slip_histories.payment_method','payments.id')
                                                    ->where( 'order_code',$orderCode)->first();



        $totalPrice = 0;
        foreach($order as $item){
            // error
            $totalPrice += $item->order_count * $item->product_price;
        }


        return view('admin.orderBoard.orderDetails',compact('order','totalPrice','paySlip'));
    }


    // change status function

    public function changeStatus(Request $request){
     Order::where('order_code',$request->ordercode)->update([
            'status' => $request->status
     ]);
    }
}
