@extends('layouts.master')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    @if ($message = Session::get('message'))
                        <p class="message" style="color: rgb(17, 186, 9); margin-left:20px"><i class="fa-solid fa-check"></i>
                            {{ $message }}</p>
                    @endif
                    <h4 class="card-title mb-0">Quản lý orders</h4>
                </div><!-- end card header -->
                <div class="card-body">
                    <div class="listjs-table" id="customerList">
                        <div class="row g-4 mb-3">
                            <div class="col-sm-auto">
                                <div>
                                    <button type="button" class="btn btn-success add-btn"><i
                                        class="ri-add-line align-bottom me-1"></i> <a
                                        href="{{ route('orders.create') }}">Add</a></button>
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
                                            STT
                                        </th>
                                        <th class="sort" data-sort="customer_name">Mã order</th>
                                        <th class="sort" data-sort="price">User</th>
                                        <th class="sort" data-sort="price-discount">Khoá học</th>
                                        <th class="sort" data-sort="status">Trạng thái</th>
                                        <th class="sort" data-sort="price-discount">Tổng giá</th>
                                        <th class="sort" data-sort="date">Ngày tạo</th>
                                        <th class="sort d-flex justify-content-center" data-sort="action">Lựa chọn</th>
                                    </tr>
                                </thead>
                                <tbody class="list form-check-all" id="course-content-list">
                                    @foreach ($orders as $index=>$order)
                                        <tr>
                                            <th scope="row">
                                                {{$index+1}}
                                            </th>
                                            <td class="customer_name">{{ $order->order_code }}</td>
                                            <td class="course-price">{{ $order->user->name }}</td>
                                            <td class="price-discount">{{ $order->course->name }}</td>
                                            <td class="status"><span
                                                    class="badge badge-soft-success text-uppercase {{ ($order->status == 1) ? 'text-success' : (($order->status == 2)?'text-danger':'text-warning') }}">{{ ($order->status == 1) ? 'Payment' : (($order->status == 2)?'Canceled':'Pending') }}</span>
                                            </td>
                                            <td class="price-discount">{{ number_format($order->amount, 0, ',', '.') }}</td>
                                            <td class="date">{{$order->created_at}}</td>
                                            <td class="d-flex justify-content-center">
                                                <div class="d-flex gap-2">
                                                    <div class="edit">
                                                        <button class="btn btn-sm btn-info edit-item-btn"><a
                                                                href="{{ route('orders.detail', $order->id) }}" class="text-light">Detail</a></button>
                                                                
                                                    </div>
                                                    @if ($order->status == 0)
                                                    <div class="active">
                                                        <button class="btn btn-sm btn-success"
                                                            onclick="PaymentVerify({{$order->id}},1)">Payment</button>
                                                    </div>
                                                    <div class="inactive">
                                                        <button class="btn btn-sm btn-danger remove-item-btn"
                                                            onclick="PaymentVerify({{$order->id}},2)">Cancel</button>
                                                    </div>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                            <div class="noresult" style="display: none">
                                <div class="text-center">
                                    <lord-icon src="https://cdn.lordicon.com/msoeawqm.json" trigger="loop"
                                        colors="primary:#121331,secondary:#08a88a" style="width:75px;height:75px">
                                    </lord-icon>
                                    <h5 class="mt-2">Sorry! No Result Found</h5>
                                    <p class="text-muted mb-0">We've searched more than 150+ Orders We did not find any
                                        orders for you search.</p>
                                </div>
                            </div>
                        </div>

                        {{$orders->links()}}
                    </div>
                </div><!-- end card -->
            </div>
            <!-- end col -->
        </div>
        <!-- end col -->
    </div>
@endsection
