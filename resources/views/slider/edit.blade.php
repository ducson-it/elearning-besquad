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
                    <h4 class="card-title mb-0 flex-grow-1">Chỉnh sửa slider</h4>
                </div><!-- end card header -->
                <div class="card-body">
                    <div class="live-preview">
                        <form method="POST" enctype="multipart/form-data" action="{{ route('slider.update', $sliders->id) }}" >
                            @csrf
                            <div class="row gy-4 d-flex justify-content-center">
                                <div class="col-11">
                                    <div>
                                        <label class="form-label">Tên</label>
                                        <input type="text" class="form-control" name="name" value="{{ old('name', $sliders->name) }}">
                                    </div>
                                </div>
                                <div class="col-11">
                                    <div>
                                        <label class="form-label">Content</label>
                                        <input type="text" class="form-control"  name="content" value="{{ old('content', $sliders->content) }}">
                                    </div>
                                </div>
                                <div class="col-11">
                                    <div>
                                        <label class="form-label" style="margin-top: 60px">Text color</label>
                                        <input type="text" class="form-control" name="text_color" value="{{ old('text_color', $sliders->text_color) }}">
                                    </div>
                                </div>
                                <div class="col-11">
                                    <div>
                                        <label class="form-label">Url-btn</label>
                                        <input type="text" class="form-control" name="url_btn" value="{{ old('url_btn', $sliders->url_btn) }}">
                                    </div>
                                </div>
                                <div class="col-11">
                                    <div>
                                        <label class="form-label">Content_btn</label>
                                        <input type="text" class="form-control" name="content_btn" value="{{ old('content_btn', $sliders->content_btn) }}">
                                    </div>
                                </div>
                                <div class="col-11">
                                    <div class="input-group">
                                    <span class="input-group-btn">
                                        <button class="lfm btn btn-primary" data-input="thumbnail2"
                                                data-preview="holder2" class="btn btn-primary text-white">
                                            <i class="fa fa-picture-o"></i> Choose
                                        </button>
                                    </span>
                                        <input id="thumbnail2" class="form-control" type="text" name="filepath" value="{{$sliders->image}}">
                                    </div>
                                </div>
                                <div class="col-11">
                                    <div>
                                        <label class="form-label">Status</label>
                                        <input type="text" class="form-control" name="status" value="{{ old('status', $sliders->status) }}">
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="mx-6">
                                    <div class="hstack gap-2 justify-content-end">
                                        <button type="submit" class="btn btn-success">Cập nhật</button>
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
