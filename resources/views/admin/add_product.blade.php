@extends('admin.dashboard')
@section('admin_content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <h4 class="card-title">Thêm Sản Phẩm</h4>
                <?php
					$message = Session()->get('message');
					if($message){
						echo "<script type='text/javascript'>alert('$message');</script>";
						session()->put('message', null);
					}	
					?>
            
                <form class="forms-sample" action="{{URL::to('/save-product')}}" method="POST" enctype="multipart/form-data">
                  {{ csrf_field() }}
                  <div class="form-group">
                    <label for="exampleInputName1">Tên Sản Phẩm</label>
                    <input type="text" class="form-control" id="exampleInputName1" placeholder="Tên Danh Mục" 
                    name="product_name" required>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputName1">Số Lượng Sản Phẩm</label>
                    <input type="text" class="form-control" id="exampleInputName1" placeholder="Số lượng" 
                    name="product_quantity" required>
                  </div>
                  
                  <div class="form-group">
                    <label for="exampleSelectGender">Danh Mục Sản Phẩm </label>
                    <select class="form-control" id="exampleSelectGender" name="product_cate">
                      @foreach ($cate_product as $key => $cate)
                      <option value="{{$cate->category_id}}">{{$cate->category_name}}</option>
                      @endforeach
                        
                     
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="exampleSelectGender">Thương Hiệu Sản Phẩm</label>
                    <select class="form-control" id="exampleSelectGender" name="product_brand">
                        @foreach ($brand_product as $key => $brand)
                        <option value="{{$brand->brand_id}}">{{$brand->brand_name}}</option>
                        @endforeach
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="exampleTextarea1">Mô Tả Sản Phẩm</label>
                    <textarea class="form-control" id="exampleTextarea1" rows="4" name="product_desc"
                     placeholder="Mô Tả Danh Mục" required></textarea>
                  </div>
                  <div class="form-group">
                    <label for="exampleTextarea1">Nội Dung Sản Phẩm</label>
                    <textarea class="form-control" id="exampleTextarea1" rows="4" name="product_content"
                     placeholder="Nội Dung Sản Phẩm" required></textarea>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputName1">Ảnh Sản Phẩm</label>
                    <input type="file" class="form-control" id="exampleInputName1" name="product_image" placeholder="Tên Danh Mục" 
                    name="product_name" required>
                  </div>
                  <div class="form-group">
                    <label for="exampleSelectGender">Trạng Thái</label>
                    <select class="form-control" id="exampleSelectGender" name="product_status">
                      <option value="0">Ẩn</option>
                      <option value="1">Hiển Thị</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputName1">Giá Sản Phẩm</label>
                    <input  type="text" class="form-control" id="exampleInputName1" placeholder="Giá Sản Phẩm" 
                    name="product_price" required>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputName1">Ngày Nhập</label>
                    <input type="date" class="form-control" id="exampleInputName1" placeholder="Ngày" name="product_time">
                  </div>
                  
                  
                  <button type="submit" class="btn btn-gradient-primary mr-2" name="add_product">Thêm Sản Phẩm</button>
                  <button class="btn btn-light">Cancel</button>
                </form>
              </div>
                </div>
        </div>
    </div>
</div>



@endsection
