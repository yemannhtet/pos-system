<?php

namespace App\Http\Controllers\user;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Payment;
use Illuminate\Http\Request;
use App\Models\PaySlipHistory;
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
        $payment = Payment::orderBy('type','asc')-> get();

        $total = 0;
        foreach($orderProduct as $item)

        $total = $item['total_price'];

    //   dd($orderProduct);
        return view('customer.payment', compact('payment','orderProduct','total'));
    }

    public function orderProduct(Request $request) {
        $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'payment_type' => 'required',
            'payslip' => 'required',
        ], [
            'name.required' => 'အမည်တစ်ခုဖြည့်စွက်ရန်လိုသည်။',
            'payslip.required' => 'ငွေ လွှဲပြေစာ ဖြည့်သွင်းရန် လိုအပ်သည်။',
            'phone.required' => 'ဖုန်းနံပါတ်ဖြည့်သွင်းရန်လိုအပ်သည်။',
            'payment_type.required' => 'payment အမျိူအစားရွေးချယ်ရန်လိုအပ်ပါသည်。',
        ]);

        $cartProduct = Session::get('orderList');

        foreach($cartProduct as $item){
            Order::create($item);
            Cart::where('user_id',$item['user_id'])->where('product_id',$item['product_id'])->delete();
        }

        $data = [
            'customer_name' => $request->name,
            'phone' => $request->phone,
            'payment_method' => $request->payment_type,
            'order_code' => $request->order_code,
            'order_amount' => $request->total,
        ];

        if($request->hasFile('payslip')){
            $fileName =uniqid() . $request->file('payslip')->getClientOriginalName();
            $request->file('payslip')->move(public_path().'/payslip/',$fileName);
            $data['payslip_image'] =$fileName;
          }
                    PaySlipHistory::create($data);
                    return to_route('orderList');
            }

}
