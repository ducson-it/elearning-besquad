<div class="dropdown topbar-head-dropdown ms-1 header-item" id="notificationDropdown">
    <button type="button" class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle"
            id="page-header-notifications-dropdown" data-bs-toggle="dropdown" data-bs-auto-close="outside"
            aria-haspopup="true" aria-expanded="false">
        <i class='bx bx-bell fs-22'></i>
        <span class="position-absolute topbar-badge fs-10 translate-middle badge rounded-pill bg-danger">{{$countIsreadNotify}}<span
                class="visually-hidden">unread messages</span></span>
    </button>
    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
         aria-labelledby="page-header-notifications-dropdown">

        <div class="dropdown-head bg-primary bg-pattern rounded-top">
            <div class="p-3">
                <div class="row align-items-center">
                    <div class="col">
                        <h6 class="m-0 fs-16 fw-semibold text-white"> Notifications </h6>
                    </div>
                </div>
            </div>

            <div class="px-2 pt-2">
                <ul class="nav nav-tabs dropdown-tabs nav-tabs-custom" data-dropdown-tabs="true"
                    id="notificationItemsTab" role="tablist">
                    <li class="nav-item waves-effect waves-light">
                        <a class="nav-link active" data-bs-toggle="tab" href="#all-noti-tab" role="tab"
                           aria-selected="true">
                            Tất cả ({{$countIsreadNotify}})
                        </a>
                    </li>

                </ul>
            </div>

        </div>

        <div class="tab-content position-relative" id="notificationItemsTabContent">
            <div class="tab-pane fade show active py-2 ps-2" id="all-noti-tab" role="tabpanel">
                <div data-simplebar style="max-height: 300px;" class="pe-2">

                    @foreach($listNotifys as $listNotify)
                        <div class="text-reset notification-item d-block dropdown-item position-relative">
                            <div class="d-flex">
                                <img src="{{URL::asset('assets/images/companies/img-3.png')}}"
                                     class="me-3 rounded-circle avatar-xs" alt="user-pic">
                                <div class="flex-1">
                                    <a href="#!" class="stretched-link">
                                        <h6 class="mt-0 mb-1 fs-13 fw-semibold">{{$listNotify->title}}</h6>
                                    </a>
                                    <div class="fs-13 text-muted">
                                        <p class="mb-1">{{$listNotify->content}} 🔔.</p>
                                    </div>
                                    <p class="mb-0 fs-11 fw-medium text-uppercase text-muted">
                                        <span><i class="mdi mdi-clock-outline"></i> {{$listNotify->created_at}}</span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <div class="my-3 text-center view-all">
                        <a href="{{route('show.notice_page')}}">
                            <button type="button" class="btn btn-soft-success waves-effect waves-light">View
                                All Messages <i class="ri-arrow-right-line align-middle"></i></button>
                        </a>

                    </div>
                </div>

            </div>

            <div class="tab-pane fade p-4" id="alerts-tab" role="tabpanel" aria-labelledby="alerts-tab"></div>

            <div class="notification-actions" id="notification-actions">
                <div class="d-flex text-muted justify-content-center">
                    Select
                    <div id="select-content" class="text-body fw-semibold px-1">0</div>
                    Result
                    <button type="button" class="btn btn-link link-danger p-0 ms-3" data-bs-toggle="modal"
                            data-bs-target="#removeNotificationModal">Remove
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
