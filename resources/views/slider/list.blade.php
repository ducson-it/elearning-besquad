@extends('layouts.master')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Quản lý slider</h4>
                </div><!-- end card header -->
                <div class="card-body">
                    <div class="listjs-table" id="customerList">
                        <div class="row g-4 mb-3">
                            <div class="col-sm-auto">
                                <div>
                                    <button type="button" class="btn btn-success add-btn"><i class="ri-add-line align-bottom me-1"></i> <a href="{{route('user.create')}}"> Add</a></button>
                                    <button class="btn btn-soft-danger" onclick="deleteMultiple()"><i class="ri-delete-bin-2-line"></i></button>
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
                                            <input class="form-check-input" type="checkbox" id="checkAll" value="option">
                                        </div>
                                    </th>
                                    <th>Stt</th>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Content</th>
                                    <th>Text Color</th>
                                    <th>Url_btn</th>
                                    <th>Content_btn</th>
                                    <th>Image</th>
                                    <th>Status</th>
                                    <th>Ngày tạo</th>
                                    <th>Thao tác</th>
                                </tr>
                                </thead>
                                <tbody class="list form-check-all">
                                @foreach($sliders as $i => $slider )
                                    <tr>
                                        <th scope="row">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="chk_child" value="option1">
                                            </div>
                                        </th>
                                        <td class="">{{$i+1}}</td>
                                        <td class="">{{$slider->id}}</td>
                                        <td class="">{{$slider->name}}</td>
                                        <td class="">{{$slider->content}}</td>
                                        <td class="">{{$slider->text_color}}</td>
                                        <td class="">{{$slider->url_btn}}</td>
                                        <td class="">{{$slider->content_btn}}</td>
                                        <td class="">
                                            <img style="width:80px; height:60px"  alt="ảnh">
                                        </td>
                                        <td class="">{{$slider->status}}</td>
                                        <td class="">{{$slider->created_at}}</td>
                                        <td>
                                            <div class="d-flex gap-2">
                                                <div class="detail">
                                                    <button class="btn btn-sm btn-success edit-item-btn"> <a href="{{route('slider.update',$slider->id)}}">Edit</a></button>
                                                </div>
                                                <div class="remove">
                                                    <button class="btn btn-sm btn-danger remove-item-btn" data-bs-toggle="modal" data-bs-target="#deleteRecordModal">Remove</button>
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

                        <div class="d-flex justify-content-end">
                            <div class="pagination-wrap hstack gap-2" style="display: flex;">
                                <a class="page-item pagination-prev disabled" href="javascrpit:void(0)">
                                    Previous
                                </a>
                                <ul class="pagination listjs-pagination mb-0"><li class="active"><a class="page" href="#" data-i="1" data-page="8">1</a></li><li><a class="page" href="#" data-i="2" data-page="8">2</a></li></ul>
                                <a class="page-item pagination-next" href="javascrpit:void(0)">
                                    Next
                                </a>
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