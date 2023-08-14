@extends('layouts.master')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Quản lý comment forum</h4>
                </div><!-- end card header -->
                <div class="card-body">
                    <div class="listjs-table" id="customerList">
                        <div class="row g-4 mb-3">
                            <div class="col-sm-auto">
                            </div>
                            <div class="col-sm">
                                <div class="d-flex justify-content-sm-end">
                                    <form method="post" action="{{route('show.forumCmt')}}">
                                        @csrf
                                        <div class="search-box ms-2">
                                            <input type="text" class="form-control search " name="search_forumCmt"
                                                   placeholder="Tìm kiếm...">
                                            <i class="ri-search-line search-icon"></i>
                                        </div>

                                    </form>

                                </div>
                            </div>
                        </div>
                        <div id="message-container">
                            @if(session('message'))
                                <div class="alert alert-success">{{ session('message') }}</div>
                            @endif
                        </div>

                        <div class="table-responsive table-card mt-3 mb-1">
                            <table class="table align-middle table-nowrap" id="forumCmtTable">
                                <thead class="table-light">
                                <tr>
                                    <th class="sort">STT</th>
                                    <th class="sort" data-sort="content">Nội dung</th>
                                    <th class="sort" data-sort="user">Người comment</th>
                                    <th class="sort" data-sort="">Thuộc bài post</th>
                                    <th class="sort" data-sort="">Trạng thái</th>
                                    <th class="sort" data-sort="">Cấp</th>
                                    <th class="sort" data-sort="">Ngày tạo</th>
                                    <th class="sort" data-sort="">Lựa chọn</th>
                                </tr>
                                </thead>
                                <tbody class="list form-check-all">
                                <!-- Trang hiện tại -->
                                @php
                                    $currentPage = $comments->currentPage();
                                    $perPage = $comments->perPage();
                                    $start = ($currentPage - 1) * $perPage + 1;
                                @endphp
                                    <!-- Sử dụng một vòng lặp để hiển thị các bản ghi người dùng -->
                                @foreach($comments as $key => $comment)
                                    <tr data-cmt-id="{{$comment->id}}">

                                        <td>{{$start + $key}}</td>
                                        <td class="content">{{$comment->content}}</td>
                                        <td class="user_id">{{$comment->user->name}}</td>
                                        <td class="post_id">{{$comment->post->title}}</td>
                                        <td class="active">{{$comment->is_active == 1 ? 'Active': 'Inactive'}}</td>
                                        <td class="parent_id">{{$comment->parent_id  ? 'Cấp 2':'Cấp 1'}}</td>
                                        <td class="created_at">{{$comment->created_at}}</td>
                                        <td>
                                            <div class="d-flex gap-2">
                                                <div class="remove">
                                                    <button class="btn btn-sm btn-warning remove-item-btn"
                                                            data-bs-toggle="modal" data-bs-target="#reply_{{$comment->id}}"
                                                            data-comment-id="{{$comment->id}}"
                                                            data-post-id="{{$comment->post_id}}">
                                                        Trả lời
                                                    </button>
                                                    <button class="btn btn-sm btn-danger remove-item-btn"
                                                            onclick="DeleteForumCmt({{$comment->id}})">
                                                        Xóa
                                                    </button>
                                                </div>
                                                <!-- ... -->
                                            </div>
                                        </td>
                                    </tr>
                                    <div class="modal fade" id="reply_{{$comment->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <form id="reply_form_{{$comment->id}}" action="{{route('reply.forumCmt')}}" method="post">
                                                @csrf
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Trả lời comment</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="tag-description-input mt-3">
                                                            <p>Nội dung phản hồi </p>
                                                            <input type="hidden" name="parent_id" value="{{$comment->id}}">
                                                            <input type="hidden" name="post_id" value="{{$comment->post_id}}">
                                                            <textarea id="cmt-content-input" cols="30" rows="12" class="form-control" name="content" placeholder="mô tả">{{ old('content') }}</textarea>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" id="cancel-button" class="btn btn-secondary" data-bs-dismiss="modal">Thoát</button>
                                                        <button type="submit" class="btn btn-primary">Trả lời</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                @endforeach

                                </tbody>
                            </table>
                            <div class="noresult" style="display: none">
                                <div class="text-center">
                                    <lord-icon src="https://cdn.lordicon.com/msoeawqm.json" trigger="loop"
                                               colors="primary:#121331,secondary:#08a88a"
                                               style="width:75px;height:75px"></lord-icon>
                                    <h5 class="mt-2">Sorry! No Result Found</h5>
                                    <p class="text-muted mb-0">We've searched more than 150+ Orders We did not find any
                                        orders for you search.</p>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end">
                            {{ $comments->links() }}
                        </div>
                    </div>
                </div><!-- end card -->
            </div>
            <!-- end col -->
        </div>
        <!-- end col -->
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const replyButtons = document.querySelectorAll('.remove-item-btn');

            replyButtons.forEach(button => {
                button.addEventListener('click', function () {
                    const commentId = this.getAttribute('data-comment-id');
                    const postId = this.getAttribute('data-post-id');

                    const form = document.getElementById(`reply_form_{{$comment->id}}`);
                    const parentIdInput = form.querySelector('[name="parent_id"]');
                    const postIdInput = form.querySelector('[name="post_id"]');

                    parentIdInput.value = commentId;
                    postIdInput.value = postId;
                });
            });
        });
    </script>

@endsection
