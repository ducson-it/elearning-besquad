@extends('layouts.master')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Thêm bài học</h4>
                </div><!-- end card header -->
                <div class="card-body">
                    <div class="live-preview">
                        {!! Form::open(['route' => 'lessons.store','enctype'=>"multipart/form-data"]) !!}
                        <div class="row gy-5 d-flex justify-content-center">
                            <div class="row col-5 mt-5">
                                <div class="col-10">
                                    <div>
                                        <label for="basiInput" class="form-label">Tên bài học</label>
                                        <input type="text" class="form-control" id="name" name="name">
                                        @if ($errors->any())
                                            <span id="error-name" style="color:red">
                                                @error('name')
                                                    {{ $message }}
                                                @enderror
                                            </span><br>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-10 mt-2">
                                    <div>
                                        <label for="basiInput" class="form-label">Khoá học</label>
                                        <select name="course_id" id="course_id" class="form-control">
                                        </select>
                                    </div>
                                </div>
                                <div class="col-10 mt-2">
                                    <div>
                                        <label for="basiInput" class="form-label">Chủ đề</label>
                                        <select name="module_id" id="module_id" class="form-control">
                                            <option></option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row col-6 mt-5">
                                <div class="col-10">
                                    <label for="">Tải lên document (docx,pdf,...)</label><br>
                                    <div class="input-group">
                                        <input type="file" class="form-control" name="document" value="{{old('document')}}">
                                    </div>
                                </div>
                                {{-- upload video to sproud video --}}
                                {{-- <div class="col-10">
                                    <label for="">Video</label><br>
                                    <div class="input-group">
                                        <input type="file" class="form-control" name="video", id="uploadVideo">
                                    </div>
                                </div> --}}
                                {{-- Lựa chọn video khoá học --}}
                                <div class="col-10">
                                    <label for="">Video</label><br>
                                    <div class="input-group">
                                        <select name="video_id" id="video" class="form-control">
                                            @foreach ($videos as $video)
                                                <option value="{{$video['id']}}">{{$video['title']}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12 mt-4 mb-5">
                                    <label class="label-control mb-2">Cho phép học thử?</label>
                                    <select name="is_trial_lesson" id="" class="form-control">
                                        <option value="0">Không học thử</option>
                                        <option value="1">Cho phép học thử</option>
                                    </select>
                                </div>
                                <!--end col-->
                                <div class="col-12 mt-4 mb-5">
                                    <label class="label-control mb-2">Mô tả</label>
                                    <div id="quillEditor">{!! old('content') !!}</div>
                                    <textarea name="content" id="content" class="d-none">{!! old('content') !!}</textarea>
                                </div>
                                

                            </div>
                            <!--end col-->

                            <div class="m-4">
                                <div class="hstack gap-2 justify-content-end mt-5">
                                    <button type="submit" class="btn btn-success" id="add-btn">Thêm</button>
                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal"><a
                                            href="{{ route('lessons.list') }}">Trở lại</a></button>
                                    <!-- <button type="button" class="btn btn-success" id="edit-btn">Update</button> -->
                                </div>
                            </div>
                            <!--end col-->
                        </div>
                        {!! Form::close() !!}
                        <!--end row-->
                    </div>
                </div>
            </div>
        </div>
        <!--end col-->
    </div>
@endsection
