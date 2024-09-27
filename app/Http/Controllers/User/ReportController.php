<?php

namespace App\Http\Controllers\user;

use Illuminate\Http\Request;
use App\Models\customerReport;
use App\Http\Controllers\Controller;



class ReportController extends Controller
{
    // direct contact page
    public function contact(){
        return view('customer.contact');
    }
    public function store(Request $request)
    {
        // dd($request->all());
        // Validate the request
        $request->validate([
            'user_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required',
        ],[
        'user_name.required' =>'အမည်ဖြည့်သွင်းရန် လိုအပ်သည်။',
        'email.required' =>'email ဖြည့်သွင်းရန် လိုအပ်သည်။',
        'message.required' =>' အကြောင်းအရာတစ်ခုခု ဖြည့်သွင်းရန် လိုအပ်သည်။'
        ]);

        $data = [
            'user_id' => $request->user_id,
            'user_name' => $request->user_name,
            'email' => $request->email,
            'message' => $request->message
        ];

        customerReport::create($data);
        return back();

    }

}


