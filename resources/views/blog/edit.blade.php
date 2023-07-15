@extends('layouts.master')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Tạo bài viết</h4>
                </div><!-- end card header -->
                <div class="card-body">
                    <div class="live-preview">
                        <form method="POST" enctype="multipart/form-data" action="{{route('blogs.store')}}" >
                            @csrf
                            <div class="row gy-4 d-flex justify-content-center">
                                <div class="col-11">
                                    <div>
                                        <label for="basiInput" class="form-label">Tiêu đề</label>
                                        <input type="text" class="form-control" name="title" id="name" oninput="generateSlug()">
                                    </div>
                                </div>
                                <div class="col-11">
                                    <div>
                                        <label for="basiInput" class="form-label">Slug</label>
                                        <input type="text" class="form-control" name="slug" id="slug">
                                    </div>
                                </div>
                                <div class="col-11">
                                    <div>
                                        <label for="basiInput" class="form-label">Image</label>
                                        <div id="blogs-image-upload" class="dropzone"></div>
                                    </div>
                                </div>
                                <div class="col-11">
                                    <div>
                                        <label for="exampleFormControlTextarea5" class="form-label">Mô tả ngắn</label>
                                        <textarea class="form-control" name="description_short" rows="3"></textarea>
                                    </div>
                                </div>
                                <div class="col-11">
                                    <label class="label-control mb-2">Nội dung</label>
                                    <div id="quillEditor" >{!!blog->content!!}</div>
                                    <textarea name="content" id="content" class="d-none">{!!blog->content!!}</textarea>
                                </div>
                                <div class="col-11" style="margin-top: 100px">
                                    <label for="basiInput" class="form-label">Chủ đề</label>
                                    <select name="category_blog_id" class="form-control ">
                                        <option value="">-- Chọn danh mục --</option>
                                        @foreach ($category_blogs as $item)
                                            <option value="{{ $item->id }}">
                                                {{ $item->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-11">
                                    <label class="label-control mb-2">View</label>
                                    <input type="number" class="form-control" name="view" >
                                </div>
                                <div class="mx-6">
                                    <div class="hstack gap-2 justify-content-end">
                                        <button type="submit" class="btn btn-success" >Thêm</button>
                                        <button type="button" class="btn btn-light" data-bs-dismiss="modal"><a href="{{route('blogs.list')}}">Trở lại</a></button>
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
