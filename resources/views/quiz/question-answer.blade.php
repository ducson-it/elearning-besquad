@extends('layouts.master')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h5>Câu hỏi: {{ $question->name }}</h5>
                    <h4 class="card-title mb-0">Danh sách đáp án</h4>
                </div><!-- end card header -->
                <div class="card-body">
                    <div class="listjs-table" id="customerList">
                        <div class="row g-4 mb-3">
                            <div class=" d-flex gap-2 col-sm-auto">
                                <div>
                                    <button type="button" class="btn btn-success add-btn" data-bs-toggle="modal"
                                        id="create-btn" data-bs-target="#showModal"><i
                                            class="ri-add-line align-bottom me-1"></i> Thêm</button>
                                </div>
                                <div>
                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal"><a
                                        href="{{ route('quiz.questions.index',$question->quiz_id) }}">Trở lại</a></button>
                                </div>
                            </div>
                            <div class="col-sm">
                                <div class="d-flex justify-content-sm-end">
                                    {{-- <div class="search-box ms-2">
                                        <form action="" method="GET">
                                            <input type="text" class="form-control search" placeholder="Tìm kiếm..." name="keyword">
                                        <i class="ri-search-line search-icon"></i>
                                        </form>
                                    </div> --}}
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive table-card mt-3 mb-1">
                            <table class="table align-middle" id="customerTable">
                                <thead class="table-light">
                                    <tr>
                                        <th scope="col" style="width: 50px;">
                                            STT
                                        </th>
                                        <th class="sort" data-sort="customer_name">Tên</th>
                                        <th class="sort" data-sort="customer_name">Đáp án</th>
                                        <th class="sort" data-sort="date">Ngày tạo</th>
                                        <th class="sort" data-sort="action">Lựa chọn</th>
                                    </tr>
                                </thead>
                                <tbody class="list form-check-all">
                                    @foreach ($answers as $index => $answer)
                                        <tr>
                                            <th scope="row">
                                                {{ $index + 1 }}
                                            </th>
                                            <td class="customer_name">{{ $answer->name }}</td>
                                            <td class="status"><span
                                                    class="badge badge-soft-success text-uppercase">{{ $answer->correct_answer == 0 ? 'Đáp án sai' : 'Đáp án đúng' }}</span>
                                            </td>
                                            <td class="date">{{ $answer->created_at }}</td>
                                            <td>
                                                <div class="d-flex gap-2">
                                                    <div class="edit">
                                                        <button class="btn btn-sm btn-success edit-item-btn"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#editAnswer{{ $answer->id }}">Edit</button>
                                                    </div>
                                                    <div class="remove">
                                                        <button class="btn btn-sm btn-danger remove-item-btn"
                                                            onclick="deleteAnswer({{ $answer->id }})">Remove</button>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>

                                        {{-- Modal edit categories --}}
                                        <div class="modal fade" id="editAnswer{{ $answer->id }}" tabindex="-1"
                                            aria-labelledby="exampleModalLabel" style="display: none;" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-light p-3">
                                                        <h5 class="modal-title" id="exampleModalLabel">Chỉnh sửa đáp án
                                                        </h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close" id="close-modal"></button>
                                                    </div>
                                                    <form id="answer-update{{ $answer->id }}">
                                                        <div class="modal-body">
                                                            <div class="mb-3">
                                                                <label for="phone-field" class="form-label">Tên đáp
                                                                    án</label>
                                                                <input type="text" id="phone-field" class="form-control"
                                                                    placeholder="Enter name" name="name"
                                                                    value="{{ $answer->name }}">
                                                                <span class="text-danger" id="error-edit"></span>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="phone-field" class="form-label bg-light">Loại
                                                                    đáp án</label>
                                                                <select name="correct_answer" id="" class="form-select">
                                                                    <option value="0" {{$answer->correc_answer == 0? 'checked':''}}>Đáp án sai</option>
                                                                    <option value="1" {{$answer->correc_answer == 1? 'checked':''}}>Đáp án đúng</option>
                                                                </select>
                                                            </div>

                                                        </div>
                                                        <div class="modal-footer" style="display: block;">
                                                            <div class="hstack gap-2 justify-content-end">
                                                                <button type="button" class="btn btn-light"
                                                                    data-bs-dismiss="modal">Đóng</button>
                                                                <button type="button" class="btn btn-success"
                                                                    id="add-btn"
                                                                    onclick="updateAnswer({{ $answer->id }})">Cập
                                                                    nhật</button>
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
                    <h5 class="modal-title" id="exampleModalLabel">Thêm đáp án</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                        id="close-modal"></button>
                </div>
                <form id="answer-create">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="phone-field" class="form-label">Tên đáp án</label>
                            <input type="text" class="form-control" id="name" placeholder="Enter name"
                                name="name">
                            <span class="text-danger" id="error-name"></span>
                        </div>
                        <div class="mb-3">
                            <label for="phone-field" class="form-label">Loại đáp án</label>
                            <select name="correct_answer" id="" class="form-select">
                                <option value="0">Đáp án sai</option>
                                <option value="1">Đáp án đúng</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer" style="display: block;">
                        <div class="hstack gap-2 justify-content-end">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Đóng</button>
                            <button type="button" class="btn btn-success" id="add-btn"
                                onclick="addAnswer()">Thêm</button>
                            <!-- <button type="button" class="btn btn-success" id="edit-btn">Update</button> -->
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
