@extends('admin.dashboard')
@section('admin_content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <h4 class="card-title">Cập Nhập Sản Phẩm</h4>
                <?php
					$message = Session()->get('message');
					if($message){
						echo "<script type='text/javascript'>alert('$message');</script>";
						session()->put('message', null);
					}	
					?>
                
                    
                @foreach ($edit_product as $key => $pro )
                    
               
                <form class="forms-sample" action="{{URL::to('/update-product/'.$pro->product_id)}}" method="POST" enctype="multipart/form-data">
                  {{ csrf_field() }}
                  <div class="form-group">
                    <label for="exampleInputName1">Tên Sản Phẩm</label>
                    <input type="text" class="form-control" id="exampleInputName1" value="{{$pro->product_name}}"
                    name="product_name">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputName1">SL Sản Phẩm</label>
                    <input type="text" class="form-control" id="exampleInputName1" value="{{$pro->product_quantity}}"
                    name="product_quantity">
                  </div>
                  <div class="form-group">
                    <label for="exampleSelectGender">Danh Mục Sản Phẩm </label>
                    <select class="form-control" id="exampleSelectGender" name="product_cate">
                      @foreach ($cate_product as $key => $cate)
                      @if($cate->category_id == $pro->category_id)
                      <option selected value="{{$cate->category_id}}">{{$cate->category_name}}</option>
                      @else
                      <option  value="{{$cate->category_id}}">{{$cate->category_name}}</option>
                    @endif
                      @endforeach
                        
                     
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="exampleSelectGender">Thương Hiệu Sản Phẩm</label>
                    <select class="form-control" id="exampleSelectGender" name="product_brand">
                        @foreach ($brand_product as $key => $brand)
                        @if($brand->brand_id == $brand->brand_id)
                        <option selected value="{{$brand->brand_id}}">{{$brand->brand_name}}</option>
                        @else
                        <option  value="{{$brand->brand_id}}">{{$brand->brand_name}}</option>
                        @endif
                        @endforeach
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="exampleTextarea1">Mô Tả Sản Phẩm</label>
                    <textarea class="form-control" id="exampleTextarea1" rows="4" name="product_desc"
                    >{{$pro->product_desc}}</textarea>
                  </div>
                  <div class="form-group">
                    <label for="exampleTextarea1">Nội Dung Sản Phẩm</label>
                    <textarea class="form-control" id="exampleTextarea1" rows="4" name="product_content"
                   >{{$pro->product_content}}</textarea>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputName1">Ảnh Sản Phẩm</label>
                    <input type="file" class="form-control" id="exampleInputName1" name="product_image" >
                    <img src="{{URL::to('public/uploads/'.$pro->product_images)}}" style="width: 30%"/>
                  </div>
                  
                  <div class="form-group">
                    <label for="exampleInputName1">Giá Sản Phẩm</label>
                    <input type="text" class="form-control" id="exampleInputName1" value="{{$pro->product_price}}"
                    name="product_price">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputName1">Ngày Nhập</label>
                    <input type="date" class="form-control" id="exampleInputName1" value="{{$pro->created_at}}" name="product_time">
                  </div>
                  
                  
                  <button type="submit" class="btn btn-gradient-primary mr-2" name="add_product">Cập nhập Sản Phẩm</button>
                  <button class="btn btn-light">Cancel</button>
                </form>
                @endforeach
              </div>
                </div>
        </div>
    </div>
</div>



@endsection
