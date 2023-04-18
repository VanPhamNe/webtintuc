@extends('admin/layouts/masterad')
@section('content')
<div class="container-fluid pt-4 px-4 ">
    <div class="row g-4 d-flex justify-content-center">
        <div class="col-sm-12 col-xl-6">
            <div class="bg-light rounded h-100 p-4">
                <h6 class="mb-4">Thêm tin tức đi bạn</h6>
                <div class="container-fluid">
                    <form action="/admin/tintuc/store" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="row mb-3">
                            <div class="col-sm-10">
                                <input type="hidden"  class="form-control" id="inputPassword3" name="idtintuc">
                                @error('idtintuc')
                                <p class="alert alert-danger">{{$message}}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputPassword3" class="col-sm-2 col-form-label">Tiêu đề</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="inputPassword3" name="tieude" required>
                                @error('tieude')
                                <p class="alert alert-danger">{{$message}}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputPassword3" class="col-sm-2 col-form-label">Hình ảnh</label>
                            <div class="col-sm-10">
                                <input type="file" class="form-control" id="inputPassword3" name="img" required>
                                @error('img')
                                <p class="alert alert-danger">{{$message}}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputPassword3" class="col-sm-2 col-form-label">Mô tả</label>
                            <div class="col-sm-10">
                                <textarea cols="30" rows="10" class="form-control" id="mota" name="mota" ></textarea>
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
                                <textarea cols="30" rows="10" class="form-control" id="noidung" name="noidung" ></textarea>
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
                            <label for="inputPassword3" class="col-sm-2 col-form-label" >Ngày đăng</label>
                            <div class="col-sm-10">
                                <input type="date" class="form-control" id="inputPassword3" name="ngaydang" required>
                                @error('ngaydang')
                                <p class="alert alert-danger">{{$message}}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputPassword3" class="col-sm-2 col-form-label">Nhóm tin</label>
                            <div class="col-sm-10">
                                <select type="text" class="form-control" id="Nhomtin" name="idnhomtin">
                                    @foreach($theloai as $item)
                                    <option value="{{$item->idnhomtin}}">{{$item->tennhomtin}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputPassword3" class="col-sm-2 col-form-label">Loại tin</label>
                            <div class="col-sm-10">
                                <select type="text" class="form-control" id="Loaitin" name="idloaitin">
                                    <!-- dong foreach ko can cg dc -->
                                    @foreach($loaitin2 as $item)
                                    <option value="{{$item->idloaitin}}">{{$item->tenloaitin}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputPassword3" class="col-sm-2 col-form-label">Lượt xem</label>
                            <div class="col-sm-10">
                                <input type="number" min="0" value="0" step="1" class="form-control" id="inputPassword3" name="luotxem" readonly>
                                @error('luotxem')
                                <p class="alert alert-danger">{{$message}}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputPassword3" class="col-sm-2 col-form-label">HOT</label>
                            <div class="col-sm-10">
                                <input type="radio" value="1" name="hot"> Có
                                <input type="radio" value="0" name="hot" checked> Không
                                @error('hot')
                                <p class="alert alert-danger">{{$message}}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="d-flex justify-content-end mt-3">
                            <input type="submit" class="btn btn-success me-2" value="Thêm">
                            <a href="/admin/tintuc" class="btn btn-danger me-2">Trở về</a>
                        </div>
                    </form>
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