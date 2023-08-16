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
                                                Tên quyền
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
                                                    <td>
                                                        <ul>
                                                            @foreach ($role->permissions as $permission)
                                                                <li> <span style="color: red;">{{ $permission->name }}</span> ({{ $permission->description }}) </li>
                                                            @endforeach
                                                        </ul>
                                                    </td>
                                                    <td class="text-center">
                                                        <a href="{{ route('roles.edit', $role->id) }}" class="btn btn-sm btn-success edit-item-btn"><i class="fa fa-pencil"></i>Chỉnh sửa</a>
                                                        <button class="btn btn-sm btn-danger remove-item-btn" data-id="{{ $role->id }}"> <i class="ace-icon fa  fa-lock bigger-120"></i>Xóa</button>
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
    $(document).on('click', '.remove-item-btn', function(e) {
            var id = $(this).data('id');
            if (confirm('Bạn có chắc muốn xóa vai trò này không?')) {
                $.ajax({
                    url: '/roles/'+ id,
                    type: 'delete',
                    headers: {
                        'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(res) {
                        if (res.success == true) {
                            toastMessage('Xóa thành công', 'success');
                            setTimeout(function() {
                                location.reload();
                            }, 200)
                        } else {
                            toastMessage('Xóa thất bại', 'error');
                        }
                    },
                    error: function(error) {
                        toastMessage('Có lỗi xảy ra', 'error');
                    }
                });
            }
        });
</script>
@endsection
