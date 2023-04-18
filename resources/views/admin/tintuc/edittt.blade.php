@extends('admin/layouts/masterad')
@section('content')
<div class="container-fluid pt-4 px-4 ">
    <div class="row g-4 d-flex justify-content-center">
        <div class="col-sm-12 col-xl-6">
            <div class="bg-light rounded h-100 p-4">
                <h6 class="mb-4">Cập nhật tin tức</h6>
                <div class="container-fluid">
                    <form action="/admin/tintuc/update" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="_method" value="put">
                        <div class="row mb-3">
                            <label for="inputPassword3" class="col-sm-2 col-form-label">ID tin tức </label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="inputPassword3" name="idtintuc" value="{{$data->idtintuc}}" readonly>

                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputPassword3" class="col-sm-2 col-form-label">Tiêu đề</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="inputPassword3" name="tieude" value="{{$data->tieude}}" required>
                                @error('tieude')
                                <p class="alert alert-danger">{{$message}}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputPassword3" class="col-sm-2 col-form-label">Hình ảnh</label>
                            <div class="col-sm-10">
                                <input type="file" class="form-control" id="inputPassword3" name="img">
                                <img src="{{asset('storage/public_img/'.$data->img)}}" style="width: 100px;" required>

                                @error('img')
                                <p class="alert alert-danger">{{$message}}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputPassword3" class="col-sm-2 col-form-label">Mô tả</label>
                            <div class="col-sm-10">
                                <textarea cols="30" rows="10" class="form-control" id="mota" name="mota" >{{$data->mota}}</textarea>
                                <script>
                                ClassicEditor
                                .create( document.querySelector( '#mota' ) )
                                .then( editor => {
                                        console.log( editor );
                                } )
                                .catch( error => {
                                        console.error( error );
                                } );
                                </script>
                                @error('mota')
                                <p class="alert alert-danger">{{$message}}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputPassword3" class="col-sm-2 col-form-label">Nội dung</label>
                            <div class="col-sm-10">
                                <textarea cols="30" rows="10" class="form-control" id="noidung" name="noidung" >{{$data->noidung}}</textarea>
                                <script>
                                ClassicEditor
                                .create( document.querySelector( '#noidung' ) )
                                .then( editor => {
                                        console.log( editor );
                                } )
                                .catch( error => {
                                        console.error( error );
                                } );
                                </script>
                                @error('noidung')
                                <p class="alert alert-danger">{{$message}}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputPassword3" class="col-sm-2 col-form-label">Ngày đăng</label>
                            <div class="col-sm-10">
                                <input type="date" class="form-control" id="inputPassword3" name="ngaydang" value="{{$data->ngaydang}}" required>
                                @error('ngaydang')
                                <p class="alert alert-danger">{{$message}}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputPassword3" class="col-sm-2 col-form-label">Nhóm tin</label>
                            <div class="col-sm-10">
                                <select class="form-control" id="Nhomtin" name="idnhomtin">
                                    @foreach($theloai as $item)
                                    <option @if($data->loaitin->nhomtin->idnhomtin==$item->idnhomtin)
                                        {{"selected"}}
                                        @endif
                                        value="{{$item->idnhomtin}}">{{$item->tennhomtin}}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputPassword3" class="col-sm-2 col-form-label">Loại tin</label>
                            <div class="col-sm-10">
                                <select class="form-control" id="Loaitin" name="idloaitin">

                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputPassword3" class="col-sm-2 col-form-label">Lượt xem</label>
                            <div class="col-sm-10">
                                <input type="number" min="0" step="1" class="form-control" id="inputPassword3" name="luotxem" value="{{$data->luotxem}}" required>
                                @error('luotxem')
                                <p class="alert alert-danger">{{$message}}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputPassword3" class="col-sm-2 col-form-label">HOT</label>
                            <div class="col-sm-10">
                                <input type="radio" value="1" name="hot" @if($data->hot==1)
                                {{"checked"}}
                                @endif
                                > Có
                                <input type="radio" value="0" name="hot" @if($data->hot==0)
                                {{"checked"}}
                                @endif
                                > Không
                                @error('hot')
                                <p class="alert alert-danger">{{$message}}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="d-flex justify-content-end mt-3">
                            <input type="submit" class="btn btn-success me-2" value="Sửa">
                            <a href="/admin/tintuc" class="btn btn-danger me-2">Trở về</a>
                        </div>
                    </form>
                </div>

            </div>
        </div>
        <div class="row g-4">
            <div class="col-md-12">
                <div class="bg-light rounded h-100 p-4">
                    <h6 class="mb-4">Quản lý Comment</h6>

                    @if(session()->has('mess'))
                    <p class="alert alert-primary sm-4">
                        {{session('mess')}}
                    </p>
                    @endif
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">User</th>
                                <th scope="col">Nội dung</th>
                                <th scope="col">Ngày đăng</th>
                                <th></th>

                            </tr>
                        </thead>
                        @foreach($data->comment as $cm)
                        <tbody>
                            <tr>
                                <td>{{$cm->idbinhluan}}</td>

                                <td>{{$cm->user->ten}}</td>
                                <td>{{$cm->noidung}}</td>
                                <td>{{$cm->ngaydang}}</td>
                                <th>
                                    <form action="/admin/comment/destroy/{{$cm->idbinhluan}}/{{$data->idtintuc}}" method="POST">
                                        @csrf
                                        <input type="hidden" name="_method" value="delete">
                                        <input type="submit" value="xóa" class="btn btn-danger">
                                    </form>
                                </th>
                             
                                </td>
                            </tr>
                        </tbody>
                        @endforeach



                    </table>

                </div>
            </div>

        </div>
    </div>

</div>

@stop
@section('script')
<script>
    $(document).ready(function() {
        var idNhomTin = $('#Nhomtin').val();
        $.get("/admin/ajax/loaitin/" + idNhomTin, function(data) {
            $("#Loaitin").html(data);
        });
        $("#Nhomtin").change(function() {
            var idNhomTin = $(this).val();
            $.get("/admin/ajax/loaitin/" + idNhomTin, function(data) {
                $("#Loaitin").html(data);
            });
        });

    });
</script>
@stop