@extends('layouts.master')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header align-items-center d-flex">
                <h4 class="card-title mb-0 flex-grow-1">Chỉnh sửa khoá học</h4>
            </div><!-- end card header -->
            <div class="card-body">
                <div class="live-preview">
                    {!! Form::open(['route'=>['courses.update',$course->id],'method'=>"put"]) !!}
                    <div class="row gy-5 d-flex justify-content-center">
                        <div class="row col-5 mt-5">
                            <div class="col-10">
                                <div>
                                    <label for="basiInput" class="form-label">Tên khoá học</label>
                                    <input type="text" class="form-control"  value="{{$course->name}}" name="name" id="name">
                                    @if ($errors->any())
                                    <span id="error-name" style="color:red">
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
                                     name="slug" id="slug" value="{{$course->slug}}">
                            </div>
                            <div class="col-10 mt-2">
                                <div>
                                    <label for="basiInput" class="form-label">Danh mục</label>
                                    {!! Form::select('category_id', $categories, $course->category_id, ['name'=>'category_id','class'=>"form-control"]) !!}
                                </div>
                            </div>
                            <div class="col-10 mt-2">
                                <div>
                                    <label for="basiInput" class="form-label">Loại khoá học</label>
                                    {!! Form::select('is_free', $courseTypes, $course->is_free, ['name'=>'is_free','class'=>"form-select" ,'id'=>"courseType"]) !!}
                                </div>
                            </div>
                            <div class="col-10 mt-2">
                                <div>
                                    <label for="basiInput" class="form-label">Trạng thái</label>
                                    {!! Form::select('status', ["0"=>"Inactive","1"=>"Active"], $course->status, ['name'=>'status','class'=>"form-select"]) !!}
                                </div>
                            </div>
                            {{-- Sử dụng dropzone để upload ảnh --}}
                            <div class="col-10 mt-2">
                                <img src="{{$course->image}}" alt="" width="200px">
                            </div>
                            <div class="col-10 mt-2">
                                <div class="input-group">
                                    <span class="input-group-btn">
                                        <button class="lfm btn btn-primary" data-input="thumbnail2"
                                            data-preview="holder2" class="btn btn-primary text-white">
                                            <i class="fa fa-picture-o"></i> Choose
                                        </button>
                                    </span>
                                    <input id="thumbnail2" class="form-control" type="text" name="filepath" value="{{$course->image}}">
                                </div>
                            </div>
                        </div>
                        <div class="row col-6 mt-5">
                            <div class="col-12 price mt-2">
                                <div>
                                    <label for="iconInput" class="form-label">Giá</label>
                                    <div class="form-icon">
                                        <input type="number" class="form-control" id="" placeholder="" value="{{$course->price}}" name="price">
                                    </div>
                                </div>
                            </div>
                            <!--end col-->
                            <div class="col-12 price-sale mt-2">
                                <div>
                                    <label for="iconrightInput" class="form-label">Giảm giá (đơn vị:%)</label>
                                    <div class="form-icon">
                                        <input type="number" class="form-control" id="" placeholder="" value="{{$course->discount}}" name="discount" max="100">
                                    </div>
                                </div>
                            </div>
                            <!--end col-->
                            <div class="col-12 mt-2">
                                <div>
                                    <label for="exampleFormControlTextarea5" class="form-label">Mô tả chung</label>
                                    <textarea class="form-control" id="exampleFormControlTextarea5" rows="3" name="featured">{{$course->featured}}</textarea><br>
                                    @if ($errors->any())
                                    <span id="error-name" style="color:red">
                                        @error('featured')
                                            {{ $message }}
                                        @enderror
                                    </span><br>
                                @endif
                                </div>
                            </div>
                            <div class="col-12 mb-5">
                                <label class="label-control mb-2">Mô tả</label>
                                {{-- <div id="quillEditor">{!!$course->description!!}</div> --}}
                                <textarea name="content" id="content" class="my-editor">{!!$course->description!!}</textarea><br>
                                @if ($errors->any())
                                    <span id="error-name" style="color:red">
                                        @error('content')
                                            {{ $message }}
                                        @enderror
                                    </span><br>
                                @endif
                            </div>
                        
                        </div>
                        <!--end col-->
                        <div class="" style="margin-top: 60px;">
                            <div class="hstack gap-2 justify-content-end">
                                <button type="submit" class="btn btn-success" id="add-btn">Cập nhật</button>
                                <button type="button" class="btn btn-light" data-bs-dismiss="modal"><a href="{{route('courses.list')}}">Trở lại</a></button>
                                <!-- <button type="button" class="btn btn-success" id="edit-btn">Update</button> -->
                            </div>
                        </div>
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