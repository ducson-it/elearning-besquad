@extends('layouts.master')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Tạo tài khoản học sinh</h4>
                </div><!-- end card header -->
                <div id="message-container">
                    @if(session('message'))
                        <div class="alert alert-success">{{ session('message') }}</div>
                    @endif
                </div>
                <div class="card-body">
                    <div class="live-preview">
                        <form action="{{route('store.user')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row gy-4 d-flex justify-content-center row">
                                <div class="col">
                                    <div class="col-11 mt-3">
                                        <div>
                                            <label for="basiInput" class="form-label">Name</label>
                                            <input type="text" name="name"
                                                   class="form-control @error('name') is-invalid @enderror"
                                                   value="{{old('name')}}" placeholder=" Name">
                                            @error('name')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-11 mt-3">
                                        <div>
                                            <label for="basiInput" class="form-label">Email</label>
                                            <input type="email" name="email"
                                                   class="form-control @error('email') is-invalid @enderror"
                                                   value="{{old('email')}}" placeholder="email">
                                            @error('email')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-11 mt-3">
                                        <div>
                                            <label for="basiInput" class="form-label">Phone</label>
                                            <input type="text" name="phone"
                                                   class="form-control @error('phone') is-invalid @enderror"
                                                   value="{{old('phone')}}" placeholder="phone">
                                            @error('phone')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-11 mt-3">
                                        <label for="basiInput" class="form-label">Avatar</label>
                                        <div class="input-group">
                                        <span class="input-group-btn">
                                            <button class="lfm btn btn-primary" data-input="thumbnail2"
                                                    data-preview="holder2" class="btn btn-primary text-white">
                                                <i class="fa fa-picture-o"></i> Choose
                                            </button>
                                        </span>
                                            <input id="thumbnail2" class="form-control" type="text" name="filepath"><br>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="col-11 mt-3">
                                        <div>
                                            <label for="basiInput" class="form-label">Password</label>
                                            <input type="password" name="password"
                                                   class="form-control @error('password') is-invalid @enderror"
                                                   value="{{old('password')}}" placeholder="password">
                                            @error('password')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-11 mt-3">
                                        <div>
                                            <label for="basiInput" class="form-label">Confirm Password</label>
                                            <input type="password" name="confirm_password"
                                                   class="form-control @error('confirm_password') is-invalid @enderror"
                                                   placeholder="confirm_password">
                                            @error('confirm_password')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-11 mt-3">
                                        <div>
                                            <label for="basiInput" class="form-label">Address</label>
                                            <input type="text" name="address"
                                                   class="form-control @error('address') is-invalid @enderror"
                                                   value="{{old('address')}}" placeholder="address">
                                            @error('address')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <input  type="hidden" name="role_id" value="2">
                                    <div class="col-11 mt-3">
                                        <div>
                                            <label class="form-label">Trạng thái</label>
                                            <select class="form-select mb-3 @error('active') is-invalid @enderror"
                                                    name="active">
                                                <option value="">Chon</option>
                                                <option value="1">Active</option>
                                                <option value="0">Inactive</option>
                                            </select>
                                            @error('active')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                    </div>
                                </div>


                                <!--end col-->
                                <div class="mx-6">
                                    <div class="hstack gap-2 justify-content-end">
                                        <button type="submit" class="btn btn-success" id="add-btn">Thêm</button>
                                        <button type="button" class="btn btn-primary"><a style="color: white"
                                                                                         href="{{route('show.user')}}">trở
                                                về</a></button>
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
