@extends('layouts.master')
@section('content')
    <div class="row">
        <div class="col">

            <div class="h-100">
                <div class="row mb-3 pb-1">
                    <div class="col-12">
                        <div class="d-flex align-items-lg-center flex-lg-row flex-column">
                            <div class="flex-grow-1">
                                <h4 class="fs-16 mb-1">Chào buổi sáng, {{Auth::user()->name}}!</h4>
                                <p class="text-muted mb-0">Chúc bạn có một ngày làm việc hiệu quả và may mắn!</p>
                            </div>
                            <div class="mt-3 mt-lg-0">
                                <form action="javascript:void(0);">
                                    <div class="row g-3 mb-0 align-items-center">
                                        <!--end col-->
                                        <div class="col-auto">
                                            <button type="button" class="btn btn-soft-success"><i
                                                    class="ri-add-circle-line align-middle me-1"></i> Thêm khoá học</button>
                                        </div>
                                        <!--end col-->
                                        <div class="col-auto">
                                            <button type="button"
                                                class="btn btn-soft-info btn-icon waves-effect waves-light layout-rightside-btn"><i
                                                    class="ri-pulse-line"></i></button>
                                        </div>
                                        <!--end col-->
                                    </div>
                                    <!--end row-->
                                </form>
                            </div>
                        </div><!-- end card header -->
                    </div>
                    <!--end col-->
                </div>
                <!--end row-->

                <div class="row">
                    <div class="col-xl-3 col-md-6">
                        <!-- card -->
                        <div class="card card-animate">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="flex-grow-1 overflow-hidden">
                                        <p class="text-uppercase fw-medium text-muted text-truncate mb-0"> Doanh thu
                                        </p>
                                    </div>
                                    <div class="flex-shrink-0">
                                        <h5 class="text-success fs-14 mb-0">
                                        </h5>
                                    </div>
                                </div>
                                <div class="d-flex align-items-end justify-content-between mt-4">
                                    <div>
                                        <h4 class="fs-22 fw-semibold ff-secondary mb-4"><span class="counter-value"
                                                data-target="559.25">{{ number_format($total_earning_day, 0, ',', '.') }}</span>Đ</h4>
                                        <a href="" class="text-decoration-underline">View net earnings</a>
                                    </div>
                                    <div class="avatar-sm flex-shrink-0">
                                        <span class="avatar-title bg-success-subtle rounded fs-3">
                                            <i class="bx bx-dollar-circle text-success"></i>
                                        </span>
                                    </div>
                                </div>
                            </div><!-- end card body -->
                        </div><!-- end card -->
                    </div><!-- end col -->

                    <div class="col-xl-3 col-md-6">
                        <!-- card -->
                        <div class="card card-animate">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="flex-grow-1 overflow-hidden">
                                        <p class="text-uppercase fw-medium text-muted text-truncate mb-0">Đơn hàng</p>
                                    </div>
                                    <div class="flex-shrink-0">
                                        @if ($order_growth_rate >= 0)
                                        <h5 class="text-success fs-14 mb-0">
                                            <i class="ri-arrow-right-up-line fs-13 align-middle"></i> +{{$order_growth_rate}} %
                                        </h5>
                                        @else
                                        <h5 class="text-danger fs-14 mb-0">
                                            <i class="ri-arrow-right-down-line fs-13 align-middle"></i> {{$order_growth_rate}} %
                                        </h5>
                                        @endif

                                    </div>
                                </div>
                                <div class="d-flex align-items-end justify-content-between mt-4">
                                    <div>
                                        <h4 class="fs-22 fw-semibold ff-secondary mb-4"><span class="counter-value"
                                                data-target="36894">{{$order_count_day}}</span></h4>
                                        <a href="{{route('orders.list')}}" class="text-decoration-underline">Xem tất cả</a>
                                    </div>
                                    <div class="avatar-sm flex-shrink-0">
                                        <span class="avatar-title bg-info-subtle rounded fs-3">
                                            <i class="bx bx-shopping-bag text-info"></i>
                                        </span>
                                    </div>
                                </div>
                            </div><!-- end card body -->
                        </div><!-- end card -->
                    </div><!-- end col -->

                    <div class="col-xl-3 col-md-6">
                        <!-- card -->
                        <div class="card card-animate">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="flex-grow-1 overflow-hidden">
                                        <p class="text-uppercase fw-medium text-muted text-truncate mb-0">Người dùng</p>
                                    </div>
                                    <div class="flex-shrink-0">
                                        @if ($users_growth_rate >= 0)
                                        <h5 class="text-success fs-14 mb-0">
                                            <i class="ri-arrow-right-up-line fs-13 align-middle"></i> +{{$users_growth_rate}} %
                                        </h5>
                                        @else
                                        <h5 class="text-danger fs-14 mb-0">
                                            <i class="ri-arrow-right-down-line fs-13 align-middle"></i> {{$users_growth_rate}} %
                                        </h5>
                                        @endif
                                    </div>
                                </div>
                                <div class="d-flex align-items-end justify-content-between mt-4">
                                    <div>
                                        <h4 class="fs-22 fw-semibold ff-secondary mb-4"><span class="counter-value"
                                                data-target="183.35">{{$users_count_day}}</span></h4>
                                        <a href="{{route('show.user')}}" class="text-decoration-underline">Xem tất cả</a>
                                    </div>
                                    <div class="avatar-sm flex-shrink-0">
                                        <span class="avatar-title bg-warning-subtle rounded fs-3">
                                            <i class="bx bx-user-circle text-warning"></i>
                                        </span>
                                    </div>
                                </div>
                            </div><!-- end card body -->
                        </div><!-- end card -->
                    </div><!-- end col -->

                    <div class="col-xl-3 col-md-6">
                        <!-- card -->
                        <div class="card card-animate">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="flex-grow-1 overflow-hidden">
                                        <p class="text-uppercase fw-medium text-muted text-truncate mb-0"> Khoá học</p>
                                    </div>
                                    <div class="flex-shrink-0">
                                        <h5 class="text-muted fs-14 mb-0">
                                            +0.00 %
                                        </h5>
                                    </div>
                                </div>
                                <div class="d-flex align-items-end justify-content-between mt-4">
                                    <div>
                                        <h4 class="fs-22 fw-semibold ff-secondary mb-4">$<span class="counter-value"
                                                data-target="165.89">165.89</span>k </h4>
                                        <a href="{{route('courses.list')}}" class="text-decoration-underline">Xem tất cả</a>
                                    </div>
                                    <div class="avatar-sm flex-shrink-0">
                                        <span class="avatar-title bg-primary-subtle rounded fs-3">
                                            <i class="bx bx-wallet text-primary"></i>
                                        </span>
                                    </div>
                                </div>
                            </div><!-- end card body -->
                        </div><!-- end card -->
                    </div><!-- end col -->
                </div> <!-- end row-->

                {{-- chart --}}
                <div>
                    <div class="card">
                        <div class="card-header border-0 align-items-center d-flex">
                            <h4 class="card-title mb-0 flex-grow-1">Kết quả kinh doanh</h4>
                            <div>
                                <button type="button" class="btn btn-soft-secondary btn-sm">
                                    ALL
                                </button>
                                <button type="button" class="btn btn-soft-secondary btn-sm">
                                    1 tháng
                                </button>
                                <button type="button" class="btn btn-soft-secondary btn-sm">
                                    6 tháng
                                </button>
                                <button type="button" class="btn btn-soft-primary btn-sm">
                                    1 năm
                                </button>
                            </div>
                        </div><!-- end card header -->

                        <div class="card-header p-0 border-0 bg-light-subtle">
                            <div class="row g-0 text-center">
                                <div class="col-6 col-sm-3">
                                    <div class="p-3 border border-dashed border-start-0">
                                        <h5 class="mb-1"><span class="counter-value" data-target="7585">7,585</span>
                                        </h5>
                                        <p class="text-muted mb-0">Đơn hàng</p>
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-6 col-sm-3">
                                    <div class="p-3 border border-dashed border-start-0">
                                        <h5 class="mb-1">$<span class="counter-value" data-target="22.89">22.89</span>k
                                        </h5>
                                        <p class="text-muted mb-0">Doanh thu</p>
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-6 col-sm-3">
                                    <div class="p-3 border border-dashed border-start-0">
                                        <h5 class="mb-1"><span class="counter-value" data-target="367">367</span>
                                        </h5>
                                        <p class="text-muted mb-0">Huỷ bỏ</p>
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-6 col-sm-3">
                                    <div class="p-3 border border-dashed border-start-0 border-end-0">
                                        <h5 class="mb-1 text-success"><span class="counter-value"
                                                data-target="18.92">18.92</span>%</h5>
                                        <p class="text-muted mb-0">Tỷ lệ chuyển đổi</p>
                                    </div>
                                </div>
                                <!--end col-->
                            </div>
                        </div><!-- end card header -->

                        <div class="card-body">
                        </div><!-- end card body -->
                    </div><!-- end card -->
                </div>
                <!-- end col -->
                <div>
                    <div class="card">
                        <div class="card-header align-items-center d-flex">
                            <h4 class="card-title mb-0 flex-grow-1">Top 5 khoá học bán chạy nhất</h4>
                            <div class="flex-shrink-0">
                                <div class="dropdown card-header-dropdown">
                                    <a class="text-reset dropdown-btn" href="#" data-bs-toggle="dropdown"
                                        aria-haspopup="true" aria-expanded="false">
                                        <span class="fw-semibold text-uppercase fs-12">Sort by:
                                        </span><span class="text-muted">Today<i
                                                class="mdi mdi-chevron-down ms-1"></i></span>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-end">
                                        <a class="dropdown-item" href="#">Today</a>
                                        <a class="dropdown-item" href="#">Yesterday</a>
                                        <a class="dropdown-item" href="#">Last 7 Days</a>
                                        <a class="dropdown-item" href="#">Last 30 Days</a>
                                        <a class="dropdown-item" href="#">This Month</a>
                                        <a class="dropdown-item" href="#">Last Month</a>
                                    </div>
                                </div>
                            </div>
                        </div><!-- end card header -->

                        <div class="card-body">
                            <div class="table-responsive table-card">
                                <table class="table table-hover table-centered align-middle table-nowrap mb-0">
                                    <tbody>
                                        @for ($i = 0; $i < 5; $i++)
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="avatar-sm bg-light rounded p-1 me-2">
                                                        <img src="assets/images/products/img-1.png" alt=""
                                                            class="img-fluid d-block">
                                                    </div>
                                                    <div>
                                                        <h5 class="fs-14 my-1"><a
                                                                href="apps-ecommerce-product-details.html"
                                                                class="text-reset">Branded T-Shirts</a></h5>
                                                        <span class="text-muted">24 Apr 2021</span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <h5 class="fs-14 my-1 fw-normal">$29.00</h5>
                                                <span class="text-muted">Giá</span>
                                            </td>
                                            <td>
                                                <h5 class="fs-14 my-1 fw-normal">62</h5>
                                                <span class="text-muted">Đơn hàng</span>
                                            </td>
                                            <td>
                                                <h5 class="fs-14 my-1 fw-normal">$1,798</h5>
                                                <span class="text-muted">Tổng doanh thu</span>
                                            </td>
                                        </tr>
                                        @endfor
                                    </tbody>
                                </table>
                            </div>

                            <div
                                class="align-items-center mt-4 pt-2 justify-content-between row text-center text-sm-start">
                                <div class="col-sm">
                                </div>
                                <div class="col-sm-auto  mt-3 mt-sm-0">
                                    <a href="">Xem tất cả</a>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-12">
                        <div class="card">
                            <div class="card-header align-items-center d-flex">
                                <h4 class="card-title mb-0 flex-grow-1">Đơn hàng gần đây</h4>
                                <div class="flex-shrink-0">
                                    <button type="button" class="btn btn-soft-info btn-sm">
                                        <i class="ri-file-list-3-line align-middle"></i> Generate Report
                                    </button>
                                </div>
                            </div><!-- end card header -->

                            <div class="card-body">
                                <div class="table-responsive table-card">
                                    <table class="table table-borderless table-centered align-middle table-nowrap mb-0">
                                        <thead class="text-muted table-light">
                                            <tr>
                                                <th scope="col">Mã đơn hàng</th>
                                                <th scope="col">User</th>
                                                <th scope="col">Khoá học</th>
                                                <th scope="col">Giá</th>
                                                <th scope="col">Tổng tiền</th>
                                                <th scope="col">Status</th>
                                                <th scope="col">Ngày tạo</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($recent_orders as $recent_order)
                                            <tr>
                                                <td>
                                                    <a href="apps-ecommerce-order-details.html"
                                                        class="fw-medium link-primary">{{$recent_order->order_code}}</a>
                                                </td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="flex-shrink-0 me-2">
                                                            <img src="assets/images/users/avatar-1.jpg" alt=""
                                                                class="avatar-xs rounded-circle">
                                                        </div>
                                                        <div class="flex-grow-1">{{$recent_order->user->name}}</div>
                                                    </div>
                                                </td>
                                                <td>{{$recent_order->course->name}}</td>
                                                <td>{{ number_format($recent_order->course->price, 0, ',', '.')}}</td>
                                                <td>
                                                    <span class="text-success">{{number_format($recent_order->amount, 0, ',', '.')}}</span>
                                                </td>
                                                
                                                <td class="status"><span
                                                    class="badge badge-soft-success text-uppercase {{ ($recent_order->status == 1) ? 'text-success' : (($recent_order->status == 2)?'text-danger':'text-warning') }}">{{ ($recent_order->status == 1) ? 'Payment' : (($recent_order->status == 2)?'Canceled':'Pending') }}</span>
                                            </td>
                                            <td class="date">{{$recent_order->created_at}}</td>
                                            </tr><!-- end tr -->
                                            @endforeach
                                        </tbody><!-- end tbody -->
                                    </table><!-- end table -->
                                </div>
                            </div>
                        </div> <!-- .card-->
                    </div> <!-- .col-->
                </div> <!-- end row-->

            </div> <!-- end .h-100-->

        </div> <!-- end col -->
    </div>
@endsection