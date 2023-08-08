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
                                                   placeholder="Search...">
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
                                        <td class="created_at">{{$comment->created_at}}</td>
                                        <td>
                                            <div class="d-flex gap-2">
                                                <div class="remove">
                                                    <button class="btn btn-sm btn-danger remove-item-btn"
                                                            onclick="DeleteForumCmt({{$comment->id}})">
                                                        Remove
                                                    </button>
                                                </div>
                                                <div class="detail">
                                                    <button onclick="activeForumCmt({{$comment->id}})"
                                                            class="btn btn-sm  edit-item-btn <?= $comment->is_active == 0 ? 'btn-success' : 'btn-primary'?>">
                                                            <?= $comment->is_active == 0 ? 'Active' : 'Inactive' ?>
                                                    </button>
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
                                               colors="primary:#121331,secondary:#08a88a"
                                               style="width:75px;height:75px"></lord-icon>
                                    <h5 class="mt-2">Sorry! No Result Found</h5>
                                    <p class="text-muted mb-0">We've searched more than 150+ Orders We did not find any
                                        orders for you search.</p>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-start">
                            {{ $comments->links() }}
                        </div>
                    </div>
                </div><!-- end card -->
            </div>
            <!-- end col -->
        </div>
        <!-- end col -->
    </div>
@endsection
