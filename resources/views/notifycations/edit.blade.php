@extends('layouts.master')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h2 class="card-title mb-0 flex-grow-1  text-primary fs-3">Sửa thông báo </h2>
                </div><!-- end card header -->
                <div id="message-container">
                    @if(session('message'))
                        <div class="alert alert-success">{{ session('message') }}</div>
                    @endif
                </div>
                <div class="card-body">
                    <div class="live-preview">
                        <form action="{{route('update.notify',$notify->id)}}" method="post">
                            @csrf
                            <div class="row gy-4 d-flex justify-content-center ">
                                <div class="col-11 mt-3">
                                    <div>
                                        <label for="basiInput" class="form-label fs-5 fw-bold">Title</label>
                                        <input type="text" name="title"
                                               class="form-control @error('title') is-invalid @enderror"
                                               value="{{$notify->title}}" placeholder=" Title">
                                        @error('title')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-11 mt-3">
                                    <div>
                                        <label for="basiInput" class="form-label fs-5 fw-bold">Content</label>
                                        <textarea rows="10" name="content_notify" class="form-control"
                                                  placeholder="Nội dung thông báo"> <?= $notify->content ?></textarea>
                                        @error('content_notify')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror

                                    </div>
                                </div>
                                <div class="col-11 mt-3">
                                    <div>
                                        <label for="basiInput" class="form-label fs-5 fw-bold">Priority</label>
                                        <select class="form-select mb-3" name="priority">
                                            <option value=""> Chọn</option>
                                            <option <?=  $notify->priority == 'low' ? 'selected' : '' ?> value="low">Low</option>
                                            <option <?=  $notify->priority == 'medium' ? 'selected': '' ?>  value="medium">Medium</option>
                                            <option <?=  $notify->priority == 'high' ? 'selected': '' ?>  value="high">High</option>
                                        </select>
                                        @error('priority')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-11 mt-3">
                                    <div>
                                        <label for="basiInput" class="form-label fs-5 fw-bold">expired</label>
                                        <input type="date" class="form-control" name="expired" value="{{$notify->expired}}" id="date"/>
                                        @error('expired')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <!--end col-->
                                <div class="mx-6">
                                    <div class="hstack gap-2 justify-content-end">
                                       <button type="submit" class="btn btn-success">Cập nhật</button>
                                        <button type="button" class="btn btn-primary"><a style="color: white" href="{{route('show.notify')}}">Danh sách</a></button>
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

@endsection
