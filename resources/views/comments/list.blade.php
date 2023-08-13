@extends('layouts.master')
@section('content')
    @if (Session::has('success'))
        <div class="alert alert-success">
            {{ Session::get('success') }}
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h3>Quản lý comment</h3>
                </div><!-- end card header -->
                <div class="card-body">
                    <div class="listjs-table" id="customerList">
                        <div class="row g-4 mb-3">
                            <div class="col-sm-auto">
                                <div>
                                    <button type="button" class="btn btn-primary add-btn" data-bs-toggle="modal" id="create-btn" data-bs-target="#addTopic"><a href="{{route('comment.create')}}" style="color:white">Thêm</a></button>
                                </div>
                            </div>
                            <div class="col-sm">
                                <div class="d-flex justify-content-sm-end">
                                    <div class="search-box ms-2">
                                        <form action="{{ route('comment.list') }}" method="GET">
                                            <input type="text" class="form-control search" placeholder="Tìm kiếm..." name="search">
                                            <i class="ri-search-line search-icon"></i>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive table-card mt-3 mb-1">
                            <table class="table align-middle table-nowrap" id="customerTable">
                                <thead class="table-light">
                                <tr>
                                    <th class="" data-sort="customer_name">STT</th>
                                    <th class="" data-sort="customer_name"> Người comment</th>
                                    <th class="" data-sort="course">Content</th>
                                    <th class="" data-sort="course">Thuộc bài viết  </th>
                                    <th class="" data-sort="course">Thuộc danh mục</th>
                                    <th class="" data-sort="action">Thao tác</th>
                                    <th class="" data-sort="course">Status</th>
                                    <th class="" data-sort="course">Trả lời</th>

                                </tr>
                                </thead>
                                <tbody class="list form-check-all">
                                @foreach($comments as $i =>$comment)
                                    <tr>
                                        <td class="customer_name">{{$i +1}}</td>
                                        <td class="customer_name">{{$comment->user?->name}}</td>
                                        <td class="course">{{$comment->content}}</td>
                                        <td class="course">{{$comment->commentable_id}}
                                        </td>
                                        <td class="course">{{$comment->commentable_type}}
                                        </td>
                                        <td>
                                            <div class="d-flex gap-2">
                                                <div class="remove">
                                                    <button onclick="event.preventDefault(); deletecomment({{ $comment->id }})" class="btn btn-sm btn-danger remove-item-btn">Remove</button>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="detail">
                                                <button class="btn btn-sm {{$comment->status == 0 ? 'btn-warning':'btn-success'}} edit-item-btn"
                                                        onclick="activeComment({{$comment->id}})">
                                                    {{$comment->status == 0 ? 'Inactive':'Active'}}
                                                </button>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex gap-2">
                                                <div class="btn btn-sm">
                                                    <button class="btn btn-sm btn-primary remove-item-btn" data-bs-toggle="modal" data-bs-target="#replyModal{{$comment->id}}">Trả lời</button>
                                                </div>
                                            </div>

                                            <form action="{{ route('comment.repcomment', ['id' => $comment->id]) }}" method="POST">
                                                @csrf
                                                <!-- Modal for reply -->
                                                <input type="hidden" name="comment_id" value="{{ $comment->id }}">
                                                <div class="modal fade" id="replyModal{{$comment->id}}" aria-hidden="true" aria-labelledby="replyModalLabel{{$comment->id}}" tabindex="-1">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h1 class="modal-title fs-5" id="replyModalLabel{{$comment->id}}">Trả lời</h1>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="mb-3">
                                                                    <label class="form-label">Nội dung trả lời</label>
                                                                    <input type="text" class="form-control" name="rep_comment" placeholder="Nhập nội dung trả lời">
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                                                                <button type="submit" class="btn btn-primary">Lưu</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="d-flex justify-content-end">
                            <div class="pagination-wrap hstack gap-2" style="display: flex;">
                                {{$comments->links()}}
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
