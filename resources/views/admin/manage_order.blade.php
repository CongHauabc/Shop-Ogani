<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
@extends('admin.dashboard')
@section('admin_content')
<div class="content-wrapper">
    <div class="col-lg-12 stretch-card">
        <div class="card">
          <div class="card-body">
            <h1 class="card-title" style="text-align: center; color: #c67bff;">Liệt Kê Đơn Hàng</h1>
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
            
            <table class="table table-bordered">
              <thead style="text-align: center;background-color: aquamarine;">
                <tr>
                  <th> ID Đơn Hàng </th>
                  
                  <th> Tình Trạng </th>
                  <th> thời gian mua </th>
                  <th> Chức Năng</th>
                </tr>
              </thead>
              <tbody style="text-align: center">
                @foreach ($order as $key => $ord)
                
                <tr class="table-info">
                  <td> {{$ord->order_code  }} </td>
                  <td>@if($ord->order_status ==1)
                  
                      Đợi Xử Lý
                    @else
                      Đã xử lý
                    @endif
                  
                  </td>
                  <td> {{$ord->created_at  }} </td>
                  
                  <td style="text-align: center">
                    <a href="{{URL::to('/view-order/'.$ord->order_code)}}" class="active" ui-toggle-class=""><img src="https://img.icons8.com/external-bearicons-gradient-bearicons/64/000000/external-setting-essential-collection-bearicons-gradient-bearicons.png" style="" id="Sua"/></a>
                    <a onclick="return confirm('Are you sure to delete ?')" href="{{URL::to('/delete-order/'.$ord->order_code)}}"><img src="https://img.icons8.com/plasticine/64/000000/filled-trash.png" style="height: 35px;width: 36px;"/></a>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
    </div>
</div>








@endsection
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