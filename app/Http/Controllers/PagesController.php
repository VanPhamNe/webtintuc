<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Loaitin;
use App\Models\Tintuc;
use App\Models\Category;
use DB;
class PagesController extends Controller
{
    //
    public function pageloaitin($idloaitin)
    {
        $loaitin=Loaitin::find($idloaitin);
        $tintuc=Tintuc::where('idloaitin',$idloaitin)->paginate(4);
        $tinnoibat=Tintuc::inRandomOrder()->where('hot',1)->orderBy('ngaydang','DESC')->take(20)->get();
        return view('clients.pages.loaitin',['theloai'=>Category::all(),'tintuc'=>$tintuc,'loaitin'=>$loaitin,'tinnoibat'=>$tinnoibat]);
      
    }
    public function trangchu()
    {
        $tinnoibat=Tintuc::inRandomOrder()->where('hot',1)->orderBy('ngaydang','DESC')->take(20)->get();
        return view('clients.pages.index',['theloai'=>Category::all(),'tinnoibat'=>$tinnoibat]);
    }
    public function chitiettintuc($id)
    {
        
     
        $tintuc=Tintuc::findOrFail($id);
        $tinnoibat=Tintuc::inRandomOrder()->where('hot',1)->orderBy('ngaydang','DESC')->take(20)->get();
        DB::table('tintuc')->where('idtintuc', $id)->update(['luotxem' => $tintuc->luotxem+1]); 
        
  
        return view('clients.pages.tintuc',['theloai'=>Category::all(),'tintuc'=>$tintuc,'tinnoibat'=>$tinnoibat]);
    }
    public function find(Request $r)
    {
        $kw = $r->keyword;
        $tintuc = Tintuc::whereFullText('mota',"%$kw%")->orwhereFullText('noidung',"%$kw%")->orwhereFullText('tieude',"%$kw%")->paginate(5);
        $tinnoibat=Tintuc::inRandomOrder()->where('hot',1)->orderBy('ngaydang','DESC')->take(20)->get();

        return view('clients.pages.timkiem', ['tintuc' => $tintuc,'theloai'=>Category::all(),'tukhoa'=>$kw,'tinnoibat'=>$tinnoibat]);
        //return view('home.book3');
    }
  

}
