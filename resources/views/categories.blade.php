@extends('layouts.master')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Quản lý danh mục</h4>
                </div><!-- end card header -->
                <div class="card-body">
                    <div class="listjs-table" id="customerList">
                        <div class="row g-4 mb-3">
                            <div class="col-sm-auto">
                                <div>
                                    <button type="button" class="btn btn-success add-btn" data-bs-toggle="modal"
                                        id="create-btn" data-bs-target="#showModal"><i
                                            class="ri-add-line align-bottom me-1"></i> Thêm</button>
                                </div>
                            </div>
                            <div class="col-sm">
                                <div class="d-flex justify-content-sm-end">
                                    <div class="search-box ms-2">
                                        <form action="" method="GET">
                                            <input type="text" class="form-control search" placeholder="Tìm kiếm..." name="keyword">
                                        <i class="ri-search-line search-icon"></i>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if ($keyword != '')
                        <p>Kết quả tìm kiếm cho từ khoá <span class="text-danger mx-1">"{{$keyword}}"</span></p>
                        @endif
                        <div class="table-responsive table-card mt-3 mb-1">
                            <table class="table align-middle" id="customerTable">
                                <thead class="table-light">
                                    <tr>
                                        <th scope="col" style="width: 50px;">
                                            STT
                                        </th>
                                        <th class="sort" data-sort="customer_name">Tên</th>
                                        <th class="sort" data-sort="customer_name">Slug</th>
                                        <th class="sort" data-sort="date">Ngày tạo</th>
                                        <th class="sort" data-sort="action">Lựa chọn</th>
                                    </tr>
                                </thead>
                                <tbody class="list form-check-all">
                                    @foreach ($categories as $index=>$category)
                                        <tr>
                                            <th scope="row">
                                                {{$index+1}}
                                            </th>
                                            <td class="customer_name">{{ $category->name }}</td>
                                            <td class="slug_name">{{ $category->slug }}</td>
                                            <td class="date">{{ $category->created_at }}</td>
                                            <td>
                                                <div class="d-flex gap-2">
                                                    <div class="edit">
                                                        <button class="btn btn-sm btn-success edit-item-btn"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#editCate{{ $category->id }}">Edit</button>
                                                    </div>
                                                    <div class="remove">
                                                        <button class="btn btn-sm btn-danger remove-item-btn"
                                                             onclick="deleteCate({{$category->id}})">Remove</button>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>

                                        {{-- Modal edit categories --}}
                                        <div class="modal fade" id="editCate{{ $category->id }}" tabindex="-1"
                                            aria-labelledby="exampleModalLabel" style="display: none;" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-light p-3">
                                                        <h5 class="modal-title" id="exampleModalLabel">Chỉnh sửa danh mục
                                                        </h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close" id="close-modal"></button>
                                                    </div>
                                                    <form id="category-update{{$category->id}}">
                                                    <div class="modal-body">
                                                        <div class="mb-3">
                                                            <label for="phone-field" class="form-label">Tên danh
                                                                mục</label>
                                                            <input type="text" id="phone-field" class="form-control"
                                                                placeholder="Enter name" name="name"
                                                                value="{{ $category->name }}">
                                                                <span class="text-danger" id="error-edit"></span>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="phone-field" class="form-label bg-light">Slug</label>
                                                            <input type="text" class="form-control" readonly
                                                                 name="slug" id="name" value="{{$category->slug}}">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="phone-field" class="form-label">Mô tả</label>
                                                            <textarea rows="8" cols="3" class="form-control" placeholder="Enter name"
                                                                name="description">{{ $category->description }}</textarea>
                                                        </div>

                                                    </div>
                                                    <div class="modal-footer" style="display: block;">
                                                        <div class="hstack gap-2 justify-content-end">
                                                            <button type="button" class="btn btn-light"
                                                                data-bs-dismiss="modal">Đóng</button>
                                                            <button type="button" class="btn btn-success"
                                                                id="add-btn" onclick="updateCate({{ $category->id }})">Cập nhật</button>
                                                            <!-- <button type="button" class="btn btn-success" id="edit-btn">Update</button> -->
                                                        </div>
                                                    </div>
                                                    </form>

                                                </div>
                                            </div>
                                        </div>
                                    @endforeach

                                </tbody>
                            </table>
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
                            {{$categories->links()}}
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
                        <input type="text"  class="form-control" id="name" placeholder="Nhập tên"
                             name="name">
                        <span class="text-danger" id="error-create"></span>
                    </div>
                    <div class="mb-3">
                        <label for="phone-field" class="form-label">Slug</label>
                        <input type="text" class="form-control bg-light" placeholder="Nhập slug" readonly
                             name="slug" id="slug">
                    </div>
                    <div class="mb-3">
                        <label for="phone-field" class="form-label">Mô tả</label>
                        <textarea rows="8" cols="3" class="form-control" placeholder="Nhập miêu tả"
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
