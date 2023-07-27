@extends('layouts.master')
@section('content')
    @if (Session::has('success'))
        <div class="alert alert-success">
            {{ Session::get('success') }}
        </div>
    @endif
    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <a href="javascript:void(0)" type="button" class="btn btn-success add-btn"><i
                                class="ri-add-line align-bottom me-1"></i>Thêm nhóm</a>
                    </div>
                    <div class="table-responsive table-card mt-3 mb-1">
                        <table class="table align-middle table-nowrap" id="customerTable">
                            <thead class="table-light">
                                <tr>
                                    <th>Stt</th>
                                    <th>Tên</th>
                                    <th>Thao tác</th>
                                </tr>
                            </thead>
                            <tbody class="list form-check-all">
                                @foreach ($permissions as $i => $permission)
                                    <tr>
                                        <td class="">{{ $i + 1 }}</td>
                                        <td class="">{{ $permission->id }}</td>
                                        <td class="">{{ $permission->name }}</td>
                                        <td>
                                            <div class="d-flex gap-2">
                                                <div class="detail">
                                                    <button class="btn btn-sm btn-success edit-item-btn"> <a
                                                            href="{{ route('slider.edit', $permission->id) }}">Edit</a></button>
                                                </div>
                                                <div class="remove">
                                                    <button onclick="deletesliders({{ $permission->id }})"
                                                        class="btn btn-sm btn-danger remove-item-btn">Remove</button>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <div class="listjs-table" id="customerList">
                        <div class="row g-4 mb-3">
                            <div class="col-sm">
                                <div class="d-flex justify-content-between">
                                    <a href="javascrip:void(0)" type="button" class="btn btn-success add-btn"><i
                                            class="ri-add-line align-bottom me-1"></i>
                                        Thêm quyền</a>
                                    <div class="search-box ms-2">
                                        <form action="{{ route('slider.list') }}" method="GET">
                                            <input type="text" class="form-control search" placeholder="Search..."
                                                name="search">
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
                                        <th>Tên</th>
                                        <th>Thao tác</th>
                                    </tr>
                                </thead>
                                <tbody class="list form-check-all">
                                    @foreach ($permissions as $i => $permission)
                                        <tr>
                                            <td class="">{{ $i + 1 }}</td>
                                            <td class="">{{ $permission->id }}</td>
                                            <td class="">{{ $permission->name }}</td>
                                            <td>
                                                <div class="d-flex gap-2">
                                                    <div class="detail">
                                                        <button class="btn btn-sm btn-success edit-item-btn"> <a
                                                                href="{{ route('slider.edit', $permission->id) }}">Edit</a></button>
                                                    </div>
                                                    <div class="remove">
                                                        <button onclick="deletesliders({{ $permission->id }})"
                                                            class="btn btn-sm btn-danger remove-item-btn">Remove</button>
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
                                {{ $permissions->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end col -->
        </div>
        <!-- end col -->
    </div>
@endsection
