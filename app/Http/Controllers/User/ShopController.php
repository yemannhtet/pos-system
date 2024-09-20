<?php

namespace App\Http\Controllers\User;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
}
