<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use Session;
use Illuminate\Support\Facades\Redirect;
use Cart;
use App\Models\Coupon;

session_start();
class CartController extends Controller
{
    public function save_cart(Request $request){
       
        $productId = $request->product_id_hidden;
        $quantity = $request-> qty;
        $product_info = DB::table('tbl_product')->where('product_id',$productId)->first();
        
              // Cart::destroy();
        //   Cart::add('293ad', 'Product 1', 1, 9.99, 550);
        $data['id'] =  $product_info->product_id ;
        $data['qty'] =  $quantity;
        $data['name'] =  $product_info->product_name;
        $data['price'] =  $product_info->product_price;
        $data['weight'] =  '123';
        
        $data['options']['image'] =  $product_info->product_images;
        Cart::add($data);
        return Redirect::to('/show-cart');
        

    }
    public function show_cart(Request $request){
        $cate_product = DB::table('tbl_category_product')->where('category_status','1')->orderby('category_id','asc')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status','1')->orderby('brand_id','desc')->get();

        return view('page.cart.show_cart')->with('category',$cate_product)
        ->with('brand',$brand_product);
    }
    public function delete_to_cart($rowId){
        Cart::update($rowId,0);
        return Redirect::to('/show-cart');
        
    }
    public function update_cart_quantity(Request $request){
       $rowID = $request->rowID_cart;
       $qty = $request->cart_quantity;
       Cart::update($rowID,$qty);
       return Redirect::to('/show-cart');
    }
    public function add_cart_ajax(Request $request){
        $data = $request->all();
        $session_id = substr(md5(microtime()),rand(0,26),5);
        $cart = Session::get('cart');
        if($cart==true){
            $is_avaiable = 0;
            foreach($cart as $key => $val){
                if($val['product_id']==$data['cart_product_id']){
                    $is_avaiable++;
                }
            }
            if($is_avaiable == 0){
                $cart[] = array(
                'session_id' => $session_id,
                'product_name' => $data['cart_product_name'],
                'product_id' => $data['cart_product_id'],
                'product_image' => $data['cart_product_image'],
                'product_qty' => $data['cart_product_qty'],
                'product_price' => $data['cart_product_price'],
                );
                Session::put('cart',$cart);
            }
        }else{
            $cart[] = array(
                'session_id' => $session_id,
                'product_name' => $data['cart_product_name'],
                'product_id' => $data['cart_product_id'],
                'product_image' => $data['cart_product_image'],
                'product_qty' => $data['cart_product_qty'],
                'product_price' => $data['cart_product_price'],

            );
            Session::put('cart',$cart);
        }
       
        Session::save();

    }  
    public function gio_hang(Request $request){
        $cate_product = DB::table('tbl_category_product')->where('category_status','1')->orderby('category_id','asc')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status','1')->orderby('brand_id','desc')->get();

        return view('page.cart.cart_ajax')->with('category',$cate_product)
        ->with('brand',$brand_product);
    }
    public function delete_product($session_id){
        $cart = Session::get('cart');
        if($cart == true){
            foreach($cart as $key=> $val){
                if($val['session_id']==$session_id){
                    unset($cart[$key]);
                }
            }
            Session::put('cart',$cart);
            return Redirect()->back()->with('message','Xóa sản phẩm thành công');
        }
        else{
            return Redirect()->back()->with('message','Xóa sản phẩm thất bại');

        }
    
    }
    public function update_cart(Request $request){
        $data = $request->all();
        $cart = Session::get('cart');
        if($cart==true){
            foreach($data['cart_qty'] as $key => $qty){
               foreach($cart as $session => $val){
                   if($val['session_id']==$key){
                       $cart[$session]['product_qty'] = $qty;
                   }
               }
            }
            Session::put('cart',$cart);
            return Redirect()->back()->with('message','Cập Nhập sản phẩm thành công');
        }
        else{
            return Redirect()->back()->with('message','Cập Nhập  sản phẩm thất bại');

        }
    }
    public function delete_all_product(){
        $cart = Session::get('cart');
        if($cart==true){
            Session::forget('cart');
            return Redirect()->back()->with('message','Xóa tất cả thành công');

        }
    }
    
}
