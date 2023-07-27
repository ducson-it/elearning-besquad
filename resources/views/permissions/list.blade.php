@extends('layouts.master')
<<<<<<< HEAD
=======

>>>>>>> f32cd424f0467988c68b02cf22e68717da52aa6a
@section('content')
    @if (Session::has('success'))
        <div class="alert alert-success">
            {{ Session::get('success') }}
        </div>
    @endif
    <div class="row">
<<<<<<< HEAD
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <a href="javascript:void(0)" type="button" class="btn btn-success add-btn"><i
                                class="ri-add-line align-bottom me-1"></i>Thêm nhóm</a>
=======
        <div class="col-lg-4">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5>Nhóm quyền</h5>
                        <button data-bs-toggle="modal" data-bs-target="#create-group-permission"
                            class="btn btn-success add-btn"><i class="ri-add-line align-bottom me-1"></i> Thêm nhóm
                            quyền</button>
>>>>>>> f32cd424f0467988c68b02cf22e68717da52aa6a
                    </div>
                    <div class="table-responsive table-card mt-3 mb-1">
                        <table class="table align-middle table-nowrap" id="customerTable">
                            <thead class="table-light">
                                <tr>
                                    <th>Stt</th>
                                    <th>Tên</th>
                                    <th>Thao tác</th>
                                </tr>
                            </thead>
                            <tbody class="list form-check-all">
                                @foreach ($permissions as $i => $permission)
                                    <tr>
<<<<<<< HEAD
=======
                                        <th scope="row">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="chk_child"
                                                    value="option1">
                                            </div>
                                        </th>
>>>>>>> f32cd424f0467988c68b02cf22e68717da52aa6a
                                        <td class="">{{ $i + 1 }}</td>
                                        <td class="">{{ $permission->id }}</td>
                                        <td class="">{{ $permission->name }}</td>
                                        <td>
                                            <div class="d-flex gap-2">
                                                <div class="detail">
                                                    <button class="btn btn-sm btn-success edit-item-btn"> <a
                                                            href="{{ route('slider.edit', $permission->id) }}">Edit</a></button>
                                                </div>
                                                <div class="remove">
                                                    <button onclick="deletesliders({{ $permission->id }})"
                                                        class="btn btn-sm btn-danger remove-item-btn">Remove</button>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5>Quyền</h5>
                        <a href="javascript:void(0);" data-click="create-permission" class="btn btn-success add-btn"><i
                                class="ri-add-line align-bottom me-1"></i> Thêm quyền</a>
                    </div>
                    <div class="listjs-table" id="customerList">
                        <div class="table-responsive table-card mt-3 mb-1">
                            <table class="table align-middle table-nowrap" id="customerTable">
                                <thead class="table-light">
                                    <tr>
                                        <th>Stt</th>
                                        <th>Name</th>
                                        <th>Thao tác</th>
                                    </tr>
                                </thead>
                                <tbody class="list form-check-all">
                                    @foreach ($permissions as $i => $permission)
                                        <tr>
                                            <th scope="row">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="chk_child"
                                                        value="option1">
                                                </div>
                                            </th>
                                            <td class="">{{ $i + 1 }}</td>
                                            <td class="">{{ $permission->name }}</td>
                                            <td class="">{{ $permission->created_at }}</td>
                                            <td>
                                                <div class="d-flex gap-2">
                                                    <div class="detail">
                                                        <button class="btn btn-sm btn-success edit-item-btn"> <a
                                                                href="{{ route('slider.edit', $permission->id) }}">Edit</a></button>
                                                    </div>
                                                    <div class="remove">
                                                        <button onclick="permissions({{ $permission->id }})"
                                                            class="btn btn-sm btn-danger remove-item-btn">Remove</button>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="d-flex justify-content-end">
                            <div class="pagination-wrap hstack gap-2" style="display: flex;">
                                {{ $permissions->links() }}
                            </div>
                        </div>
                    </div>
                </div><!-- end card -->
            </div>
            <!-- end col -->
        </div>
        <!-- end col -->
    </div>
    <div class="modal fade" id="create-group-permission" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Thêm nhóm quyền</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">Tên nhóm quyền</span>
                        <input type="text" name="name" class="form-control" placeholder="Nhóm quyền"
                            aria-label="Username" aria-describedby="basic-addon1">
                        <input type="hidden" value="0" name="parent_id">
                    </div>
                    <div class="text-danger error input_name mt-1 ml-1"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                    <button type="button" class="btn btn-primary" id="createGroupPermission">Thêm</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function() {
            $('#createGroupPermission').click(function() {
                let modalCreateGroupId = $('#create-group-permission');
                let nameGroup = modalCreateGroupId.find("input[name='name']").val();
                let parentIdGroup = modalCreateGroupId.find("input[name='parent_id']").val();
                let error = false;
                if (!nameGroup) {
                    error = true;
                    $('.error.input_name').html('Vui lòng nhập dữ liệu!')
                }

                if (error) return;

                $.ajax({
                    url: '/permissions',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        name: nameGroup,
                        parent_id: parentIdGroup
                    },
                    type: 'post',
                    success: function(res) {
                        if (res.success == true) {
                            // fileName.val('');
                            // $('#attFileName').text('');
                            // file.val(null);
                            // Contract.config.fileList.push(res.data);
                            // Contract.renderFileHtml();
                            // button.find('.spin').css('display', 'none');
                            location.reload();
                            init.notyPopup('Upload thành công.', 'success');
                        } else {
                            init.notyPopup('Upload thất bại!', 'error');
                        }
                        button.attr('disabled', false)
                    },
                    // error: function(error) {
                    //     button.attr('disabled', false)
                    //     button.find('.spin').css('display', 'none');
                    //     init.notyPopup('Upload thất bại!, Vui lòng thử lại', 'error');

                    // }
                });
            })
        });
    </script>
@endsection
