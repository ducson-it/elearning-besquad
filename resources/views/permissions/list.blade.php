@extends('layouts.master')
@section('content')
    @if (Session::has('success'))
        <div class="alert alert-success">
            {{ Session::get('success') }}
        </div>
    @endif
    <div class="row">
        <div class="col-lg-5">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5>Nhóm quyền</h5>
                        <button data-bs-toggle="modal" data-bs-target="#create-group-permission"
                            class="btn btn-success btn-sm add-btn"><i class="ri-add-line align-bottom me-1"></i> Thêm nhóm
                            quyền</button>
                    </div>
                    <div class="table-responsive table-card mt-3 mb-1">
                        <table class="table align-middle table-nowrap" id="customerTable">
                            <thead class="table-light">
                                <tr>
                                    <th scope="col">Stt</th>
                                    <th scope="col">Tên</th>
                                    <th scope="col">Thao tác</th>
                                </tr>
                            </thead>
                            <tbody class="list form-check-all">
                                @foreach ($groupPermissions as $i => $permission)
                                    <tr>
                                        <td class="col">{{ $i + 1 }}</td>
                                        <td class="col">{{ $permission->name }}</td>
                                        <td>
                                            <div class="d-flex gap-2">
                                                <div class="detail">
                                                    <button class="btn btn-sm btn-success edit-item-btn">Sửa</button>
                                                </div>
                                                <div class="remove">
                                                    <button  data_id='{{ $permission->id }}'
                                                        class="btn btn-sm btn-danger remove-item-btn">Xóa</button>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <div class="modal fade" id="create-group-permission" tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Thêm nhóm quyền</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text" id="basic-addon1">Tên nhóm
                                                            quyền</span>
                                                        <input type="text" name="name" class="form-control"
                                                            placeholder="Nhóm quyền" aria-label="Username"
                                                            aria-describedby="basic-addon1">
                                                        <input type="hidden" value="0" name="parent_id">
                                                    </div>
                                                    <div class="text-danger error input_name mt-1 ml-1"></div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Đóng</button>
                                                    <button type="button" class="btn btn-primary spin"
                                                        id="createGroupPermission">Thêm</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-7">
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
                                        <th scope="col">Stt</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Thao tác</th>
                                    </tr>
                                </thead>
                                <tbody class="list form-check-all">
                                    @foreach ($permissions as $i => $permission)
                                        <tr>
                                            <td class="">{{ $i + 1 }}</td>
                                            <td class="">{{ $permission->name }}</td>
                                            <td>
                                                <div class="d-flex gap-2">
                                                    <div class="detail">
                                                        <button class="btn btn-sm btn-success edit-item-btn"> <a
                                                                href="{{ route('slider.edit', $permission->id) }}">Edit</a></button>
                                                    </div>
                                                    <div class="remove">
                                                        <button class="destroy-permission" data_id='{{ $permission->id }}'
                                                            class="btn btn-sm btn-danger remove-item-btn">Xóa</button>
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
                    <button type="button" class="btn btn-primary spin" id="createGroupPermission">Thêm</button>
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
                            location.reload();
                        } else {
                            init.notyPopup('Upload thất bại!', 'error');
                        }
                    },
                    error: function(error) {
                        init.notyPopup('Upload thất bại!, Vui lòng thử lại', 'error');
                    }
                });
            })
        });
    </script>
@endsection
