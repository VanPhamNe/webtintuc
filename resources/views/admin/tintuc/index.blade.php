@extends('admin/layouts/masterad')
@section('content')
<!-- Table Start -->
<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-md-12">
            <div class="bg-light rounded h-100 p-4">
                <h6 class="mb-4">Quản lý tin tuc</h6>

                @if(session()->has('mess'))
                <p class="alert alert-primary sm-4">
                    {{session('mess')}}
                </p>
                @endif
                <table class="table table-striped table-bordered table-hover" >
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Tiêu đề</th>
                            <th scope="col">Mô tả</th>
                            <th scope="col" >Nội dung</th>
                            <th scope="col">Ngày đăng</th>
                            <th scope="col">Nhóm tin</th>
                            <th scope="col">Loại tin</th>
                            <th scope="col">Lượt xem</th>
                            <th scope="col">HOT</th>
                            <th></th>

                        </tr>
                    </thead>
                    @foreach($tintuc as $item)
                    <tbody >
                        <tr >
                            <td>{{$item->idtintuc}}</td>
                            <td><div>{{$item->tieude}}</div>
                                <img width="100px" src="{{asset('storage/public_img/'.$item->img)}}" />
                            </td>
                            <td ><span>{{$item->mota}}</span></td>
                            <td >{{$item->noidung}}</td>
                            <td>{{$item->ngaydang}}</td>
                            <td>{{$item->loaitin->nhomtin->tennhomtin}}</td>
                            <td>{{$item->loaitin->tenloaitin}}</td>
                            <td>{{$item->luotxem}}</td>
                            <td>
                                @if($item->hot==0)
                                {{'Không'}}
                                @else
                                {{'Có'}}
                                @endif
                            </td>
                            <th>
                                <form action="/admin/tintuc/destroy/{{$item->idtintuc}}" method="POST">
                                    @csrf
                                    <input type="hidden" name="_method" value="delete">
                                    <input type="submit" value="xóa" class="btn btn-danger">
                                </form>
                            </th>
                            <th>
                                <a href="/admin/tintuc/edit/{{$item->idtintuc}}" class="btn btn-success"> sửa</a>
                            </th>
                            </td>
                        </tr>
                    </tbody>
                    @endforeach
                   
                    
                    
                </table>
                <div class="" style="float: right;"> {{$tintuc->links()}}</div>
            </div>
        </div>

    </div>
</div>
<!-- Table End -->
@stop