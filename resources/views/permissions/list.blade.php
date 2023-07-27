@extends('layouts.master')

@section('content')
    @if (Session::has('success'))
        <div class="alert alert-success">
            {{ Session::get('success') }}
        </div>
    @endif
    <div class="row">
        <div class="col-lg-4">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5>Nhóm quyền</h5>
                        <a href="javascript:void(0);" data-click="createGroupPermission" class="btn btn-success add-btn"><i
                                class="ri-add-line align-bottom me-1"></i> Thêm nhóm quyền</a>
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
                                        <th scope="row">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="chk_child"
                                                    value="option1">
                                            </div>
                                        </th>
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
    <div class="modal fade" id="create-group-permission" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Xuất File</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <label for="">Lý do: </label>
                    <textarea class="form-control" name="reason" id="reason"></textarea>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                    <button type="button" class="btn btn-primary request " data-click="requestExport">Yêu cầu xuất
                        file
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function() {
            $(this).on('click', '*[data-click]', function(e) {
                let func = $(this).data('click');
                switch (func) {
                    case 'createGroupPermission':
                        Permission.createGroupPermission();
                        break;
                    default:
                        return;
                }
            });

            const Permission = {
                createGroupPermission: function() {
                    let modal = $("#create-group-permission");
                    modal.modal('show');
                }
            }
        });
    </script>
@endsection
