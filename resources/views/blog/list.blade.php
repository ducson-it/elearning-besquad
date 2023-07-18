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
                <h1>
                    <marquee class="text-danger">Quản lý blog</marquee>
                </h1>
            </div><!-- end card header -->
            <div class="card-body">
                <div class="listjs-table" id="customerList">
                    <div class="row g-4 mb-3">
                        <div class="col-sm-auto">
                            <div>
                                <button type="button" class="btn btn-success add-btn" data-bs-toggle="modal" id="create-btn" data-bs-target="#addTopic"><i class="ri-add-line align-bottom me-1"></i><a href="{{route('blogs.create')}}"> Add</a></button>
                                <button class="btn btn-soft-danger" onclick="deleteMultiple()"><i class="ri-delete-bin-2-line"></i></button>
                            </div>
                        </div>
                        <div class="col-sm">
                            <div class="d-flex justify-content-sm-end">
                                <div class="search-box ms-2">
                                        <input type="text"  class="form-control" placeholder="tìm kiếm" id="searchBlogInput">
                                    <i class="ri-search-line search-icon"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive table-card mt-3 mb-1">
                        <table class="table align-middle table-nowrap" id="BlogTable">
                            <thead class="table-light">
                                <tr>
                                    <th scope="col" style="width: 50px;">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="checkAll" value="option">
                                        </div>
                                    </th>
                                    <th class="" data-sort="customer_name">STT</th>
                                    <th class="" data-sort="customer_name">Title</th>
                                    <th class="" data-sort="course">Slug</th>
                                    <th class="" data-sort="status">Images</th>
                                    <th class="" data-sort="author">View</th>
                                    <th class="" data-sort="action">Tác giả</th>
                                    <th class="" data-sort="action">Category_blog</th>
                                    <th class="" data-sort="action">Thao tác</th>
                                </tr>
                            </thead>
                            <tbody class="list form-check-all">
                                @foreach($blogs as $i =>$blog)
                                <tr>
                                    <th scope="col" style="width: 50px;">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="checkAll" value="option">
                                        </div>
                                    </th>
                                    <td class="">{{$i +1}}</td>
                                    <td class="title">{{$blog->title}}</td>
                                    <td class="slug">{{$blog->slug}}</td>
                                    <td class="customer_name">
                                        <img src="{{$blog->image}}" alt="ảnh" width="80px" height="60px">
                                    </td>
                                    <td class="course">{{$blog->view}}</td>
                                    <td class="customer_name">{{$blog->user?->name}}</td>
                                    <td class="course">{{$blog->category?->name}}</td>
                                    <td>
                                        <div class="d-flex gap-2">
                                            <div class="detail">
                                                <button class="btn btn-sm btn-success edit-item-btn"> <a href="{{route('blogs.edit',$blog->id)}}">Edit</a></button>
                                            </div>
                                            <div class="remove">
                                                <button onclick="event.preventDefault(); deleteblogs({{ $blog->id }})" class="btn btn-sm btn-danger remove-item-btn">Remove</button>
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
                            {{$blogs->links()}}
                        </div>
                    </div>

                </div>
            </div><!-- end card -->
        </div>
        <!-- end col -->
    </div>
    <!-- end col -->
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/list.js/2.3.1/list.min.js"></script>
    <script>
        //search
        // Khởi tạo List.js và cấu hình tìm kiếm
        const options = {
            valueNames: ['title', 'content', 'description_short'], // Các trường dữ liệu để tìm kiếm
        };
        const customerList = new List('BlogTable', options);

        // Lắng nghe sự kiện nhập liệu trong ô tìm kiếm
        document.addEventListener('DOMContentLoaded', function () {
            const searchInput = document.getElementById('searchBlogInput');
            searchInput.addEventListener('keyup', function () {
                const searchString = searchInput.value;
                customerList.search(searchString);
            });
        });
    </script>
@endsection
