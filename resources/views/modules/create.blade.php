@extends('layouts.master')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Thêm chủ đề khoá học</h4>
                </div><!-- end card header -->
                <div class="card-body">
                    <div class="live-preview">
                        {!! Form::open(['route' => 'modules.store']) !!}
                        <div class="row gy-5 d-flex justify-content-center">
                                <div class="col-10">
                                    <div>
                                        <label for="basiInput" class="form-label">Tên chủ đề</label>
                                        <input type="text" class="form-control" id="basiInput" name="name">
                                        @if ($errors->any())
                                            <span style="color:red">
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
                                        {!! Form::select('course_id',$courses,null,['id'=>'course_id','class'=>'form-control']) !!}
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-10 mt-4 mb-5">
                                    <label class="label-control mb-2">Mô tả</label>
                                    <div id="quillEditor"></div>
                                    <textarea name="content" id="content" class="d-none"></textarea>
                                </div>
                            <!--end col-->

                            <div class="m-4">
                                <div class="hstack gap-2 justify-content-end mt-5">
                                    <button type="submit" class="btn btn-success" id="add-btn">Thêm</button>
                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal"><a
                                            href="{{ route('modules.list') }}">Trở lại</a></button>
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
