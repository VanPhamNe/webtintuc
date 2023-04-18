<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Loaitin;
use App\Models\Tintuc;
use Illuminate\Http\Request;

class LoaitinController extends Controller
{
    //
    public function index()
    {
        return view('admin.loaitin.index',['loaitin'=>Loaitin::orderBy('idloaitin','ASC')->get()]);
    }
    public function create()
    {

        return view('admin.loaitin.createlt',['theloai'=>Category::all()]);
    }
    public function store(Request $r)
    {
        $r->validate(
            [
                'idloaitin' => 'unique:loaitin|max:50|min:2',
                'tenloaitin' => 'unique:loaitin|min:3',              

            ],
            [
                'idloaitin.unique' => 'Mã đã tồn tại!',
                'idloaitin.min' => 'Mã phải tối thiểu 2 ký tự!',
                'idloaitin.max' => 'Mã tối đa 50 ký tự!',
                'tenloaitin.min' => 'Tên loại tin tối thiểu 3 ký tự!',
                'tenloaitin.unique' => 'Tên loại tin bị trùng, vui lòng nhập tên khác!',
            ]
        );
     
        $u = Loaitin::create($r->all());
        session()->flash('mess','Đã thêm mã: '. $u->idloaitin);
        return redirect('admin/loaitin');
    }
    public function destroy($id)
    {
        if(count(Loaitin::find($id)->tintuc)==0){
            Loaitin::destroy($id);
            session()->flash('mess', 'đã xóa');
        }else{
            session()->flash('mess', 'không thể xóa vì tồn tại tin tức');
        }
        return redirect('/admin/loaitin');
    }
    public function edit($id)
    {
        $data = Loaitin::findOrFail($id);
        return view('admin.loaitin.editlt',['loaitin'=>$data,'theloai'=>Category::all()]);
    }
    public function update(Request $r)
    {
        $r->validate(
            [                
                'tenloaitin' =>'unique:loaitin|min:3',
            ],
            [
                'tenloaitin.unique' => 'Tên loại tin bị trùng, vui lòng nhập tên khác!',
                'tenloaitin.min'=> 'Tên tối thiểu phải có 3 ký tự',
            ]
        );
        $c = Loaitin::findOrFail($r->idloaitin);
        $c->tenloaitin = $r->tenloaitin;
        $c->idnhomtin = $r->idnhomtin;
        $c->save();
        session()->flash("mess","Sửa thành công");
        return redirect('/admin/loaitin');
    }
    // nguoi dung

}
