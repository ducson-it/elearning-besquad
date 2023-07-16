@extends('layouts.master')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h2 class="card-title mb-0 flex-grow-1  text-primary fs-3">Tạo thông báo </h2>
                </div><!-- end card header -->
                <div id="message-container">
                    @if(session('message'))
                        <div class="alert alert-success">{{ session('message') }}</div>
                    @endif
                </div>
                <div class="card-body">
                    <div class="live-preview">
                        <form action="{{route('store.notify')}}" method="post">
                            @csrf
                            <div class="row gy-4 d-flex justify-content-center ">
                                <div class="col-11 mt-3">
                                    <div>
                                        <label for="basiInput" class="form-label fs-5 fw-bold">Title</label>
                                        <input type="text" name="title"
                                               class="form-control @error('title') is-invalid @enderror"
                                               value="{{old('title')}}" placeholder=" Title">
                                        @error('title')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-11 mt-3">
                                    <div>
                                        <label for="basiInput" class="form-label fs-5 fw-bold">Content</label>
                                        <textarea rows="10" name="content_notify" class="form-control"
                                                  placeholder="Nội dung thông báo"></textarea>
                                        @error('content_notify')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror

                                    </div>
                                </div>
                                <div class="col-11 mt-3">
                                    <div>
                                        <label class="form-label fs-5 fw-bold">Đối tượng nhận thông báo</label>
                                        <div>
                                            <input type="radio" name="option" checked value="system"
                                                   onchange="showDiv('div1')"> Toàn hệ thống
                                            <input type="radio" class="ml-3" name="option" value="option2"
                                                   onchange="showDiv('div2')"> Nhóm thành viên
                                        </div>

                                        <div id="div1"
                                             class="border  border-primary  bg-primary p-3  rounded text-white"
                                             style="display: none;">Bạn đang lựa chọn gửi thông báo cho toàn hệ thống
                                        </div>
                                        <div id="div2" class="border border-primary bg-success p-3 rounded text-white"
                                             style="display: none;">
                                            Vui lòng nhập hoặc lựa chọn những user muốn gửi thông báo
                                            <select class="list-select-user" name="group_user[]" multiple="multiple">
                                                @foreach ($list_users as $user)
                                                    <option value="{{ $user->id }}">{{ $user->email }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        @error('group_user')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-11 mt-3">
                                    <div>
                                        <label for="basiInput" class="form-label fs-5 fw-bold">Priority</label>
                                        <select class="form-select mb-3" name="priority">
                                            <option value=""> Chọn</option>
                                            <option value="low">Low</option>
                                            <option value="medium">Medium</option>
                                            <option value="high">High</option>
                                        </select>
                                        @error('priority')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-11 mt-3">
                                    <div>
                                        <label for="basiInput" class="form-label fs-5 fw-bold">Notification_type</label>
                                        <select class="form-select mb-3"
                                                name="notification_type">
                                            <option value=""> Chon</option>
                                            <option value="Tin tức">Tin tức</option>
                                            <option value="Cảnh báo">Cảnh báo</option>
                                            <option value="Hệ thống">Hệ thống</option>
                                        </select>
                                        @error('notification_type')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-11 mt-3">
                                    <div>
                                        <label for="basiInput" class="form-label fs-5 fw-bold">expired</label>
                                        <input type="date" class="form-control" name="expired" id="date"/>
                                        @error('expired')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <!--end col-->
                                <div class="mx-6">
                                    <div class="hstack gap-2 justify-content-end">
                                        <button type="submit" class="btn btn-success">Thêm</button>
                                        <button type="button" class="btn btn-primary"><a style="color: white"
                                                                                         href="{{route('show.notify')}}">Danh
                                                sách</a></button>
                                    </div>
                                </div>
                                <!--end col-->
                            </div>
                        </form>
                        <!--end row-->
                    </div>
                </div>
            </div>
        </div>
        <!--end col-->
    </div>

    <!-- Select2 -->
    <!-- Thêm liên kết JavaScript của jQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        function showDiv(divId) {
            // Ẩn tất cả các div
            var divs = document.querySelectorAll('div[id^="div"]');
            for (var i = 0; i < divs.length; i++) {
                divs[i].style.display = 'none';
            }

            // Hiển thị div tương ứng
            var div = document.getElementById(divId);
            div.style.display = 'block';
        }

        //
    </script>

@endsection
