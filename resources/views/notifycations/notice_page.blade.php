@extends('layouts.master')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h2 class="card-title mb-0 flex-grow-1  text-primary fs-3">Danh sách thông báo </h2>
                </div><!-- end card header -->
                <div id="message-container">
                    @if(session('message'))
                        <div class="alert alert-success">{{ session('message') }}</div>
                    @endif
                </div>
                <div class="d-flex justify-content-sm-end mt-2">
                    <a href="{{route('show.notice_page')}}">
                        <button class="rounded border-0 btn btn-warning">Danh sách</button>
                    </a>
                    <form method="post" action="{{route('show.notice_page')}}">
                        @csrf
                        <div class="search-box ms-2">
                            <input type="text" class="form-control search " name="search_notice"
                                   placeholder="Tìm kiếm...">
                            <i class="ri-search-line search-icon"></i>
                        </div>
                    </form>
                        <div style="margin-left: 20px; margin-right: 20px">
                            <select class="form-select" name aria-label="Default select example">
                                <option selected>Lọc theo</option>
                                <option value="1">Tất cả</option>
                                <option value="2">Bình luận</option>
                            </select>
                        </div>

                </div>
                @if($search && $search != "")
                    <p style="padding-left: 40px;" class="fs-5">Kết quả tìm kiếm từ khóa"<strong
                            class="text-danger">  {{$search}}  </strong>"</p>
                @endif
                <div class="d-flex justify-content-end m-2 fw-bold">Đánh dấu</div>
                <div class="card-body ">
                    <div class=" ">
                        @foreach($listNotifys as $listNotify)
                            <div class="text-reset notification-item d-block dropdown-item position-relative border">
                                <div class="d-flex">
                                    <img src="{{URL::asset('assets/images/users/avatar-2.jpg')}}"
                                         class="me-3 rounded-circle avatar-xs" alt="user-pic">
                                    <div class="flex-1">
                                        <a href="#!" class="stretched-link">
                                            <h6 class="mt-0 mb-1 fs-13 fw-semibold">{{$listNotify->title}}</h6>
                                        </a>
                                        <div class="fs-13 text-muted">
                                            <p class="mb-1">{{$listNotify->content}} 🔔.</p>
                                        </div>
                                        <p class="mb-0 fs-11 fw-medium text-uppercase text-muted">
                                            <span><i class="mdi mdi-clock-outline"></i> 48 min ago</span>
                                        </p>
                                    </div>
                                    <div class="px-2 fs-15">
                                        <div class="form-check notification-check">
                                            <input class="form-check-input" name="updateIsread" type="checkbox" data-notify-id="{{ $listNotify->id }}">
                                            <label class="form-check-label" for="all-notification-check02"></label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <!--end col-->
    </div>

@endsection
