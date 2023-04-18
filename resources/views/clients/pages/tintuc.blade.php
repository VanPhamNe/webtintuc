@extends('clients/layouts/masteru')
@section('content')
@include('clients.layouts.navbar')
<section id="contentSection">
    <div class="row">
      <div class="col-lg-8 col-md-8 col-sm-8">
        <div class="left_content">
          <div class="single_page">
            <ol class="breadcrumb">
              <li><a href="../index.html">Home</a></li>
              <li><a href="#">{{$tintuc->loaitin->nhomtin->tennhomtin}}</a></li>
              <li class="active">{{$tintuc->loaitin->tenloaitin}}</li>
            </ol>
            <h1>{{$tintuc->tieude}}</h1>
            <div class="post_commentbox"> <a href="#"><i class="fa fa-user"></i>VanDepTrai</a> <span><i class="fa fa-calendar"></i>{{$tintuc->ngaydang}}</span> <a href="/loaitin/{{$tintuc->idloaitin}}"><i class="fa fa-tags"></i>{{$tintuc->loaitin->tenloaitin}}</a> </div>
            <div class="single_page_content"> <img class="img-center" src="{{asset('storage/public_img/'.$tintuc->img)}}" alt="">
              <p>{!!$tintuc->mota!!}</p>
              <blockquote> {!!$tintuc->noidung!!} </blockquote>
          
              
           
            </div>
        
          
          </div>

          <div >
              <h4>Viết bình luận ...<span class="glyphicon-pencil"></span></h4>

              <form role="form" action="/{{$tintuc->idtintuc}}" method="POST">
                @csrf
                <div class="form-group">
                    <textarea class="form-control" name="noidung" rows="3" required></textarea>

                </div>
                
                <button type="submit" class="btn btn-primary">Gửi</button>
                
              </form>
          </div>
          @foreach($tintuc->comment as $cm)
          
          <div >
              <a class="pull-left" href="#">
                <img class="media-object" src="http://placehold.it/40x40" alt="">
              </a>
              <div class="media-body">
                <h4 class="media-heading">{{$cm->user->ten}}
                  <small>{{$cm->ngaydang}}</small>
                </h4>
                {{$cm->noidung}}

              </div>
          </div>
          
          @endforeach


  
        </div>
      </div>
        <div>
        </div>
        <div>
        </div>
        </a> </nav>
        @include("clients.layouts.contentRight")
@stop