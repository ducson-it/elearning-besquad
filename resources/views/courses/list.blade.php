@extends('layouts.master')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    @if ($message = Session::get('message'))
                        <p class="message" style="color: rgb(17, 186, 9); margin-left:20px"><i class="fa-solid fa-check"></i>
                            {{ $message }}</p>
                    @endif
                    <h4 class="card-title mb-0">Quản lý khoá học</h4>
                </div><!-- end card header -->
                <div class="card-body">
                    <div class="listjs-table" id="customerList">
                        <div class="row g-4 mb-3">
                            <div class="col-sm-auto">
                                <div>
                                    <button type="button" class="btn btn-success add-btn"><i
                                            class="ri-add-line align-bottom me-1"></i> <a
                                            href="{{ route('courses.create') }}">Add</a></button>
                                    <button class="btn btn-soft-danger" onclick="deleteMultiple()"><i
                                            class="ri-delete-bin-2-line"></i></button>
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
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="checkAll"
                                                    value="option">
                                            </div>
                                        </th>
                                        <th class="sort" data-sort="customer_name">Tên</th>
                                        <th class="sort" data-sort="price">Giá</th>
                                        <th class="sort" data-sort="price-discount">Giảm giá</th>
                                        <th class="sort" data-sort="customer_name">Danh mục</th>
                                        <th class="sort" data-sort="status">Trạng thái</th>
                                        <th class="sort" data-sort="image">Ảnh</th>
                                        <th class="sort" data-sort="date">Ngày tạo</th>
                                        <th class="sort" data-sort="action">Lựa chọn</th>
                                    </tr>
                                </thead>
                                <tbody class="list form-check-all">
                                    @foreach ($courses as $course)
                                        <tr>
                                            <th scope="row">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="chk_child"
                                                        value="option1">
                                                </div>
                                            </th>
                                            <td class="customer_name">{{ $course->name }}</td>
                                            <td class="course-price">{{ number_format($course->price, 0, ',', '.') }}</td>
                                            <td class="price-discount">{{ $course->discount ? $course->discount : 0 }}%</td>
                                            <td class="cate">{{ $course->category->name }}</td>
                                            <td class="status"><span
                                                    class="badge badge-soft-success text-uppercase">{{ $course->status == 1 ? 'Active' : 'Inactive' }}</span>
                                            </td>
                                            <td class="course-image"><img
                                                    src="{{$course->image}}"
                                                    alt="" width="100px"></td>
                                            <td class="date">{{$course->created_at}}</td>
                                            <td>
                                                <div class="d-flex gap-2">
                                                    <div class="edit">
                                                        <button class="btn btn-sm btn-success edit-item-btn"><a
                                                                href="{{ route('courses.edit', $course->id) }}">Edit</a></button>
                                                    </div>
                                                    <div class="remove">
                                                        <button class="btn btn-sm btn-danger remove-item-btn"
                                                            onclick="deleteCourse({{$course->id}})">Remove</button>
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
                                        colors="primary:#121331,secondary:#08a88a" style="width:75px;height:75px">
                                    </lord-icon>
                                    <h5 class="mt-2">Sorry! No Result Found</h5>
                                    <p class="text-muted mb-0">We've searched more than 150+ Orders We did not find any
                                        orders for you search.</p>
                                </div>
                            </div>
                        </div>

                        {{$courses->links()}}
                    </div>
                </div><!-- end card -->
            </div>
            <!-- end col -->
        </div>
        <!-- end col -->
    </div>
@endsection
