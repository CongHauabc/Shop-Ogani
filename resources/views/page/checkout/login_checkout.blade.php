



@extends('layout1')
@section('content')


<!-- Checkout Section Begin -->
<section class="checkout spad">
    <div class="container">
       
        
            
          
                
                <div class="row">
                   
                    <div class="col-lg-5 col-md-6">
                        <form action="{{URL::to('/login-customer')}}" method="post">
                            {{ csrf_field() }}
                        <h4>Đăng Nhập tài khoản</h4>
                        <br>
                                <div class="checkout__input ">
                                    <p>Tài khoản<span>*</span></p>
                                    <input type="text" name="email_account" placeholder="Tài Khoản" required>
                                </div>
                           
                            
                       
                        <div class="checkout__input">
                            <p>Mật Khẩu<span>*</span></p>
                            <input type="password" name="password_acccount" placeholder="Password" required>
                        </div>
                       
                       
                        <div class="checkout__input__checkbox">
                            <label for="acc">
                                nhớ mật khẩu
                                <input type="checkbox" id="acc">
                                <span class="checkmark"></span>
                            </label>
                        </div>
                        
                        <button type="submit" class="btn btn-default" style="border: 1px solid whitesmoke;background-color: #7fad39">Đăng Nhập</button>
                    </form>
                    </div>
                
                    
                    <div class="col-lg-1 col-md-1" style="padding-top: 17%">
                    <h2 style="border: 1px solid;
                    border-radius: 38px;
                    padding: 10px;
                    padding-left: 10px;
                    padding-bottom: 15px;
                    background-color: #7fad39; color: whitesmoke">OR</h2>
                    </div>
                    
                        <div class="col-lg-5 col-md-6">
                            <h4>Đăng ký tài khoản</h4>
                            <form action="{{URL::to('/add-customer')}}" id="dk" method="POST">
                                {{ csrf_field() }}
                            Họ Và Tên: <input type="text" name="customer_name" placeholder="Họ Và Tên" required><br>
                            Email: <input type="email" name="customer_email" placeholder="email" required><br>
                            Password: <input type="password" name="customer_password" required placeholder="Mật Khẩu"><br>
                            Điện Thoại: <input type="text" name="customer_phone" required placeholder="phone"><br>
                            <button type="submit" class="btn btn-default" style="border: 1px solid whitesmoke;background-color: #7fad39;margin-top: 30px">Đăng Ký</button>

                            </form>
                        </div>
                    
                </div>
           
        
    </div>
</section>



@endsection

