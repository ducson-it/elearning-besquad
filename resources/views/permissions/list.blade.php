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
                <div class="card-header">
                    <h5>Tên nhóm quyền</h5>
                </div>
                <div class="card-body">
                    <div class="container">
                        <div class="table-responsive table-card mt-3 mb-1">
                            <input type="text" name="group_permission_name" class="form-control" id="group_permission">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-7">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5>Quyền</h5>
                    </div>
                    <div class="listjs-table" id="customerList">
                        <div class="table-responsive table-card mt-3 mb-1">
                            <table class="table align-middle table-nowrap" id="customerTable">
                                <thead class="table-light">
                                    <tr>
                                        <th scope="col">Name</th>
                                        <th scope="col">Decription</th>
                                        <th scope="col">Thao tác</th>
                                    </tr>
                                </thead>
                                <tbody class="list form-check-all" id="render">

                                </tbody>
                            </table>
                            <div class="d-flex justify-content-center align-items-center border-top">
                                <div class="px-2">
                                    <label class="form-label">Tên</label>
                                    <input type="text" class="form-control" name="name" id="name">
                                </div>
                                <div class="px-2">
                                    <label class="form-label">Miêu tả</label>
                                    <input type="text" class="form-control" name="description" id="description">
                                </div>
                                <div class="px-2 align-self-end">
                                    <button class="btn btn-primary" onclick="addPermission()">Thêm</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- end card -->
                <div class="card-footer">
                    <button class="btn btn-success float-end" id="savePermission">Lưu</button>
                </div>
            </div>
            <!-- end col -->
        </div>
        <!-- end col -->
    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function() {
            var dataArray = [];
            var name = $("#name").val();
            var description = $("#description").val();
            var groupPermission = $("#group_permission").val();

            function addPermission() {
                dataArray.push({
                    name: name,
                    description: description,
                    group_permission: groupPermission
                });
                var html = `<tr>
                            <td scope="col">${name}</td>
                            <td scope="col">${description}</td>
                            <td scope="col"><button class="deleteBtn">Delete</button></td>
                        </tr>`;
                $("#render").append(html);
                $("#name").val("");
                $("#description").val("");
                $("#group_permission").val("");
            }
        });
    </script>
@endsection
