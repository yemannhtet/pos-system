<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;


class CategoryController extends Controller
{
    public function list(){
        $data = Category::get();
        return view('admin.category.list',compact('data'));
    }

    //create category
    public function createPage(){
        return view('admin.category.create');
    }
    //create category data
    public function create(Request $request){

        $validator = $request->validate([
            'category' => 'required | unique:categories,name'
        ],[
            'category.required' => 'Category Field ကိုဖြည့်စွက်ရန် လိုအပ်ပါသည်။',
            'category.unique' =>'name အမျိုးအစား ကို အသုံးပြုပြီး ဖြစ်သည်။'
        ]);

        Category::create([
            'name' =>$request->category
        ]);
        Alert::success('Success Title', 'Success Message');


        return back();
        return to_route('categoryList');
    }
}
