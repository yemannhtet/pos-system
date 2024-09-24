<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderBoardController extends Controller
{
    //order list page
    public function adminOrderList(){

        $order = Order::select('orders.created_at as order_date','orders.status','orders.id as order_id','orders.order_code','orders.total_price','users.name as user_name','products.name as product_name')
                                    ->leftJoin('products','orders.product_id','products.id')
                                    ->leftJoin('users','orders.user_id','users.id')
                                    ->get();
        return view('admin.orderBoard.orderList',compact('order'));
    }
}
