<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
@extends('admin.dashboard')
@section('admin_content')
<div class="content-wrapper">
    <div class="row">
    <div class="col-lg-12 stretch-card">
        <div class="card">
          <div class="card-body">
            
               
                
            <?php
            
            
            $message = Session::get('message');
            if($message){
              echo '<span class="message">'.$message.'</span>';
              session::put('message',null);
            }
            ?>
              </div>
           <h1 class="card-title" style="text-align: center; color: #c67bff;">Thông Tin Khách Hàng</h1>
            
             
            <table class="table table-bordered" style="width: 95%;margin-left: 2.5%;">
              <thead style="text-align: center;background-color: aquamarine;">
                <tr>
                  
                  <th> Tên Khách Hàng </th>
                  <th> Điện Thoại</th>
                  <th> Email</th>
                </tr>
              </thead>
              <tbody style="text-align: center">
                
               
                
                <tr class="table-info">
                  <td> {{$customer->customer_name}}</td>
                  <td>{{$customer->customer_phone}} </td>
                  <td>{{$customer->customer_email}} </td>

                  
                </tr>
               
              </tbody>
            </table>
            <br><br>
            <h1 class="card-title" style="text-align: center; color: #c67bff;">Thông Tin Vận Chuyển</h1>
            <table class="table table-bordered" style="width: 95%;margin-left: 2.5%;">
                <thead style="text-align: center;background-color: aquamarine;">
                  <tr>
                    
                    <th> Tên Người Nhận </th>
                    <th> Địa Chỉ</th>
                    <th> Số Điện Thoại</th>
                    <th> Ghi chú</th>
                    <th> Hình thức thanh toán</th>


                  </tr>
                </thead>
                <tbody style="text-align: center">
                  
                   
                  <tr class="table-info">
                    <td> {{$shipping->shipping_name}}</td>
                    <td> {{$shipping->shipping_address}}</td>
                    <td>{{$shipping->shipping_phone}} </td>
                    <td>{{$shipping->shipping_note}} </td>
                    <td>@if($shipping->shipping_method==0)Chuyển Khoản @else Thanh toán khi nhận hàng @endif </td>

                    
                  </tr>
                 
                </tbody>
            </table>
            <br><br>
            <h1 class="card-title" style="text-align: center; color: #c67bff;">Thông Tin Chi Tiết Đơn Hàng</h1>
            <table class="table table-bordered" style="width: 95%;margin-left: 2.5%">
                <thead style="text-align: center;background-color: aquamarine;">
                  <tr >
                    
                    <th> Tên Sản Phẩm </th>
                    
                    <th>Số Lượng </th>
                    <th>Sl Hàng còn</th>
                    <th>Giá sản phẩm</th>
                    <th>Tổng tiền</th>
                   
                  </tr>
                </thead>
                @php
                   $total= 0;
                @endphp
                <tbody style="text-align: center">
               
                    @foreach ($order_details as $key => $detail)
                      @php
                     
                      $subtotal= $detail->product_price*$detail->product_sales_quantity;
                      $total+=$subtotal;
                      @endphp
                  <tr class="color_qty_{{$detail->product_id}}">
                    <td> {{$detail->product_name}} </td>
                                    

                    @if ($order_status !=2)
                    <td><input type="number" min="1" class="order_qty_{{$detail->product_id}}" value="{{$detail->product_sales_quantity}}" name="product_sales_quantity">
                     @else
                    <td><input type="number" min="1" disabled class="order_qty_{{$detail->product_id}}" value="{{$detail->product_sales_quantity}}" name="product_sales_quantity">

                      @endif
                      <input type="hidden" name="order_qty_storage" class="order_qty_storage_{{$detail->product_id}}" value="{{$detail->product->product_quantity}}">
                      <input type="hidden" name="order_code" class="order_code" value="{{$detail->order_code}}">

                   <input type="hidden" name="order_product_id" class="order_product_id" value="{{$detail->product_id}}">
                   @if ($order_status !=2)
                     
                   
                    <button type="submit" data-product_id="{{$detail->product_id}}" class="btn btn-primary update_quantity_order" name="update_quantity_order" style="padding: 4px 10px;">Cập Nhật</button>
                    @endif  
                  </td>
                    <td>{{$detail->product->product_quantity}}</td>

                    <td>  {{number_format($detail->product_price,0,',','.')}} VNĐ</td>
                    <td>{{number_format($subtotal,0,',','.')}}  VNĐ</td>
                   
                   
                  </tr>
                  @endforeach
               
                <tr>
                  <td colspan="1"> 
                    <h4>Tổng Hóa Đơn</h4>
                    {{number_format($total,0,',','.')}}VNĐ </td>
                  
                </tr>
                
                <tr>
                  <td colspan="4">
                    @foreach ( $order as $key=>$or)
                      @if($or->order_status==1)
                          <form>
                            @csrf
                          <select name="" id="" class="form-control order_details">
                            <option value="">------Chọn hình thức xử lý đơn hàng-----</option>
                            <option id="{{$or->order_id}}" selected value="1">Chưa xử lý</option>

                            <option id="{{$or->order_id}}" value="2">Đã xử lý</option>
                            <option id="{{$or->order_id}}" value="3">Hủy Đơn Hàng</option>

                          </select>
                          </form>
                    @elseif ($or->order_status==2)
                          <form>
                            @csrf
                            <select  name="" id="" class="form-control order_details">
                            <option value="">------Chọn hình thức xử lý đơn hàng-----</option>

                            <option id="{{$or->order_id}}" value="1">Chưa xử lý</option>

                              <option id="{{$or->order_id}}" selected value="2">Đã xử lý</option>
                              <option id="{{$or->order_id}}" value="3">Hủy Đơn Hàng</option>
        
                            </select>
                            </form>
                    @else
                    <form>
                      @csrf
                      <select  name="" id="" class="form-control order_details">
                        <option value="">------Chọn hình thức xử lý đơn hàng-----</option>

                      <option id="{{$or->order_id}}" value="1">Chưa xử lý</option>

                        <option id="{{$or->order_id}}"  value="2">Đã xử lý</option>
                        <option id="{{$or->order_id}}" selected value="3">Hủy Đơn Hàng</option>
  
                      </select>
                      </form>
                    @endif
                    @endforeach
                  </td>
                </tr>
                <tr>
                  <td colspan="4">  <a href="{{URL::to('/print-order/'.$detail->order_code)}}  " target="_black" style="align-items: center;text-decoration: none" ><img src="https://img.icons8.com/clouds/100/000000/print.png"/>In Đơn Hàng</a></td>
                </tr>
                </tbody>
              </table>
         <br><br><br>
            </div>
        </div>
    
        
       
       
           

    </div>
    
    
    
</div>
</div>


<style>
#Sua{
  width: 28px;height: 28px;margin-right: 10px;
  
}
a{
  cursor: pointer;
}
#Sua:hover{

}
.table-info, .table-info > th, .table-info > td {
  background-color: #e1fffd;
}
.message{
  width: 100%;
    text-align: center;
    background-color: #6ca8ad;
    padding: 6px 0;
}
</style>





@endsection
