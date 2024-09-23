<?php

namespace App\Http\Controllers\user;

use App\Models\Cart;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    //diretct cart page
    public function cartDetails(){
        $id = Auth::user()->id;

        $cart = Cart::select('carts.*','products.image','products.price','products.name')
                            ->leftJoin('products','carts.product_id','products.id')
                            ->where('user_id',$id)
                            ->get();

        $totalPrice = 0 ;
        foreach($cart as $item){
            $totalPrice += $item->price*$item->qty ;
        }
        return view('customer.cart',compact('cart','totalPrice'));
    }
    //add to cart proceess
    public function addToCart(Request $request){

       $product_id = $request->product_id;
       $qty = $request->qty;
       $user_id =Auth::user()->id;

       Cart::create([
        'user_id' => $user_id,
        'product_id' => $product_id,
        'qty' => $qty,
       ]);

       return to_route('shopList');
    }

    //remove cart
    public function removeCart(Request $request) {
        $cartId = $request->input('cartId'); // Get cart ID from request

        // Delete the cart item
        Cart::where('id', $cartId)->delete();



        // Prepare the response
        $serverResponse = [
            'message' => 'success'
        ];

        // Return the response as JSON
        return response()->json($serverResponse, 200);
    }


}
