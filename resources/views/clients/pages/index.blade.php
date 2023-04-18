@extends('clients/layouts/masteru')
@section('content')
@include('clients.layouts.navbar')
<section id="contentSection">
    <div class="row">
        <div class="col-lg-8 col-md-8 col-sm-8">
            <div class="left_content">
                @foreach($theloai as $item)
                
                <div class="single_post_content">
                
                @if(count($item->loaitin)>0)

                    <h2><span>{{$item->tennhomtin}}</span></h2>
                    
                    <?php 
                    $data=$item->tintuc->sortByDesc('ngaydang')->take(5);
                    $tin1= $data->shift();
                    ?>
                    <div class="single_post_content_left">
                        <ul class="business_catgnav  wow fadeInDown" style="text-align: center;">
                        @if(isset($tin1))
                            <li>
                                <figure class="bsbig_fig"> <img alt="" src="{{asset('storage/public_img/'.$tin1['img'])}}"  width="330px" height="250px"> <span class="overlay"></span> </a>
                                    <figcaption> {!!$tin1['tieude']!!}</figcaption>
                                    <p>{!!$tin1['mota']!!}</p>
                                    <a class="btn btn-info" href="/tintuc/{{$tin1->idtintuc}}">Xem tin <span class="glyphicon glyphicon-chevron-right"></span></a>
                                </figure>
                            </li>
                        @endif
                        </ul>
                    </div>
                    
                 
                    <div class="single_post_content_right" style="text-align: center;">
                        @foreach($data->all() as $tintuc)
                        <ul class="spost_nav">
                            <li>
                                <div class="media wow fadeInDown">
                                    <img alt="" src="{{asset('storage/public_img/'.$tintuc['img'])}}" width="330px" height="100px"> 

                                    <div class="media-body"> <a href="/tintuc/{{$tintuc->idtintuc}}">{{$tintuc['tieude']}}</a> </div>
                                </div>

                            </li>
                      
                        </ul>
                        @endforeach
                    </div>
                @endif
                </div>
                
                @endforeach
             
            </div>
        </div>
        @include("clients.layouts.contentRight")
        @stop