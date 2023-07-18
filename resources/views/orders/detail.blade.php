@extends('layouts.master')
@section('content')

<div class="">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Chi tiết order</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card">
                <div class="{{ ($order->status == 1) ? 'bg-success-subtle' : (($order->status == 2)?'bg-danger-subtle':'bg-warning-subtle') }} position-relative">
                    <div class="card-body p-5">
                        <div class="text-center">
                            <h3>Mã order: {{$order->order_id}}</h3>
                            <p class="mb-0 text-muted">Ngày tạo: {{$order->created_at}}</p>
                        </div>
                    </div>
                    <div class="shape">
                        <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" width="1440" height="60" preserveAspectRatio="none" viewBox="0 0 1440 60">
                            <g mask="url(&quot;#SvgjsMask1001&quot;)" fill="none">
                                <path d="M 0,4 C 144,13 432,48 720,49 C 1008,50 1296,17 1440,9L1440 60L0 60z" style="fill: var(--vz-secondary-bg);"></path>
                            </g>
                            <defs>
                                <mask id="SvgjsMask1001">
                                    <rect width="1440" height="60" fill="#ffffff"></rect>
                                </mask>
                            </defs>
                        </svg>
                    </div>
                </div>
                <div class="card-body p-4">
                    <div class="d-flex">
                        <div class="flex-shrink-0 me-3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-circle text-success icon-dual-success icon-xs"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>
                        </div>
                        <div class="flex-grow-1">
                            <h5>Thông tin user: </h5>
                            <p class="text-muted">Name: <span class="fw-bold">{{$order->user->name}}</span></p>
                            <p class="text-muted">Email:<span class="fw-bold">{{$order->user->email}}</span></p>
                            
                        </div>
                    </div>
                    
                    <div class="d-flex">
                        <div class="flex-shrink-0 me-3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-circle text-success icon-dual-success icon-xs"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>
                        </div>
                        <div class="flex-grow-1">
                            <h5>Thông tin khoá học</h5>
                            <div class="card" style="width: 18rem;">
                                <img src="{{$order->course->image}}" class="card-img-top" alt="...">
                                <div class="card-body">
                                  <p class="card-text">{{$order->course->name}}</p>
                                  <p class="card-text">Giá: <span class="fw-bold">{{number_format($order->course->price, 0, ',', '.')}}</span></p>
                                </div>
                              </div>
                        </div>
                    </div>

                    <div class="d-flex">
                        <div class="flex-shrink-0 me-3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-circle text-success icon-dual-success icon-xs"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>
                        </div>
                        <div class="flex-grow-1">
                            <h5>Tổng giá sau khi đã áp dụng voucher: <span class="fw-bold">{{number_format($order->amount, 0, ',', '.')}}</span></h5>
                        </div>
                    </div>
                    <div class="d-flex">
                        <div class="flex-shrink-0 me-3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-circle text-success icon-dual-success icon-xs"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>
                        </div>
                        <div class="flex-grow-1">
                            <h5>Trạng thái order: <span class="fw-bold {{ ($order->status == 1) ? 'text-success' : (($order->status == 2)?'text-danger':'text-warning') }}">{{ ($order->status == 1) ? 'Payment' : (($order->status == 2)?'Canceled':'Pending') }}</span></h5>
                        </div>
                    </div>
                    <div class="text-end">
                        <a href="{{route('orders.list')}}" class="btn btn-light">Trở lại</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- container-fluid -->

@endsection
