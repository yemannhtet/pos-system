<?php

namespace App\Http\Controllers\user;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class ProfileController extends Controller
{
    //direct profile route
    public function Details(){
        return view('customer.profile.details');
    }

    //update profile
    public function update(Request $request){
        $this->validationCheck($request);
        $adminData = $this->requestAdminData($request);

        if ($request->hasFile('image')) {
            // delete old image if it exists
            if ($request->oldImage != null && file_exists(public_path('adminProfile/' . $request->oldImage))) {
                unlink(public_path('adminProfile/' . $request->oldImage));
            }

            // upload new image
            $fileName = uniqid() . '_' . $request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('adminProfile'), $fileName);
            $adminData['profile'] = $fileName;
        } else {
            $adminData['profile'] = $request->oldImage; // Use the old image if no new image is uploaded
        }

        User::where('id', Auth::user()->id)->update($adminData);
        Alert::success('Update Success', 'Update Profile Successfully');
        return back();
    }

    private function requestAdminData($request){
        $data = [];

        if (Auth::user()->provider == 'simple') {
            $data['name'] = $request->name ?? Auth::user()->name;
        } else {
            $data['nickname'] = $request->nickname ?? Auth::user()->nickname;
        }

        $data['email'] = Auth::user()->provider == 'simple' ? $request->email : Auth::user()->email;
        $data['phone'] = $request->phone;
        $data['address'] = $request->address;

        return $data;
    }

    //Validation Check
    private function validationCheck($request){
        $rules = [
            'phone' => 'required|unique:users,phone,' . Auth::user()->id,
            'address' => 'required',
            'image' => 'nullable|mimes:jpg,png,jpeg,svg|file' // Allow image to be nullable
        ];

        if (Auth::user()->provider == 'simple') {
            $rules['name'] = 'required';
            $rules['email'] = 'required|unique:users,email,' . Auth::user()->id;
        }

        $messages = [
            'image.mimes' => 'Please upload an image of type: jpg, jpeg, png, svg.',
            'name.required' => 'You must fill in a name.',
            'email.required' => 'You must fill in an email address.',
            'email.unique' => 'You cannot use the same email.',
            'phone.required' => 'You must fill in your phone number.',
            'phone.unique' => 'You cannot use the same phone number.',
            'address.required' => 'You must fill in an address.'
        ];

        $validator = $request->validate($rules, $messages);
    }
}
