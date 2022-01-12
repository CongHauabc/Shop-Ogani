<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use Session;
use Illuminate\Support\Facades\Redirect;
session_start();
class AdminController extends Controller
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
     public function dashboardtk(Request $request){
        return view('admin.dashboardtk');
     }

    public function index(){
        return view('admin.loginAD');
    }
    public function dashboard(){
        $this->AuthLogin();
        return view('admin.dashboard');
    }
    public function dashboardAD(Request $request){
        $admin_email = $request-> admin_email;
        $admin_password = md5($request->admin_password);
        $result = DB::table('tbl_admin') -> where('admin_email',$admin_email) -> where('admin_password',$admin_password) -> first();
       
        if($result){
            Session::put('admin_name', $request->admin_name);
            Session::put('admin_password', $request->admin_password);
            return Redirect::to('/dashboardtk');
        }
        else{
            Session::put('message','Email hoặc mật khẩu không hợp lệ!' );
            return redirect::to('/loginAD');

        }
    }
    public function logout(){
        Session::put('admin_name',null);
        Session::put('admin_password', null);
        return redirect::to('/loginAD');
    }
}
