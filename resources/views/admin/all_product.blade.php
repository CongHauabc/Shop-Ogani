<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
@extends('admin.dashboard')
@section('admin_content')
<div class="content-wrapper">
    <div class="col-lg-12 stretch-card">
        <div class="card">
          <div class="card-body" style="">
            <h1 class="card-title" style="text-align: center; color: #c67bff;">Danh Mục Tất Cả Sản Phẩm</h1>
            <div class="row w3-res-tb">
                <div class="col-sm-5 " style="display: flex">
                  <select class="input-sm form-control w-sm inline v-middle" style="height: 77%">
                    <option value="0">Tên Danh Mục</option>
                    <option value="1">Hiển Thị</option>
                    <option value="2">Ngày Thêm</option>
                  </select>
                  <button class="btn btn-sm btn-default" style="border: 0;
                  outline: 1px solid #ebedf2;margin-bottom: 12px; margin-left: 4%">Apply</button>                
                </div>
                <div class="col-sm-4">
                </div>
                <div class="col-sm-3">
                  <div class="input-group">
                    <input type="text" class="input-sm form-control" placeholder="Search" style="height: 0px">
                    <span class="input-group-btn">
                      <button class="btn btn-sm btn-default" type="button" style="border: 0;
                      outline: 1px solid #ebedf2;margin-bottom: 12px; margin-left: 4%">Go!</button>
                    </span>
                  </div>
                </div>
                <?php
            $message = Session::get('message');
            if($message){
              echo '<span class="message">'.$message.'</span>';
              session::put('message',null);
            }
            ?>
              </div>
            </p>
            
            <table class="table table-bordered"  >
              <thead style="text-align: center;background-color: aquamarine;">
                <tr>
                  <th> ID  </th>
                  <th> Tên Sản Phẩm </th>
                  <th> Danh Mục </th>
                  <th> Thương Hiệu </th>
                  <th>Ảnh Sản Phẩm</th>
                  <th> Trạng Thái </th>
                  <th> Giá </th>
                  <th> Số Lượng </th>
                  <th> Chức Năng </th>
                </tr>
              </thead>
              <tbody style="text-align: center">
                @foreach ( $all_product as $key =>$pro)
                
                <tr class="table-info">
                  <td> {{$pro->product_id }} </td>
                  <td>{{$pro->product_name }} </td>
                  <td>{{$pro->category_name }} </td>
                  <td>{{$pro->brand_name }} </td>
                  <td><img src="public/uploads/{{$pro->product_images }}" style="border-radius:0px;width: 100%;height: 100%;" > </td>
                 

                  <td> 
                  <?php
                    if($pro->product_status==0 ){
                  ?>
                    <a href="{{URL::to('/unactive-product/'.$pro->product_id)}}"><img src="https://img.icons8.com/color/48/000000/closed-eye.png"/></a>
                  <?php  
                  }else{
                  ?>
                    <a href="{{URL::to('/active-product/'.$pro->product_id)}}"><img src="https://img.icons8.com/bubbles/48/000000/visible--v2.png"/></a>
                  <?php
                    }
                  ?>
                   <td>{{$pro->product_price }} </td>
                  </td>
                  <td> {{$pro->product_quantity}}</td>
                  <td style="text-align: center">
                    <a href="{{URL::to('/edit-product/'.$pro->product_id)}}" class="active" ui-toggle-class=""><img src="https://img.icons8.com/external-bearicons-gradient-bearicons/64/000000/external-setting-essential-collection-bearicons-gradient-bearicons.png" style="" id="Sua"/></a>
                    <a onclick="return confirm('Are you sure to delete ?')" href="{{URL::to('/delete-product/'.$pro->product_id)}}"><img src="https://img.icons8.com/plasticine/64/000000/filled-trash.png" style="height: 35px;width: 36px;"/></a>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
    </div>
</div>
<style>
#Sua{
  width: 28px;height: 28px;margin-right: 10px;
  
}
a{
  cursor: pointer;
}
#Sua:hover{

}
.table-info, .table-info > th, .table-info > td {
  background-color: #e1fffd;
}
.message{
  width: 100%;
    text-align: center;
    background-color: #6ca8ad;
    padding: 6px 0;
}

</style>





@endsection
