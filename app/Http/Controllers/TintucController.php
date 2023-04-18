<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tintuc;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;
class TintucController extends Controller
{
    //
    public function index()
    {
        return view('admin.tintuc.index',['tintuc'=>Tintuc::orderBy('idtintuc','DESC')->paginate(6)]);
    }
    public function create()
    {
        return view('admin.tintuc.creatett',['theloai'=>Category::all()]);
    }
    public function store(Request $r)
    {
        $r->validate(
            [
                'idtintuc' => 'unique:tintuc',
                'tieude' => 'min:10|max:1000',
                'img'=>'mimes:jpeg,jpg,png|max:10000',
                'mota'=>'required|min:10',
                'noidung'=>'required|min:10',
                'ngaydang'=>'before:now',
                


            ],
            [
                'idtintuc.unique' => 'Mã đã tồn tại',
                
                'mota.required' => 'Chua nhap Mô tả',
                'noidung.required' => 'Chua nhap Nội dung ',
            
                'tieude.min' => 'Tiêu đề tối thiểu 10 ký tự',
                'tieude.max' => 'Tiêu đề qua dai',
                'img.mimes'=>'Hình không đúng định dạng',
                'img.max'=>'Dung lượng hình ảnh quá lớn',
                'mota.min'=>'Mô tả tối thiểu 10 ký tự',
                'noidung.min'=>'Nội dung tối thiểu 10 ký tự',
                'ngaydang.before'=>'Không được chọn ngày tương lai'
            ]
        );
     
     
        $data = $r->all();
        ///response()->json($r->all());
        $img = $data['idtintuc'] . '-' . $r->img->getClientOriginalName();
        $data['img'] = $img;
        $r->img->storeAs('public/public_img', $img);
        $u = Tintuc::create($data);
        return redirect('admin/tintuc');
    }
    public function destroy($id)
    {
        //Storage::disk('local')->delete("public/product/$data->Image");
        $data = Tintuc::find($id);
        //dd($data->img);
        if (Count(Tintuc::find($id)->comment) == 0) {
            Storage::disk('local')->delete("public/public_img/$data->img");
            Tintuc::destroy($id);
            session()->flash('mess', 'đã xóa');
        } else {
            session()->flash('mess', 'không thể xóa vì tồn tại bình luận');
        }
        return redirect('/admin/tintuc');
    }
    public function edit($id)
    {
        $data = Tintuc::findOrFail($id);
        return View('admin.tintuc.edittt', ['data' => $data,'theloai'=>Category::all()]);
    }
    
    public function update(Request $request)
    {
        //
        $request->validate(
            [
                'tieude' => 'min:10|max:1000',
                'img'=>'mimes:jpeg,jpg,png|max:10000',
                'mota'=>'required|min:10',
                'noidung'=>'required|min:10',
                'ngaydang'=>'before:now',
                
            ],
            [
                'mota.required' => 'Chua nhap Mô tả',
                'noidung.required' => 'Chua nhap Nội dung ',
       
                'tieude.min' => 'Tiêu đề tối thiểu 10 ký tự',
                'tieude.max' => 'Tiêu đề qua dai',
                'img.mimes'=>'Hình không đúng định dạng',
                'img.max'=>'Dung lượng hình ảnh quá lớn',
                'mota.min'=>'Mô tả tối thiểu 10 ký tự',
                'noidung.min'=>'Nội dung tối thiểu 10 ký tự',
                'ngaydang.before'=>'Không được chọn ngày tương lai'
            ]
        );
        $c = Tintuc::findorfail($request->idtintuc); //tim cate can sua
        $temp = $c->img;
        //dd($data->Image);
        if ($request->img != null) {
            Storage::disk('local')->delete("public/public_img/$temp");
            $img = $c['idtintuc'] . '-' . $request->img->getClientOriginalName();
            $c['img'] = $img;
            $request->img->storeAs('public/public_img', $img);
        }
        $c->tieude = $request->tieude; //thay doi cat name
        $c->mota = $request->mota;
        $c->noidung = $request->noidung;
        $c->ngaydang = $request->ngaydang;
        $c->idloaitin = $request->idloaitin;
        $c->luotxem = $request->luotxem;
        $c->hot = $request->hot;
        $c->save();
        session()->flash("mess","Sua thanh cong");
        //dd($c);
        return redirect('/admin/tintuc');
    }

}
