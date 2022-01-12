<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\order;
use App\Models\shipping;
use App\Models\orderDeails;
use App\Models\customer;
use App\Models\product;

use PDF;
use Session;
use Illuminate\Support\Facades\Redirect;

class orderCotroller extends Controller
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
    
    public function manage_order(){
        $this->AuthLogin();
        $order = order::orderby('created_at','desc')->get();
        return view('admin.manage_order')->with(compact('order'));
    }
    public function view_order($order_code){
        $order_details = orderDeails::with('product')->Where('order_code',$order_code)->get();
        $order = order::where('order_code',$order_code)->get();
        foreach($order as $key => $ord){
            $customer_id = $ord->customer_id;
            $shipping_id = $ord->shipping_id;

            $order_status = $ord->order_status;
        }
        $customer = customer::where('customer_id',$customer_id)->first();
        $shipping = shipping::where('shipping_id',$shipping_id)->first();

        $order_details = orderDeails::with('product')->where('order_code',$order_code)->get();

        return view('admin.view_order')->with(compact('order_details','customer','shipping','order_details','order','order_status'));
    
    
    }
    public function print_order($checkout_code){
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($this->print_order_convert($checkout_code));
        return $pdf->stream();
    }
    public function print_order_convert($checkout_code){
        $order_details = orderDeails::Where('order_code',$checkout_code)->get();
        $order = order::where('order_code',$checkout_code)->get();
        foreach($order as $key => $ord){
            $customer_id = $ord->customer_id;
            $shipping_id = $ord->shipping_id;
        }
        $customer = customer::where('customer_id',$customer_id)->first();
        $shipping = shipping::where('shipping_id',$shipping_id)->first();
        $order_details_product = orderDeails::with('product')->where('order_code',$checkout_code)->get();
        $output='';
        $output.='<div  >
        <h4><img src="https://img.icons8.com/doodle/48/000000/small-business--v1.png"/><span>Ogani Shop</span></h4>
       
        </div>
        
        <h1 style="text-align:center;" >Hóa Đơn Mua hàng</h1>';
        $output.='
                <style>
                body{
                    font-family: Dejavu Sans;
                    background-image: url(https://scr.vn/wp-content/uploads/2020/11/hinh-nen-vu-tru-819x1024.jpg);
                }
                th{
                    border: 1px solid;
                }
                td{
                    border: 1px solid;
                }
                </style>
                
                <h4>Thông tin khách hàng</h4>
                <table class="table table-bordered" style="margin-left: 20%;">
                <thead>
                    <tr>
                    <th>Tên Khách Hàng</th>
                    <th>Số Điên Thoại</th>
                    <th>Email</th>
                    </tr>
                </thead>
                <tbody>';
        $output.='      
                <tr class="table-info">
                  <td>' .$customer->customer_name.'</td>
                  <td>'.$customer->customer_phone.' </td>
                  <td>'.$customer->customer_email.' </td>
                </tr>';
        $output.='         
                </tbody>    
        
        
        </table>';
        $output.='
                <style>
                body{
                    font-family: Dejavu Sans
                }
                th{
                    border: 1px solid;
                }
                td{
                    border: 1px solid;
                }
                </style>
               
                <h4>Thông tin Vận Chuyển</h4>
                <table class="table table-bordered" style="margin-left: 15%;" >
                <thead>
                    <tr>
                    <th>Tên Người Nhận</th>
                    <th>Địa Chỉ</th>
                    <th>Số Điện Thoại</th>
                    <th>Ghi Chú</th>
                    </tr>
                </thead>
                <tbody>';
        $output.='      
                <tr class="table-info" >
                  <td>' .$shipping->shipping_name.'</td>
                  <td>'.$shipping->shipping_address.' </td>
                  <td>'.$shipping->shipping_phone.' </td>
                  <td>'.$shipping->shipping_note.' </td>

                </tr>';
        $output.='         
                </tbody>    
        
        
        </table>';
        $output.='
        <style>
        body{
            font-family: Dejavu Sans
        }
        th{
            border: 1px solid;
        }
        td{
            border: 1px solid;
        }
        </style>
       
        <h4>Thông tin chi tiết đơn hàng</h4>
        <table class="table table-bordered" style="margin-left: 19%;" >
        <thead>
            <tr>
            <th>Tên Sản Phẩm</th>
            <th> Số lượng</th>
            <th>Giá sản phẩm</th>
            <th>Tổng tiền</th>
            </tr>
        </thead>
        <tbody>';
        $total=0;
        foreach ($order_details as $key => $detail){
        $subtotal= $detail->product_price*$detail->product_sales_quantity;
        $total+=$subtotal;
        
        $output.='      
                <tr class="table-info" >
                <td>' .$detail->product_name.'</td>
                <td>'.$detail->product_sales_quantity.' </td>
                <td>'.number_format($detail->product_price,0,',','.').'VNĐ'.'</td>
                <td>'.number_format($subtotal,0,',','.').'VNĐ'. '</td>

                </tr>';
    }
        
        $output.='         
                </tbody>    


        </table>';
        $output.='
            
           
        <p>  <b> Tổng Tiền Hóa Đơn:</b>'.number_format($total,0,',','.').'VNĐ'. '</p>
      
   
   ';
        
        return $output;
    }
    public function update_order_qty(Request $request){
        $data = $request->all();
        $order = order::find($data['order_id']);
        $order->order_status = $data['order_status'];
        $order->save();
        if($order->order_status==2){
            foreach($data['order_product_id'] as $key =>$product_id){
                $product = product::find($product_id);
                $product_quantity = $product->product_quantity;
                $product_sold = $product->product_sold;
                    foreach($data['quantity'] as $key2 => $qty){
                        if($key==$key2){
                            $pro_remain = $product_quantity - $qty;
                            $product->product_quantity   = $pro_remain;
                            $product->product_sold = $product_sold + $qty;
                            $product->save();
                        }
                    }
            }
        }
        elseif($order->order_status!=2 && $order->order_status!=1){
            foreach($data['order_product_id'] as $key =>$product_id){
                $product = product::find($product_id);
                $product_quantity = $product->product_quantity;
                $product_sold = $product->product_sold;
                    foreach($data['quantity'] as $key2 => $qty){
                        if($key==$key2){
                            $pro_remain = $product_quantity + $qty;
                            $product->product_quantity   = $pro_remain;
                            $product->product_sold = $product_sold - $qty;
                            $product->save();
                        }
                    }
            }
        }
    }
    public function update_qty(Request $request){
        $data = $request->all();
        $order_details = orderDeails::where('product_id',$data['order_product_id'])->where('order_code',$data['order_code'])->first();
        $order_details->product_sales_quantity = $data['order_qty'];
        $order_details->save();

    }


}
