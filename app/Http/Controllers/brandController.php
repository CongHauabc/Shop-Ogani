<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use Session;
use Illuminate\Support\Facades\Redirect;
session_start();
class brandController extends Controller
{
    public function AuthLogin(){
        $admin_password = Session::get('admin_password');
        if($admin_password){
           
            return Redirect::to('dashboardAD');
        }
        else{
           
            return Redirect::to('loginAD')->send();


        }
     }
    public function add_brand_product(){
        $this->AuthLogin();
        return view('admin.add_brand');
    }
    
    public function save_brand_product( Request $request)
    {
        $data = array();
        $data['brand_name'] = $request -> brand_product_name;
        $data['brand_desc'] = $request -> brand_product_desc;
        $data['brand_status'] = $request -> brand_product_status;
        $data['created_at'] = $request -> brand_product_time;

        DB::table('tbl_brand')->insert($data);
        Session::put('message','Thêm Thương Hiệu Thành Công');
        return redirect::to('/add-brand-product');

    }
    public function all_brand_product(){
        $this->AuthLogin();
        $all_brand_product = DB::table('tbl_brand')->get();
        $manager_brand_product = view('admin.all_brand')->with('all_brand_product',$all_brand_product);
        return view('admin.dashboard')->with('admin.all_brand',$manager_brand_product);
    }

    
    public function unactive_brand_product($brand_product_id){
        
        DB::table('tbl_brand')->where('brand_id',$brand_product_id)->update(['brand_status'=>1]);
        Session::put('message','Kích hoạt hiển thị thành công');
        return redirect::to('all-brand-product');
    }
    public function active_brand_product($brand_product_id){
        DB::table('tbl_brand')->where('brand_id',$brand_product_id)->update(['brand_status'=>0]);
        Session::put('message','Kích hoạt ẩn  thành công');
        return redirect::to('all-brand-product');
    }
    public function edit_brand_product($brand_product_id){
        $edit_brand_product =  DB::table('tbl_brand')->where('brand_id',$brand_product_id)->get();
        $manager_brand_product = view('admin.edit_brand_product')-> with('edit_brand_product',$edit_brand_product);
        return view('admin.dashboard')->with('admin.edit_brand_product', $manager_brand_product);
    
    }
    public function update_brand_product(Request $request,$brand_product_id){
        $data = array();
        $data['brand_name'] = $request ->brand_product_name;
        $data['brand_desc'] = $request ->brand_product_desc;
        
        $data['created_at'] = $request ->brand_product_time;

       DB::table('tbl_brand')->where('brand_id',$brand_product_id)->update($data);
       Session::put('message', 'Cập Nhập danh mục thành công');
       return Redirect::to('/all-brand-product');
    }
    public function delete_brand_product($brand_product_id){
       DB::table('tbl_brand')->where('brand_id',$brand_product_id)->delete();
       Session::put('message', 'Xóa danh mục thành công');
       return Redirect::to('/all-brand-product');
    }

    // end admin
    public function show_brand_home ($brand_id){
        $cate_product = DB::table('tbl_category_product')->where('category_status','1')->orderby('category_id','asc')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status','1')->orderby('brand_id','desc')->get();
       
       $brand_by_id = DB::table('tbl_product')
        ->join('tbl_brand','tbl_product.brand_id','=','tbl_brand.brand_id')
        ->where('tbl_product.brand_id',$brand_id)->get();
        $brand_name = DB::table('tbl_brand')
        ->where('tbl_brand.brand_id',$brand_id)->limit(1)->get();
        
        return view('brand.show_brand')->with('category',$cate_product)
        ->with('brand',$brand_product)->with('brand_by_id',$brand_by_id)
        ->with('brand_name',$brand_name);
       
     }
}
