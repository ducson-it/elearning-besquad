@extends('layouts.master')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Chỉnh sửa đề</h4>
                </div><!-- end card header -->
                <div class="card-body">
                    <div class="live-preview">
                        {!! Form::open(['route' => ['quiz.update',$quiz->id],'enctype'=>"multipart/form-data",'method'=>'put']) !!}
                        <div class="row gy-5 d-flex justify-content-center">
                            <div class="row col-9 mt-5">
                                <div class="">
                                    <div>
                                        <label for="basiInput" class="form-label">Tên đề</label>
                                        <input type="text" class="form-control" id="name" name="name" value="{{$quiz->name}}">
                                        @if ($errors->any())
                                            <span style="color:red">
                                                @error('name')
                                                    {{ $message }}
                                                @enderror
                                            </span><br>
                                        @endif
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="phone-field" class="form-label">Slug</label>
                                    <input type="text" class="form-control bg-light" readonly
                                         name="slug" id="slug" value="{{$quiz->slug}}">
                                </div>
                                <div class="mt-2">
                                    <div>
                                        <label for="basiInput" class="form-label">Loại đề</label>
                                        {!! Form::select('is_free', $quizTypes, $quiz->quiz_type, [
                                            'name' => 'quiz_type',
                                            'class' => 'form-select',
                                            'id' => 'quizType',
                                        ]) !!}
                                    </div>
                                    @if ($errors->any())
                                    <span id="error-name" style="color:red">
                                        @error('quiz_type')
                                            {{ $message }}
                                        @enderror
                                    </span><br>
                                @endif
                                </div>
                                <div class="mt-2">
                                    <div>
                                        <label for="basiInput" class="form-label">Khoá học</label>
                                        <select name="course_id" id="course_id" class="form-control">
                                            <option value="{{$quiz->courses->id}}">{{$quiz->courses->name}}</option>
                                        </select>
                                    </div>
                                </div>
                                @if (isset($quiz->modules->id))
                                <div class="module col-10 mt-2">
                                    <div>
                                        <label for="basiInput" class="form-label">Chủ đề</label>
                                        <select name="module_id" id="module_id" class="form-control">
                                            <option value="{{$quiz->modules->id}}">{{$quiz->modules->name}}</option>
                                        </select>
                                    </div>
                                </div>
                                @else
                                <div class="module mt-2">
                                    <div>
                                        <label for="basiInput" class="form-label">Chủ đề</label>
                                        <select name="module_id" id="module_id" class="form-control">
                                            <option></option>
                                        </select>
                                    </div>
                                </div>
                                @endif
                                
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
