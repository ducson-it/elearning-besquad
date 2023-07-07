@extends('layouts.master')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Chỉnh sửa slider</h4>
                </div><!-- end card header -->
                <div class="card-body">
                    <div class="live-preview">
                        <form action="">
                            <div class="row gy-4 d-flex justify-content-center">
                                <div class="col-11">
                                    <div>
                                        <label class="form-label">Tên</label>
                                        <input type="text" class="form-control">
                                    </div>
                                </div>
                                <div class="col-11">
                                    <div>
                                        <label class="form-label">Content</label>
                                        <input type="email" class="form-control">
                                    </div>
                                </div>
                                <div class="col-11">
                                    <div>
                                        <label class="form-label" style="margin-top: 60px">Text color</label>
                                        <input type="file" class="form-control">
                                    </div>
                                </div>
                                <div class="col-11">
                                    <div>
                                        <label class="form-label">Url-btn</label>
                                        <input type="text" class="form-control">
                                    </div>
                                </div>
                                <div class="col-11">
                                    <div>
                                        <label class="form-label">Content_btn</label>
                                        <input type="text" class="form-control">
                                    </div>
                                </div>
                                <div class="col-11">
                                    <div>
                                        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS1BwYl1Svb2h_YRhj9tcnZk0yAuIHh3oBM03dzDa8f&s" alt="" width="100px"><br>
                                        <label for="basiInput" class="form-label" style="margin-top: 60px">Images</label>
                                        <input type="file" name="document">
                                    </div>
                                </div>
                                <div class="col-11">
                                    <div>
                                        <label class="form-label">Status</label>
                                        <input type="text" class="form-control">
                                    </div>
                                </div>
                                <div class="col-11">
                                    <div>
                                        <label class="form-label">Ngày tạo</label>
                                        <input type="text" class="form-control">
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="mx-6">
                                    <div class="hstack gap-2 justify-content-end">
                                        <button type="submit" class="btn btn-success" id="add-btn">Cập nhật</button>
                                        <button type="button" class="btn btn-light"><a href="{{route('slider.list')}}">Trở lại</a></button>
                                    </div>
                                </div>
                                <!--end col-->
                            </div>
                        </form>
                        <!--end row-->
                    </div>
                </div>
            </div>
        </div>
        <!--end col-->
    </div>
@endsection
