<?php

namespace App\Http\Controllers\user;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class AuthController extends Controller
{
    //direct password change page
    public function passwordChangePage(){
        return view('customer.profile.changePassword');
    }

        // change password function
        public function userPasswordChange (Request $request){

            $validator = $request->validate([
               'oldPassword' => 'required',
               'newPassword' => 'required|min:8',
                'confirmPassword' => 'required|same:newPassword'
            ],[
                'oldPassword.required' => 'Old Password Field ကိုဖြည့်စွက်ရန် လိုအပ်ပါသည်။',
                'newPassword.required' =>' New Password  Field ကိုဖြည့်စွက်ရန် လိုအပ်ပါသည်။',
                'newPassword.min' => 'New Password သည် အနည်းဆုံး 8 လုံး ဖြစ်ရမည်။',
                'confirmPassword.required' => 'Confirm Password Field ကိုဖြည့်စွက်ရန် လိုအပ်ပါသည်။',
                'confirmPassword.same' =>'စကားဝှက်မတူညီပါ။',
            ]);

            $dbHashPassword  = User::select('password')->where('id',Auth::user()->id)->first();
            $dbHashPassword  =$dbHashPassword['password'];
            $userOldPassword =$request->oldPassword;

            if (Hash::check($userOldPassword  , $dbHashPassword)){
                $data =[
                  'password'=> Hash::make($request->newPassword)
                ];

                User::where('id',Auth::user()->id)->update($data);
                Alert::success('Update Success', 'Update Password  Successfully');
                return back();
            }
            Alert::error('Error Message ', 'Password does not match !Try Again');
            return back();
}
}
