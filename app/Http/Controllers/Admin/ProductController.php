<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;

class ProductController extends Controller
{
    // List page function
    public function list(){
        $products = Product::when(request('searchKey'),function($query){
                                                $query->whereAny(['name','price','count'],'Like','%'.request('searchKey').'%');
                                               })
                                              ->paginate(3);
        return view('admin.product.list',compact('products'));
    }

    //create product validation
    public function productcreate(Request $request){
        $this->validationCheck($request,"create");

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


    // create product
    public function create(){
        $categories = Category::get();
        return view('admin.product.create',compact('categories'));
    }
//delete
        public function delete($id){
            Product::where('id', $id )->delete();
            Alert::success('Delete Success', 'Delete Product Successfully');
            return back();
        }

        //details function
        public function details($id) {
            // Find the product with the specified ID
            $data = Product::select('products.id','products.name', 'products.price', 'products.count','products.category_id', 'products.description','products.image', 'categories.name as category_name')
                ->leftJoin('categories', 'products.category_id', 'categories.id')
                ->where('products.id', $id)
                ->first();
            return view('admin.product.details', compact('data'));
        }

        //edit product
        public function edit($id) {
            // Find the product with the specified ID
            $products = Product::select('products.id','products.name', 'products.price', 'products.count','products.category_id', 'products.description','products.image', 'categories.name as category_name')
                ->leftJoin('categories', 'products.category_id', 'categories.id')
                ->where('products.id', $id)
                ->first();
                $categories = Category::get();
            // Pass the data to the view
            return view('admin.product.edit ', compact('products','categories'));
        }

        // //update product
        public function update(Request $request){
            $this->validationCheck($request,"update");

            $data=$this->requestProductData($request);

            if ($request->hasFile('image')) {
                // delete old image if it exists
                if (file_exists(public_path('images/' . $request->oldImage))) {
                    unlink(public_path('images/' . $request->oldImage));
                }

                // upload new image
                $fileName = uniqid() . '.' . $request->file('image')->getClientOriginalExtension();
                $request->file('image')->move(public_path('images'), $fileName);
                $data['image'] = $fileName;
            } else {
                $data['image'] = $request->oldImage;
            }

                Product::where('id', $request->productId)->update($data);
                Alert::success('Update Success', 'Update Product Successfully');
                return to_route('productList');

        }

    // crate | update validation
    private function validationCheck($request,$action){
        $rules = [
                'name' => 'required|unique:products,name,'.$request->productId,
                'price'   => 'required',
                'categoryName' =>'required',
                'count' => 'required|numeric|numeric|max:100',
                'description' => 'required'
        ];
        $rules['image']=$action=="create" ? "required |mimes:jpg,png,jpeg,svg|file":"mimes:jpg,png,jpeg,svg|file";

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
