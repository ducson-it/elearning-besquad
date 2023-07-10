@extends('layouts.master')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title mb-0">Quản lý taggable</h4>
            </div><!-- end card header -->
            <div class="card-body">
                <div class="listjs-table" id="customerList">
                    <div class="row g-4 mb-3">
                        <div class="col-sm-auto">
                            <div>
                                <button type="button" class="btn btn-success add-btn" data-bs-toggle="modal" id="create-btn" data-bs-target="#addTopic"><i class="ri-add-line align-bottom me-1"></i> Add</button>
                                <button class="btn btn-soft-danger" onclick="deleteMultiple()"><i class="ri-delete-bin-2-line"></i></button>
                            </div>
                        </div>
                        <div class="col-sm">
                            <div class="d-flex justify-content-sm-end">
                                <div class="search-box ms-2">
                                    <input type="text" class="form-control search" placeholder="Search..." id="searchInputTaggable">
                                    <i class="ri-search-line search-icon"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive table-card mt-3 mb-1">
                        <table class="table align-middle table-nowrap" id="customerTaggable">
                            <thead class="table-light">
                                <tr>
                                    <th scope="col" style="width: 50px;" class="checkbox-column">
                                    </th>
                                    <th class="sort" >STT</th>
                                    <th class="sort" data-sort="customer_name">Tên thẻ</th>
                                    <th class="sort" data-sort="">Bài post/blog</th>
                                    <th class="sort" data-sort="tag_type">Loại thẻ</th>
                                    <th class="sort" data-sort="date">Ngày tạo</th>
                                    <th class="sort" data-sort="action">Lựa chọn</th>
                                </tr>
                            </thead>
                            <tbody class="list form-check-all">
                            @if (isset($taggables) && !empty($taggables))
                            @foreach($taggables as $key => $taggable)
                                <tr data-taggable-id="{{$taggable->id}}">
                                    <th scope="row">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="chk_child" value="option1">
                                        </div>
                                    </th>
                                    <td >{{$key}}</td>
                                    <td  class="customer_name">{{$taggable->tag->name}}</td>
                                    <td class="course">Học lập trình website cần chuẩn bị gì?</td>
                                    <td class="tag_type">{{$taggable->taggable_type}}</td>
                                    <td class="date">{{$taggable->created_at}}</td>
                                    <td>
                                        <div class="d-flex gap-2">
                                            <div class="remove">
                                                <button class="btn btn-sm btn-danger remove-item-btn"  onclick="showDeleteTaggable({{$taggable->id}})">Remove</button>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            @endif
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
                        {{ $taggables->links() }}
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
    function showDeleteTaggable(id) {
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
                    url: '/tag/delete-taggable/' + id,
                    type: 'DELETE',
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        Swal.fire(
                            'Deleted!',
                            'Your record has been deleted.',
                            'success'
                        ).then(() => {
                            // Chuyển hướng sau khi xóa thành công
                            window.location.reload();
                        });
                    },
                    error: function(xhr) {
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
    function deleteTaggables(selectedIds) {
        // Gửi yêu cầu xóa bằng Ajax
        $.ajax({
            url: '/tag/delete-taggable-checkbox',
            type: 'POST',
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
                selectedIds: selectedIds
            },
            success: function(response) {
                // Xóa các hàng đã chọn từ giao diện
                selectedIds.forEach(function(taggableId) {
                    const row = document.querySelector(`tr[data-taggable-id="${taggableId}"]`);
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
            error: function(xhr) {
                Swal.fire(
                    'Error!',
                    'An error occurred while deleting the records.',
                    'error'
                );
            }
        });
    }

    function deleteMultiple() {
        // Lấy danh sách tất cả các checkbox đã được tích
        const checkboxes = document.querySelectorAll('#customerTable tbody input[type="checkbox"]:checked');

        // Tạo một mảng để lưu trữ các ID đã chọn
        const selectedIds = [];

        // Lặp qua từng checkbox đã được tích và lưu trữ ID vào mảng
        checkboxes.forEach(function (checkbox) {
            const row = checkbox.closest('tr');
            const taggableId = row.dataset.taggableId;
            selectedIds.push(taggableId);

            // Xóa hàng khỏi bảng
            row.remove();
        });
        console.log(selectedIds)
        // Gọi hàm xóa trên backend và gửi mảng các ID đã chọn
        deleteTaggables(selectedIds);
    }
    //search
    // Khởi tạo List.js và cấu hình tìm kiếm
    const options = {
        valueNames: ['customer_name','tag_type', 'course', 'date'], // Các trường dữ liệu để tìm kiếm
    };
    const customerList = new List('customerTaggable', options);

    // Lắng nghe sự kiện nhập liệu trong ô tìm kiếm
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('searchInputTaggable');
        searchInput.addEventListener('keyup', function() {
            const searchString = searchInput.value;
            customerList.search(searchString);
        });
    });
</script>
@endsection

