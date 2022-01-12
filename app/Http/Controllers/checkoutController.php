<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use Session;
use Illuminate\Support\Facades\Redirect;
use Cart;
use App\Models\order;
use App\Models\shipping;
use App\Models\orderDeails;
session_start();
class checkoutController extends Controller
{
    public function AuthLogin(){
        $admin_password = Session::get('admin_password');
        if($admin_password){
           
            return Redirect::to('dashboardAD');
        }
        else{
           
            return Redirect::to('loginAD')->send();


        }
     }
    public function login_checkout(){
        $cate_product = DB::table('tbl_category_product')->where('category_status','1')->orderby('category_id','asc')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status','1')->orderby('brand_id','desc')->get();

        return view('page.checkout.login_checkout')->with('category',$cate_product)
        ->with('brand',$brand_product);
    }
    public function add_customer(Request $request){
        $data = array();
        $data['customer_name'] = $request->customer_name;
        $data['customer_email'] = $request->customer_email;
        $data['customer_password'] = md5($request->customer_password);
        $data['customer_phone'] = $request->customer_phone;

        $customer_id = DB::table('tbl_customer')->insertGetId($data);

        Session::put('customer_id',$customer_id);
        Session::put('customer_name',$request->customer_name);
        return Redirect::to('/checkout');



    }
    public function checkout(Request $request){
        $cate_product = DB::table('tbl_category_product')->where('category_status','1')->orderby('category_id','asc')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status','1')->orderby('brand_id','desc')->get();

        return view('page.checkout.show_checkout')->with('category',$cate_product)
        ->with('brand',$brand_product);
    }
    public function save_checkout_customer(Request $request){
        $data = array();
        $data['shipping_name'] = $request->shipping_name;
        $data['shipping_email'] = $request->shipping_email;
        $data['shipping_note'] = $request->shipping_note;
        $data['shipping_address'] = $request->shipping_address;
        $data['shipping_phone'] = $request->shipping_phone;

        $shipping_id = DB::table('tbl_shipping')->insertGetId($data);

        Session::put('shipping_id',$shipping_id);
        
        return Redirect::to('/payment');
    }
    public function payment(Request $request){
        $cate_product = DB::table('tbl_category_product')->where('category_status','1')->orderby('category_id','asc')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status','1')->orderby('brand_id','desc')->get();

        return view('page.checkout.payment')->with('category',$cate_product)
        ->with('brand',$brand_product);
      

    }
    public function logout_checkout(){
        Session::flush();
        
        return Redirect::to('/login-checkout');
    }
    public function login_customer(Request $request){
        $email = $request->email_account;
        $password = md5($request->password_acccount);
        $result = DB::table('tbl_customer')->where('customer_email',$email)->where('customer_password',$password)->first();

        if($result){
            Session::put('customer_id',$result-> customer_id);
         return Redirect::to('/checkout');
        }
        else{
            return Redirect::to('/login-checkout');
        }
       
        
    }
    public function order_place(Request $request){
        //inser payment
        $data = array();
        $data['payment_method'] = $request->payment_option;
        $data['payment_status'] = 'Đang chờ xử lý';
        $payment_id = DB::table('tbl_payment')->insertGetId($data);
        //inser order
        $order_data = array();
        $order_data['customer_id'] = Session::get('customer_id');
        $order_data['shipping_id'] = Session::get('shipping_id');
        $order_data['payment_id'] = $payment_id;
        $order_data['order_total'] = Cart::total();
        $order_data['order_status'] = 'Đang chờ xử lý';
        $order_id = DB::table('tbl_order')->insertGetId($order_data);
        //inser order_details
        $content = Cart::content();
        foreach($content as $v_content){
            $order_d_data = array();
            $order_d_data['order_id'] = $order_id;
            $order_d_data['product_id'] = $v_content->id;
            $order_d_data['product_name'] = $v_content->name;
            $order_d_data['product_price'] = $v_content->price;
            $order_d_data['product_sales_quantity'] = $v_content->qty;
            DB::table('tbl_order_details')->insert($order_d_data);
    
        }
        if($data['payment_method']==1){
            echo 'Thanh toán online';

        }
        elseif($data['payment_method']==2){
            Cart::destroy();
            $cate_product = DB::table('tbl_category_product')->where('category_status','1')->orderby('category_id','asc')->get();
            $brand_product = DB::table('tbl_brand')->where('brand_status','1')->orderby('brand_id','desc')->get();
    
            
           
            return view('page.checkout.handcash')->with('category',$cate_product)
            ->with('brand',$brand_product);
        }
        else {
            echo 'paypal';
        }
        
        
        // return Redirect::to('/payment');
    }
    public function manage_order(){
        $this->AuthLogin();

        $all_order = DB::table('tbl_order')
        ->join('tbl_customer','tbl_order.customer_id','=','tbl_customer.customer_id')
        ->select('tbl_order.*','tbl_customer.customer_name')
        ->orderby('tbl_order.order_id','asc')->get();

        $manager_order = view('admin.manage_order')->with('all_order',$all_order);
        return view('admin.dashboard')->with('admin.manage_order',$manager_order);
    }
    public function view_order($orderid){
        $this->AuthLogin();

        $order_by_id = DB::table('tbl_order')
        ->join('tbl_customer','tbl_order.customer_id','=','tbl_customer.customer_id')
        ->join('tbl_shipping','tbl_order.shipping_id','=','tbl_shipping.shipping_id')
        ->join('tbl_order_details','tbl_order.order_id','=','tbl_order_details.order_id')
        ->where('tbl_order.order_id', $orderid)
        ->select('tbl_order.*','tbl_customer.*','tbl_shipping.*','tbl_order_details.*')
       
        ->Get() ;
        

        $manager_order_by_id = view('admin.view_order')->with('order_by_id',$order_by_id);
        return view('admin.dashboard')->with('admin.view_order',$manager_order_by_id);
    }
    public function confirm_order(Request $request){
        $data = $request->all();
        $shipping = new  shipping();
      
        $shipping->shipping_name = $data['shipping_name'];
        $shipping->shipping_address = $data['shipping_address'];
        $shipping->shipping_phone = $data['shipping_phone'];
        $shipping->shipping_email = $data['shipping_email'];
       
        $shipping->shipping_note = $data['shipping_note'];
        $shipping->shipping_method = $data['shipping_method'];
        $shipping->save();

        $checkout_code= substr(md5(microtime()),rand(0,26),5);

        $shipping_id = $shipping->shipping_id;
        $order = new order;
        $order->customer_id = Session::get('customer_id');
        $order->shipping_id = $shipping_id;
        $order->order_status=1;
        $order->order_code = $checkout_code;
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $order->created_at = now();

        $order->save();


      if(Session::get('cart')){
            foreach(Session::get('cart') as $key => $cart)
            {
                $orderDeails = new orderDeails;
               $orderDeails->order_code= $checkout_code;
               
               
               $orderDeails->product_id= $cart['product_id'];
               $orderDeails->product_name = $cart['product_name'];
               $orderDeails->product_price = $cart['product_price'];
               $orderDeails->product_sales_quantity = $cart['product_qty'];

               $orderDeails->save();
            }
            
            
        }
        Session::forget('cart');
      
    }
    

}

