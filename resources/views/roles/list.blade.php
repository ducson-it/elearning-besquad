@extends('layouts.master')
@section('content')
    @if (Session::has('success'))
        <div class="alert alert-success">
            {{ Session::get('success') }}
        </div>
    @endif
    <div class="container-fluid">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-md-4">
                    <form action="{{ route('roles.store') }}" method="POST">
                        @csrf
                        <div class="card">
                            <div class="card-header">
                                <strong>Thêm vai trò</strong>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label class=" col-form-label">Tên vai trò</label>
                                    <div class="">
                                        <input type="text" class="form-control role_name" name="name" maxlength="130"
                                            placeholder="Tên nhóm quyền" required>
                                    </div>
                                    @error('name')
                                        <div style="color:red">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="card-footer">
                                <button class="btn btn-primary role_btn_add">Thêm</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <strong>Danh sách vai trò</strong>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th scope="col">
                                                Stt
                                            </th>
                                            <th scope="col">
                                                Tên vai trò
                                            </th>
                                            <th scope="col">
                                                Hành động
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody class="permission-content">
                                        @if (count($roles) > 0)
                                            @foreach ($roles as $key => $role)
                                                <tr>
                                                    <td>
                                                        {{ $key + 1 }}
                                                    </td>
                                                    <td>
                                                        {{ $role->name }}
                                                    </td>
                                                    <td class="text-center">
                                                        <a href="{{ route('roles.edit', $role->id) }}" class="btn btn-outline-warning btn-sm"><i class="fa fa-pencil"></i>Chỉnh sửa</a>
                                                        <button class="btn btn-outline-danger btn-sm"> <i class="ace-icon fa  fa-lock bigger-120"></i>Xóa</button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.col-->
            </div>
            <!-- /.row-->
        </div>
    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function() {

        })
    </script>
@endsection
