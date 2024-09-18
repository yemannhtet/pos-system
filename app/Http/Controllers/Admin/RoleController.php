<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;

class RoleController extends Controller
{
    //list page admin
    public function adminList(){

        $data = User::select('id','name','nickname','email','phone','address')
                        ->orWhere('role','admin')
                        ->orWhere('role','superadmin')
                        ->get();
        return view('admin.role.adminList',compact('data'));
    }

    // delete admin account
    public function destroy($id){
            User::where('id',$id)->delete();

            Alert::success('Delete Success', 'Delete Admin Account Successfully');
            return back();
    }
}
