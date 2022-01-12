@extends('layout1')
@section('content')


<!-- Checkout Section Begin -->
<section class="checkout spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h6><span class="icon_tag_alt"></span> Have a coupon? <a href="#">Click here</a> to enter your code
                </h6>
            </div>
        </div>
        <div class="checkout__form">
            <h4> Thông tin hóa đơn</h4>
            <form method="POST">
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-lg-12 col-md-6">
                       
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="checkout__input">
                                    <p>Email<span>*</span></p>
                                    <input type="text" required name="shipping_email" class="shipping_email">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="checkout__input">
                                    <p>Họ Tên<span>*</span></p>
                                    <input type="text" required name="shipping_name" class="shipping_name">
                                </div>
                            </div>
                        </div>
                        <div class="checkout__input">
                            <p>Địa Chỉ<span>*</span></p>
                            <input type="text" required name="shipping_address" class="shipping_address">
                        </div>
                        <div class="checkout__input">
                            <p>Điện Thoại<span>*</span></p>
                            <input type="text" required name="shipping_phone" placeholder="Điện Thạoi" class="checkout__input__add shipping_phone" >
                        </div>
                        <div class="checkout__input">
                            <p>Ghi chú đơn hàng</p>
                        <textarea name="shipping_note" class="shipping_note" required id="" cols="100" rows="5"></textarea>    
                        </div>
                        
                        <div class="checkout__input" style="">
                            <p>Chọn Hình Thức Thanh Toán</p>
                          
                          <select name="payment_select" id="" class="form-control payment_select" >
                              <option value="">-------Chọn-------</option>
                            <option value="0">Chuyển Khoản</option>
                            <option value="1">Thanh toán khi nhận hàng</option>
                             </select>   
                        </div>
                       
                   
                    </div>
                   
                    <input type="button" style="margin: 17px;
                    background-color: #7fad39;
                    border: 1px solid;
                    color: white;
                    padding: 7px 33px;" value="Đặt Hàng" name="send_order" class="send_order">
                    
                        
                    
                </div>
            </form>
        </div>
    </div>
</section>



@endsection