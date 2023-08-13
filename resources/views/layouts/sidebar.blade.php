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
                <img src="{{ URL::asset('assets/images/logo-sm.png') }}" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="{{ URL::asset('assets/images/logo-light.png') }}" alt="" height="17">
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
                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{route('categories')}}">
                        <i class="ri-apps-2-line"></i> <span>Quản lý danh mục</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#course" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarApps">
                        <i class="ri-apps-2-line"></i> <span>Quản lý khoá học</span>
                    </a>
                    <div class="collapse menu-dropdown" id="course">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{route('courses.list')}}" class="nav-link">Danh sách</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('modules.list')}}" class="nav-link">Chủ đề</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('lessons.list')}}" class="nav-link">Bài học</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{route('category_blog.list')}}">
                        <i class="ri-apps-2-line"></i><span>Quản lý chủ đề blog</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{route('blogs.list')}}">
                        <i class="ri-apps-2-line"></i><span>Quản lý blog</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{route('comment.list')}}">
                        <i class="ri-apps-2-line"></i><span>Quản lý comments</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#user" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarApps">
                        <i class="ri-apps-2-line"></i> <span>Quản lý user</span>
                    </a>
                    <div class="collapse menu-dropdown" id="user">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a class="nav-link menu-link" href="{{route('show.teacher')}}" >
                                    <span>Quản lý giảng viên</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link menu-link" href="{{route('show.user')}}" >
                                    <span>Quản lý học sinh</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{route('show.tag')}}">
                        <i class="ri-apps-2-line"></i> <span>Quản lý tag</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{route('slider.list')}}">
                        <i class="ri-apps-2-line"></i> <span>Quản lý slider</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#vouchers" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarApps">
                        <i class="ri-apps-2-line"></i> <span>Quản lý vouchers</span>
                    </a>
                    <div class="collapse menu-dropdown" id="vouchers">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{route('add.voucher')}}" class="nav-link">Tạo mới</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('show.voucher')}}" class="nav-link">Danh sách</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{route('orders.list')}}">
                        <i class="ri-apps-2-line"></i><span>Quản lý order</span>
                    </a>
                </li>
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

                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{route('show.notify')}}">
                        <i class="ri-apps-2-line"></i> <span>Notifycation</span>
                    </a>

                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{route('show.forumCmt')}}">
                        <i class="ri-apps-2-line"></i> <span>Forum comment</span>
                    </a>

                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#studies" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarApps">
                        <i class="ri-apps-2-line"></i> <span>Quản lý forum</span>
                    </a>
                    <div class="collapse menu-dropdown" id="studies">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a class="nav-link menu-link" href="{{route('forum.list')}}">
                                    <span>Danh sách</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link menu-link" href="{{route('feedbacks.list')}}">
                                    <span>Đánh giá(feedback)</span>
                                </a>
                            </li>
                        </ul>
                    </div>

                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#">
                        <i class="ri-apps-2-line"></i> <span>Thống kê</span>
                    </a>
                </li>

            </ul>
        </div>
        <!-- Sidebar -->
    </div>
    <div class="sidebar-background"></div>
</div>
<!-- Left Sidebar End -->
<!-- Vertical Overlay-->
<div class="vertical-overlay"></div>
