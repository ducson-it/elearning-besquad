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
                <h4 class="card-title mb-0">Danh sách đề</h4>
            </div><!-- end card header -->
            <div class="card-body">
                <div class="listjs-table" id="customerList">
                    <div class="row g-4 mb-3">
                        <div class="col-sm-auto">
                            <div>
                                <a href="{{ route('quiz.create') }}">
                                    <button type="button" class="btn btn-success add-btn"><i
                                        class="ri-add-line align-bottom me-1"></i>
                                        Add</button>
                                </a>
                            </div>
                        </div>
                        <div class="col-sm">
                            <div class="d-flex justify-content-sm-end">
                                <div class="search-box ms-2">
                                    <form action="" method="GET">
                                        <input type="text" class="form-control search" placeholder="Search..." name="keyword">
                                    <i class="ri-search-line search-icon"></i>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    @if ($keyword != '')
                    <p>Kết quả tìm kiếm cho từ khoá <span class="text-danger mx-1">"{{$keyword}}"</span></p>
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal"><a
                        href="{{ route('quiz.list') }}">Trở lại</a></button>
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
                                <th class="sort" data-sort="customer_name">Loại đề</th>
                                <th class="sort" data-sort="customer_name">Khoá học</th>
                                <th class="sort" data-sort="customer_name">Chủ đề</th>
                                <th class="sort" data-sort="date">Ngày tạo</th>
                                <th class="sort" data-sort="action">Lựa chọn</th>
                            </tr>
                        </thead>
                        <tbody class="list form-check-all">
                            @foreach ($quizzes as $index=>$quiz)
                                <tr>
                                    <th scope="row">
                                        {{$index+1}}
                                    </th>
                                    <td class="customer_name">{{ $quiz->name }}</td>
                                    <td class="customer_name">{{ $quiz->slug }}</td>
                                    <td class="status"><span
                                        class="badge badge-soft-success text-uppercase">{{ $quiz->quiz_type == 0 ? 'Theo chủ đề' : 'Theo khoá học' }}</span>
                                </td>
                                    <td class="date">{{ isset($quiz->courses->name)?$quiz->courses->name:'' }}</td>
                                    <td class="date">{{ isset($quiz->modules->name)?$quiz->modules->name:'' }}</td>
                                    <td class="date">{{ $quiz->created_at}}</td>
                                    <td>
                                        <div class="d-flex gap-2">
                                            <div class="edit">
                                                <button class="btn btn-sm btn-success edit-item-btn"><a href="{{route('quiz.edit',$quiz->id)}}" class="text-light">Edit</a></button>
                                            </div>
                                            <div class="edit">
                                                <button class="btn btn-sm btn-info edit-item-btn"><a
                                                    href="{{ route('quiz.questions.index', $quiz->id) }}" class="text-light">Detail</a></button>
                                            </div>
                                            <div class="remove">
                                                <button class="btn btn-sm btn-danger remove-item-btn"
                                                     onclick="deleteQuiz({{$quiz->id}})">Remove</button>
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
                    {{-- paginate --}}
                    {{$quizzes->links()}}
                </div>
            </div><!-- end card -->
        </div>
        <!-- end col -->
    </div>  
</div>
@endsection