<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class ProfileController extends Controller
{
    //direct page admin profile
    public function profileDetails(){
        return view('admin.profile.details');
    }

    //update profile
    public function update(Request $request){
        $this->validationCheck($request);
        $adminData =$this->requestAdminData($request);

        User::where('id',Auth::user()->id)->update($adminData);
        Alert::success('Update Success', 'Update Profile Successfully');
        return back();
    }

        //request admin data
    private function requestAdminData($request){
        $data = [];

        if(Auth::user()->name != null ){
            $data['name'] = $request->name;
        }else{
            $data['nickname'] = $request->name;
        }
        $data['email'] = Auth::user()->provider == 'simple' ? $request->email : Auth::user()->email;
        $data['phone'] = $request->phone;
        $data['address'] = $request->address;

    return $data;
    }

    //Validation Check
    private function validationCheck($request){
        $rules = [
                'name' => 'required',
                'phone' =>'required|unique:users,phone,'.Auth::user()->phone,
                'address' => 'required',
                'image' => 'mimes:jpg,png,jpeg,svg|file'
        ];
      if(Auth::user()->provider == 'simple'){
        $rules['email'] = 'required|unique:users,email,'.Auth::user()->id;
      }
        $messages=[
            'image.required' =>' ပုံဖြည့်ရန် လိုအပ်သည်။',
            'name.required'   =>' အမည်တစ်ခုဖြည့်စွက်ရန်လိုသည်။',
            'email.required'    =>'အီးမေးလ်အကွက်ဖြည့်ရန် လိုအပ်သည်။',
            'email.unique' =>' တူညီသောအီးမေးလ်ကိုသုံး၍မရပါ။',
            'phone.required'=>'သင့်ဖုန်းနံပါတ်ကို ဖြည့်ပေးရပါမည်။ ',
            'phone.unique'=>'တူညီသောဖုန်းနံပါတ်ကို သုံး၍မရပါ။ ',
            'address.required'=>'လိပ်စာအကွက်ဖြည့်ရန် လိုအပ်သည်။'
        ];

        $validator = $request->validate($rules,$messages);
    }
}
