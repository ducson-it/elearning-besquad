@extends('layouts.master')
@section('content')
    <div class="row">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header align-items-center d-flex">
                            <h4 class="card-title mb-0 flex-grow-1">Sửa bài post</h4>
                        </div><!-- end card header -->
                        <div class="card-body">
                            <form method="POST" enctype="multipart/form-data" action="{{ route('feedbacks.update',$feedbacks->id)}}">
                                @csrf
                                <div class="col-12">
                                    <label class="label-control mb-2">Content</label>
                                    <textarea name="content" class="d-none my-editor">{{ old('content', $feedbacks->content) }}</textarea>
                                    @error('content')
                                    <div class="alert text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <br>
                                <br>
                                <div class="mx-6 mt-3">
                                    <div class="hstack gap-2 justify-content-end">
                                        <button type="submit" class="btn btn-primary">Lưu</button>
                                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal" ><a
                                                href="{{ route('feedbacks.list') }}" style="color: white">Trở lại</a></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!--end col-->
                </div>
@endsection
