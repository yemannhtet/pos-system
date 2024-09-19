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
                        ->paginate(5);
        $userCount =User::where('role','user')
                        ->  count();

         $adminCount =User::orWhere('role','admin')
                                            ->  orWhere('role','superadmin')
                                            ->  count();
        return view('admin.role.adminList',compact('data','adminCount','userCount'));
    }

    // delete admin account
    public function destroy($id){
            User::where('id',$id)->delete();

            Alert::success('Delete Success', 'Admin Account Deleted Successfully');
            return back();
    }
        // update to admin role
        public function  changeUserRole($id){
            User::where('id',$id)->update(['role'=>'user']);
            Alert::success('Change Success', 'Change To User Account  Successfully');
            return back();
        }
        //list page admin
        public function userList(){
            $data = User::select('id','name','nickname','email','phone','address')
                            ->where('role','user')
                            ->paginate(5);

            $adminCount =User::orWhere('role','admin')
                            ->  orWhere('role','superadmin')
                            ->  count();
            return view('admin.role.userList',compact('data','adminCount'));
        }
            // delete admin account
    public function destroyUser($id){
        User::where('id',$id)->delete();

        Alert::success('Delete Success', 'User Account  Deleted Successfully');
        return back();
}

// update to admin role
public function  changeAdminRole($id){
    User::where('id',$id)->update(['role'=>'admin']);
    Alert::success('Change Success', 'Change To Admin Account  Successfully');
    return back();
}
}
