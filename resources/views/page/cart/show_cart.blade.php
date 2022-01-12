
@extends('layout1')
@section('content')
<!-- Breadcrumb Section Begin -->

<!-- Breadcrumb Section End -->

<!-- Shoping Cart Section Begin -->
<section class="shoping-cart spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="shoping__cart__table">
                    <?php
                    $content = Cart::content();
                    //   echo '<pre>';
                    // print_r($content);
                    // echo '</pre>';

                    ?>
                    <table>
                        <thead>
                            <tr>
                                <th class="shoping__product">Sản Phẩm</th>
                                

                                <th>Giá</th>
                                <th>Số Lượng</th>
                                <th></th>
                                <th>Tổng tiền</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($content as $v_content )
                                
                            
                            <tr>
                                <td class="shoping__cart__item">
                                    <img src="{{URL::to('public/uploads/'.$v_content->options->image)}}" style="width: 50px" alt="">
                                    <h5>{{$v_content->name}}</h5>
                                </td>
                                
                                <td class="shoping__cart__price">
                                    {{number_format($v_content->price).' '.'VNĐ'}}
                                </td>
                                <form action="{{URL::to('update-cart-quantity')}}" method="post">
                                    {{ csrf_field() }}
                                <td class="shoping__cart__quantity">
                                    <div class="quantity">
                                        
                                        <div class="pro-qty">
                                            <input type="text" name="cart_quantity" value="{{$v_content->qty}}">
                                        </div>
                                      
                                          
                                    </div>
                                </td>
                                <td>
                                    <input type="hidden" name="rowID_cart" value="{{$v_content->rowId}}">
                                            <input style="background-color: whitesmoke;
                                            border: 1px solid whitesmoke; " type="submit" value="Cập Nhâp" name="update_qty" class="btn btn-default btn-sm">
                                           
                                    
                                </td>
                            </form>
                                <td class="shoping__cart__total">
                                  <?php
                                    $subtotal= $v_content->price * $v_content->qty;
                                    echo number_format($subtotal).' '.'VNĐ';
                                    ?>
                                    
                                </td>
                                <td class="shoping__cart__item__close">
                                    <a href="{{URL::to('/delete-to-cart/'.$v_content->rowId)}}"><span class="icon_close"></span></a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="shoping__cart__btns">
                    <a href="#" class="primary-btn cart-btn">CONTINUE SHOPPING</a>
                    
                </div>
            </div>
            <div class="col-lg-6">
                <div class="shoping__continue">
                    <div class="shoping__discount">
                        <h5>Mã Giảm Giá</h5>
                        <form action="#">
                            <input type="text" placeholder="Enter your coupon code">
                            <button type="submit" class="site-btn">Áp Dụng</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="shoping__checkout">
                    <h5>Tổng Tiền</h5>
                    <ul>
                        <li>Tổng Tiền <span> {{Cart::subtotal(0,',','.').' '.'VNĐ'}}</span></li>
                        <li>Thuế <span>{{Cart::tax(0).' '.'VNĐ'}}</span></li>
                        <li>Thành Tiền<span>{{Cart::total(0,',','.')}}</span></li>
                    </ul>
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
</section>
@endsection