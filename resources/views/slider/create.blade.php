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
                        <form action="{{route('slider.store')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row gy-4 d-flex justify-content-center">
                                <div class="col-11">
                                    <div>
                                        <label for="basiInput" class="form-label">Name</label>
                                        <input type="text" class="form-control" id="basiInput" name="name">
                                    </div>
                                </div>
                                <div class="col-11">
                                    <div>
                                        <label for="basiInput" class="form-label">Content</label>
                                        <input type="text" class="form-control" id="basiInput"  name="content">
                                    </div>
                                </div>
                                <div class="col-11">
                                    <div>
                                        <label for="basiInput" class="form-label" >Text-color</label>
                                        <input type="text" class="form-control" id="basiInput" name="text_color">
                                    </div>
                                </div>
                                <div class="col-11">
                                    <div>
                                        <label for="basiInput" class="form-label" >Url_btn</label>
                                        <input type="text" class="form-control" id="basiInput" name="url_btn">
                                    </div>
                                </div>
                                <div class="col-11">
                                    <div>
                                        <label for="basiInput" class="form-label" >Content_btn</label>
                                        <input type="text" class="form-control" id="basiInput" name="content_btn">
                                    </div>
                                </div>
                                <div class="col-11">
                                    <label for="basiInput" class="form-label" >Images</label>
                                    <div id="sliders-image-upload" class="dropzone"></div>
                                </div>
                                <div class="col-11">
                                    <div>
                                        <label for="basiInput" class="form-label" >Status</label>
                                        <input type="text" class="form-control" id="basiInput" name="status">
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
