<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Users;
use App\Models\Category;
use Hash;
class LoginController extends Controller
{
    //trang admin
    public function login(Request $r)
    {
        $u = Admin::where('username', $r->username)->first();
        if ($u) {
            if (Hash::check($r->password, $u->password)) {
                session([
                    'admin' => [
                        'idadmin' => $u->idadmin,
                        'username' => $u->username,
                        'password' => $u->password,
                    ]
                ]);
                return redirect('/admin');
            } else {
                session()->flash('error', 'Nhập sai thông tin! ');
                return redirect('/admin/login');
            }
        } else {
            session()->flash('error', 'Tài khoản không tồn tại');
            return redirect('/admin/login');
        }
    }
    function logout()
    {
        session()->forget(['admin']);
        return redirect('/admin/login');
    }

    // ng dung
    function loginuser()
    {
        return view('clients.pages.loginu',['theloai'=>Category::all()]);
    }
    function loginuserpost(Request $r)
    {
        $u = Users::where('email', $r->u)->first();
        //dd($u);
        if ($u) {
            if (Hash::check($r->p, $u->password)) {
                //dd($u);
                session([
                    'users' => [
                        'idusers' => $u->idusers,
                        'email' => $u->email,
                        'ten' => $u->ten,
                        
                    ]
                ]);
                //dd( $u->idusers);
                return redirect('/');
            } else {
                session()->flash('error', 'Nhập sai thông tin! ');
                return redirect('/loginuser');
            }
        } else {
            session()->flash('error', 'Tài khoản không tồn tại');
            return redirect('/loginuser');
        }
    }
    function logoutuser()
    {
        
        session()->forget(['users']);
        return redirect('/');
    }
    //dang ky
    function register()
    {
        return view('clients.pages.register',['theloai'=>Category::all()]);
    }
    function registerpost(Request $r)
    {
      
        $r->validate(
            [
                
                'ten' => 'min:3',
                'email'=>'unique:users|min:3|max:45|email',
                'password' => 'max:50|min:2',
                'password2'=>'same:password',
            ],
            [
                
                'ten.min' => 'Họ tên phải tối thiểu 3 ký tự',
                
                'email.unique'=>'email đã tồn tại',
                'email.min'=>'Email phai tối thiểu 3 ký tự',
                'email.max'=>'Email không vượt quá 45 ký tự',
                'password.min' => 'Mat khau toi thieu 2 ky tu',
                'password.max' => 'Mat khau qua 50 ky tu',
         
                'password2.same'=>'Không giống password',


            ]
        );
     
        $u = Users::create([
            'idusers'=>$r->idusers,
            'ten'=>$r->ten,
            'email'=>$r->email,
            'password'=>hash::make($r->password),
            'password2'=>hash::make($r->password),

        ]);
        
        session()->flash('mess', 'Success You Can Sign In Now' );
        return redirect('/registeruser');
    }
}
