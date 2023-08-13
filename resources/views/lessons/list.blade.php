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
                <h4 class="card-title mb-0">Quản lý bài học</h4>
            </div><!-- end card header -->
            <div class="card-body">
                <div class="listjs-table" id="customerList">
                    <div class="row g-4 mb-3">
                        <div class="col-sm-auto">
                            <div>
                                <a href="{{ route('lessons.create') }}">
                                    <button type="button" class="btn btn-success add-btn"><i
                                        class="ri-add-line align-bottom me-1"></i>
                                        Thêm</button>
                                </a>
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
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal"><a
                        href="{{ route('lessons.list') }}">Trở lại</a></button>
                @endif
                    <div class="table-responsive table-card mt-3 mb-1">
                        <table class="table align-middle table-nowrap" id="customerTable">
                            <thead class="table-light">
                                <tr>
                                    <th scope="col" style="width: 50px;">
                                        sTT
                                    </th>
                                    <th class="sort" data-sort="customer_name">Tên</th>
                                    <th class="sort" data-sort="course">Khoá học</th>
                                    <th class="sort" data-sort="topic">Chủ đề</th>
                                    <th class="sort" data-sort="status">Trạng thái</th>
                                    <th class="sort" data-sort="status">View</th>
                                    <th class="sort" data-sort="status">Trạng thái học thử</th>
                                    <th class="sort" data-sort="date">Ngày tạo</th>
                                    <th class="sort" data-sort="action">Lựa chọn</th>
                                </tr>
                            </thead>
                            <tbody class="list form-check-all" >
                                @foreach ($lessons as $index=>$lesson)
                                <tr>
                                    <th scope="row">
                                        {{$index+1}}
                                    </th>
                                    <td class="customer_name">{{ $lesson->name }}</td>
                                    <td class="course">{{ $lesson->course->name }}</td>
                                    <td class="topic">{{ $lesson->module->name }}</td>
                                    <td class="status"><span
                                        class="badge badge-soft-success text-uppercase">{{ $lesson->status == 1 ? 'Active' : 'Inactive' }}</span>
                                </td>
                                <td class="topic">{{ $lesson->view }}</td>
                                <td class="status"><span
                                    class="badge badge-soft-success text-uppercase">{{ $lesson->is_trial_lesson == 1 ? 'Được phép học thử' : 'Không được phép học thử' }}</span>
                            </td>
                                    <td class="date">13 Dec, 2021</td>
                                    <td>
                                        <div class="d-flex gap-2">
                                            <div class="edit">
                                                <button class="btn btn-sm btn-success edit-item-btn"><a href="{{route('lessons.edit',$lesson->id)}}" class="text-light">Edit</a></button>
                                            </div>
                                            <div class="remove">
                                                <button class="btn btn-sm btn-danger remove-item-btn" onclick="deleteLesson({{$lesson->id}})">Remove</button>
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
                    {{-- paginate --}}
                    {{$lessons->links()}}
                </div>
            </div><!-- end card -->
        </div>
        <!-- end col -->
    </div>
    <!-- end col -->
</div>
@endsection
