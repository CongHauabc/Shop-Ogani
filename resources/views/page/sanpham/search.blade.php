@extends('layout')


@section('conten')
<section class="featured spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title">
                    <h2> Kết quả tìm kiếm</h2>
                </div>
               
            </div>
        </div>
        <div class="row featured__filter">
            @foreach ($search_product as $key => $pro)
            <div class="col-lg-3 col-md-4 col-sm-6 mix ">
                <div class="featured__item">
                    <div class="featured__item__pic set-bg" data-setbg="public/frontend/shop/img/featured/feature-1.jpg">
                        <ul class="featured__item__pic__hover">
                            <li><a href="#"><i class="fa fa-heart"></i></a></li>
                            <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                            <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                        </ul>
                    </div>
                    <div class="featured__item__text">
                        <h6><a href="{{URL::to('/chi-tiet-san-pham/'.$pro->product_id)}}">{{$pro->product_name}}</a></h6>
                        <h5>{{$pro->product_price}} VNĐ</h5>
                    </div>
                    <div class="featured__item__text">
                        <form>
                            {{ csrf_field() }}
                            <input type="hidden" value="{{$pro->product_id}}" class="cart_product_id_{{$pro->product_id}}">
                            <input type="hidden" value="{{$pro->product_name}}" class="cart_product_name_{{$pro->product_id}}">
                            <input type="hidden" value="{{$pro->product_images}}" class="cart_product_image_{{$pro->product_id}}">
                            <input type="hidden" value="{{number_format($pro->product_price,0,',','.')}}" class="cart_product_price_{{$pro->product_id}}">
                            <input type="hidden" value="1" class="cart_product_qty_{{$pro->product_id}}">

                        <button type="button" style=" color: white ;  background-color: #7fad39" class=" btn btn-default add-to-cart" name="add-to-cart" data-id_product="{{$pro->product_id}}">Thêm Giỏ Hàng</button>
                        </form>
                    </div>
                </div>
            </div>         
            @endforeach
            
           
        </div>
    </div>
</section>
@endsection
