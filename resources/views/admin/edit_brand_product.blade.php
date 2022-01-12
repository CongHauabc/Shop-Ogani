@extends('admin.dashboard')
@section('admin_content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <h4 class="card-title">Cập Nhập Danh Mục Sản Phẩm</h4>
                <?php
					$message = Session()->get('message');
					if($message){
						echo "<script type='text/javascript'>alert('$message');</script>";
						session()->put('message', null);
					}	
					?>
           @foreach ( $edit_brand_product as $key => $edit_value )
                <form class="forms-sample" action="{{URL::to('/update-brand-product/'.$edit_value->brand_id)}}" method="POST">
                  {{ csrf_field() }}
                 
                  <div class="form-group">
                    <label for="exampleInputName1">Tên Thương Hiệu</label>
                    <input type="text" value="{{$edit_value->brand_name}}" class="form-control" id="exampleInputName1" placeholder="Tên Thương Hiệu" name="brand_product_name">
                  </div>
                  <div class="form-group">
                    <label for="exampleTextarea1">Mô Tả Danh Mục</label>
                    <textarea class="form-control"  id="exampleTextarea1" rows="4" name="brand_product_desc" >{{$edit_value->brand_desc}}"</textarea>
                  </div>
                 
                  <div class="form-group">
                    <label for="exampleInputName1">Ngày Nhập</label>
                    <input type="{{$edit_value->created_at}}" class="form-control" value="{{$edit_value->created_at}}" id="exampleInputName1"  name="category_product_time">
                  </div>
                  
                  
                  <button type="submit" class="btn btn-gradient-primary mr-2" name="add_brand_product">Cập Nhật  </button>
                  <button class="btn btn-light">Cancel</button>
                </form>
                @endforeach
              </div>
                </div>
        </div>
    </div>
</div>



@endsection
