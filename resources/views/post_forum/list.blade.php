@extends('layouts.master')
@section('content')

    <div class="row" xmlns="">
        @if (Session::has('success'))
            <div class="alert alert-success">
                {{ Session::get('success') }}
            </div>
        @endif
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h3>Quản lý bài viết diễn đàn</h3>
                </div><!-- end card header -->
                <div class="card-body">
                    <div class="listjs-table" id="customerList">
                        <div class="row g-4 mb-3">
                            <div>
                                <button class="btn btn-primary"><a href="{{route('forum.create')}}" style="color:white"> Add</a></button>
                            </div>
                            <div class="col-sm">
                                <div class="d-flex justify-content-sm-end">
                                    <div class="search-box ms-2">
                                        <form action="{{ route('forum.list') }}" method="GET">
                                            <input type="text" class="form-control search" placeholder="Tìm kiếm..." name="search">
                                            <i class="ri-search-line search-icon"></i>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive table-card mt-3 mb-1">
                            <table class="table align-middle table-nowrap" id="BlogTable">
                                <thead class="table-light">
                                <tr>
                                    <th class="" data-sort="customer_name">STT</th>
                                    <th class="" data-sort="customer_name">Title</th>
                                    <th class="" data-sort="author">View</th>
                                    <th class="" data-sort="action">Người viết</th>
                                    <th class="" data-sort="action">Số sao</th>
                                    <th class="" data-sort="action">Thuộc danh mục</th>
                                    <th class="" data-sort="action">Kiểu post</th>
                                    <th class="" data-sort="action">Thao tác</th>
                                    <th class="" data-sort="action">Trạng thái</th>

                                </tr>
                                </thead>
                                <tbody class="list form-check-all">
                                @foreach($forumposts as $i =>$iteam)
                                    <tr>
                                        <td class="">{{$i +1}}</td>
                                        <td class="title">{{$iteam->title}}</td>
                                        <td class="course">{{$iteam->view}}</td>
                                        <td class="customer_name">{{$iteam->user?->name}}</td>
                                        <td class="course">{{$iteam->star}}</td>
                                        <td class="course">{{$iteam->category?->name}}</td>
                                        <td class="course">
                                            @if ($iteam->type == 1)
                                                Thắc mắc
                                            @elseif ($iteam->type == 2)
                                                Câu hỏi
                                            @elseif ($iteam->type == 3)
                                                Thảo luận
                                            @elseif ($iteam->type == 4)
                                                Giải trí
                                            @endif
                                        </td>
                                        <td>
                                            <div class="d-flex gap-2">
                                                <div class="detail">
                                                    <button class="btn btn-sm btn-success edit-item-btn"> <a href="{{route('forum.edit',$iteam->id)}}">Edit</a></button>
                                                </div>
                                                <div class="remove">
                                                    <button onclick="event.preventDefault(); deletepostForum({{ $iteam->id }})" class="btn btn-sm btn-danger remove-item-btn">Remove</button>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="course">
                                            <button class="btn btn-sm {{$iteam->is_active == 0 ? 'btn-warning':'btn-success'}} edit-item-btn"
                                                    onclick="active({{$iteam->id}})">
                                                {{$iteam->is_active == 0 ? 'Inactive':'Active'}}
                                            </button>
                                            </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="d-flex justify-content-end">
                            <div class="pagination-wrap hstack gap-2" style="display: flex;">
                                {{$forumposts->links()}}
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
