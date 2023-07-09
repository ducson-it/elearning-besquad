@extends('layouts.master')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header align-items-center d-flex">
                <h4 class="card-title mb-0 flex-grow-1">Chủ đề</h4>
            </div><!-- end card header -->
            <div class="card-body">
                <div class="live-preview">
                    <form action="{{route('courses.topics.selected')}}" method="POST">
                    @csrf
                    <div class="row gy-4 d-flex justify-content-center">
                        <div class="col-8">
                            <div>
                                <label for="basiInput" class="form-label">Lựa chọn chủ đề theo khoá học</label>
                                <select name="course" class="form-select mb-3" aria-label="Default select example" >
                                    <option value=""></option>
                                    <option value="1">Lập trình website</option>
                                    <option value="2">Lập trình C</option>
                                    <option value="3">Lập trình Java</option>
                                    <option value="4">Lập trình C#</option>
                                </select>
                            </div>
                        </div>
                        <div class="mx-6">
                            <div class="hstack gap-2 justify-content-end">
                                <button type="submit" class="btn btn-success" id="add-btn">Chọn</button>
                                <!-- <button type="button" class="btn btn-success" id="edit-btn">Update</button> -->
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