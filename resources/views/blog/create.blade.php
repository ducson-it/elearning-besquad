@extends('layouts.master')
@section('content')
<div class="row">
        <div class="container">
            <div class="row">
                <!-- Left column -->
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header align-items-center d-flex">
                            <h4 class="card-title mb-0 flex-grow-1">Tạo bài viết</h4>
                        </div><!-- end card header -->
                        <div class="card-body">
                            <form method="POST" enctype="multipart/form-data" action="{{ route('blogs.store') }}">
                                @csrf
                                <div class="row gy-4">
                                    <div class="col-12">
                                        <div>
                                            <label for="basiInput" class="form-label">Tiêu đề</label>
                                            <input type="text" class="form-control" name="title" id="name" oninput="generateSlug()" value="{{ old('title') }}">
                                        </div>
                                        @error('title')
                                        <div class="alert text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-12">
                                        <div>
                                            <label for="basiInput" class="form-label">Slug</label>
                                            <input type="text" class="form-control" name="slug" id="slug" value="{{ old('slug') }}">
                                        </div>
                                        @error('slug')
                                        <div class="alert text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-12">
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
                                    <div class="col-12">
                                        <div>
                                            <label for="exampleFormControlTextarea5" class="form-label">Mô tả ngắn</label>
                                            <textarea class="form-control" name="description_short" rows="3" value="{{ old('description_short') }}"></textarea>
                                        </div>
                                        @error('description_short')
                                        <div class="alert text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!--end col-->
                                </div>

                            <!--end row-->
                        </div>
                    </div>
                </div>
                <!-- Right column -->
                <div class="col-lg-6">
                    <div class="card">
                        <div class="col-12">
                            <label class="label-control mb-2">Nội dung</label>
                            <textarea name="content" id="content" class="d-none my-editor" value="{{ old('content') }}"></textarea>
                            @error('content')
                            <div class="alert text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <br>
                        <div class="col-12">
                            <label for="basiInput" class="form-label">Chủ đề</label>
                            <select name="category_blog_id" class="form-control" >
                                <option value="{{ old('category_blog_id') }}" >-- Chọn danh mục --</option>
                                @foreach ($category_blogs as $item)
                                    <option value="{{ $item->id }}">
                                        {{ $item->name }}</option>
                                @endforeach
                            </select>
                            @error('category_blog_id')
                            <div class="alert text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <br>
{{--                        <div class="col-12">--}}
{{--                            <label class="label-control mb-2">View</label>--}}
{{--                            <input type="number" class="form-control" name="view">--}}
{{--                        </div>--}}
                    </div>
                    <div class="mx-6 mt-3">
                        <div class="hstack gap-2 justify-content-end">
                            <button type="submit" class="btn btn-success">Thêm</button>
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal"><a
                                    href="{{ route('blogs.list') }}">Trở lại</a></button>
                        </div>
                    </div>
                </div>
                </form>
            </div>
        </div>
    <!--end col-->
</div>
@endsection
