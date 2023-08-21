@extends('layouts.master')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Quản lý Giảng viên</h4>
                </div><!-- end card header -->
                <div class="card-body">
                    <div class="listjs-table" id="customerList">
                        <div class="row g-4 mb-3">
                            <div class="col-sm-auto">
                                <div>
                                    <a
                                        href="{{route('add.teacher')}}">
                                        <button type="button" class="btn btn-success add-btn"><i
                                                class="ri-add-line align-bottom me-1"></i> Thêm
                                        </button>
                                    </a>
                                </div>
                            </div>
                            <div class="col-sm">
                                <div class="d-flex justify-content-sm-end">
                                    <form method="post" action="{{route('show.teacher')}}">
                                        @csrf
                                        <div class="search-box ms-2">
                                            <input type="text" class="form-control search " name="search_teacher"
                                                   placeholder="Tìm kiếm...">
                                            <i class="ri-search-line search-icon"></i>
                                        </div>

                                    </form>

                                </div>
                            </div>
                        </div>
                        <div id="message-container">
                            @if(session('message'))
                                <div class="alert alert-success">{{ session('message') }}</div>
                            @endif
                        </div>
                        <div class="table-responsive table-card mt-3 mb-1">
                            <table class="table align-middle table-nowrap" id="teacherTable">
                                <thead class="table-light">
                                <tr>
                                    <th class="sort">STT</th>
                                    <th class="sort" data-sort="customer_name">Tên</th>
                                    <th class="sort" data-sort="course">Email</th>
                                    <th class="sort" data-sort="action">Điện thoại</th>
                                    <th class="sort" data-sort="action">Loại tài khoản</th>
                                    <th class="sort" data-sort="action">Trạng thái</th>
                                    <th class="sort" data-sort="action">Point</th>
                                    <th class="sort" data-sort="action">Ngày tạo</th>
                                    <th class="sort" data-sort="action">Lựa chọn</th>
                                </tr>
                                </thead>
                                <tbody class="list form-check-all">
                                <!-- Trang hiện tại -->
                                @php
                                    $currentPage = $list_teachers->currentPage();
                                    $perPage = $list_teachers->perPage();
                                    $start = ($currentPage - 1) * $perPage + 1;
                                @endphp
                                <!-- Sử dụng một vòng lặp để hiển thị các bản ghi người dùng -->
                                @foreach($list_teachers as $key => $teacher)
                                    <tr data-user-id="{{$teacher->id}}">
                                        <td>{{$start + $key}}</td>
                                        <td class="customer_name">{{$teacher->name}}</td>
                                        <td class="email">{{$teacher->email}}</td>
                                        <td class="phone">{{$teacher->phone}}</td>
                                        <td class="role_name">
                                            @foreach ($teacher->roles as $role)
                                                {{ $role->name }}
                                            @endforeach
                                        </td>
                                        <td class="active">{{$teacher->active == 1 ? 'Active': 'Inactive'}}</td>
                                        <td class="phone">{{$teacher->point}}</td>
                                        <td class="created_at">{{$teacher->created_at}}</td>
                                        <td>
                                            <div class="d-flex gap-2">
                                                <div class="detail">
                                                    <a href="{{route('edit.teacher',$teacher->id)}}">
                                                        <button class="btn btn-sm btn-warning edit-item-btn">Edit
                                                        </button>
                                                    </a>
                                                </div>
                                                <div class="remove">
                                                    <button class="btn btn-sm btn-danger remove-item-btn"
                                                            onclick="DeleteUser({{$teacher->id}})">
                                                        Remove
                                                    </button>
                                                </div>
                                                <div class="detail">
                                                    <button onclick="activeUser({{$teacher->id}})"
                                                            class="btn btn-sm  edit-item-btn <?= $teacher->active == 0 ? 'btn-success' : 'btn-primary'?>">
                                                            <?= $teacher->active == 0 ? 'Active' : 'Inactive' ?>
                                                    </button>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="noresult" style="display: none">
                                <div class="text-center">
                                    <lord-icon src="https://cdn.lordicon.com/msoeawqm.json" trigger="loop"
                                               colors="primary:#121331,secondary:#08a88a"
                                               style="width:75px;height:75px"></lord-icon>
                                    <h5 class="mt-2">Sorry! No Result Found</h5>
                                    <p class="text-muted mb-0">We've searched more than 150+ Orders We did not find any
                                        orders for you search.</p>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end">
                            {{ $list_teachers->links() }}
                        </div>
                    </div>
                </div><!-- end card -->
            </div>
            <!-- end col -->
        </div>
        <!-- end col -->
    </div>
@endsection
