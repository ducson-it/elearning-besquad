@extends('layouts.master')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title mb-0">Quản lý tag</h4>
            </div><!-- end card header -->
            <div class="card-body">
                <div class="listjs-table" id="customerList">
                    <div class="row g-4 mb-3">
                        <div class="col-sm-auto">
                            <div>
                                <button type="button" class="btn btn-success add-btn" data-bs-toggle="modal" id="create-btn" data-bs-target="#addTopic"><i class="ri-add-line align-bottom me-1"></i> Add</button>
                                <button class="btn btn-soft-danger" onclick="deleteMultiple()"><i class="ri-delete-bin-2-line"></i></button>
                                <!-- Modal -->
                                <div class="modal fade" id="addTopic" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <form id="tag-form" action="{{route('storeTag')}}" method="post">
                                            @csrf
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="tag-name-input">
                                                        <p>Name</p>
                                                        <input type="text" id="tag-name-input" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="tag name">
                                                        <div id="error-messages" class="text-danger"></div>
                                                    </div>
                                                    <div class="tag-description-input mt-3">
                                                        <p>Description</p>
                                                        <textarea id="tag-description-input"  class="form-control" name="tag_description" placeholder="mô tả"></textarea>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                                </div>
                                            </div>
                                        </form>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm">
                            <div class="d-flex justify-content-sm-end">
                                <div class="search-box ms-2">
                                    <input type="text" class="form-control search" placeholder="Search...">
                                    <i class="ri-search-line search-icon"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive table-card mt-3 mb-1">
                        <table class="table align-middle table-nowrap" id="customerTable">
                            <thead class="table-light">
                                <tr>
                                    <th scope="col" style="width: 50px;">

                                    </th>
                                    <th class="sort" data-sort="customer_name">Tên thẻ</th>
                                    <th class="sort" data-sort="course">Mô tả</th>
                                    <th class="sort" data-sort="date">Ngày tạo</th>
                                    <th class="sort" data-sort="action">Lựa chọn</th>
                                </tr>
                            </thead>
                            <tbody class="list form-check-all">
                                @for ($i = 0; $i < 5; $i++)
                                <tr>
                                    <th scope="row">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="chk_child" value="option1">
                                        </div>
                                    </th>
                                    <td class="customer_name">Lập trình website</td>
                                    <td class="course">Lập trình website </td>
                                    <td class="date">13 Dec, 2021</td>
                                    <td>
                                        <div class="d-flex gap-2">
                                            <div class="remove">
                                                <button class="btn btn-sm btn-danger remove-item-btn" data-bs-toggle="modal" data-bs-target="#deleteRecordModal">Remove</button>
                                            </div>
                                            <div class="detail">
                                                <button class="btn btn-sm btn-success edit-item-btn"> <a href="{{route('tag.taggable',1)}}">Detail</a></button>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @endfor
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
                        <div class="pagination-wrap hstack gap-2" style="display: flex;">
                            <a class="page-item pagination-prev disabled" href="javascrpit:void(0)">
                                Previous
                            </a>
                            <ul class="pagination listjs-pagination mb-0"><li class="active"><a class="page" href="#" data-i="1" data-page="8">1</a></li><li><a class="page" href="#" data-i="2" data-page="8">2</a></li></ul>
                            <a class="page-item pagination-next" href="javascrpit:void(0)">
                                Next
                            </a>
                        </div>
                    </div>
                </div>
            </div><!-- end card -->
        </div>
        <!-- end col -->
    </div>
    <!-- end col -->
</div>

@endsection
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#tag-form').submit(function(event) {
            event.preventDefault(); // Ngăn chặn hành vi mặc định của form (tải lại trang)

            var form = $(this);
            var url = form.attr('action');
            var formData = form.serialize();

            $.ajax({
                type: 'POST',
                url: url,
                data: formData,
                success: function(response) {
                    // Xử lý kết quả thành công
                    console.log(response);

                    window.location.reload();
                    // Thực hiện các hành động khác sau khi gửi thành công
                    $('#tag-name-input').val('');
                    $('#tag-description-input').val('');
                    // Hiển thị thông báo thành công (nếu cần)
                    // ...
                },
                error: function(response) {
                    // Xử lý lỗi
                    var errors = response.responseJSON.errors;
                    console.log(errors);
                    // Hiển thị lỗi trên giao diện
                    var errorMessages = '';
                    $.each(errors, function(key, value) {
                        errorMessages += '<p>' + value + '</p>';
                    });
                    $('#error-messages').html(errorMessages);
                }
            });
        });
    });
</script>
