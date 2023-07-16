@extends('layouts.master')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Quản lý Thông báo</h4>
                </div><!-- end card header -->
                <div class="card-body">
                    <div class="listjs-table" id="NotifyList">
                        <div class="row g-4 mb-3">
                            <div class="col-sm-auto">
                                <div>
                                    <button type="button" class="btn btn-success add-btn"><i class="ri-add-line align-bottom me-1"></i> <a href="{{route('add.notify')}}"> Tạo thông báo</a></button>
                                    <button class="btn btn-soft-danger" onclick="deleteMultipleNotify()"><i class="ri-delete-bin-2-line"></i></button>
                                </div>
                            </div>
                            <div class="col-sm">
                                <div class="d-flex justify-content-sm-end">
                                    <div class="search-box ms-2">
                                        <input type="text" class="form-control search" placeholder="Search..." id="searchNotifyInput">
                                        <i class="ri-search-line search-icon"></i>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="table-responsive table-card mt-3 mb-1">
                            <table class="table align-middle table-nowrap" id="NotifyTable">
                                <thead class="table-light">
                                <tr>
                                    <th scope="col" style="width: 50px;" class="checkbox-column">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="checkAll" value="option">
                                        </div>
                                    </th>
                                    <th class="sort" >STT</th>
                                    <th class="sort" data-sort="title">Title</th>
                                    <th class="sort" data-sort="content">Content</th>
                                    <th class="sort" data-sort="is_processed">Trạng thái</th>
                                    <th class="sort" data-sort="is_send_email">Ngày tạo</th>
                                    <th class="sort" data-sort="created_at">Ngày hết hạn</th>
                                    <th class="sort" data-sort="action">Lựa chọn</th>
                                </tr>
                                </thead>
                                <tbody class="list form-check-all">
                                @foreach($notifycations as $key => $notifycation)
                                    <tr data-notify-id="{{$notifycation->id}}">
                                        <th scope="row">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="chk_child"
                                                       value="option1">
                                            </div>
                                        </th>
                                        <td >{{$key + 1}}</td>
                                        <td class="title">{{$notifycation->title}}</td>
                                        <td class="content">{{ Str::limit($notifycation->content, 50) }}</td>
                                        <td class="is_processed"><?= $notifycation->is_processed == false ? 'Chưa xử lí': 'Đã xử lí'  ?></td>
                                        <td class="created_at">{{$notifycation->created_at}}</td>
                                        <td class="expired">{{$notifycation->expired}}</td>

                                        <td>
                                            <div class="d-flex gap-2">
                                                <div class="detail">
                                                    <a href="{{route('edit.notify',$notifycation->id)}}">
                                                        <button class="btn btn-sm btn-warning edit-item-btn">Edit
                                                        </button>
                                                    </a>
                                                </div>
                                                <div class="remove">
                                                    <button class="btn btn-sm btn-danger remove-item-btn"  onclick="DeleteNotify({{$notifycation->id}})" >Remove</button>
                                                </div>

                                            </div>
                                        </td>
                                    </tr>
                                @endforeach

                                </tbody>
                            </table>
                            <div class="noresult" style="display: none">
                                <div class="text-center">
                                    <lord-icon src="https://cdn.lordicon.com/msoeawqm.json" trigger="loop" colors="primary:#121331,secondary:#08a88a" style="width:75px;height:75px"></lord-icon>
                                    <h5 class="mt-2">Sorry! No Result Found</h5>
                                    <p class="text-muted mb-0">We've searched more than 150+ Orders We did not find any orders for you search.</p>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end">
                            {{ $notifycations->links() }}
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
        function DeleteNotify(id) {
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
                        url: '/notify/delete-notify/' + id,
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
        //
        function deleteNotifyCheckbox(selectedIds) {
            // Gửi yêu cầu xóa bằng Ajax
            $.ajax({
                url: '/notify/delete-notify-checkbox',
                type: 'POST',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    selectedIds: selectedIds
                },
                success: function (response) {
                    // Xóa các hàng đã chọn từ giao diện
                    selectedIds.forEach(function (notifyId) {
                        const row = document.querySelector(`tr[data-notify-id="${notifyId}"]`);
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

        function deleteMultipleNotify() {
            // Lấy danh sách tất cả các checkbox đã được tích
            const checkboxes = document.querySelectorAll('#NotifyTable tbody input[type="checkbox"]:checked');

            // Tạo một mảng để lưu trữ các ID đã chọn
            const selectedIds = [];

            // Lặp qua từng checkbox đã được tích và lưu trữ ID vào mảng
            checkboxes.forEach(function (checkbox) {
                const row = checkbox.closest('tr');
                const notifyId = row.dataset.notifyId;
                selectedIds.push(notifyId);

                // Xóa hàng khỏi bảng
                row.remove();
            });
            console.log(selectedIds)
            // Gọi hàm xóa trên backend và gửi mảng các ID đã chọn
            deleteNotifyCheckbox(selectedIds);
        }
        //search
        // Khởi tạo List.js và cấu hình tìm kiếm
        const options = {
            valueNames: ['title', 'conntent', 'is_processed'], // Các trường dữ liệu để tìm kiếm
        };
        const customerList = new List('NotifyTable', options);

        // Lắng nghe sự kiện nhập liệu trong ô tìm kiếm
        document.addEventListener('DOMContentLoaded', function () {
            const searchInput = document.getElementById('searchNotifyInput');
            searchInput.addEventListener('keyup', function () {
                const searchString = searchInput.value;
                customerList.search(searchString);
            });
        });
    </script>
@endsection
