

@extends('layout1')
@section('content')

<!-- Breadcrumb Section End -->

<!-- Product Details Section Begin -->
<section class="product-details spad">
    <h2 style="text-align: center">Thông tin chi tiết sản phẩm</h2>
    <br><br>
    @foreach ( $product_details as $key => $value )
        
    
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6">
                <div class="product__details__pic">
                    <div class="product__details__pic__item">
                        <img style="max-height: 500px" class="product__details__pic__item--large"
                            src="{{URL::to('public/uploads/'.$value->product_images)}}" alt="">
                    </div>
                   
                </div>
            </div>
            <div class="col-lg-6 col-md-6">
                <div class="product__details__text">
                    <h3 >{{$value->product_name}}</h3>
                    <div class="product__details__rating">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star-half-o"></i>
                        <span>(18 reviews)</span>
                    </div>
                    
                    @php
                        $str = "{$value->product_content}";
                        
                        
                        echo stripslashes($str);
                    @endphp
                    
                    <form>
                        
                        {{ csrf_field() }}
                        <input type="hidden" value="{{$value->product_id}}" class="cart_product_id_{{$value->product_id}}">
                        <input type="hidden" value="{{$value->product_name}}" class="cart_product_name_{{$value->product_id}}">
                        <input type="hidden" value="{{$value->product_images}}" class="cart_product_image_{{$value->product_id}}">
                        <input type="hidden" value="{{$value->product_price}}" class="cart_product_price_{{$value->product_id}}">
                        <div class="product__details__price">{{$value->product_price}} VNĐ</div>
                        <input type="hidden" value="1" class="cart_product_qty_{{$value->product_id}}">
                        <div class="product__details__quantity">
                            
                        <div class="quantity">
                            <div class="pro-qty">
                                <input type="text" name="qty" value="1">
                            </div>
                        </div>
                        <input type="hidden" name="product_id_hidden" value="{{$value->product_id}}">
                        </div>
                        <div class="product__details__quantity">
                        <button type="button" style=" color: white ;  background-color: #7fad39" class=" btn btn-default add-to-cart" name="add-to-cart" data-id_product="{{$value->product_id}}">Thêm Giỏ Hàng</button>
                        </div>
                        <a href="#" class="heart-icon"><span class="icon_heart_alt"></span></a>
                    </form>
                    <ul>
                        <li><b>Tình Trạng</b> <span>Còn hàng</span></li>
                        <li><b>Shipping</b> <span>01 day shipping. <samp>Free pickup today</samp></span></li>
                        <li><b>Danh Mục</b> <span>{{$value->category_name}}</span></li>
                        <li><b>Thương Hiệu</b>
                            <span>{{$value->brand_name}}</span>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="product__details__tab">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#tabs-1" role="tab"
                                aria-selected="true">Mô Tả Sản Phẩm</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#tabs-2" role="tab"
                                aria-selected="false">Nội dung sản phẩm</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#tabs-3" role="tab"
                                aria-selected="false">Đánh giá <span>(1)</span></a>
                        </li>
                    </ul>
                    @foreach ( $product_details as $key => $value )
                    <div class="tab-content">
                        <div class="tab-pane active" id="tabs-1" role="tabpanel">
                            <div class="product__details__tab__desc">
                               
                                
                                <h6>{{$value->product_name}}</h6>
                            <div style"display: -webkit-box;
    width: 300px;
    line-height: 25px;
    overflow: hidden;
    text-overflow: ellipsis;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    background:blue;"> @php
                                $str = "{$value->product_desc}";
                                
                                
                                echo stripslashes($str);
                                @endphp</div>
                               

                            </div>
                        </div>
                        <div class="tab-pane" id="tabs-2" role="tabpanel">
                            <div class="product__details__tab__desc">
                                <h6>{{$value->product_name}}</h6>
                                <p>{!!$value->product_content!!}</p>
                                 </div>
                        </div>
                        <div class="tab-pane" id="tabs-3" role="tabpanel">
                            <div class="product__details__tab__desc">
                                <h6>{{$value->product_name}}</h6>
                                <p>{{$value->product_content}}</p>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    @endforeach
</section>
<!-- Product Details Section End -->

<!-- Related Product Section Begin -->
<section class="related-product">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title related__product__title">
                    <h2> Sản Phẩm Gợi Ý</h2>
                </div>
            </div>
        </div>
        <div class="row">
            @foreach ( $relate as $key=>$lienquan )
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="product__item">
                    <div class="product__item__pic set-bg" data-setbg="{{URL::to('public/uploads/'.$lienquan->product_images)}}">
                        <ul class="product__item__pic__hover">
                            <li><a href="#"><i class="fa fa-heart"></i></a></li>
                            <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                            <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                        </ul>
                    </div>
                    <div class="product__item__text">
                        <h6><a href="{{URL::to('/chi-tiet-san-pham/'.$lienquan->product_id)}}">{{$lienquan->product_name}}</a></h6>
                        <h5>{{number_format($lienquan->product_price).' '.'VNĐ'}}</h5>
                    </div>
                </div>
            </div>
            @endforeach
           
           
        </div>
    </div>
</section>
@endsection