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
        Alert::success('Insert Success', 'Category Insert  Successfully');


        return back();

    }

    //delete category

    public function delete($id){
        Category::where('id',$id)->delete();
        Alert::success('Delete Success', 'Delete Category Successfully');
        return back();

    }
    //edit category
    public function edit($id){
        $data = Category:: where('id' , $id)->first();
        return view('admin.category.edit' ,compact('data'));
    }
    //update category
    public function update(Request $request){

        $validator = $request->validate([
            'category' => 'required | unique:categories,name,'.$request->id
        ]);

        Category::where('id' , $request->categoryId)->update([
            'name' => $request->category
        ]);
        Alert::success('Update Success', 'Update Category Successfully');
        return to_route('categoryList');
    }

}
