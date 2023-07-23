@extends('layouts.master')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Quản lý Thông báo</h4>
                </div><!-- end card header -->
                <div class="card-body">
                    <div class="listjs-table" id="NotifyList">
                        <div class="row g-4 mb-3">
                            <div class="col-sm-auto">
                                <div>
                                    <button type="button" class="btn btn-success add-btn"><i class="ri-add-line align-bottom me-1"></i> <a href="{{route('add.notify')}}"> Tạo thông báo</a></button>
                                </div>
                            </div>
                            <div class="col-sm">

                                <div class="d-flex justify-content-sm-end">
                                   <a href="{{route('show.notify')}}"> <button class="rounded border-0 btn btn-warning">Danh sách</button></a>
                                    <form method="post" action="{{route('show.notify')}}">
                                        @csrf
                                        <div class="search-box ms-2">
                                            <input type="text" class="form-control search " name="search_notify"
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
                        @if($search && $search != "")
                            <p style="padding-left: 40px;" class="fs-5">Kết quả tìm kiếm từ khóa"<strong class="text-danger">  {{$search}}  </strong>"</p>
                        @endif
                        <div class="table-responsive table-card mt-3 mb-1">
                            <table class="table align-middle table-nowrap" id="notifyTable">
                                <thead class="table-light">
                                <tr>
                                    <th class="sort" >STT</th>
                                    <th class="sort" data-sort="title">Title</th>
                                    <th class="sort" data-sort="content">Content</th>
                                    <th class="sort" data-sort="is_processed">Trạng thái</th>
                                    <th class="sort" data-sort="is_send_email">Ngày tạo</th>
                                    <th class="sort" data-sort="created_at">Ngày hết hạn</th>
                                    <th class="sort" data-sort="action">Lựa chọn</th>
                                </tr>
                                </thead>
                                <tbody class="list form-check-all">
                                @foreach($notifycations as $key => $notifycation)
                                    <tr data-notify-id="{{$notifycation->id}}">
                                        <td >{{$key + 1}}</td>
                                        <td class="title">{{$notifycation->title}}</td>
                                        <td class="content">{{ Str::limit($notifycation->content, 50) }}</td>
                                        <td class="is_processed"><?= $notifycation->is_processed == false ? 'Chưa xử lí': 'Đã xử lí'  ?></td>
                                        <td class="created_at">{{$notifycation->created_at}}</td>
                                        <td class="expired">{{$notifycation->expired}}</td>

                                        <td>
                                            <div class="d-flex gap-2">
                                                <div class="detail">
                                                    <a href="{{route('edit.notify',$notifycation->id)}}">
                                                        <button class="btn btn-sm btn-warning edit-item-btn">Edit
                                                        </button>
                                                    </a>
                                                </div>
                                                <div class="remove">
                                                    <button class="btn btn-sm btn-danger remove-item-btn"  onclick="DeleteNotify({{$notifycation->id}})" >Remove</button>
                                                </div>

                                            </div>
                                        </td>
                                    </tr>
                                @endforeach

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
                            {{ $notifycations->links() }}
                        </div>
                    </div>
                </div><!-- end card -->
            </div>
            <!-- end col -->
        </div>
        <!-- end col -->
    </div>
    <script>
        const editNotifyUrl = "{{ route('edit.notify', ':notifyId') }}";
    </script>
@endsection
