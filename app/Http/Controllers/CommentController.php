<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Tintuc;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    //
    function commentpost($id,Request $r)
    {
    
        $idtintuc=$id;
     
        $comment=new Comment();
        $comment->idtintuc=$idtintuc;
        $comment->idusers=session()->get('users')['idusers'];
        $comment->noidung=$r->noidung;
        $comment->ngaydang=date('y-m-d h:i:s');
        $comment->save();
    
        
        
       
        return redirect("/tintuc/$id");
    }
    public function destroy($idbinhluan,$idtintuc)
    {
        if(Comment::find($idbinhluan)){
            Comment::destroy($idbinhluan);
            session()->flash('mess', 'đã xóa');
        }
        return redirect("/admin/tintuc/edit/$idtintuc");
    }
}
