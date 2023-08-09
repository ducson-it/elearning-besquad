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
                    <h3>Quản lý sliders</h3>
                </div><!-- end card header -->
                <div class="card-body">
                    <div class="listjs-table" id="customerList">
                        <div class="row g-4 mb-3">
                            <div class="col-sm-auto">
                                <div>
                                    <button class="btn btn-primary"><a href="{{route('slider.create')}}" style="color:white"> Add</a></button>
                                </div>
                            </div>
                            <div class="col-sm">
                                <div class="d-flex justify-content-sm-end">
                                    <div class="search-box ms-2">
                                        <form action="{{ route('slider.list') }}" method="GET">
                                            <input type="text" class="form-control search" placeholder="Search..." name="search">
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
                                    <th>Stt</th>
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
                                        <td class="">{{$i+1}}</td>
                                        <td class="">{{$slider->name}}</td>
                                        <td class="">{{$slider->content}}</td>
                                        <td class="">{{$slider->text_color}}</td>
                                        <td class="">{{$slider->url_btn}}</td>
                                        <td class="">{{$slider->content_btn}}</td>
                                        <td class="">
                                            <img src="{{$slider->image}}" alt="ảnh" width="80px" height="60px">
                                        </td>
                                        <td class="">{{$slider->status}}</td>
                                        <td class="">{{$slider->created_at}}</td>
                                        <td>
                                            <div class="d-flex gap-2">
                                                <div class="detail">
                                                    <button class="btn btn-sm btn-success edit-item-btn"> <a href="{{route('slider.edit',$slider->id)}}">Edit</a></button>
                                                </div>
                                                <div class="remove">
                                                    <button onclick="deletesliders({{ $slider->id }})" class="btn btn-sm btn-danger remove-item-btn">Remove</button>
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
                                {{$sliders->links()}}
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
