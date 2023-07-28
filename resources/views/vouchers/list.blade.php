@extends('layouts.master')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Quản lý Voucher</h4>
                </div><!-- end card header -->
                <div class="card-body">
                    <div class="listjs-table" id="customerList">
                        <div class="row g-4 mb-3">
                            <div class="col-sm-auto">
                                <div>
                                    <a
                                        href="{{route('add.voucher')}}">
                                        <button type="button" class="btn btn-success add-btn"><i
                                                class="ri-add-line align-bottom me-1"></i> Add
                                        </button>
                                    </a>
                                </div>
                            </div>
                            <div class="col-sm">
                                <div class="d-flex justify-content-sm-end">
                                    <form method="post" action="{{route('show.voucher')}}">
                                        @csrf
                                        <div class="search-box ms-2">
                                            <input type="text" class="form-control search " name="search_voucher"
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
                            <table class="table align-middle table-nowrap" id="">
                                <thead class="table-light">
                                <tr>
                                    <th class="sort">STT</th>
                                    <th class="sort" data-sort="customer_name">Tên</th>
                                    <th class="sort" data-sort="course"> Mã code</th>
                                    <th class="sort" data-sort="action">Giảm giá</th>
                                    <th class="sort" data-sort="action">Đơn vị</th>
                                    <th class="sort" data-sort="action">Giới hạn sử dụng</th>
                                    <th class="sort" data-sort="action">Ngày tạo</th>
                                    <th class="sort" data-sort="action">Ngày hết hạn</th>
                                    <th class="sort" data-sort="action">Lựa chọn</th>
                                </tr>
                                </thead>
                                <tbody class="list form-check-all">
                                <!-- Trang hiện tại -->
                                @php
                                    $currentPage = $list_vouchers->currentPage();
                                    $perPage = $list_vouchers->perPage();
                                    $start = ($currentPage - 1) * $perPage + 1;
                                @endphp
                                    <!-- Sử dụng một vòng lặp để hiển thị các bản ghi người dùng -->
                                @foreach($list_vouchers as $key => $voucher)
                                    <tr data-voucher-id="{{$voucher->id}}">
                                        <td>{{$start + $key}}</td>
                                        <td class="name">{{$voucher->name}}</td>
                                        <td class="code">{{$voucher->code}}</td>
                                        <td class="value">{{$voucher->value}}</td>
                                        <td class="unit"><?= $voucher->unit == 'Percent' ? '%':  'Vnd' ?></td>
                                        <td class="quantity"><?= $voucher->is_infinite == true ? 'Vô hạn' : '1 lần'  ?></td>
                                        <td class="created_at">{{$voucher->created_at}}</td>
                                        <td class="expired">{{$voucher->expired}}</td>
                                        <td>
                                            <div class="d-flex gap-2">
                                                <div class="detail">
                                                    <a href="{{route('edit.voucher',$voucher->id)}}">
                                                        <button class="btn btn-sm btn-warning edit-item-btn">Edit
                                                        </button>
                                                    </a>
                                                </div>
                                                <div class="remove">
                                                    <button class="btn btn-sm btn-danger remove-item-btn"
                                                            onclick="DeleteVoucher({{$voucher->id}})">
                                                        Remove
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

                        <div class="d-flex justify-content-end">
                            {{ $list_vouchers->links() }}
                        </div>
                    </div>
                </div><!-- end card -->
            </div>
            <!-- end col -->
        </div>
        <!-- end col -->
    </div>

@endsection
