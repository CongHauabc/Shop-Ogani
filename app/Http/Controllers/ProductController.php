<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use Session;
use Illuminate\Support\Facades\Redirect;
session_start();
use App\Models\product;

class ProductController extends Controller
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
    public function add_product(){
        $this->AuthLogin();

        $cate_product = DB::table('tbl_category_product')->orderby('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand')->orderby('brand_id','desc')->get();
        return view('admin.add_product')->with('cate_product', $cate_product)->with('brand_product',$brand_product);
    
    }
    
    public function save_product( Request $request)
    {
        $data = array();
        $data['product_name'] = $request -> product_name;
        $data['product_quantity'] = $request -> product_quantity;
        $data['category_id'] = $request -> product_cate;
        $data['brand_id'] = $request -> product_brand;

        $data['product_desc'] = $request -> product_desc;
        $data['product_content'] = $request -> product_content;
        $data['product_price'] = $request -> product_price;
        $data['product_status'] = $request -> product_status;
        $data['created_at'] = $request -> product_time;
        $data['product_images'] = $request -> product_image;
        $get_img = $request->file('product_image');
        if($get_img){
            $get_name_img = $get_img->getClientOriginalName();
            $name_img = current(explode('.',$get_name_img));
            $new_img = $name_img.rand(0,99).'.'.$get_img->getClientOriginalExtension();
            $get_img->move('public/uploads',$new_img);
            $data['product_images'] = $new_img;
            DB::table('tbl_product')->insert($data);
            Session::put('message','Thêm Sản Phẩm Thành Công');
            return redirect::to('/add-product');
        }
        $data['product_images'] = '';
        DB::table('tbl_product')->insert($data);
        Session::put('message','Thêm Sản Phẩm Thành Công');
        return redirect::to('/add-product');

    }
    public function all_product(){
        $this->AuthLogin();

        $all_product = DB::table('tbl_product')
        ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
        ->join('tbl_brand','tbl_brand.brand_id','=','tbl_product.brand_id')->orderby('tbl_product.product_id','asc')->get();

        $manager_product = view('admin.all_product')->with('all_product',$all_product);
        return view('admin.dashboard')->with('admin.all_product',$manager_product);
    }
    public function delete_product(Request $request,$product_id){
        product::where('product_id',$product_id)->delete();
        Session::put('message', 'Xóa Sản Phẩm thành công');
        return Redirect::to('/all-product');
     }
    
    public function unactive_product($product_id){
        DB::table('tbl_product')->where('product_id',$product_id)->update(['product_status'=>1]);
        Session::put('message','Kích hoạt hiển thị thành công');
        return redirect::to('all-product');
    }
    public function active_product($product_id){
        DB::table('tbl_product')->where('product_id',$product_id)->update(['product_status'=>0]);
        Session::put('message','Kích hoạt ẩn  thành công');
        return redirect::to('all-product');
    }
    public function edit_product($product_id){
        $cate_product = DB::table('tbl_category_product')->orderby('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand')->orderby('brand_id','desc')->get();

        $edit_product =  DB::table('tbl_product')->where('product_id',$product_id)->get();
        $manager_product = view('admin.edit_product')-> with('edit_product',$edit_product)
        ->with('cate_product', $cate_product)->with('brand_product',$brand_product);

        return view('admin.dashboard')->with('admin.edit_product', $manager_product);
    
    }

    public function update_product(Request $request,$product_id){
        $data = array();
        $data['product_name'] = $request ->product_name;
        $data['product_quantity'] = $request -> product_quantity;

        $data['product_desc'] = $request ->product_desc;
        $data['product_content'] = $request ->product_content;
        $data['product_price'] = $request ->product_price;
        
        $data['category_id'] = $request ->product_cate;
        $data['brand_id'] = $request ->product_brand;
        
        $data['created_at'] = $request ->product_time;
        
        $get_img = $request->file('product_image');
        if($get_img){
            $get_name_img = $get_img->getClientOriginalName();
            $name_img = current(explode('.',$get_name_img));
            $new_img = $name_img.rand(0,99).'.'.$get_img->getClientOriginalExtension();
            $get_img->move('public/uploads',$new_img);
            $data['product_images'] = $new_img;
            DB::table('tbl_product')->where('product_id',$product_id)->update($data);
            Session::put('message','Cập Nhập Sản Phẩm Thành Công');
            return redirect::to('/all-product');
        }
       
        DB::table('tbl_product')->where('product_id',$product_id)->update($data);
        Session::put('message','Cập Nhập Sản Phẩm Thành Công');
        return redirect::to('/all-product');
    }
    
    public function deltails_product($product_id){
        $cate_product = DB::table('tbl_category_product')->where('category_status','1')->orderby('category_id','asc')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status','1')->orderby('brand_id','desc')->get();
       
        $detail_product = DB::table('tbl_product')
       ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
       ->join('tbl_brand','tbl_brand.brand_id','=','tbl_product.brand_id')
       ->where('tbl_product.product_id',$product_id)
       ->get();
       foreach( $detail_product as $key=>$value){
        $category_id = $value->category_id;
       }
       $related_product = DB::table('tbl_product')
       ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
       ->join('tbl_brand','tbl_brand.brand_id','=','tbl_product.brand_id')
       ->where('tbl_category_product.category_id',$category_id)
       ->whereNotin('tbl_product.product_id',[$product_id])
       ->get();
        return view('page.sanpham.show_details')->with('category',$cate_product)
        ->with('brand',$brand_product)->with('product_details',$detail_product)->with('relate',$related_product);
     }
}
