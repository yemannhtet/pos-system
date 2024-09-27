<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class ProfileController extends Controller
{
    //direct admin profile  page
    public function profileDetails(){
        return view('admin.profile.details');
    }
        //direct admin create page
        public function createAdminAccount(){
            return view('admin.createAdminAccount');
        }

            //  create admin
                public function create(Request $request){
                    $request->validate([
                        'name' => 'required',
                        'email' => 'required|unique:users,email',
                        'password' => 'required',
                        'confirm_password' => 'required|same:password'
                    ],[
                        'name.required' =>'အမည်အကွက်ဖြည့်စွက်ရန် လိုအပ်သည်။',
                        'email.required' =>'အီးမေးလ်အကွက်ဖြည့်ရန် လိုအပ်သည်။',
                        'password.required' =>'စကားဝှက် အကွက်ဖြည့်စွက်ရန် လိုအပ်သည်။',
                        'confirm_password.required' =>'စကားဝှက် အားနောက်တစ်ကြိမ်ဖြည့်စွက်ရန် လိုအပ်သည်။',
                        'confirm_password.same' =>'သင့်စကားဝှက်သည် တူညီရပါမည်။',
                    ]);

                    $adminAccount = [
                        'name' => $request->name ,
                        'email' => $request->email ,
                        'password' => Hash::make($request->password) ,
                        'role' => 'admin' ,
                        'provider' =>'simple' ,
                    ];
                    User::create($adminAccount);
                    Alert::success('Create Success', 'Create New Admin Account  Successfully');
                    return back();
                }
    //update profile
    public function update(Request $request){
        $this->validationCheck($request);
        $adminData =$this->requestAdminData($request);

        if ($request->hasFile('image')) {
        if($request->oldImage != null){
                    // delete old image if it exists
                    if (file_exists(public_path('adminProfile/' . $request->oldImage))) {
                        unlink(public_path('adminProfile/' . $request->oldImage));
                    }
        }
                 // upload new image
                $fileName = uniqid() . $request->file('image')->getClientOriginalName();
                $request->file('image')->move(public_path().'/adminProfile/', $fileName);
                $adminData ['profile'] = $fileName;
                }else{
                    $adminData ['profile']=$request->oldImage;
                }

        User::where('id',Auth::user()->id)->update($adminData);
        Alert::success('Update Success', 'Update Profile Successfully');
        return back();
    }

        //request admin data
    private function requestAdminData($request){
        $data = [];

        if(Auth::user()->name != null ){
            $data['name'] = Auth::user()->provider == 'simple' ? $request->name : Auth::user()->name;
        }else{
            $data['nickname'] = Auth::user()->provider == 'simple' ? $request->nickname : Auth::user()->nickname;
        }
        $data['email'] = Auth::user()->provider == 'simple' ? $request->email : Auth::user()->email;
        $data['phone'] = $request->phone;
        $data['address'] = $request->address;

    return $data;
    }

    //Validation Check
    private function validationCheck($request){
        $rules = [
                'phone' =>'required|unique:users,phone,'.Auth::user()->id,
                'address' => 'required',
                'image' => 'mimes:jpg,png,jpeg,svg|file'
        ];
      if(Auth::user()->provider == 'simple'){
        $rules['name'] = 'required';
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

    //account profile direct route
    public function accountProfile($id){
       $account =  User::where('id',$id)->first();
        return view('admin.profile.accountProfile',compact('account'));
    }
}
