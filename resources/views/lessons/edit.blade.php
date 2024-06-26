@extends('layouts.master')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Chỉnh sửa bài học</h4>
                </div><!-- end card header -->
                <div class="card-body">
                    <div class="live-preview">
                        {!! Form::open(['route' => ['lessons.update',$lesson->id],'enctype'=>"multipart/form-data",'method'=>'put']) !!}
                        <div class="row gy-5 d-flex justify-content-center">
                            <div class="row col-5 mt-5">
                                <div class="col-10">
                                    <div>
                                        <label for="basiInput" class="form-label">Tên bài học</label>
                                        <input type="text" class="form-control" id="name" name="name" value="{{$lesson->name}}">
                                        @if ($errors->any())
                                            <span style="color:red">
                                                @error('name')
                                                    {{ $message }}
                                                @enderror
                                            </span><br>
                                        @endif
                                    </div>
                                </div>
                                <div class="mb-3 col-10">
                                    <label for="phone-field" class="form-label">Slug</label>
                                    <input type="text" class="form-control bg-light" readonly
                                         name="slug" id="slug" value="{{$lesson->slug}}">
                                </div>
                                <div class="col-10">
                                    <div>
                                        <label for="basiInput" class="form-label">Loại bài học</label>
                                        <select name="lesson_type" id="lesson_type" class="form-control">
                                            <option value="1" {{($lesson->lesson_type == 1?'selected':'')}}>Lý thuyết</option>
                                            <option value="0" {{($lesson->lesson_type == 0?'selected':'')}}>Bài tập</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-10 mt-2">
                                    <div>
                                        <label for="basiInput" class="form-label">Khoá học</label>
                                        <select name="course_id" id="course_id" class="form-control">
                                            <option value="{{$lesson->course->id}}">{{$lesson->course->name}}</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-10 mt-2">
                                    <div>
                                        <label for="basiInput" class="form-label">Chủ đề</label>
                                        <select name="module_id" id="module_id" class="form-control">
                                            <option value="{{$lesson->module->id}}">{{$lesson->module->name}}</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-10">
                                    <div>
                                        <a href="{{ URL::asset('/storage/document/'.$lesson->document)}}" target="_blank">Tài liệu bài học</a><br>
                                        <a href="{{route('lessons.downloadDoc',$lesson->document)}}" class="btn btn-primary">Download</a>
                                    </div>
                                    <label for="" class="mt-3">Tải lên document (docx,pdf,...)</label><br>
                                    <div class="input-group">
                                        <input type="hidden" name="document" value="{{$lesson->document}}">
                                        <input type="file" class="form-control" name="document">
                                    </div>
                                </div>
                            </div>
                            <div class="row col-6 mt-5">

                                {{-- upload video to sproud video --}}
                                {{-- <div class="col-10">
                                    <label for="">Video</label><br>
                                    <div class="input-group">
                                        <input type="file" class="form-control" name="video", id="uploadVideo">
                                    </div>
                                </div> --}}
                                {{-- Lựa chọn video khoá học --}}
                                <div class="col-10" id="video-select">
                                    <label for="">Video</label><br>
                                    @if ((isset($video['embed_code'])))
                                    <div style="width:200px" id="showVideo">
                                        {!!$video['embed_code']!!}
                                    </div>
                                    @else
                                    <div style="width:200px" id="showVideo">
                                        
                                    </div>
                                    
                                    @endif
                                        <label for="">Lựa chọn video</label><br>
                                    <div class="input-group">
                                        <select name="video_id" id="video" class="form-control">
                                            @foreach ($videos as $video)
                                                <option value="{{$video['id']}}" {{$video['id'] == $lesson->video_id?'selected':''}} >{{$video['title']}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div id="time">
                                    <input class="form-control" type="hidden" name="time" value="{{ $lesson->time }}">
                                </div>
                                <div class="col-10 mt-4 mb-5">
                                    <label class="label-control mb-2">Cho phép học thử?</label>
                                    {!! Form::select('is_trial_lesson', ["0"=>"Không học thử","1"=>"Cho phép học thử"], $lesson->is_trial_lesson, ['name'=>'is_trial_lesson','class'=>"form-control"]) !!}
                                </div>
                                <div class="col-10 mt-2">
                                    <div>
                                        <label for="basiInput" class="form-label">Bài tập</label>
                                        <select name="quiz_id" id="quiz_id" class="form-control">
                                            <option value="{{$lesson->quiz_id}}"></option>
                                        </select>
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-12 mb-5">
                                    <label class="label-control mb-2">Mô tả</label>
                                        <label class="label-control mb-2">Mô tả</label>
                                        {{-- <div >{!!old('content')!!}</div> --}}
                                        <textarea name="content" id="content" class="my-editor">{!!$lesson->description!!}</textarea>
                                </div>


                            </div>
                            <!--end col-->

                            <div class="m-4">
                                <div class="hstack gap-2 justify-content-end mt-5">
                                    <button type="submit" class="btn btn-success" id="add-btn">Cập nhật</button>
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
