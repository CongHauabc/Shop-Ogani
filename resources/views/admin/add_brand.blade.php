@extends('admin.dashboard')
@section('admin_content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <h4 class="card-title">Thêm Thương Hiệu Sản Phẩm</h4>
                <?php
					$message = Session()->get('message');
					if($message){
						echo "<script type='text/javascript'>alert('$message');</script>";
						session()->put('message', null);
					}	
					?>
          
                <form class="forms-sample" action="{{URL::to('/save-brand-product')}}" method="POST">
                  {{ csrf_field() }}
                  <div class="form-group">
                    <label for="exampleInputName1">Tên Thương Hiệu</label>
                    <input type="text" class="form-control" required id="exampleInputName1" placeholder="Tên Thương Hiệu" name="brand_product_name">
                  </div>
                  <div class="form-group">
                    <label for="exampleTextarea1">Mô Tả Thương Hiệu</label>
                    <textarea class="form-control" id="exampleTextarea1" required rows="4" name="brand_product_desc" placeholder="Mô Tả Thương Hiệu"></textarea>
                  </div>
                  <div class="form-group">
                    <label for="exampleSelectGender">Trạng Thái</label>
                    <select class="form-control" id="exampleSelectGender" name="brand_product_status">
                      <option value="0">Ẩn</option>
                      <option value="1">Hiển Thị</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputName1">Ngày Nhập</label>
                    <input type="date" class="form-control" id="exampleInputName1" placeholder="Tên Danh Mục" name="brand_product_time">
                  </div>
                  
                  
                  <button type="submit" class="btn btn-gradient-primary mr-2" name="add_brand_product">Thêm Thương Hiệu Sản Phẩm</button>
                  <button class="btn btn-light">Cancel</button>
                </form>
              </div>
                </div>
        </div>
    </div>
</div>



@endsection
