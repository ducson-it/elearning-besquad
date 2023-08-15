
@extends('layouts.master')
@section('content')

    <div class="row" xmlns="">
        @if (Session::has('success'))
            <div class="alert alert-success">
                {{ Session::get('success') }}
            </div>
        @endif
        <div class="col-lg-10">
            <div class="card">
                <div class="card-header">
{{--                    <?php--}}
{{--                    dd($tagsforum);--}}
{{--                    ?>--}}
                    <h3>Quản lý thẻ tag</h3>
                </div><!-- end card header -->
                <div class="card-body">
                    <div class="listjs-table" id="customerList">
                        <div class="row g-4 mb-3">
                            <div>
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@getbootstrap">Add</button>
                                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <form action="{{ route('tagsforum.store') }}" method="POST">
                                                @csrf
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Thêm thẻ tags</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <label for="recipient-name" class="col-form-label">Tên</label>
                                                        <input type="text" class="form-control" name="name">
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Đóng</button>
                                                    <button type="submit" class="btn btn-primary">Lưu</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive table-card mt-3 mb-1">
                            <table class="table align-middle table-nowrap" id="BlogTable">
                                <thead class="table-light">
                                <tr>
                                    <th class="" data-sort="customer_name">STT</th>
                                    <th class="" data-sort="customer_name">Tên thẻ tag</th>
                                    <th class="" data-sort="action">Thao tác</th>
                                </tr>
                                </thead>
                                <tbody class="list form-check-all">
                                @foreach($tagsforum as $i =>$iteam)
                                    <tr>
                                        <td class="">{{$i +1}}</td>
                                        <td class="title">{{$iteam->name}}</td>
                                        <td>
                                            <div class="d-flex gap-2">
                                                    <div class="d-flex gap-2">
                                                        <div class="detail">
                                                            <!-- Button trigger modal -->
                                                            <form action="{{ route('tagsforum.update',$iteam->id) }}" method="POST">
                                                                @csrf
                                                                <button type="button" class="btn btn-sm btn-success edit-item-btn" data-bs-toggle="modal" data-bs-target="#staticBackdrop{{$iteam->id}}">
                                                                    Sửa
                                                                </button>
                                                                <div class="modal fade" id="staticBackdrop{{$iteam->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                                                    <div class="modal-dialog">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h1 class="modal-title fs-5" id="staticBackdropLabel">Sửa tags</h1>
                                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                <div class="mb-3">
                                                                                    <label for="recipient-name" class="col-form-label">Tên</label>
                                                                                    <input type="text" class="form-control" name="name" value="{{$iteam->name}}">
                                                                                </div>
                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                                                                                <button type="submit" class="btn btn-primary">Sửa</button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                        <div class="remove">
                                                            <button onclick="deletecTagsforum({{ $iteam->id }})" class="btn btn-sm btn-danger remove-item-btn">Xóa</button>
                                                        </div>
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
                                {{$tagsforum->links()}}
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
