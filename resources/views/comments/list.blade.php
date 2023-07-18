@extends('layouts.master')
@section('content')
    @if (Session::has('success'))
        <div class="alert alert-success">
            {{ Session::get('success') }}
        </div>
    @endif
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h1>
                        <marquee class="text-danger">Quản lý Comment</marquee>
                    </h1>
                </div><!-- end card header -->
                <div class="card-body">
                    <div class="listjs-table" id="customerList">
                        <div class="row g-4 mb-3">
                            <div class="col-sm-auto">
                                <div>
                                    <button type="button" class="btn btn-success add-btn" data-bs-toggle="modal" id="create-btn" data-bs-target="#addTopic"><a href="{{route('comment.create')}}"> Add</a></button>
                                    <button type="button" class="btn btn-primary"><a style="color: white" href="{{ route('comment.list') }}">Danh sách</a></button>
                                </div>
                            </div>
                            <div class="col-sm">
                                <div class="d-flex justify-content-sm-end">
                                    <div class="search-box ms-2">
                                        <form action="{{ route('comment.list') }}" method="GET">
                                            <input type="text" class="form-control search" placeholder="Search..." name="search">
                                        </form>
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
                                            <input class="form-check-input" type="checkbox" id="checkAll" value="option">
                                        </div>
                                    </th>
                                    <th class="" data-sort="customer_name">STT</th>
                                    <th class="" data-sort="customer_name"> Người comment</th>
                                    <th class="" data-sort="course">Content</th>
                                    <th class="" data-sort="course">Status</th>
                                    <th class="" data-sort="course">Thuộc bài viết  </th>
                                    <th class="" data-sort="course">Thuộc danh mục</th>
                                    <th class="" data-sort="action">Thao tác</th>
                                </tr>
                                </thead>
                                <tbody class="list form-check-all">
                                @foreach($comments as $i =>$comment)
                                    <tr>
                                        <th scope="col" style="width: 50px;">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="checkAll" value="option">
                                            </div>
                                        </th>
                                        <td class="customer_name">{{$i +1}}</td>
                                        <td class="customer_name">{{$comment->user?->name}}</td>
                                        <td class="course">{{$comment->content}}</td>
                                        <td class="course">
                                            @if($comment->status == 0)
                                                <p style="color:orange; margin-top: 15px">Inactive</p>
                                            @else
                                                <p style="color:green; margin-top: 15px">Active</p>
                                            @endif
                                        </td>
                                        <td class="course">{{$comment->commentable_id}}
                                        </td>
                                        <td class="course">{{$comment->commentable_type}}
                                        </td>
                                        <td>
                                            <div class="d-flex gap-2">
                                                <div class="detail">
                                                    <button class="btn btn-sm btn-success edit-item-btn"> <a href="{{route('comment.edit',$comment->id)}}">Edit</a></button>
                                                </div>
                                                <div class="remove">
                                                    <button onclick="event.preventDefault(); deletecomment({{ $comment->id }})" class="btn btn-sm btn-danger remove-item-btn">Remove</button>
                                                </div>
                                            </div>
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
