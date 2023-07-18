@extends('layouts.master')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Tạo order</h4>
                </div><!-- end card header -->
                <div class="card-body">
                    <div class="live-preview">
                        {!! Form::open(['route' => 'orders.store']) !!}
                        <div class="row gy-5 d-flex justify-content-center">
                                <div class="col-10">
                                    <div>
                                        <div>
                                            <label for="basiInput" class="form-label">User</label>
                                        <select name="user_id" id="user_id" class="form-control">
                                        </select>
                                        </div>
                                        @if ($errors->any())
                                            <span style="color:red">
                                                @error('user_id')
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
                                    @if ($errors->any())
                                            <span style="color:red">
                                                @error('course_id')
                                                    {{ $message }}
                                                @enderror
                                            </span><br>
                                        @endif
                                </div>
                                <!--end col-->
                                <div class="col-10 mt-4 mb-5">
                                    <label class="label-control mb-2">Tổng tiền</label>
                                    <input type="number" name="amount" id="total_amount" class="form-control">
                                </div>
                            <!--end col-->

                            <div class="m-4">
                                <div class="hstack gap-2 justify-content-end mt-5">
                                    <button type="submit" class="btn btn-success" id="add-btn">Thêm</button>
                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal"><a
                                            href="{{ route('orders.list') }}">Trở lại</a></button>
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
