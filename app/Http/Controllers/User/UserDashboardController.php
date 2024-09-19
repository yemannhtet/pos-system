<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserDashboardController extends Controller
{
    //direct  admindashboard route
    public function index(){
        $categories = Category::get();
        $products = Product::select('products.*','categories.name as category_name')
                            ->leftJoin('categories','products.category_id','categories.id')
                            ->get();
        $customerCount = User::where('role','user')->count();
        return view('customer.home',compact('categories','products','customerCount'));
    }
}
