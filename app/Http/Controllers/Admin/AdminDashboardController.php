<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
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

        // Counting unique pending orders
        $order_pending = Order::where('status', 0)->groupBy('order_code')->get()->count();

        // Counting unique successful orders
        $successCount = Order::where('status', 1)->groupBy('order_code')->get()->count();
      // Counting unique successful orders
       $rejectCount = Order::where('status', 2)->groupBy('order_code')->get()->count();



        return view('admin.home', compact('total_sale', 'user_total', 'order_pending', 'successCount','admin_total','category_total','product_total','payment_total','rejectCount'));
    }

}
