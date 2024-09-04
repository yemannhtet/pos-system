<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;

class ProductController extends Controller
{
    //list page function
    public function list(){
        $products = Product::get();
        return view('admin.product.list',compact('products'));
    }
    // create product
    public function create(){
        $categories = Category::get();
        return view('admin.product.create',compact('categories'));
    }

    //create  product
    public function productcreate(Request $request){
       $this->validationCheck($request);

       $data = $this->requestProductData($request);

       if($request->hasFile('image')){
         $fileName =uniqid() . $request->file('image')->getClientOriginalName();
         $request->file('image')->move(public_path().'/Images/',$fileName);
         $data['image'] =$fileName;
       }

       Product::create($data);
       Alert::success('Insert Success', 'Insert Product Successfully');
       return to_route('productList');
    }
    // crate | update validation
    private function validationCheck($request){
        $rules = [
            'image' => 'required |mimes:jpg,png,jpeg,svg|file',
            'name'  => 'required|unique:products,name',
            'price'   => 'required',
            'categoryName' =>'required',
            'count' => 'required|numeric|digits_between:1,100',
            'description' => 'required'
        ];
        $messages=[
            'images.required' =>' ပုံဖြည့်ရန် လိုအပ်သည်။',
            'name.required'   =>' အမည်တစ်ခုဖြည့်စွက်ရန်လိုသည်။',
            'price.required'    =>'ပစ္စည်း၏စျေးနှုန်းဖြည့်စွက်ရန်လိုအပ်သည်။',
            'categoryName.required' =>' အမျိုးအစားအမည်တစ်ခုကို ရွေးချယ်ရန် လိုအပ်သည်။',
            'count.required'=>'ပစ္စည်းအရေအတွက် ဖြည့်ရန် လိုအပ်သည်။ ',
            'description.required'=>'ဖော်ပြချက်အချို့ကို ဖြည့်စွက်ရန် လိုအပ်သည်။'
        ];

        $validator = $request->validate($rules,$messages);
    }

    //request product data
    public function requestProductData($request) {
        return[
            'name' =>$request->name,
            'price' =>$request->price,
            'category_id' =>$request->categoryName,
            'count' =>$request->count,
            'description' =>$request->description
        ];
    }


}
