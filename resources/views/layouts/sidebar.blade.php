<!-- ========== App Menu ========== -->
<div class="app-menu navbar-menu">
    <!-- LOGO -->
    <div class="navbar-brand-box">
        <!-- Dark Logo-->
        <a href="index" class="logo logo-dark">
            <span class="logo-sm">
                <img src="{{ URL::asset('assets/images/logo-sm.png') }}" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="{{ URL::asset('assets/images/logo-dark.png') }}" alt="" height="17">
            </span>
        </a>
        <!-- Light Logo-->
        <a href="index" class="logo logo-light">
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
                    <a class="nav-link menu-link" href="#">
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
                    <a class="nav-link menu-link" href="{{route('blog-categories')}}">
                        <i class="ri-apps-2-line"></i> <span>Quản lý chủ đề blog</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#blog" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarApps">
                        <i class="ri-apps-2-line"></i> <span>Quản lý blog</span>
                    </a>
                    <div class="collapse menu-dropdown" id="blog">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{route('blogs.create')}}" class="nav-link">Tạo mới</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('blogs.list')}}" class="nav-link">Danh sách</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#blog" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarApps">
                        <i class="ri-apps-2-line"></i> <span>Quản lý Category_blogs</span>
                    </a>
                    <div class="collapse menu-dropdown" id="blog">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{route('category_blog.create')}}" class="nav-link">Tạo mới</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('category_blog.list')}}" class="nav-link">Danh sách</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#comment" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarApps">
                        <i class="ri-apps-2-line"></i> <span>Quản lý comments</span>
                    </a>
                    <div class="collapse menu-dropdown" id="comment">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{route('comment.list')}}"class="nav-link">Danh sách</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
{{--                    <a class="nav-link menu-link" href="{{route('tags.list')}}">--}}
{{--                        <i class="ri-apps-2-line"></i> <span>Quản lý tag</span>--}}
{{--                    </a>--}}
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#user" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarApps">
                        <i class="ri-apps-2-line"></i> <span>Quản lý user</span>
                    </a>
                    <div class="collapse menu-dropdown" id="user">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
{{--                                <a href="" class="nav-link">Tạo mới</a>--}}
                            </li>
                            <li class="nav-item">
{{--                                <a href="" class="nav-link">Danh sách</a>--}}
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
                    <a class="nav-link menu-link" href="#user" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarApps">
                        <i class="ri-apps-2-line"></i> <span>Quản lý slider</span>
                    </a>
                    <div class="collapse menu-dropdown" id="user">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{route('slider.create')}}" class="nav-link">Tạo mới</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('slider.list')}}" class="nav-link">Danh sách</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#vouchers" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarApps">
                        <i class="ri-apps-2-line"></i> <span>Quản lý vouchers</span>
                    </a>
                    <div class="collapse menu-dropdown" id="vouchers">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="apps-calendar" class="nav-link">Tạo mới</a>
                            </li>
                            <li class="nav-item">
                                <a href="apps-calendar" class="nav-link">Danh sách</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#order" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarApps">
                        <i class="ri-apps-2-line"></i> <span>Quản lý order</span>
                    </a>
                    <div class="collapse menu-dropdown" id="order">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="apps-calendar" class="nav-link">Khoá học miễn phí</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('orders.list')}}" class="nav-link">Khoá học mất phí</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{route('show.notify')}}">
                        <i class="ri-apps-2-line"></i> <span>Notifycation</span>
                    </a>
                    <a class="nav-link menu-link" href="#order" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarApps">
                        <i class="ri-apps-2-line"></i> <span>Quản lý order</span>
                    </a>
                    <div class="collapse menu-dropdown" id="order">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="apps-calendar" class="nav-link">Danh sách</a>
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
