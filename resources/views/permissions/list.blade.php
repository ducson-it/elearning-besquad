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
                    <div class="card">
                        <div class="card-header">
                            <strong>Danh sách quyền</strong>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>
                                                Nhóm quyền
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
                                        @if ($groupPermissions)
                                            @foreach ($groupPermissions as $groupPermission)
                                                <tr>
                                                    <td>
                                                        {{ $groupPermission->name }}
                                                    </td>
                                                    <td>
                                                        @foreach ($groupPermission->permissions as $permission)
                                                            <p>{{ $permission->description }} (<span
                                                                    style="color:red">{{ $permission->name }}</span>)</p>
                                                        @endforeach
                                                    </td>
                                                    <td class="d-flex justify-content-center align-items-center">
                                                        <a href="{{ route('permissions.edit', $groupPermission->id) }}"
                                                            class="btn btn-sm btn-success edit-item-btn"><i
                                                                class="fa fa-pencil-square-o icon-sm"
                                                                aria-hidden="true"></i> Chỉnh sửa</a>
                                                            <br>
                                                        <a href="javascript:void(0)" data-id="{{ $groupPermission->id }}"
                                                            class="btn btn-sm btn-danger remove-item-btn"><i
                                                                class="fa fa-trash icon-sm" aria-hidden="true"></i> Xóa
                                                            quyền </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>
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
        $(document).on('click', '.rm_group_btn', function(e) {
                var id = $(this).data('id');
                if (confirm('Bạn có chắc muốn xóa quyền này không?')) {
                    $.ajax({
                        url: '/permissions/group-permissions/'+ id,
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
    </script>
@endsection
