@extends('clients/layouts/masteru')
@section('content')
@include('clients.layouts.navbar')
<section id="contentSection">
  <div class="row">
    <div class="col-lg-8 col-md-4 col-sm-4">
      <div class="left_content">

        <div class="contact_area">

          <h2>Từ khóa: {{$tukhoa}}</h2>
          @foreach($tintuc as $tt)
          <div>
            <ul class="business_catgnav  wow fadeInDown" style="align-content: center;">
              <li>
                <figure class="bsbig_fig"> <a href="pages/single_page.html" class="featured_img"> <img alt="" src="{{asset('storage/public_img/'.$tt->img)}}" height="300px"> <span class="overlay"></span> </a>
                  <figcaption> <a href="pages/single_page.html">{{$tt->tieude}}</a> </figcaption>
                  <p>{!!$tt->mota!!}</p>
                  <a class="btn btn-info" href="/tintuc/{{$tt->idtintuc}}">Xem them <span class="glyphicon glyphicon-chevron-right"></span></a>
                </figure>
              </li>
            </ul>
          </div>
          @endforeach


        </div>
        <div style="text-align: right;">
        
          {{ $tintuc->appends(Request::all())->links() }}
        </div>
      </div>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-4">
      <aside class="right_content">
        <div class="single_sidebar">
          <h2><span>Popular Post</span></h2>
          <ul class="spost_nav">
          @foreach($tinnoibat as $item)
            <li>
              <div class="media wow fadeInDown"> <a href="single_page.html" class="media-left"> <img alt="" src="{{asset('storage/public_img/'.$item->img)}}"> </a>
                <div class="media-body"> <a href="/tintuc/{{$item->idtintuc}}" class="catg_title">{{$item->tieude}} </a> </div>
              </div>
            </li>
            @endforeach
         
          </ul>
        </div>
      </aside>
    </div>


  </div>



</section>


@stop