@extends('layouts.master')
@section('content')
    <div class="row">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header align-items-center d-flex">
                            <h4 class="card-title mb-0 flex-grow-1">Tạo bài Post</h4>
                        </div><!-- end card header -->
                        <div class="card-body">
                            <form method="POST" enctype="multipart/form-data" action="{{ route('feedbacks.store') }}">
                                @csrf
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
                            <label class="label-control mb-2">Nội dung</label>
                            <textarea name="content" class="d-none my-editor" value="{{ old('content') }}"></textarea>
                            @error('content')
                            <div class="alert text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <br>
                        <br>
                    <div class="mx-6 mt-3">
                        <div class="hstack gap-2 justify-content-end">
                            <button type="submit" class="btn btn-primary">Thêm</button>
                            <button type="button" class="btn btn-primary" data-bs-dismiss="modal" ><a
                                    href="{{ route('forum.list') }}" style="color: white">Trở lại</a></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!--end col-->
    </div>
@endsection
