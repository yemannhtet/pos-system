<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\customerReport;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;


class AdminDashboardController extends Controller
{
    //direct  admindashboard route
    public function index()
    {
        $total_sale = Order::sum('total_price');
        $user_total = User::where('role', 'user')->count();
        $admin_total = User::where('role', 'admin','superadmin')->count();
        $category_total = Category::count();
        $product_total = Product::count();
        $payment_total = Payment::count();
        $report =    customerReport::count();

        $order_total = Order::where('status', 1)
        ->select('total_price')
        ->groupBy('order_code')
        ->get();

        $order_count =count($order_total);

    // Sum the total_price from the collection
    $success_total = $order_total->sum('total_price');


    $delivery_fee = 1000;

    $total_sale = $success_total - ($order_count  * $delivery_fee);



        // Counting unique pending orders
        $order_pending = Order::where('status', 0)->groupBy('order_code')->get()->count();

        // Counting unique successful orders
        $successCount = Order::where('status', 1)->groupBy('order_code')->get()->count();
      // Counting unique reject orders
       $rejectCount = Order::where('status', 2)->groupBy('order_code')->get()->count();



        return view('admin.home', compact( 'user_total', 'order_pending', 'successCount','admin_total','category_total','order_total','product_total','rejectCount','total_sale','payment_total','report'));
    }

}
