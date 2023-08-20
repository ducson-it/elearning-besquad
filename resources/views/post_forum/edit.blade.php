@extends('layouts.master')
@section('content')
    <div class="row">
        <div class="container">
            <div class="row">
                <!-- Left column -->
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header align-items-center d-flex">
                            <h4 class="card-title mb-0 flex-grow-1">Edit post</h4>
                        </div><!-- end card header -->
                        <div class="card-body">
                            <form method="POST" enctype="multipart/form-data" action="{{ route('forum.update',$forumPost->id) }}">
                                @csrf
                                <div class="row gy-4">
                                    <div class="col-12">
                                        <div>
                                            <label for="basiInput" class="form-label">title</label>
                                            <input type="text" class="form-control" name="title" value="{{$forumPost->title}}">
                                        </div>
                                        @error('title')
                                        <div class="alert text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Post-Type</label>
                                        <select name="type" class="form-control @error('type') is-invalid @enderror">
                                            <option value="1" {{ old('type', $forumPost->type) == 1 ? 'selected' : '' }}>
                                                Thắc mắc
                                            </option>
                                            <option value="2" {{ old('type', $forumPost->type) == 2 ? 'selected' : '' }}>
                                                Câu hỏi
                                            </option>
                                            <option value="3" {{ old('type', $forumPost->type) == 3 ? 'selected' : '' }}>
                                                Thảo luận
                                            </option>
                                            <option value="4" {{ old('type', $forumPost->type) == 4 ? 'selected' : '' }}>
                                                Giải trí
                                            </option>
                                        </select>
                                        @error('type')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-12">
                                        <div>
                                            <label for="exampleFormControlTextarea5" class="form-label">Danh mục</label>
                                            <select name="category_id" class="form-control">
                                                <option value="">-- Chọn danh mục bài viết --</option>
                                                @foreach ($categories as $item)
                                                    <option value="{{ $item->id }}"
                                                        {{ $item->id == old('category_id', $forumPost->category_id) ? 'selected' : '' }}>
                                                        {{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
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
                            <textarea name="content" id="content" class="d-none my-editor">{{ old('content', $forumPost->content) }}</textarea>
                            @error('content')
                            <div class="alert text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <br>
                        <br>
                    </div>
                    <div class="mx-6 mt-3">
                        <div class="hstack gap-2 justify-content-end">
                            <button type="submit" class="btn btn-primary">Cập nhật</button>
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
