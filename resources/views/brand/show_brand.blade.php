

@extends('layout1')
@section('content')

<!-- Breadcrumb Section End -->

<!-- Product Section Begin -->
<section class="product spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-5">
                <div class="sidebar">
                    <div class="sidebar__item">
                        <h4>Danh Mục</h4>
                        <ul>
                            @foreach ($category as $key=>$cate )
                            <li><a href="{{URL::to('/Danh-muc-san-pham/'.$cate->category_id  )}}"> {{$cate ->category_name}}</a></li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="sidebar__item">
                        <h4>Price</h4>
                        <div class="price-range-wrap">
                            <div class="price-range ui-slider ui-corner-all ui-slider-horizontal ui-widget ui-widget-content"
                                data-min="10" data-max="540">
                                <div class="ui-slider-range ui-corner-all ui-widget-header"></div>
                                <span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default"></span>
                                <span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default"></span>
                            </div>
                            <div class="range-slider">
                                <div class="price-input">
                                    <input type="text" id="minamount">
                                    <input type="text" id="maxamount">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="sidebar__item sidebar__item__color--option">
                        <h4>Colors</h4>
                        <div class="sidebar__item__color sidebar__item__color--white">
                            <label for="white">
                                White
                                <input type="radio" id="white">
                            </label>
                        </div>
                        <div class="sidebar__item__color sidebar__item__color--gray">
                            <label for="gray">
                                Gray
                                <input type="radio" id="gray">
                            </label>
                        </div>
                        <div class="sidebar__item__color sidebar__item__color--red">
                            <label for="red">
                                Red
                                <input type="radio" id="red">
                            </label>
                        </div>
                        <div class="sidebar__item__color sidebar__item__color--black">
                            <label for="black">
                                Black
                                <input type="radio" id="black">
                            </label>
                        </div>
                        <div class="sidebar__item__color sidebar__item__color--blue">
                            <label for="blue">
                                Blue
                                <input type="radio" id="blue">
                            </label>
                        </div>
                        <div class="sidebar__item__color sidebar__item__color--green">
                            <label for="green">
                                Green
                                <input type="radio" id="green">
                            </label>
                        </div>
                    </div>
                    <div class="sidebar__item">
                        <h4>Popular Size</h4>
                        <div class="sidebar__item__size">
                            <label for="large">
                                Large
                                <input type="radio" id="large">
                            </label>
                        </div>
                        <div class="sidebar__item__size">
                            <label for="medium">
                                Medium
                                <input type="radio" id="medium">
                            </label>
                        </div>
                        <div class="sidebar__item__size">
                            <label for="small">
                                Small
                                <input type="radio" id="small">
                            </label>
                        </div>
                        <div class="sidebar__item__size">
                            <label for="tiny">
                                Tiny
                                <input type="radio" id="tiny">
                            </label>
                        </div>
                    </div>
                    
                </div>
            </div>
            <div class="col-lg-9 col-md-7">
                
                <div class="filter__item">
                    <div class="row">
                        <div class="col-lg-4 col-md-5">
                            <div class="filter__sort">
                                <span>Sort By</span>
                                <select>
                                    <option value="0">Default</option>
                                    <option value="0">Default</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4">
                            <div class="filter__found">
                                <h6><span>16</span> Products found</h6>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-3">
                            <div class="filter__option">
                                <span class="icon_grid-2x2"></span>
                                <span class="icon_ul"></span>
                            </div>
                        </div>
                    </div>
                </div>
                @foreach ( $brand_name as $key => $name_brand )
                <h2 style="text-align: center">{{$name_brand->brand_name}}</h2>
                @endforeach
                <br>
                <div class="row">
                   
                    @foreach ($brand_by_id as $key => $pro)
                    
                    <div class="col-lg-4 col-md-6 col-sm-6">
                        
                        <div class="product__item" style="background-color: rgb(248 248 248)">
                            
                            <div class="product__item__pic set-bg" data-setbg="{{URL::to('public/uploads/'.$pro->product_images)}}">
                               
                                <ul class="product__item__pic__hover">
                                    <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                    <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                                    
                                </ul>
                            </div>
                            </a>
                            <div class="product__item__text">
                                <h6><a href="{{URL::to('/chi-tiet-san-pham/'.$pro->product_id)}}">{{$pro->product_name}}</a></h6>
                            <h5>{{number_format($pro->product_price,0,',','.')}} VNĐ</h5>
                            </div>
                            <div class="featured__item__text">
                                <form>
                                    {{ csrf_field() }}
                                    <input type="hidden" value="{{$pro->product_id}}" class="cart_product_id_{{$pro->product_id}}">
                                    <input type="hidden" value="{{$pro->product_name}}" class="cart_product_name_{{$pro->product_id}}">
                                    <input type="hidden" value="{{$pro->product_images}}" class="cart_product_image_{{$pro->product_id}}">
                                    <input type="hidden" value="{{$pro->product_price}}" class="cart_product_price_{{$pro->product_id}}">
                                    <input type="hidden" value="1" class="cart_product_qty_{{$pro->product_id}}">
        
                                <button type="button" style=" color: white ;  background-color: #7fad39" class=" btn btn-default add-to-cart" name="add-to-cart" data-id_product="{{$pro->product_id}}">Thêm Giỏ Hàng</button>
                                </form>
                            </div>
                        </div>
                    
                    </div>
                
                   @endforeach
                </div>
                <div class="product__pagination">
                    <a href="#">1</a>
                    <a href="#">2</a>
                    <a href="#">3</a>
                    <a href="#"><i class="fa fa-long-arrow-right"></i></a>
                </div>
                <div class="product__discount" style="padding-top: 37px">
                    <div class="section-title product__discount__title">
                        <h2>Danh mục ưa thích</h2>
                    </div>
                    <div class="row">
                        <div class="categories__slider owl-carousel">
                            @foreach ($category as $key=>$cate )
                            <div class="col-lg-3">
                                <div class="categories__item set-bg" data-setbg="{{URL::to('public/uploads/'.$cate->category_image)}}">
                                    <h5><a href="{{URL::to('/Danh-muc-san-pham/'.$cate->category_id  )}}">{{$cate ->category_name}}</a></h5>
                                </div>
                            </div>
                            @endforeach
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection