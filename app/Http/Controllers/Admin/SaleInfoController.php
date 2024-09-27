<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SaleInfoController extends Controller
{
    //direct sale information website
    public function saleInfoList(){
        $order = Order::select('orders.created_at as order_date','orders.count as order_count','orders.status','orders.id as order_id','orders.order_code','orders.total_price','users.name as user_name','products.name as product_name','products.image as product_image')
        ->leftJoin('products','orders.product_id','products.id')
        ->leftJoin('users','orders.user_id','users.id')
        ->where('orders.status',1)
        ->groupBy( 'orders.order_code')
        ->orderBy( 'orders.created_at','desc')
        ->get();


        return view('admin.SaleInformation.list',compact('order'));
    }
}
