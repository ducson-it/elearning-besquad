<!-- ========== App Menu ========== -->
<div class="app-menu navbar-menu overflow-auto">
    <!-- LOGO -->
    <div class="navbar-brand-box">
        <!-- Dark Logo-->
        <a href="{{route('home')}}" class="logo logo-dark">
            <span class="logo-sm">
                <img src="{{ URL::asset('assets/images/logo-sm.png') }}" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="{{ URL::asset('assets/images/logo-dark.png') }}" alt="" height="17">
            </span>
        </a>
        <!-- Light Logo-->
        <a href="{{route('home')}}" class="logo logo-light">
            <span class="logo-sm">
                <img src="{{ URL::asset('assets/images/beesquad-logo.png') }}" alt="" height="100px">
            </span>
            <span class="logo-lg">
                <img src="{{ URL::asset('assets/images/beesquad-logo.png') }}" alt="" height="100px">
            </span>
        </a>
        <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover" id="vertical-hover">
            <i class="ri-record-circle-line"></i>
        </button>
    </div>

    <div id="scrollbar">
        <div class="container-fluid">
            <ul class="navbar-nav" id="navbar-nav">
                <li class="menu-title"><span>@lang('translation.menu')</span></li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{route('home')}}">
                        <i class="ri-dashboard-2-line"></i> <span>Dashboards</span>
                    </a>
                </li> <!-- end Dashboard Menu -->
                @can('menu.permissions')
                    <li class="nav-item">
                        <a class="nav-link menu-link" href="#permission" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarApps">
                            <i class="ri-apps-2-line"></i> <span>Phân quyền</span>
                        </a>
                        <div class="collapse menu-dropdown" id="permission">
                            <ul class="nav nav-sm flex-column">
                                <li class="nav-item">
                                    <a class="nav-link menu-link" href="{{route('permissions.index')}}">
                                        <span>Danh sách quyền</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link menu-link" href="{{route('roles.index')}}">
                                        <span>Danh sách vai trò</span>
                                    </a>
                                </li>
                            </ul>
                        </div>

                    </li>
                @endcan
                @can('menu.user')
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#user" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="user">
                        <i class="ri-apps-2-line"></i> <span>Quản lý user</span>
                    </a>
                    <div class="collapse menu-dropdown" id="user">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a class="nav-link menu-link" href="{{route('show.teacher')}}" >
                                    <span>Giảng viên</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link menu-link" href="{{route('show.user')}}" >
                                    <span>Học viên</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                @endcan
                @can('menu.courses')
                    <li class="nav-item">
                        <a class="nav-link menu-link" href="#course" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarApps">
                            <i class="ri-apps-2-line"></i> <span>Quản lý khoá học</span>
                        </a>
                        <div class="collapse menu-dropdown" id="course">
                            <ul class="nav nav-sm flex-column">
                                @can('categories')
                                    <li class="nav-item">
                                        <a class="nav-link menu-link" href="{{route('categories')}}">
                                            <span>Danh mục</span>
                                        </a>
                                    </li>
                                @endcan
                                <li class="nav-item">
                                    <a href="{{route('courses.list')}}" class="nav-link">Danh sách</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('modules.list')}}" class="nav-link">Chủ đề</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('lessons.list')}}" class="nav-link">Bài học</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('comment.list')}}"  class="nav-link">Bình luận</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                @endcan
                @can('menu.studies')
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#studies" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarApps">
                        <i class="ri-apps-2-line"></i> <span>Quản lý học tập</span>
                    </a>
                    <div class="collapse menu-dropdown" id="studies">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a class="nav-link menu-link" href="{{route('studies.list')}}">
                                    <span>Đăng ký khoá học</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link menu-link" href="{{route('histories.list')}}">
                                    <span>Lịch sử học</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                @endcan
                @can('menu.forums')
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#forum" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="forum">
                        <i class="ri-apps-2-line"></i> <span>Quản lý forum</span>
                    </a>
                    <div class="collapse menu-dropdown" id="forum" >
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a class="nav-link menu-link" href="{{route('forum.list')}}">
                                    <span>Quản lý post</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link menu-link" href="{{route('feedbacks.list')}}">
                                    <span>Đánh giá (Feedback)</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link menu-link" href="{{route('show.forumCmt')}}">
                                  <span>Bình luận</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                @endcan

                @can('menu.vouchers')
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#vouchers" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarApps">
                        <i class="ri-apps-2-line"></i> <span>Quản lý voucher</span>
                    </a>
                    <div class="collapse menu-dropdown" id="vouchers">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a class="nav-link menu-link" href="{{route('add.voucher')}}" class="nav-link">Tạo mới</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link menu-link" href="{{route('show.voucher')}}" class="nav-link">Danh sách</a>
                            </li>
                        </ul>
                    </div>
                </li>
                @endcan
                @can('menu.orders')
                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{route('quiz.list')}}">
                        <i class="ri-apps-2-line"></i><span>Quản lý quiz</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{route('orders.list')}}">
                        <i class="ri-apps-2-line"></i><span>Quản lý order</span>
                    </a>
                </li>
                @endcan
                @can('menu.notify')
                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{route('show.notify')}}">
                        <i class="ri-apps-2-line"></i> <span>Thông báo</span>
                    </a>
                </li>
                @endcan
                @can('menu.sliders')
                    <li class="nav-item">
                        <a class="nav-link menu-link" href="{{route('slider.list')}}">
                            <i class="ri-apps-2-line"></i> <span>Quản lý slider</span>
                        </a>
                    </li>
                @endcan
                {{-- <li class="nav-item">
                    <a class="nav-link menu-link" href="#">
                        <i class="ri-apps-2-line"></i> <span>Thống kê</span>
                    </a>
                </li> --}}

            </ul>
        </div>
        <!-- Sidebar -->
    </div>
    <div class="sidebar-background"></div>
</div>
<!-- Left Sidebar End -->
<!-- Vertical Overlay-->
<div class="vertical-overlay"></div>
