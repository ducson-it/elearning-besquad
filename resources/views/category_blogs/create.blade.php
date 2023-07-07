@extends('layouts.master')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Tạo mới slider</h4>
                </div><!-- end card header -->
                <div class="card-body">
                    <div class="live-preview">
                        <form action="">
                            <div class="row gy-4 d-flex justify-content-center">
                                <div class="col-11">
                                    <div>
                                        <label for="basiInput" class="form-label" name="name">Name</label>
                                        <input type="text" class="form-control" id="basiInput">
                                    </div>
                                </div>
                                <div class="col-11">
                                    <div>
                                        <label for="basiInput" class="form-label" name="content">Content</label>
                                        <input type="text" class="form-control" id="basiInput">
                                    </div>
                                </div>
                                <div class="col-11">
                                    <div>
                                        <label for="basiInput" class="form-label" name="text_color">Text-color</label>
                                        <input type="text" class="form-control" id="basiInput">
                                    </div>
                                </div>
                                <div class="col-11">
                                    <div>
                                        <label for="basiInput" class="form-label" name="url_btn">Url_btn</label>
                                        <input type="text" class="form-control" id="basiInput">
                                    </div>
                                </div>
                                <div class="col-11">
                                    <div>
                                        <label for="basiInput" class="form-label" name="content_btn">Content_btn</label>
                                        <input type="text" class="form-control" id="basiInput">
                                    </div>
                                </div>
                                <div class="col-11">
                                    <div>
                                        <label for="basiInput" class="form-label" style="margin-top: 60px" name="image">Images</label>
                                        <input type="file"  name="document" class="form-control" id="basiInput">
                                    </div>
                                </div>
                                <div class="col-11">
                                    <div>
                                        <label for="basiInput" class="form-label" name="status">Status</label>
                                        <input type="text" class="form-control" id="basiInput">
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="mx-6">
                                    <div class="hstack gap-2 justify-content-end">
                                        <button type="submit" class="btn btn-success" id="add-btn">Thêm</button>
                                        <button type="button" class="btn btn-primary"><a style="color: white" href="{{route('slider.list')}}">Danh sách</a></button>
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
