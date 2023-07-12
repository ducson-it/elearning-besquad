@extends('layouts.master')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header align-items-center d-flex">
                <h4 class="card-title mb-0 flex-grow-1">Chỉnh sửa tài khoản</h4>
            </div><!-- end card header -->
            <div class="card-body">
                <div class="live-preview">
                    <form action="{{route('updateUser',$user->id)}}" method="post" enctype="multipart/form-data">
                        @csrf
                    <div class="row gy-4 d-flex justify-content-center">
                        <div class="col">
                            <div class="col-11 mt-3">
                                <div>
                                    <label for="basiInput" class="form-label">Name</label>
                                    <input type="text" class="form-control" name="name"  value="{{$user->name}}">
                                    @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-11 mt-3">
                                <div>
                                    <label for="basiInput" class="form-label" >Tải ảnh đại diện</label>
                                    <input type="hidden" name="image" value="{{$user->avatar}}">
                                    <div id="user-img-upload" class="dropzone dz-clickable"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="col-11 mt-3">
                                <div>
                                    <label for="basiInput" class="form-label">Phone</label>
                                    <input type="text" class="form-control" name="phone"  value="{{$user->phone}}">
                                    @error('phone')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-11 mt-4">
                                <div>
                                    <label for="basiInput" class="form-label">Address</label>
                                    <input type="text" class="form-control" name="address"  value="{{$user->address}}">
                                    @error('address')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-11 mt-4">
                                <div>
                                    <label for="basiInput" class="form-label">Loại tài khoản</label>
                                    <select class="form-select mb-3" name="role_id"  aria-label="Default select example" >
                                        <option value=""></option>
                                        <option <?= $user->role_id ==  2 ? 'selected':'' ?> value="2" >Giảng viên</option>
                                        <option  <?= $user->role_id ==  3 ? 'selected':'' ?> value="3">Người dùng</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-11 mt-4">
                                <div>
                                    <label for="basiInput" class="form-label">Trạng thái</label>
                                    <select class="form-select mb-3" name="active" >
                                        <option <?= $user->active ==  1 ? 'selected':'' ?> value="1" >Active</option>
                                        <option <?= $user->active ==  0 ? 'selected':'' ?> value="0">Inactive</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <!--end col-->
                    </div>



                        <!--end col-->
                        <div class="mx-6">
                            <div class="hstack gap-2 justify-content-end">
                                <button type="submit" class="btn btn-success" id="add-btn">Cập nhật</button>
                                <button type="button" class="btn btn-light"><a href="{{route('show.user')}}">Trở lại</a></button>
                            </div>
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
