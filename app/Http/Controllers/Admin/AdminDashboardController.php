<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    //direct  admindashboard route
    public function index(){
        return view('admin.home');
    }
}
