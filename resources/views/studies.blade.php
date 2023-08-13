@extends('layouts.master')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Đăng ký khoá học</h4>
                </div><!-- end card header -->
                <div class="card-body">
                    <div class="listjs-table" id="customerList">
                        <div class="row g-4 mb-3">
                            <div class="col-sm-auto">

                            </div>
                            <div class="col-sm">
                                {{-- <div class="d-flex justify-content-sm-end">
                                    <div class="search-box ms-2">
                                        <form action="" method="GET">
                                            <input type="text" class="form-control search" placeholder="Tìm kiếm..." name="keyword">
                                        <i class="ri-search-line search-icon"></i>
                                        </form>
                                    </div>
                                </div> --}}
                            </div>
                        </div>
                        <div class="table-responsive table-card mt-3 mb-1">
                            <table class="table align-middle table-nowrap" id="customerTable">
                                <thead class="table-light">
                                    <tr>
                                        <th scope="col" style="width: 50px;">
                                            STT
                                        </th>
                                        <th class="sort" data-sort="customer_name">User</th>
                                        <th class="sort" data-sort="customer_name">Khoá học</th>
                                        <th class="sort" data-sort="customer_name">Trạng thái</th>
                                        <th class="sort" data-sort="date">Ngày tạo</th>
                                    </tr>
                                </thead>
                                <tbody class="list form-check-all">
                                    @foreach ($studies as $index=>$study)
                                        <tr>
                                            <th scope="row">
                                                {{$index+1}}
                                            </th>
                                            <td class="customer_name">{{ $study->user->name }}</td>
                                            <td class="customer_name">{{ $study->course->name }}</td>
                                            <td class="status"><span
                                                class="badge badge-soft-success text-uppercase">{{ $study->status == 1 ? 'Đã hoàn thành' : 'Đang học' }}</span>
                                            </td>
                                            <td class="date">{{ $study->created_at }}</td>

                                        </tr>

                                    @endforeach

                                </tbody>
                            </table>
                            <div class="noresult" style="display: none">
                                <div class="text-center">
                                    <lord-icon src="https://cdn.lordicon.com/msoeawqm.json" trigger="loop"
                                        colors="primary:#121331,secondary:#08a88a" style="width:75px;height:75px">
                                    </lord-icon>
                                    <h5 class="mt-2">Sorry! No Result Found</h5>
                                    <p class="text-muted mb-0">We've searched more than 150+ Orders We did not find any
                                        orders for you search.</p>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end">
                            {{-- <div class="pagination-wrap hstack gap-2" style="display: flex;">
                                <a class="page-item pagination-prev disabled" href="javascrpit:void(0)">
                                    Previous
                                </a>
                                <ul class="pagination listjs-pagination mb-0">
                                    <li class="active"><a class="page" href="#" data-i="1"
                                            data-page="8">1</a></li>
                                    <li><a class="page" href="#" data-i="2" data-page="8">2</a></li>
                                </ul>
                                <a class="page-item pagination-next" href="javascrpit:void(0)">
                                    Next
                                </a>
                            </div> --}}
                            {{$studies->links()}}
                        </div>
                    </div>
                </div><!-- end card -->
            </div>
            <!-- end col -->
        </div>
        <!-- end col -->
    </div>
    {{-- Modal create categories --}}
    <div class="modal fade" id="showModal" tabindex="-1" aria-labelledby="exampleModalLabel" style="display: none;"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-light p-3">
                    <h5 class="modal-title" id="exampleModalLabel">Thêm danh mục</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                        id="close-modal"></button>
                </div>
                <form id="category-create">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="phone-field" class="form-label">Tên danh mục</label>
                        <input type="text"  class="form-control" id="name" placeholder="Enter name"
                             name="name">
                        <span class="text-danger" id="error"></span>
                    </div>
                    <div class="mb-3">
                        <label for="phone-field" class="form-label">Slug</label>
                        <input type="text" class="form-control bg-light" readonly
                             name="slug" id="slug">
                    </div>
                    <div class="mb-3">
                        <label for="phone-field" class="form-label">Mô tả</label>
                        <textarea rows="8" cols="3" class="form-control" placeholder="Enter name"
                            name="description"></textarea>
                    </div>
                </div>
                <div class="modal-footer" style="display: block;">
                    <div class="hstack gap-2 justify-content-end">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Đóng</button>
                        <button type="button" class="btn btn-success" id="add-btn" onclick="addCate()">Thêm</button>
                        <!-- <button type="button" class="btn btn-success" id="edit-btn">Update</button> -->
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
@endsection
