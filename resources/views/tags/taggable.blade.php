@extends('layouts.master')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title mb-0">Quản lý taggable</h4>
            </div><!-- end card header -->
            <div class="card-body">
                <div class="listjs-table" id="customerList">
                    <div class="row g-4 mb-3">
                        <div class="col-sm-auto">
                            <div>
                                <button type="button" class="btn btn-success add-btn" data-bs-toggle="modal" id="create-btn" data-bs-target="#addTopic"><i class="ri-add-line align-bottom me-1"></i> Add</button>
                                <button class="btn btn-soft-danger" onclick="deleteMultiple()"><i class="ri-delete-bin-2-line"></i></button>
                            </div>
                        </div>
                        <div class="col-sm">
                            <div class="d-flex justify-content-sm-end">
                                <a href="{{route('show.taggable',$tag_id)}}"> <button class="rounded border-0 btn btn-warning">Danh sách</button></a>
                                <form method="post" action="{{route('show.taggable',$tag_id)}}">
                                    @csrf
                                    <div class="search-box ms-2">
                                        <input type="text" class="form-control search " name="search_taggable"
                                               placeholder="Search...">
                                        <i class="ri-search-line search-icon"></i>
                                    </div>

                                </form>

                            </div>
                        </div>
                    </div>
                    @if($search && $search != "")
                        <p style="padding-left: 40px;" class="fs-5">Kết quả tìm kiếm từ khóa"<strong class="text-danger">  {{$search}}  </strong>"</p>
                    @endif
                    <div class="table-responsive table-card mt-3 mb-1">
                        <table class="table align-middle table-nowrap" id="customerTaggable">
                            <thead class="table-light">
                                <tr>
                                    <th class="sort" >STT</th>
                                    <th class="sort" data-sort="customer_name">Tên thẻ</th>
                                    <th class="sort" data-sort="">Bài post/blog</th>
                                    <th class="sort" data-sort="tag_type">Loại thẻ</th>
                                    <th class="sort" data-sort="date">Ngày tạo</th>
                                    <th class="sort" data-sort="action">Lựa chọn</th>
                                </tr>
                            </thead>
                            <tbody class="list form-check-all">
                            @if (isset($taggables) && !empty($taggables))
                            @foreach($taggables as $key => $taggable)
                                <tr data-taggable-id="{{$taggable->id}}">
                                    <td >{{$key}}</td>
                                    <td  class="customer_name">{{$taggable->tag->name}}</td>
                                    <td class="course">Học lập trình website cần chuẩn bị gì?</td>
                                    <td class="tag_type">{{$taggable->taggable_type}}</td>
                                    <td class="date">{{$taggable->created_at}}</td>
                                    <td>
                                        <div class="d-flex gap-2">
                                            <div class="remove">
                                                <button class="btn btn-sm btn-danger remove-item-btn"  onclick="showDeleteTaggable({{$taggable->id}})">Remove</button>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            @endif
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
                        {{ $taggables->links() }}
                    </div>
                </div>
            </div><!-- end card -->
        </div>
        <!-- end col -->
    </div>
    <!-- end col -->
</div>

@endsection

