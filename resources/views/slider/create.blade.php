@extends('layouts.master')
@section('content')
    <div class="row">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
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
                                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                                               name="name" value="{{ old('name') }}">
                                    </div>
                                </div>
                                <div class="col-11">
                                    <div>
                                        <label for="basiInput" class="form-label">Content</label>
                                        <input type="text" class="form-control @error('content') is-invalid @enderror"
                                               name="content" value="{{ old('content') }}">
                                    </div>
                                </div>
                                <div class="col-11">
                                    <div>
                                        <label for="basiInput" class="form-label" >Text-color</label>
                                        <input type="text" class="form-control @error('text_color') is-invalid @enderror"
                                               name="text_color" value="{{ old('text_color') }}">
                                    </div>
                                </div>
                                <div class="col-11">
                                    <div>
                                        <label for="basiInput" class="form-label" >Url_btn</label>
                                        <input type="text" class="form-control @error('url_btn') is-invalid @enderror"
                                               name="url_btn" value="{{ old('url_btn') }}">
                                    </div>
                                </div>
                                <div class="col-11">
                                    <div>
                                        <label for="basiInput" class="form-label" >Content_btn</label>
                                        <input type="text" class="form-control @error('content_btn') is-invalid @enderror"
                                               name="content_btn" value="{{ old('content_btn') }}">
                                    </div>
                                </div>
                                <div class="col-11">
                                    <label>Images</label>
                                    <div class="input-group">
                                        <span class="input-group-btn">
                                            <button class="lfm btn btn-primary" data-input="thumbnail2"
                                                    data-preview="holder2" class="btn btn-primary text-white">
                                                <i class="fa fa-picture-o"></i> Choose
                                            </button>
                                        </span>
                                        <input id="thumbnail2" class="form-control" type="text" name="filepath">
                                    </div>
                                </div>
                                <div class="col-11">
                                    <div>
                                        <label for="basiInput" class="form-label" >Status</label>
                                        <input type="text" class="form-control @error('status') is-invalid @enderror"
                                               name="status" value="{{ old('status') }}">
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
