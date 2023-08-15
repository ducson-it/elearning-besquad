@extends('layouts.master')
@section('content')
    <div class="row">
        <div class="container">
            <div class="row">
                <!-- Left column -->
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header align-items-center d-flex">
                            <h4 class="card-title mb-0 flex-grow-1">Tạo bài Post</h4>
                        </div><!-- end card header -->
                        <div class="card-body">
                            <form method="POST" enctype="multipart/form-data" action="{{ route('forum.store') }}">
                                @csrf
                                <div class="row gy-4">
                                    <div class="col-12">
                                        <div>
                                            <label for="basiInput" class="form-label">Title</label>
                                            <input type="text" class="form-control" name="title" value="{{ old('title') }}">
                                        </div>
                                        @error('title')
                                        <div class="alert text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-12">
                                        <div>
                                            <label for="exampleFormControlTextarea5" class="form-label">Post-Type</label>
                                            <select value="{{ old('type') }}" class="form-select" name="type" aria-label="Default select example">
                                                <option >--Chọn--</option>
                                                <option value="1">Thắc mắc</option>
                                                <option value="2">Câu hỏi</option>
                                                <option value="3">Thảo luận</option>
                                                <option value="4">Giải trí</option>
                                            </select>
                                        </div>
                                        @error('type')
                                        <div class="alert text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-12">
                                        <div>
                                            <label for="exampleFormControlTextarea5" class="form-label"> Thuộc tags </label>
                                            <select name="tag_id" class="form-control" >
                                                <option value="{{ old('tag_id') }}" >-- Chọn danh mục bài viết --</option>
                                                @foreach ($tagsforum as $item)
                                                    <option value="{{ $item->id }}">
                                                        {{ $item->name }}</option>
                                                @endforeach
                                            </select>                            </div>
                                        @error('tag_id')
                                        <div class="alert text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-12">
                                        <div>
                                            <label for="exampleFormControlTextarea5" class="form-label"> Category </label>
                                            <select name="category_id" class="form-control" >
                                                <option value="{{ old('category_id') }}" >-- Chọn danh mục bài viết --</option>
                                                @foreach ($categories as $item)
                                                    <option value="{{ $item->id }}">
                                                        {{ $item->name }}</option>
                                                @endforeach
                                            </select>                            </div>
                                        @error('category_id')
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
                            <label class="label-control mb-2">Content</label>
                            <textarea name="content" class="d-none my-editor" value="{{ old('content') }}"></textarea>
                            @error('content')
                            <div class="alert text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <br>
                        <br>
                    </div>
                    <div class="mx-6 mt-3">
                        <div class="hstack gap-2 justify-content-end">
                            <button type="submit" class="btn btn-primary">Thêm</button>
                            <button type="button" class="btn btn-primary" data-bs-dismiss="modal" ><a
                                    href="{{ route('forum.list') }}" style="color: white">Trở lại</a></button>
                        </div>
                    </div>
                </div>
                </form>
            </div>
        </div>
        <!--end col-->
    </div>
@endsection
