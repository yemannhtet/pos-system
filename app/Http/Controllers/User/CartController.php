<?php

namespace App\Http\Controllers\user;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Payment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

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

        $payment = Payment::get();

        return view('customer.cart',compact('cart','totalPrice','payment'));
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

    //order process
    public function order(Request $request){

        $orderArr = [];
        foreach($request->all() as $item){

            array_push($orderArr,[
                'user_id' => $item['user_id'],
                'product_id' => $item['product_id'],
                'order_code' => $item['ordercode'],
                'status' => 0,
                'count' =>$item['qty'],
               'total_price'=>$item['total_price']
            ]);


            Session::put('orderList',$orderArr);

            logger(Session::get('orderList'));

            // Order::create([

            // ]);

            // Cart::where('user_id',$item['user_id'])->where('product_id',$item['product_id'])->delete();

        }
        $serverResponse = [
            'message' => 'success'
        ];

        return response()->json($serverResponse, 200);
    }

    public function orderList(){

        $order = Order::where('user_id',Auth::user()->id)
                        ->groupBy('order_code')
                        ->orderBy('created_at','desc')
                        ->get();

        return view('customer.orderList',compact('order'));
    }

    //order details
    public function userOrderDetails($orderCode){

        $order = Order::select('users.name as customer_name','products.image as product_image','products.name as product_name','products.price as product_price','orders.count as order_count','orders.created_at as order_date','orders.order_code')
        ->leftJoin('products','orders.product_id','products.id')
        ->leftJoin('users','orders.user_id','users.id')
        ->where('orders.order_code',$orderCode)
        ->get();

        $totalPrice = 0;
        foreach($order as $item){
            $totalPrice += $item->order_count * $item->product_price;
        }


        return view('customer.orderDetails',compact('order','totalPrice'));
    }

    public function payment() {
        $orderProduct =Session::get('orderList');
        $payment = Payment::get();

        $total = 0;
        foreach($orderProduct as $item)

        $total += $item['total_price'];

        // dd($total);
        return view('customer.payment', compact('payment'));
    }

}
