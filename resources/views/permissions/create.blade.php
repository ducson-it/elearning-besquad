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
                                        <input type="text" class="form-control group_permission_name" name="name"
                                            maxlength="130" placeholder="Tên nhóm quyền" required>
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

                                        </tbody>
                                    </table>
                                </div>
                                <div class="row mt-5">
                                    <div class="col-md-4 ">
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
                                            <button class="btn btn-info btn-fw mr-2 mt-4 permission_btn_add"> Thêm
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
            $('.permission_btn_add').click(function(e) {
                e.preventDefault();
                var permission_name = $('.permission_name').val();
                var permission_code = $('.permission_code').val();
                var group_name = $('.group_permission_name').val();
                var permission_content = $('.permission-content');

                if (group_name == '') {
                    Toastify({
                        text: "Nhập tên nhóm quyền",
                        duration: 3000,
                        newWindow: true,
                        close: true,
                        position: "right",
                        style: {
                            background: "#FF0000",
                        },
                    }).showToast();
                    return false;
                }

                if (permission_name == '' || permission_code == '') {
                    Toastify({
                        text: "Tên quyền + Mã quyền không được rỗng!",
                        duration: 3000,
                        newWindow: true,
                        close: true,
                        position: "right",
                        style: {
                            background: "#FF0000",
                        },
                    }).showToast();
                    return false;
                }

                data = {
                    name: permission_name,
                    code: permission_code,
                    group_name: group_name,
                }

                $.ajax({
                    url: '/permissions',
                    type: 'post',
                    headers: {
                        'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: data,
                    success: function(res) {
                        if (res.success == true) {
                            Toastify({
                                text: "Thêm thành công",
                                duration: 3000,
                                newWindow: true,
                                close: true,
                                position: "right",
                                style: {
                                    background: "#00CC33",
                                },
                            }).showToast();
                            permission_content.append(`
                                <tr>
                                    <td>
                                        ${permission_name}
                                    </td>
                                    <td>
                                        ${permission_code}
                                    </td>
                                    <td>
                                        <button class="btn btn-danger btn-sm permission_del" data-code="${permission_code}">Xóa</button>
                                    </td>
                                </tr>
                            `)
                            } else {
                                Toastify({
                                    text: "Thêm thất bại",
                                    duration: 3000,
                                    newWindow: true,
                                    close: true,
                                    position: "right",
                                    style: {
                                        background: "#FF0000",
                                    },
                                }).showToast();
                            }
                    },
                    error: function(error) {
                        Toastify({
                            text: "Có lỗi xảy ra",
                            duration: 3000,
                            newWindow: true,
                            close: true,
                            position: "right",
                            style: {
                                background: "#FF0000",
                            },
                        }).showToast();
                    }
                });
            });

            $(document).on('click', '.permission_del', function(e) {
                e.preventDefault();
                var code = $(this).data('code');
                if (confirm('Bạn có chắc muốn xóa quyền này không?')) {
                    $.ajax({
                        url: '/permissions/' + code,
                        type: 'delete',
                        headers: {
                            'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(res) {
                            if (res.success == true) {
                                Toastify({
                                    text: "Xóa thành công",
                                    duration: 3000,
                                    newWindow: true,
                                    close: true,
                                    position: "right",
                                    style: {
                                        background: "#00CC33",
                                    },
                                }).showToast();
                            } else {
                                Toastify({
                                    text: "Xóa thất bại",
                                    duration: 3000,
                                    newWindow: true,
                                    close: true,
                                    position: "right",
                                    style: {
                                        background: "#FF0000",
                                    },
                                }).showToast();
                            }
                        },
                        error: function(error) {
                            Toastify({
                                text: "Có lỗi xảy ra",
                                duration: 3000,
                                newWindow: true,
                                close: true,
                                position: "right",
                                style: {
                                    background: "#FF0000",
                                },
                            }).showToast();
                        }
                    });

                    $(this).parent().parent().remove();
                }
            });

            $(document).on('click', '.permission_btn_save', function(e) {
                e.preventDefault();
                if (data.length <= 0) {
                    Toastify({
                        text: "Dữ liệu không tổn tại",
                        duration: 3000,
                        newWindow: true,
                        close: true,
                        position: "right",
                        style: {
                            background: "#FF0000",
                        },
                    }).showToast();
                    return false;
                }
                $.ajax({
                    url: '/permissions',
                    type: 'post',
                    headers: {
                        'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: JSON.stringify(data),
                    success: function(res) {
                        if (res.success == true) {
                            Toastify({
                                text: "Thêm thành công",
                                duration: 3000,
                                newWindow: true,
                                close: true,
                                position: "right",
                                style: {
                                    background: "#00CC33",
                                },
                            }).showToast();
                            setTimeout(function() {
                                location.reload();
                            }, 200)
                        } else {
                            Toastify({
                                text: "Thêm thất bại",
                                duration: 3000,
                                newWindow: true,
                                close: true,
                                position: "right",
                                style: {
                                    background: "#FF0000",
                                },
                            }).showToast();
                        }
                    },
                    error: function(error) {
                        Toastify({
                            text: "Có lỗi xảy ra",
                            duration: 3000,
                            newWindow: true,
                            close: true,
                            position: "right",
                            style: {
                                background: "#FF0000",
                            },
                        }).showToast();
                    }
                });
            });

            $(document).on('change', '.group_permission_name', function() {
                $('.permission-content').html('');
            });
        })
    </script>
@endsection
