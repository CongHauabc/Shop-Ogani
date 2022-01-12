
@extends('layout1')
@section('content')
<!-- Breadcrumb Section Begin -->

<!-- Breadcrumb Section End -->

<!-- Shoping Cart Section Begin -->
<section class="shoping-cart spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
               @if(session()->has('message'))
                <div class="alert alert-succes" style="background-color: #75e388">
                    {{session()->get('message')}}
                </div>
                @elseif(session()->has('error'))
                <div class="alert alert-succes" style="background-color: #75e388">
                    {{session()->get('error')}}
                </div>
                @endif
                <div class="shoping__cart__table">
                    
                    <form action="{{URL::to('/update-cart')}}" method="post">
                        {{ csrf_field() }}
                    <table>
                        <thead>
                            <tr>
                                <th class="shoping__product">Sản Phẩm</th>
                                

                                <th>Giá</th>
                                <th>Số Lượng</th>
                                
                                <th>Tổng tiền</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $total = 0;
                                
                            @endphp
                            @if(Session::get('cart')==true)
                            
                            @foreach (Session::get('cart') as $key=>$cart)
                             
                            @php
                           
                            $subtotal =(float)($cart['product_price']) *(float)($cart['product_qty']);
                            $total+=$subtotal;
                            
                            @endphp
                            
                          
                            
                            <tr>
                                <td class="shoping__cart__item">
                                    <img src="{{asset('public/uploads/'.$cart['product_image'])}}" style="width: 50px" alt="">
                                    
                                    <h5> {{$cart['product_name']}}</h5>
                                </td>
                                
                                <td class="shoping__cart__price">
                                    
                                    {{number_format($cart['product_price'],0,',','.')}}VNĐ
                                </td>
                               
                                    
                                <td class="shoping__cart__quantity">
                                    <div class="quantity">
                                        
                                        <div class="pro-qty">
                                            <input type="number" min="1" name="cart_qty[{{$cart['session_id']}}]" value="{{$cart['product_qty']}}">
                                        </div>
                                      
                                          
                                    </div>
                                </td>
                               
                           
                                <td class="shoping__cart__total">
                                  {{number_format($subtotal,0,',','.')}}VNĐ
                                    
                                </td>
                                <td class="shoping__cart__item__close">
                                    <a href="{{URL::to('/del-product/'.$cart['session_id'])}}"><span class="icon_close"></span></a>
                                </td>
                                
                            </tr>
                            
                            
                            @endforeach 
                           
                            <tr>
                                <td colspan="5" style="padding-bottom: 0;padding-top: 0; border: 0">
                                    <div class="row" style="margin-top: 4%">
                                        <div class="col-lg-12">
                                            <div class="shoping__cart__btns">
                                                <a  style="margin-right: 42%" href="{{URL::to('/trangchu')}}" class="primary-btn cart-btn">CONTINUE SHOPPING</a>
                    <a href="{{URL::to('/del-all-product')}}" class="primary-btn" style=""> Xóa Giỏ Hàng</a>
                                                
                                                <button type="submit" style="border: 0" class="primary-btn cart-btn cart-btn-right"><span class="icon_loading"></span>
                                                    Cập Nhập Giỏ Hàng</button>
                                                   
                                            </div>
                                           
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="5" style="border: 0">
                                    <div class="row">
           
            
                                        <div class="col-lg-6" >
                                            <div class="shoping__continue">
                                                <div class="shoping__discount" style="text-align: left;">
                                                    <h5>Mã Giảm Giá</h5>
                                                    <form action="{{URL::to('/check-coupon')}}">
                                                        <input style="border-radius: 5px;
                                                        border: 1px solid #d7c7c7;
                                                        padding: 4px 24px;" type="text" name="coupon" placeholder="Enter your coupon code">
                                                        <button style="border: 1px solid;
                                                        border-radius: 34px;" type="submit" class="site-btn">Áp Dụng</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6" style="    border-radius: 38px;
                                        border: 1px solid #d7d2d2;
                                        background-color: whitesmoke;">
                                            <div class="shoping__checkout" style=" text-align: left;
                                            border-radius: 47px;">
                                                <h5>Tổng Tiền</h5>
                                                <ul>
                                                    <li>Tổng Tiền <span> {{number_format($total,0,',','.')}} VNĐ </span></li>
                                                    <li>Thuế <span></span></li>
                                                    <li>Thành Tiền<span></span></li>
                                                </ul>
                                                
                                                
                                                    <div class="header__top__right__auth" style="display: flex">
                                                        <?php
                                                        $customer_id = Session::get('customer_id');
                                                        if($customer_id!=null){
                                                        ?>
                                                        <div class="header__top__right__auth">
                                                    <a href="{{URL::to('/checkout')}}" class="primary-btn"> Thanh Toán</a>
                                                            
                                                        </div>
                                                        <?php
                                                        }else{
                                                            ?>
                                                             <div class="header__top__right__auth">
                                                    <a href="{{URL::to('/login-checkout')}}" class="primary-btn"> Thanh Toán</a>
                                                               
                                                            </div>
                                                            <?php
                                                        }
                                                        ?>
                                                        
                                                    </div>
                                                    
                                                    
                                                        
                                            
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @else
                            <tr>
                                <td colspan="5">
                                @php
                                    echo 'Giỏ hàng của bạn hiện tại trống';
                                @endphp
                                </td>
                            </tr>
                            @endif
                        </tbody>
                        
                    </table>
                    
                    </form>
                </div>
            </div>
        </div>
        

    </div>
</section>
@endsection