@extends('layouts.master')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Quản lý user</h4>
                </div><!-- end card header -->
                <div class="card-body">
                    <div class="listjs-table" id="customerList">
                        <div class="row g-4 mb-3">
                            <div class="col-sm-auto">
                                <div>
                                    <a
                                        href="{{route('addUser')}}"> <button type="button" class="btn btn-success add-btn"><i
                                            class="ri-add-line align-bottom me-1"></i> Add</button></a>
                                    <button class="btn btn-soft-danger" onclick="deleteMultipleUser()"><i
                                            class="ri-delete-bin-2-line"></i></button>
                                </div>
                            </div>
                            <div class="col-sm">
                                <div class="d-flex justify-content-sm-end">
                                    <div class="search-box ms-2">
                                        <input type="text" class="form-control search" placeholder="Search..."
                                               id="searchUserInput">
                                        <i class="ri-search-line search-icon"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="message-container">
                            @if(session('message'))
                                <div class="alert alert-success">{{ session('message') }}</div>
                            @endif
                        </div>
                        <div class="table-responsive table-card mt-3 mb-1">
                            <table class="table align-middle table-nowrap" id="userTable">
                                <thead class="table-light">
                                <tr>
                                    <th scope="col" style="width: 50px;" class="checkbox-column">
                                    </th>
                                    <th class="sort">STT</th>
                                    <th class="sort" data-sort="customer_name">Tên</th>
                                    <th class="sort" data-sort="course">Email</th>
                                    <th class="sort" data-sort="action">Điện thoại</th>
                                    <th class="sort" data-sort="action">Loại tài khoản</th>
                                    <th class="sort" data-sort="action">Trạng thái</th>
                                    <th class="sort" data-sort="action">Ngày tạo</th>
                                    <th class="sort" data-sort="action">Lựa chọn</th>
                                </tr>
                                </thead>
                                <tbody class="list form-check-all customerList">
                                @foreach($list_users as $key => $user)
                                    <tr data-user-id="{{$user->id}}">
                                        <th scope="row">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="chk_child"
                                                       value="option1">
                                            </div>
                                        </th>
                                        <td>{{$key + 1}}</td>
                                        <td class="customer_name">{{$user->name}}</td>
                                        <td class="email">{{$user->email}}</td>
                                        <td class="phone">{{$user->phone}}</td>
                                        <td class="role_name">{{$user->role->name}}</td>
                                        <td class="active">{{$user->active == 1 ? 'Active': 'Inactive'}}</td>
                                        <td class="created_at">{{$user->created_at}}</td>
                                        <td>
                                            <div class="d-flex gap-2">
                                                <div class="detail">
                                                    <a href="{{route('editUser',$user->id)}}">
                                                        <button class="btn btn-sm btn-warning edit-item-btn">Edit
                                                        </button>
                                                    </a>
                                                </div>
                                                <div class="remove">
                                                    <button class="btn btn-sm btn-danger remove-item-btn"
                                                            onclick="DeleteUser({{$user->id}})">
                                                        Remove
                                                    </button>
                                                </div>
                                                <div class="detail">
                                                    <button onclick="activeUser({{$user->id}})"
                                                            class="btn btn-sm btn-success edit-item-btn">
                                                     <?= $user->active == 0 ? 'Active': 'Inactive'  ?>
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
                            {{ $list_users->links() }}
                        </div>
                    </div>
                </div><!-- end card -->
            </div>
            <!-- end col -->
        </div>
        <!-- end col -->
    </div>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/list.js/2.3.1/list.min.js"></script>
    <script>
        function DeleteUser(id) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Gửi yêu cầu xóa bằng Ajax
                    $.ajax({
                        url: '/user/delete-user/' + id,
                        type: 'DELETE',
                        data: {
                            _token: $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function (response) {
                            Swal.fire(
                                'Deleted!',
                                'Your record has been deleted.',
                                'success'
                            ).then(() => {
                                // Chuyển hướng sau khi xóa thành công
                                window.location.reload();
                            });
                        },
                        error: function (xhr) {
                            Swal.fire(
                                'Error!',
                                'An error occurred while deleting the record.',
                                'error'
                            );
                        }
                    });
                }
            });
        }
        function activeUser(id) {
            console.log(id)
            Swal.fire({
                title: ' Bạn chắc chắn ? ',
                text: "Thay đổi trạng thái tài khoản này ?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, update it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Gửi yêu cầu xóa bằng Ajax
                    $.ajax({
                        url: '/user/user-active/' + id,
                        type: 'POST',
                        data: {
                            _token: $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function (response) {
                            Swal.fire(
                                'Updated!',
                                'Đã cập nhật trường active thành công',
                                'success'
                            ).then(() => {
                                // Chuyển hướng sau khi xóa thành công
                                window.location.reload();
                            });
                        },
                        error: function (xhr) {
                            Swal.fire(
                                'Error!',
                                'Không thể cập nhật trường active.',
                                'error'
                            );
                        }
                    });
                }
            });
        }
        //
        function deleteUserCheckbox(selectedIds) {
            // Gửi yêu cầu xóa bằng Ajax
            $.ajax({
                url: '/user/delete-user-checkbox',
                type: 'POST',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    selectedIds: selectedIds
                },
                success: function (response) {
                    // Xóa các hàng đã chọn từ giao diện
                    selectedIds.forEach(function (userId) {
                        const row = document.querySelector(`tr[data-user-id="${userId}"]`);
                        if (row) {
                            row.remove();
                        }
                    });

                    Swal.fire(
                        'Deleted!',
                        'Your records have been deleted.',
                        'success'
                    );
                },
                error: function (xhr) {
                    Swal.fire(
                        'Error!',
                        'An error occurred while deleting the records.',
                        'error'
                    );
                }
            });
        }

        function deleteMultipleUser() {
            // Lấy danh sách tất cả các checkbox đã được tích
            const checkboxes = document.querySelectorAll('#userTable tbody input[type="checkbox"]:checked');

            // Tạo một mảng để lưu trữ các ID đã chọn
            const selectedIds = [];

            // Lặp qua từng checkbox đã được tích và lưu trữ ID vào mảng
            checkboxes.forEach(function (checkbox) {
                const row = checkbox.closest('tr');
                const userId = row.dataset.userId;
                selectedIds.push(userId);

                // Xóa hàng khỏi bảng
                row.remove();
            });
            console.log(selectedIds)
            // Gọi hàm xóa trên backend và gửi mảng các ID đã chọn
            deleteUserCheckbox(selectedIds);
        }

        //search
        // Khởi tạo List.js và cấu hình tìm kiếm
        const options = {
            valueNames: ['customer_name', 'email', 'phone', 'role_name', 'created_at', 'active'], // Các trường dữ liệu để tìm kiếm
        };
        const customerList = new List('userTable', options);

        // Lắng nghe sự kiện nhập liệu trong ô tìm kiếm
        document.addEventListener('DOMContentLoaded', function () {
            const searchInput = document.getElementById('searchUserInput');
            searchInput.addEventListener('keyup', function () {
                const searchString = searchInput.value;
                customerList.search(searchString);
            });
        });
    </script>
@endsection
