<?php

namespace App\Http\Controllers\User;

use App\Models\Rating;
use App\Models\Comment;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class ShopController extends Controller
{
    // direct shop List page
    public function shop($category_id = null) {


        $products = Product::when(request('searchKey'),function($query){
                                $query->where('products.name','like','%'.request('searchKey').'%');
                             });

        if(request('minPrice') != null && request('maxPrice') != null)    {
                     $products = $products->whereBetween('price',[request('minPrice'),request('maxPrice')]);
        }
        if(request('minPrice') != null && request('maxPrice') == null)    {
            $products = $products->where('products.price','>=',request('minPrice'));
        }
        if(request('minPrice') == null && request('maxPrice') != null)    {
            $products = $products->where('products.price','<=',request('maxPrice'));
        }
//             $products = $products->when(request('minPrice'),function($query){
//                                 $query->where('products.price','>=',request('minPrice'));
//             });
//             $products = $products->when(request('maxPrice'),function($query){
//                 $query->where('products.price','<=',request('maxPrice'));
// });
          $products = $products->select('products.*', 'categories.name as category_name')
                            ->leftJoin('categories', 'products.category_id', 'categories.id');

        if ($category_id == null) {
            $products = $products->paginate(9);
        } else {
            $products = $products->where('products.category_id', $category_id)->paginate(9);
        }

        $categories = Category::get();
        return view('customer.shop', compact('categories', 'products'));
    }
    //details page route
    public function  details($id){
        $product = Product::select('products.id','products.name', 'products.price', 'products.count','products.category_id', 'products.description','products.image', 'categories.name as category_name')
                                    ->leftJoin('categories', 'products.category_id', 'categories.id')
                                    ->where('products.id', $id)
                                    ->first();

        $comment = Comment::select('comments.*','users.name' ,'users.nickname','users.profile')
                                                ->leftJoin('users','comments.user_id','users.id')
                                                ->where('comments.product_id',$id)
                                                ->orderBy('created_at','desc')
                                                ->get();

        $productRating =Rating::where('product_id',$id)->avg('count');

        $ratingCount = Rating::where('product_id',$id)->get();


        $user_rating = Rating::select('count')->where('product_id',$id)->where('user_id',Auth::user()->id)->first();
        $user_rating = $user_rating == null ? 0 : $user_rating = $user_rating['count'];

        $productList = Product::select('products.id','products.name', 'products.price', 'products.count','products.category_id', 'products.description','products.image', 'categories.name as category_name')
                                        ->leftJoin('categories', 'products.category_id', 'categories.id')
                                        ->get();
        return view('customer.details',compact('product','comment','productRating','ratingCount','user_rating','productList'));
    }

    //comment

    public function comment(Request $request){
     $request->validate([
        'message' => 'required'
     ],[
        'message.required'=>'message box ကို ဖြည့်သွင်းရန်လိုအပ် ပါသည်။'
     ]);

     $data =   [
       'product_id' => $request->productId,
        'user_id' => $request->userId,
        'message' => $request->message,
     ];
     Comment::create($data);
     Alert::success('Comment Post Success', 'Post A Comment Successfully');
     return back();
   }
   // add rating

   public function addRating(Request $request){
    $ratingCheckData = Rating::where('product_id', $request->product_id)
                                                ->where('user_id', $request->userId)
                                                ->first();

        if ($ratingCheckData == null) {
                    Rating::create([
                                'product_id' => $request->product_id,
                                'user_id' => $request->userId,
                                'count' => $request->productRating,
                        ]);
                } else {Rating::where('product_id', $request->product_id)
                            ->where('user_id', $request->userId)
                            ->update([
                            'count' => $request->productRating
            ]);
            }
            Alert::success('Rating Success', 'Rating to Products Successfully');
            return back();
   }
}
