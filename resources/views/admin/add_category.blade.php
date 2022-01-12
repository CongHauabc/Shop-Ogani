@extends('admin.dashboard')
@section('admin_content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <h4 class="card-title">Thêm Danh Mục Sản Phẩm</h4>
                <?php
					$message = Session()->get('message');
					if($message){
						echo "<script type='text/javascript'>alert('$message');</script>";
						session()->put('message', null);
					}	
					?>
          
                <form class="forms-sample" action="{{URL::to('/save-category-product')}}" method="POST">
                  {{ csrf_field() }}
                  <div class="form-group">
                    <label for="exampleInputName1">Tên Danh Mục</label>
                    <input type="text" required class="form-control" id="exampleInputName1" placeholder="Tên Danh Mục" name="category_product_name">
                  </div>
                  <div class="form-group">
                    <label for="exampleTextarea1">Mô Tả Danh Mục</label>
                    <textarea class="form-control" required id="exampleTextarea1" rows="4" name="category_product_desc" placeholder="Mô Tả Danh Mục"></textarea>
                  </div>
                  <div class="form-group">
                    <label for="exampleSelectGender">Hiện Thị</label>
                    <select class="form-control" id="exampleSelectGender" name="category_product_status">
                      <option value="0">Ẩn</option>
                      <option value="1">Hiển Thị</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputName1">Ngày Nhập</label>
                    <input type="date" class="form-control" id="exampleInputName1" placeholder="Tên Danh Mục" name="category_product_time">
                  </div>
                  
                  
                  <button type="submit" class="btn btn-gradient-primary mr-2" name="add_category_product">Thêm Danh Mục Sản Phẩm</button>
                  <button class="btn btn-light">Cancel</button>
                </form>
              </div>
                </div>
        </div>
    </div>
</div>



@endsection
