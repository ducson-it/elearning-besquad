@extends('layouts.master')
@section('content')
    @if (Session::has('message'))
        <div class="alert alert-success text-center">
            {{ Session::get('message') }}
        </div>
    @endif
    <form action="{{ route('changepass') }}" method="post">
        @csrf
        <div class="modal-dialog d-flex justify-content-center">
            <div class="modal-content w-75 ">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Đổi mật khẩu</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body ">
                    <div class="row ">
                        <div  class="col">
                            <div class="mb-3">
                                <label for="recipient-name" class="col-form-label">Mật khẩu cũ</label>
                                <input type="password" class="form-control" name="old_password" value="{{ old('old_password') }}">
                                @if ($errors->has('old_password'))
                                    <span class="text-danger">{{ $errors->first('old_password') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3">
                                <label for="message-text" class="col-form-label">Mật khẩu mới</label>
                                <input type="password" class="form-control"  name="new_password">
                                @if ($errors->has('new_password'))
                                    <span class="text-danger">{{ $errors->first('new_password') }}</span>
                                @endif
                            </div>
                            <div class="mb-3">
                                <label for="message-text" class="col-form-label">Nhập lại mật khẩu</label>
                                <input type="password" class="form-control" name="confirm_password">
                                @if ($errors->has('confirm_password'))
                                    <span class="text-danger">{{ $errors->first('confirm_password') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary m-2" data-bs-dismiss="modal">Trở lại</button>
                    <button type="submit" class="btn btn-primary m-2" >Cập nhật</button>
                </div>
            </div>
        </div>

    </form>
@endsection



