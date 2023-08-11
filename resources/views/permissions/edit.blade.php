@extends('layouts.master')
@section('content')
    @if (Session::has('success'))
        <div class="alert alert-success">
            {{ Session::get('success') }}
        </div>
    @endif
    <form class="forms-sample" action="" method="post">
        @csrf
        <div class="container-fluid">
            <div class="animated fadeIn">
                <div class="row">
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header">
                                <strong>Thông tin cơ bản</strong>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label class=" col-form-label">Tên nhóm quyền</label>
                                    <div class="">
                                        <input type="text" class="form-control group_permission_name" name="group_name"
                                            value="{{ $groupPermission->name }}" maxlength="130" data-id="{{ $groupPermission->id }}"
                                            placeholder="Tên nhóm quyền" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header">
                                <strong>Phân quyền</strong>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>
                                                    Tên quyền
                                                </th>
                                                <th>
                                                    Mã quyền
                                                </th>
                                                <th>
                                                    Hành động
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody class="permission-content">
                                            @if ($groupPermission->permissions)
                                                @foreach ($groupPermission->permissions as $permission)
                                                    <tr>
                                                        <td>
                                                            {{ $permission->description }}
                                                        </td>
                                                        <td>
                                                            {{ $permission->name }}
                                                        </td>
                                                        <td>
                                                            <a href="javascript:void(0)"
                                                                class="text-warning edit_permission_btn mr-4"
                                                                data-id="{{ $permission->id }}"
                                                                data-name="{{ $permission->description }}"
                                                                data-code="{{ $permission->name }}">
                                                                <i class="fa fa-pencil-square-o icon-sm"
                                                                    aria-hidden="true"></i>
                                                            </a>
                                                            <a href="javascript:void(0)" data-code="{{ $permission->name }}"
                                                                class="text-danger permission_del">
                                                                <i class="fa fa-trash icon-sm" aria-hidden="true"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                                <div class="row mt-5">
                                    <div class="col-md-4 ">
                                        <input type="text" class="form-control permission_id" hidden />
                                        <div class="form-group">
                                            <label>Tên quyền</label>
                                            <input type="text" class="form-control permission_name"
                                                placeholder="Tên quyền" />
                                        </div>
                                    </div>
                                    <div class="col-md-4 ">
                                        <div class="form-group">
                                            <label>Mã quyền</label>
                                            <input type="text" class="form-control permission_code"
                                                placeholder="Mã quyền" />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <button class="btn btn-warning btn-fw mr-2 mt-4 permission_btn_edit"> Sửa
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- /.col-->
                </div>
                <!-- /.row-->
            </div>
        </div>
    </form>
@endsection
@section('script')
    <script>
        $(document).ready(function() {
            $('.permission_btn_edit').click(function(e) {
                e.preventDefault();
                var permission_name = $('.permission_name').val();
                var permission_code = $('.permission_code').val();
                var permission_id = $('.permission_id').val();
                var group_name = $('.group_permission_name').val();
                var group_permission_id = $('.group_permission_name').data('id');
                var permission_content = $('.permission-content');

                if (group_name == '') {
                    toastMessage('Nhập tên nhóm quyền');
                    return false;
                }

                // if (permission_name == '' || permission_code == '') {
                //     toastMessage('Mã quyền không được rỗng!', 'error');
                //     return false;
                // }

                data = {
                    id : permission_id,
                    name: permission_name,
                    code: permission_code,
                    group_name: group_name,
                }

                $.ajax({
                    url: '/permissions/' + group_permission_id,
                    type: 'put',
                    headers: {
                        'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: data,
                    success: function(res) {
                        console.log(res);
                        if (res.success == true) {
                            toastMessage('Sửa thành công', 'success');
                            setTimeout(function() {
                                location.reload();
                            }, 200)
                        } else {
                            toastMessage(res.message, 'error');
                        }
                    },
                    error: function(error) {
                        toastMessage('Có lỗi xảy ra', 'error');
                    }
                });
            });

            $(document).on('click', '.permission_del', function() {
                var code = $(this).data('code');
                if (confirm('Bạn có chắc muốn xóa quyền này không?')) {
                    $.ajax({
                        url: '/permissions/'+ code,
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
                                $(this).parent().parent().remove();
                            } else {
                                toastMessage('Xóa thất bại', 'error');

                            }
                        },
                        error: function(error) {
                            toastMessage('Có lỗi xảy ra', 'success');
                        }
                    });
                }
            });


            $(document).on('click', '.edit_permission_btn', function() {
                var id = $(this).data('id');
                var name = $(this).data('name');
                var code = $(this).data('code');
                $('.permission_id').val(id);
                $('.permission_name').val(name);
                $('.permission_code').val(code);
            });
        })
    </script>
@endsection
