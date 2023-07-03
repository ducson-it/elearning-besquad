@extends('layouts.master')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header align-items-center d-flex">
                <h4 class="card-title mb-0 flex-grow-1">Tạo tài khoản user</h4>
            </div><!-- end card header -->
            <div class="card-body">
                <div class="live-preview">
                    <form action="">
                    <div class="row gy-4 d-flex justify-content-center">
                        <div class="col-11">
                            <div>
                                <label for="basiInput" class="form-label">Name</label>
                                <input type="text" class="form-control" id="basiInput">
                            </div>
                        </div>
                        <div class="col-11">
                            <div>
                                <label for="basiInput" class="form-label">Email</label>
                                <input type="email" class="form-control" id="basiInput">
                            </div>
                        </div>
                        <div class="col-11">
                            <div>
                                <label for="basiInput" class="form-label">Password</label>
                                <input type="password" class="form-control" id="basiInput">
                            </div>
                        </div>
                        <div class="col-11">
                            <div>
                                <label for="basiInput" class="form-label" style="margin-top: 60px">Tải ảnh đại diện</label>
                                <input type="file"  name="document" class="form-control" id="basiInput">
                            </div>
                        </div>
                        <div class="col-11">
                            <div>
                                <label for="basiInput" class="form-label">UserName</label>
                                <input type="text" class="form-control" id="basiInput">
                            </div>
                        </div>
                        <div class="col-11">
                            <div>
                                <label for="basiInput" class="form-label">Phone</label>
                                <input type="text" class="form-control" id="basiInput">
                            </div>
                        </div>
                        <div class="col-11">
                            <div>
                                <label for="basiInput" class="form-label">Address</label>
                                <input type="text" class="form-control" id="basiInput">
                            </div>
                        </div>
                        <div class="col-11">
                            <div>
                                <label for="basiInput" class="form-label">Loại tài khoản</label>
                                <select class="form-select mb-3" aria-label="Default select example" >
                                    <option selected=""></option>
                                    <option value="1">Giảng viên</option>
                                    <option value="2">Người dùng</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-11">
                            <div>
                                <label for="basiInput" class="form-label">Trạng thái</label>
                                <select class="form-select mb-3" aria-label="Default select example" >
                                    <option selected=""></option>
                                    <option value="1">Active</option>
                                    <option value="2">Inactive</option>
                                </select>
                            </div>
                        </div>
                        <!--end col-->
                        <div class="mx-6">
                            <div class="hstack gap-2 justify-content-end">
                                <button type="submit" class="btn btn-success" id="add-btn">Thêm</button>
                                <button type="button" class="btn btn-primary"><a style="color: white" href="{{route('user.list')}}">Danh sách</a></button>
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