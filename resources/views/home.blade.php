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
                            <div>
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
                <div>
                    <h6>TODAY</h6>

                </div>
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

                                    </div>
                                </div>
                                <div class="d-flex align-items-end justify-content-between mt-4">
                                    <div>
                                        <h4 class="fs-22 fw-semibold ff-secondary mb-4"><span class="counter-value"
                                                data-target="165.89">{{$total_number_courses}}</span></h4>
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
                                <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                                    <li class="nav-item mx-1" role="presentation">
                                      <button class="btn btn-soft-secondary btn-sm active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true" onclick="Statistic(0)">All</button>
                                    </li>
                                    <li class="nav-item mx-1" role="presentation">
                                      <button class="btn btn-soft-secondary btn-sm" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false" onclick="Statistic(1)">1 tháng</button>
                                    </li>
                                    <li class="nav-item mx-1" role="presentation">
                                      <button class="btn btn-soft-secondary btn-sm" id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#pills-contact" type="button" role="tab" aria-controls="pills-contact" aria-selected="false" onclick="Statistic(6)">6 tháng</button>
                                    </li>
                                    <li class="nav-item mx-1" role="presentation">
                                        <button class="btn btn-soft-secondary btn-sm" id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#pills-contact" type="button" role="tab" aria-controls="pills-contact" aria-selected="false" onclick="Statistic(12)">1 năm</button>
                                      </li>
                                  </ul>
                            </div>
                        </div><!-- end card header -->

                        <div class="card-header p-0 border-0 bg-light-subtle">
                            <div class="row g-0 text-center" id="statistic">
                                <div class="col-6 col-sm-2">
                                    <div class="p-3 border border-dashed border-start-0">
                                        <h5 class="mb-1"><span class="counter-value" data-target="7585">{{$order_all}}</span>
                                        </h5>
                                        <p class="text-muted mb-0">Đơn hàng</p>
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-6 col-sm-3">
                                    <div class="p-3 border border-dashed border-start-0">
                                        <h5 class="mb-1">{{ number_format($revenue_all, 0, ',', '.') }}</span> Đ
                                        </h5>
                                        <p class="text-muted mb-0">Doanh thu</p>
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-6 col-sm-2">
                                    <div class="p-3 border border-dashed border-start-0">
                                        <h5 class="mb-1"><span class="counter-value" data-target="367">{{$order_cancel}}</span>
                                        </h5>
                                        <p class="text-muted mb-0">Hoàn thành</p>
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-6 col-sm-2">
                                    <div class="p-3 border border-dashed border-start-0">
                                        <h5 class="mb-1"><span class="counter-value" data-target="367">{{$order_cancel}}</span>
                                        </h5>
                                        <p class="text-muted mb-0">Huỷ bỏ</p>
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-6 col-sm-3">
                                    <div class="p-3 border border-dashed border-start-0 border-end-0">
                                        <h5 class="mb-1 text-success"><span class="counter-value"
                                                data-target="18.92">{{$conversion_rate}}</span>%</h5>
                                        <p class="text-muted mb-0">Tỷ lệ hoàn thành</p>
                                    </div>
                                </div>
                                <!--end col-->
                            </div>
                        </div><!-- end card header -->

                        <div class="card-body">
                            <div class="card-body p-0 pb-2">
                                <div class="w-100">
                                    <div id="customer_impression_charts" data-colors="[&quot;--vz-primary&quot;, &quot;--vz-success&quot;, &quot;--vz-danger&quot;]" class="apex-charts" dir="ltr" style="min-height: 385px;"><div id="apexchartsjguqmcyo" class="apexcharts-canvas apexchartsjguqmcyo apexcharts-theme-light" style="width: 806px; height: 370px;"><svg id="SvgjsSvg2422" width="806" height="370" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.dev" class="apexcharts-svg apexcharts-zoomable" xmlns:data="ApexChartsNS" transform="translate(0, 0)" style="background: transparent;"><foreignObject x="0" y="0" width="806" height="370"><div class="apexcharts-legend apexcharts-align-center apx-legend-position-bottom" xmlns="http://www.w3.org/1999/xhtml" style="inset: auto 0px 10px 20px; position: absolute; max-height: 185px;"><div class="apexcharts-legend-series" style="margin: 0px 10px;" rel="1" seriesname="Orders" data:collapsed="false"><span class="apexcharts-legend-marker" style="background: rgb(64, 81, 137) !important; color: rgb(64, 81, 137); height: 9px; width: 9px; left: 0px; top: 0px; border-width: 0px; border-color: rgb(255, 255, 255); border-radius: 6px;" rel="1" data:collapsed="false"></span><span class="apexcharts-legend-text" style="color: rgb(55, 61, 63); font-size: 12px; font-weight: 400; font-family: Helvetica, Arial, sans-serif;" rel="1" i="0" data:default-text="Orders" data:collapsed="false">Orders</span></div><div class="apexcharts-legend-series" style="margin: 0px 10px;" rel="2" seriesname="Earnings" data:collapsed="false"><span class="apexcharts-legend-marker" style="background: rgb(10, 179, 156) !important; color: rgb(10, 179, 156); height: 9px; width: 9px; left: 0px; top: 0px; border-width: 0px; border-color: rgb(255, 255, 255); border-radius: 6px;" rel="2" data:collapsed="false"></span><span class="apexcharts-legend-text" style="color: rgb(55, 61, 63); font-size: 12px; font-weight: 400; font-family: Helvetica, Arial, sans-serif;" rel="2" i="1" data:default-text="Earnings" data:collapsed="false">Earnings</span></div><div class="apexcharts-legend-series" style="margin: 0px 10px;" rel="3" seriesname="Refunds" data:collapsed="false"><span class="apexcharts-legend-marker" style="background: rgb(240, 101, 72) !important; color: rgb(240, 101, 72); height: 9px; width: 9px; left: 0px; top: 0px; border-width: 0px; border-color: rgb(255, 255, 255); border-radius: 6px;" rel="3" data:collapsed="false"></span><span class="apexcharts-legend-text" style="color: rgb(55, 61, 63); font-size: 12px; font-weight: 400; font-family: Helvetica, Arial, sans-serif;" rel="3" i="2" data:default-text="Refunds" data:collapsed="false">Refunds</span></div></div><style type="text/css">

.apexcharts-legend {
display: flex;
overflow: auto;
padding: 0 10px;
}
.apexcharts-legend.apx-legend-position-bottom, .apexcharts-legend.apx-legend-position-top {
flex-wrap: wrap
}
.apexcharts-legend.apx-legend-position-right, .apexcharts-legend.apx-legend-position-left {
flex-direction: column;
bottom: 0;
}
.apexcharts-legend.apx-legend-position-bottom.apexcharts-align-left, .apexcharts-legend.apx-legend-position-top.apexcharts-align-left, .apexcharts-legend.apx-legend-position-right, .apexcharts-legend.apx-legend-position-left {
justify-content: flex-start;
}
.apexcharts-legend.apx-legend-position-bottom.apexcharts-align-center, .apexcharts-legend.apx-legend-position-top.apexcharts-align-center {
justify-content: center;
}
.apexcharts-legend.apx-legend-position-bottom.apexcharts-align-right, .apexcharts-legend.apx-legend-position-top.apexcharts-align-right {
justify-content: flex-end;
}
.apexcharts-legend-series {
cursor: pointer;
line-height: normal;
}
.apexcharts-legend.apx-legend-position-bottom .apexcharts-legend-series, .apexcharts-legend.apx-legend-position-top .apexcharts-legend-series{
display: flex;
align-items: center;
}
.apexcharts-legend-text {
position: relative;
font-size: 14px;
}
.apexcharts-legend-text *, .apexcharts-legend-marker * {
pointer-events: none;
}
.apexcharts-legend-marker {
position: relative;
display: inline-block;
cursor: pointer;
margin-right: 3px;
border-style: solid;
}

.apexcharts-legend.apexcharts-align-right .apexcharts-legend-series, .apexcharts-legend.apexcharts-align-left .apexcharts-legend-series{
display: inline-block;
}
.apexcharts-legend-series.apexcharts-no-click {
cursor: auto;
}
.apexcharts-legend .apexcharts-hidden-zero-series, .apexcharts-legend .apexcharts-hidden-null-series {
display: none !important;
}
.apexcharts-inactive-legend {
opacity: 0.45;
}</style></foreignObject><rect id="SvgjsRect2427" width="0" height="0" x="0" y="0" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fefefe"></rect><g id="SvgjsG2529" class="apexcharts-yaxis" rel="0" transform="translate(31.183334350585938, 0)"><g id="SvgjsG2530" class="apexcharts-yaxis-texts-g"><text id="SvgjsText2532" font-family="Helvetica, Arial, sans-serif" x="20" y="31.4" text-anchor="end" dominant-baseline="auto" font-size="11px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-yaxis-label " style="font-family: Helvetica, Arial, sans-serif;"><tspan id="SvgjsTspan2533">120.00</tspan><title>120.00</title></text><text id="SvgjsText2535" font-family="Helvetica, Arial, sans-serif" x="20" y="97.10440030860902" text-anchor="end" dominant-baseline="auto" font-size="11px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-yaxis-label " style="font-family: Helvetica, Arial, sans-serif;"><tspan id="SvgjsTspan2536">90.00</tspan><title>90.00</title></text><text id="SvgjsText2538" font-family="Helvetica, Arial, sans-serif" x="20" y="162.80880061721803" text-anchor="end" dominant-baseline="auto" font-size="11px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-yaxis-label " style="font-family: Helvetica, Arial, sans-serif;"><tspan id="SvgjsTspan2539">60.00</tspan><title>60.00</title></text><text id="SvgjsText2541" font-family="Helvetica, Arial, sans-serif" x="20" y="228.51320092582702" text-anchor="end" dominant-baseline="auto" font-size="11px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-yaxis-label " style="font-family: Helvetica, Arial, sans-serif;"><tspan id="SvgjsTspan2542">30.00</tspan><title>30.00</title></text><text id="SvgjsText2544" font-family="Helvetica, Arial, sans-serif" x="20" y="294.217601234436" text-anchor="end" dominant-baseline="auto" font-size="11px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-yaxis-label " style="font-family: Helvetica, Arial, sans-serif;"><tspan id="SvgjsTspan2545">0.00</tspan><title>0.00</title></text></g></g><g id="SvgjsG2424" class="apexcharts-inner apexcharts-graphical" transform="translate(81.5690919009122, 30)"><defs id="SvgjsDefs2423"><clipPath id="gridRectMaskjguqmcyo"><rect id="SvgjsRect2429" width="742.4166652679444" height="265.01760123443603" x="-21.485757550326262" y="-1.1" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fff"></rect></clipPath><clipPath id="forecastMaskjguqmcyo"></clipPath><clipPath id="nonForecastMaskjguqmcyo"></clipPath><clipPath id="gridRectMarkerMaskjguqmcyo"><rect id="SvgjsRect2430" width="703.4451501672918" height="266.81760123443604" x="-2" y="-2" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fff"></rect></clipPath></defs><line id="SvgjsLine2428" x1="0" y1="0" x2="0" y2="262.81760123443604" stroke="#b6b6b6" stroke-dasharray="3" stroke-linecap="butt" class="apexcharts-xcrosshairs" x="0" y="0" width="1" height="262.81760123443604" fill="#b1b9c4" filter="none" fill-opacity="0.9" stroke-width="1"></line><g id="SvgjsG2471" class="apexcharts-grid"><g id="SvgjsG2472" class="apexcharts-gridlines-horizontal"></g><g id="SvgjsG2473" class="apexcharts-gridlines-vertical"><line id="SvgjsLine2475" x1="0" y1="0" x2="0" y2="262.81760123443604" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline"></line><line id="SvgjsLine2476" x1="63.585922742481074" y1="0" x2="63.585922742481074" y2="262.81760123443604" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline"></line><line id="SvgjsLine2477" x1="127.17184548496215" y1="0" x2="127.17184548496215" y2="262.81760123443604" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline"></line><line id="SvgjsLine2478" x1="190.75776822744322" y1="0" x2="190.75776822744322" y2="262.81760123443604" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline"></line><line id="SvgjsLine2479" x1="254.3436909699243" y1="0" x2="254.3436909699243" y2="262.81760123443604" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline"></line><line id="SvgjsLine2480" x1="317.9296137124054" y1="0" x2="317.9296137124054" y2="262.81760123443604" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline"></line><line id="SvgjsLine2481" x1="381.5155364548865" y1="0" x2="381.5155364548865" y2="262.81760123443604" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline"></line><line id="SvgjsLine2482" x1="445.1014591973676" y1="0" x2="445.1014591973676" y2="262.81760123443604" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline"></line><line id="SvgjsLine2483" x1="508.6873819398487" y1="0" x2="508.6873819398487" y2="262.81760123443604" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline"></line><line id="SvgjsLine2484" x1="572.2733046823298" y1="0" x2="572.2733046823298" y2="262.81760123443604" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline"></line><line id="SvgjsLine2485" x1="635.8592274248109" y1="0" x2="635.8592274248109" y2="262.81760123443604" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline"></line><line id="SvgjsLine2486" x1="699.445150167292" y1="0" x2="699.445150167292" y2="262.81760123443604" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline"></line></g><line id="SvgjsLine2488" x1="0" y1="262.81760123443604" x2="699.4451501672918" y2="262.81760123443604" stroke="transparent" stroke-dasharray="0" stroke-linecap="butt"></line><line id="SvgjsLine2487" x1="0" y1="1" x2="0" y2="262.81760123443604" stroke="transparent" stroke-dasharray="0" stroke-linecap="butt"></line></g><g id="SvgjsG2431" class="apexcharts-area-series apexcharts-plot-series"><g id="SvgjsG2432" class="apexcharts-series" seriesName="Orders" data:longestSeries="true" rel="1" data:realIndex="0"><path id="SvgjsPath2435" d="M 0 262.81760123443604 L 0 188.3526142180125 L 63.58592274248107 120.45806723244985 L 127.17184548496213 162.0708540945689 L 190.7577682274432 113.88762720158894 L 254.34369096992427 155.50041406370798 L 317.92961371240534 129.21865394026437 L 381.5155364548864 170.83144080238344 L 445.1014591973675 166.45114744847615 L 508.68738193984854 91.9861604320526 L 572.2733046823296 148.9299740328471 L 635.8592274248107 124.83836058635711 L 699.4451501672918 116.07777387854259 L 699.4451501672918 262.81760123443604M 699.4451501672918 116.07777387854259z" fill="rgba(64,81,137,0.1)" fill-opacity="1" stroke-opacity="1" stroke-linecap="butt" stroke-width="0" stroke-dasharray="0" class="apexcharts-area" index="0" clip-path="url(#gridRectMaskjguqmcyo)" pathTo="M 0 262.81760123443604 L 0 188.3526142180125 L 63.58592274248107 120.45806723244985 L 127.17184548496213 162.0708540945689 L 190.7577682274432 113.88762720158894 L 254.34369096992427 155.50041406370798 L 317.92961371240534 129.21865394026437 L 381.5155364548864 170.83144080238344 L 445.1014591973675 166.45114744847615 L 508.68738193984854 91.9861604320526 L 572.2733046823296 148.9299740328471 L 635.8592274248107 124.83836058635711 L 699.4451501672918 116.07777387854259 L 699.4451501672918 262.81760123443604M 699.4451501672918 116.07777387854259z" pathFrom="M -1 262.81760123443604 L -1 262.81760123443604 L 63.58592274248107 262.81760123443604 L 127.17184548496213 262.81760123443604 L 190.7577682274432 262.81760123443604 L 254.34369096992427 262.81760123443604 L 317.92961371240534 262.81760123443604 L 381.5155364548864 262.81760123443604 L 445.1014591973675 262.81760123443604 L 508.68738193984854 262.81760123443604 L 572.2733046823296 262.81760123443604 L 635.8592274248107 262.81760123443604 L 699.4451501672918 262.81760123443604"></path><path id="SvgjsPath2436" d="M 0 188.3526142180125 L 63.58592274248107 120.45806723244985 L 127.17184548496213 162.0708540945689 L 190.7577682274432 113.88762720158894 L 254.34369096992427 155.50041406370798 L 317.92961371240534 129.21865394026437 L 381.5155364548864 170.83144080238344 L 445.1014591973675 166.45114744847615 L 508.68738193984854 91.9861604320526 L 572.2733046823296 148.9299740328471 L 635.8592274248107 124.83836058635711 L 699.4451501672918 116.07777387854259" fill="none" fill-opacity="1" stroke="#405189" stroke-opacity="1" stroke-linecap="butt" stroke-width="2" stroke-dasharray="0" class="apexcharts-area" index="0" clip-path="url(#gridRectMaskjguqmcyo)" pathTo="M 0 188.3526142180125 L 63.58592274248107 120.45806723244985 L 127.17184548496213 162.0708540945689 L 190.7577682274432 113.88762720158894 L 254.34369096992427 155.50041406370798 L 317.92961371240534 129.21865394026437 L 381.5155364548864 170.83144080238344 L 445.1014591973675 166.45114744847615 L 508.68738193984854 91.9861604320526 L 572.2733046823296 148.9299740328471 L 635.8592274248107 124.83836058635711 L 699.4451501672918 116.07777387854259" pathFrom="M -1 262.81760123443604 L -1 262.81760123443604 L 63.58592274248107 262.81760123443604 L 127.17184548496213 262.81760123443604 L 190.7577682274432 262.81760123443604 L 254.34369096992427 262.81760123443604 L 317.92961371240534 262.81760123443604 L 381.5155364548864 262.81760123443604 L 445.1014591973675 262.81760123443604 L 508.68738193984854 262.81760123443604 L 572.2733046823296 262.81760123443604 L 635.8592274248107 262.81760123443604 L 699.4451501672918 262.81760123443604" fill-rule="evenodd"></path><g id="SvgjsG2433" class="apexcharts-series-markers-wrap apexcharts-hidden-element-shown" data:realIndex="0"><g class="apexcharts-series-markers"><circle id="SvgjsCircle2549" r="0" cx="0" cy="0" class="apexcharts-marker w43nsrwnv" stroke="#ffffff" fill="#405189" fill-opacity="1" stroke-width="2" stroke-opacity="0.9" default-marker-size="0"></circle></g></g></g></g><g id="SvgjsG2437" class="apexcharts-bar-series apexcharts-plot-series"><g id="SvgjsG2438" class="apexcharts-series" rel="1" seriesName="Earnings" data:realIndex="1"><path id="SvgjsPath2443" d="M -9.53788841137216 262.818601234436 L -9.53788841137216 67.34801031632423 L 9.53788841137216 67.34801031632423 L 9.53788841137216 262.818601234436 Z" fill="rgba(10,179,156,0.9)" fill-opacity="1" stroke-opacity="1" stroke-linecap="butt" stroke-width="0" stroke-dasharray="0" class="apexcharts-bar-area" index="1" clip-path="url(#gridRectMaskjguqmcyo)" pathTo="M -9.53788841137216 262.818601234436 L -9.53788841137216 67.34801031632423 L 9.53788841137216 67.34801031632423 L 9.53788841137216 262.818601234436 Z" pathFrom="M -9.53788841137216 262.818601234436 L -9.53788841137216 262.818601234436 L 9.53788841137216 262.818601234436 L 9.53788841137216 262.818601234436 L 9.53788841137216 262.818601234436 L 9.53788841137216 262.818601234436 L 9.53788841137216 262.818601234436 L -9.53788841137216 262.818601234436 Z" cy="67.34701031632423" cx="9.53788841137216" j="0" val="89.25" barHeight="195.4705909181118" barWidth="19.07577682274432"></path><path id="SvgjsPath2445" d="M 54.04803433110891 262.818601234436 L 54.04803433110891 46.913941820346814 L 73.12381115385323 46.913941820346814 L 73.12381115385323 262.818601234436 Z" fill="rgba(10,179,156,0.9)" fill-opacity="1" stroke-opacity="1" stroke-linecap="butt" stroke-width="0" stroke-dasharray="0" class="apexcharts-bar-area" index="1" clip-path="url(#gridRectMaskjguqmcyo)" pathTo="M 54.04803433110891 262.818601234436 L 54.04803433110891 46.913941820346814 L 73.12381115385323 46.913941820346814 L 73.12381115385323 262.818601234436 Z" pathFrom="M 54.04803433110891 262.818601234436 L 54.04803433110891 262.818601234436 L 73.12381115385323 262.818601234436 L 73.12381115385323 262.818601234436 L 73.12381115385323 262.818601234436 L 73.12381115385323 262.818601234436 L 73.12381115385323 262.818601234436 L 54.04803433110891 262.818601234436 Z" cy="46.912941820346816" cx="73.12381115385323" j="1" val="98.58" barHeight="215.90465941408922" barWidth="19.07577682274432"></path><path id="SvgjsPath2447" d="M 117.63395707358997 262.818601234436 L 117.63395707358997 112.26791866064326 L 136.70973389633428 112.26791866064326 L 136.70973389633428 262.818601234436 Z" fill="rgba(10,179,156,0.9)" fill-opacity="1" stroke-opacity="1" stroke-linecap="butt" stroke-width="0" stroke-dasharray="0" class="apexcharts-bar-area" index="1" clip-path="url(#gridRectMaskjguqmcyo)" pathTo="M 117.63395707358997 262.818601234436 L 117.63395707358997 112.26791866064326 L 136.70973389633428 112.26791866064326 L 136.70973389633428 262.818601234436 Z" pathFrom="M 117.63395707358997 262.818601234436 L 117.63395707358997 262.818601234436 L 136.70973389633428 262.818601234436 L 136.70973389633428 262.818601234436 L 136.70973389633428 262.818601234436 L 136.70973389633428 262.818601234436 L 136.70973389633428 262.818601234436 L 117.63395707358997 262.818601234436 Z" cy="112.26691866064326" cx="136.70973389633428" j="2" val="68.74" barHeight="150.55068257379278" barWidth="19.07577682274432"></path><path id="SvgjsPath2449" d="M 181.21987981607103 262.818601234436 L 181.21987981607103 24.377332514493926 L 200.29565663881536 24.377332514493926 L 200.29565663881536 262.818601234436 Z" fill="rgba(10,179,156,0.9)" fill-opacity="1" stroke-opacity="1" stroke-linecap="butt" stroke-width="0" stroke-dasharray="0" class="apexcharts-bar-area" index="1" clip-path="url(#gridRectMaskjguqmcyo)" pathTo="M 181.21987981607103 262.818601234436 L 181.21987981607103 24.377332514493926 L 200.29565663881536 24.377332514493926 L 200.29565663881536 262.818601234436 Z" pathFrom="M 181.21987981607103 262.818601234436 L 181.21987981607103 262.818601234436 L 200.29565663881536 262.818601234436 L 200.29565663881536 262.818601234436 L 200.29565663881536 262.818601234436 L 200.29565663881536 262.818601234436 L 200.29565663881536 262.818601234436 L 181.21987981607103 262.818601234436 Z" cy="24.376332514493924" cx="200.29565663881536" j="3" val="108.87" barHeight="238.44126871994212" barWidth="19.07577682274432"></path><path id="SvgjsPath2451" d="M 244.8058025585521 262.818601234436 L 244.8058025585521 92.99462790345126 L 263.88157938129643 92.99462790345126 L 263.88157938129643 262.818601234436 Z" fill="rgba(10,179,156,0.9)" fill-opacity="1" stroke-opacity="1" stroke-linecap="butt" stroke-width="0" stroke-dasharray="0" class="apexcharts-bar-area" index="1" clip-path="url(#gridRectMaskjguqmcyo)" pathTo="M 244.8058025585521 262.818601234436 L 244.8058025585521 92.99462790345126 L 263.88157938129643 92.99462790345126 L 263.88157938129643 262.818601234436 Z" pathFrom="M 244.8058025585521 262.818601234436 L 244.8058025585521 262.818601234436 L 263.88157938129643 262.818601234436 L 263.88157938129643 262.818601234436 L 263.88157938129643 262.818601234436 L 263.88157938129643 262.818601234436 L 263.88157938129643 262.818601234436 L 244.8058025585521 262.818601234436 Z" cy="92.99362790345126" cx="263.88157938129643" j="4" val="77.54" barHeight="169.82397333098478" barWidth="19.07577682274432"></path><path id="SvgjsPath2453" d="M 308.3917253010332 262.818601234436 L 308.3917253010332 78.7805759700222 L 327.46750212377754 78.7805759700222 L 327.46750212377754 262.818601234436 Z" fill="rgba(10,179,156,0.9)" fill-opacity="1" stroke-opacity="1" stroke-linecap="butt" stroke-width="0" stroke-dasharray="0" class="apexcharts-bar-area" index="1" clip-path="url(#gridRectMaskjguqmcyo)" pathTo="M 308.3917253010332 262.818601234436 L 308.3917253010332 78.7805759700222 L 327.46750212377754 78.7805759700222 L 327.46750212377754 262.818601234436 Z" pathFrom="M 308.3917253010332 262.818601234436 L 308.3917253010332 262.818601234436 L 327.46750212377754 262.818601234436 L 327.46750212377754 262.818601234436 L 327.46750212377754 262.818601234436 L 327.46750212377754 262.818601234436 L 327.46750212377754 262.818601234436 L 308.3917253010332 262.818601234436 Z" cy="78.7795759700222" cx="327.46750212377754" j="5" val="84.03" barHeight="184.03802526441385" barWidth="19.07577682274432"></path><path id="SvgjsPath2455" d="M 371.97764804351425 262.818601234436 L 371.97764804351425 150.59548550733186 L 391.0534248662586 150.59548550733186 L 391.0534248662586 262.818601234436 Z" fill="rgba(10,179,156,0.9)" fill-opacity="1" stroke-opacity="1" stroke-linecap="butt" stroke-width="0" stroke-dasharray="0" class="apexcharts-bar-area" index="1" clip-path="url(#gridRectMaskjguqmcyo)" pathTo="M 371.97764804351425 262.818601234436 L 371.97764804351425 150.59548550733186 L 391.0534248662586 150.59548550733186 L 391.0534248662586 262.818601234436 Z" pathFrom="M 371.97764804351425 262.818601234436 L 371.97764804351425 262.818601234436 L 391.0534248662586 262.818601234436 L 391.0534248662586 262.818601234436 L 391.0534248662586 262.818601234436 L 391.0534248662586 262.818601234436 L 391.0534248662586 262.818601234436 L 371.97764804351425 262.818601234436 Z" cy="150.59448550733185" cx="391.0534248662586" j="6" val="51.24" barHeight="112.2231157271042" barWidth="19.07577682274432"></path><path id="SvgjsPath2457" d="M 435.56357078599535 262.818601234436 L 435.56357078599535 200.24611067387073 L 454.6393476087397 200.24611067387073 L 454.6393476087397 262.818601234436 Z" fill="rgba(10,179,156,0.9)" fill-opacity="1" stroke-opacity="1" stroke-linecap="butt" stroke-width="0" stroke-dasharray="0" class="apexcharts-bar-area" index="1" clip-path="url(#gridRectMaskjguqmcyo)" pathTo="M 435.56357078599535 262.818601234436 L 435.56357078599535 200.24611067387073 L 454.6393476087397 200.24611067387073 L 454.6393476087397 262.818601234436 Z" pathFrom="M 435.56357078599535 262.818601234436 L 435.56357078599535 262.818601234436 L 454.6393476087397 262.818601234436 L 454.6393476087397 262.818601234436 L 454.6393476087397 262.818601234436 L 454.6393476087397 262.818601234436 L 454.6393476087397 262.818601234436 L 435.56357078599535 262.818601234436 Z" cy="200.24511067387073" cx="454.6393476087397" j="7" val="28.57" barHeight="62.57249056056532" barWidth="19.07577682274432"></path><path id="SvgjsPath2459" d="M 499.1494935284764 262.818601234436 L 499.1494935284764 60.07672334883818 L 518.2252703512207 60.07672334883818 L 518.2252703512207 262.818601234436 Z" fill="rgba(10,179,156,0.9)" fill-opacity="1" stroke-opacity="1" stroke-linecap="butt" stroke-width="0" stroke-dasharray="0" class="apexcharts-bar-area" index="1" clip-path="url(#gridRectMaskjguqmcyo)" pathTo="M 499.1494935284764 262.818601234436 L 499.1494935284764 60.07672334883818 L 518.2252703512207 60.07672334883818 L 518.2252703512207 262.818601234436 Z" pathFrom="M 499.1494935284764 262.818601234436 L 499.1494935284764 262.818601234436 L 518.2252703512207 262.818601234436 L 518.2252703512207 262.818601234436 L 518.2252703512207 262.818601234436 L 518.2252703512207 262.818601234436 L 518.2252703512207 262.818601234436 L 499.1494935284764 262.818601234436 Z" cy="60.07572334883818" cx="518.2252703512207" j="8" val="92.57" barHeight="202.74187788559786" barWidth="19.07577682274432"></path><path id="SvgjsPath2461" d="M 562.7354162709574 262.818601234436 L 562.7354162709574 170.04398799868014 L 581.8111930937017 170.04398799868014 L 581.8111930937017 262.818601234436 Z" fill="rgba(10,179,156,0.9)" fill-opacity="1" stroke-opacity="1" stroke-linecap="butt" stroke-width="0" stroke-dasharray="0" class="apexcharts-bar-area" index="1" clip-path="url(#gridRectMaskjguqmcyo)" pathTo="M 562.7354162709574 262.818601234436 L 562.7354162709574 170.04398799868014 L 581.8111930937017 170.04398799868014 L 581.8111930937017 262.818601234436 Z" pathFrom="M 562.7354162709574 262.818601234436 L 562.7354162709574 262.818601234436 L 581.8111930937017 262.818601234436 L 581.8111930937017 262.818601234436 L 581.8111930937017 262.818601234436 L 581.8111930937017 262.818601234436 L 581.8111930937017 262.818601234436 L 562.7354162709574 262.818601234436 Z" cy="170.04298799868013" cx="581.8111930937017" j="9" val="42.36" barHeight="92.77461323575592" barWidth="19.07577682274432"></path><path id="SvgjsPath2463" d="M 626.3213390134385 262.818601234436 L 626.3213390134385 68.96871885726992 L 645.3971158361828 68.96871885726992 L 645.3971158361828 262.818601234436 Z" fill="rgba(10,179,156,0.9)" fill-opacity="1" stroke-opacity="1" stroke-linecap="butt" stroke-width="0" stroke-dasharray="0" class="apexcharts-bar-area" index="1" clip-path="url(#gridRectMaskjguqmcyo)" pathTo="M 626.3213390134385 262.818601234436 L 626.3213390134385 68.96871885726992 L 645.3971158361828 68.96871885726992 L 645.3971158361828 262.818601234436 Z" pathFrom="M 626.3213390134385 262.818601234436 L 626.3213390134385 262.818601234436 L 645.3971158361828 262.818601234436 L 645.3971158361828 262.818601234436 L 645.3971158361828 262.818601234436 L 645.3971158361828 262.818601234436 L 645.3971158361828 262.818601234436 L 626.3213390134385 262.818601234436 Z" cy="68.96771885726992" cx="645.3971158361828" j="10" val="88.51" barHeight="193.84988237716613" barWidth="19.07577682274432"></path><path id="SvgjsPath2465" d="M 689.9072617559196 262.818601234436 L 689.9072617559196 182.72493725824165 L 708.9830385786639 182.72493725824165 L 708.9830385786639 262.818601234436 Z" fill="rgba(10,179,156,0.9)" fill-opacity="1" stroke-opacity="1" stroke-linecap="butt" stroke-width="0" stroke-dasharray="0" class="apexcharts-bar-area" index="1" clip-path="url(#gridRectMaskjguqmcyo)" pathTo="M 689.9072617559196 262.818601234436 L 689.9072617559196 182.72493725824165 L 708.9830385786639 182.72493725824165 L 708.9830385786639 262.818601234436 Z" pathFrom="M 689.9072617559196 262.818601234436 L 689.9072617559196 262.818601234436 L 708.9830385786639 262.818601234436 L 708.9830385786639 262.818601234436 L 708.9830385786639 262.818601234436 L 708.9830385786639 262.818601234436 L 708.9830385786639 262.818601234436 L 689.9072617559196 262.818601234436 Z" cy="182.72393725824165" cx="708.9830385786639" j="11" val="36.57" barHeight="80.09366397619439" barWidth="19.07577682274432"></path><g id="SvgjsG2440" class="apexcharts-bar-goals-markers" style="pointer-events: none"><g id="SvgjsG2442" className="apexcharts-bar-goals-groups" class="apexcharts-hidden-element-shown" clip-path="url(#gridRectMarkerMaskjguqmcyo)"></g><g id="SvgjsG2444" className="apexcharts-bar-goals-groups" class="apexcharts-hidden-element-shown" clip-path="url(#gridRectMarkerMaskjguqmcyo)"></g><g id="SvgjsG2446" className="apexcharts-bar-goals-groups" class="apexcharts-hidden-element-shown" clip-path="url(#gridRectMarkerMaskjguqmcyo)"></g><g id="SvgjsG2448" className="apexcharts-bar-goals-groups" class="apexcharts-hidden-element-shown" clip-path="url(#gridRectMarkerMaskjguqmcyo)"></g><g id="SvgjsG2450" className="apexcharts-bar-goals-groups" class="apexcharts-hidden-element-shown" clip-path="url(#gridRectMarkerMaskjguqmcyo)"></g><g id="SvgjsG2452" className="apexcharts-bar-goals-groups" class="apexcharts-hidden-element-shown" clip-path="url(#gridRectMarkerMaskjguqmcyo)"></g><g id="SvgjsG2454" className="apexcharts-bar-goals-groups" class="apexcharts-hidden-element-shown" clip-path="url(#gridRectMarkerMaskjguqmcyo)"></g><g id="SvgjsG2456" className="apexcharts-bar-goals-groups" class="apexcharts-hidden-element-shown" clip-path="url(#gridRectMarkerMaskjguqmcyo)"></g><g id="SvgjsG2458" className="apexcharts-bar-goals-groups" class="apexcharts-hidden-element-shown" clip-path="url(#gridRectMarkerMaskjguqmcyo)"></g><g id="SvgjsG2460" className="apexcharts-bar-goals-groups" class="apexcharts-hidden-element-shown" clip-path="url(#gridRectMarkerMaskjguqmcyo)"></g><g id="SvgjsG2462" className="apexcharts-bar-goals-groups" class="apexcharts-hidden-element-shown" clip-path="url(#gridRectMarkerMaskjguqmcyo)"></g><g id="SvgjsG2464" className="apexcharts-bar-goals-groups" class="apexcharts-hidden-element-shown" clip-path="url(#gridRectMarkerMaskjguqmcyo)"></g></g><g id="SvgjsG2441" class="apexcharts-bar-shadows apexcharts-hidden-element-shown" style="pointer-events: none"></g></g></g><g id="SvgjsG2466" class="apexcharts-line-series apexcharts-plot-series"><g id="SvgjsG2467" class="apexcharts-series" seriesName="Refunds" data:longestSeries="true" rel="1" data:realIndex="2"><path id="SvgjsPath2470" d="M 0 245.29642781880696 L 63.58592274248107 236.53584111099244 L 127.17184548496213 247.4865744957606 L 190.7577682274432 225.58510772622427 L 254.34369096992427 216.82452101840974 L 317.92961371240534 238.72598778794605 L 381.5155364548864 251.86686784966787 L 445.1014591973675 243.10628114185334 L 508.68738193984854 247.4865744957606 L 572.2733046823296 199.30334760278066 L 635.8592274248107 236.53584111099244 L 699.4451501672918 186.16246754105885" fill="none" fill-opacity="1" stroke="rgba(240,101,72,1)" stroke-opacity="1" stroke-linecap="butt" stroke-width="2.2" stroke-dasharray="8" class="apexcharts-line" index="2" clip-path="url(#gridRectMaskjguqmcyo)" pathTo="M 0 245.29642781880696 L 63.58592274248107 236.53584111099244 L 127.17184548496213 247.4865744957606 L 190.7577682274432 225.58510772622427 L 254.34369096992427 216.82452101840974 L 317.92961371240534 238.72598778794605 L 381.5155364548864 251.86686784966787 L 445.1014591973675 243.10628114185334 L 508.68738193984854 247.4865744957606 L 572.2733046823296 199.30334760278066 L 635.8592274248107 236.53584111099244 L 699.4451501672918 186.16246754105885" pathFrom="M -1 262.81760123443604 L -1 262.81760123443604 L 63.58592274248107 262.81760123443604 L 127.17184548496213 262.81760123443604 L 190.7577682274432 262.81760123443604 L 254.34369096992427 262.81760123443604 L 317.92961371240534 262.81760123443604 L 381.5155364548864 262.81760123443604 L 445.1014591973675 262.81760123443604 L 508.68738193984854 262.81760123443604 L 572.2733046823296 262.81760123443604 L 635.8592274248107 262.81760123443604 L 699.4451501672918 262.81760123443604" fill-rule="evenodd"></path><g id="SvgjsG2468" class="apexcharts-series-markers-wrap apexcharts-hidden-element-shown" data:realIndex="2"><g class="apexcharts-series-markers"><circle id="SvgjsCircle2550" r="0" cx="0" cy="0" class="apexcharts-marker wyrvw8bmaj" stroke="#ffffff" fill="#f06548" fill-opacity="1" stroke-width="2" stroke-opacity="0.9" default-marker-size="0"></circle></g></g></g><g id="SvgjsG2434" class="apexcharts-datalabels" data:realIndex="0"></g><g id="SvgjsG2439" class="apexcharts-datalabels apexcharts-hidden-element-shown" data:realIndex="1"></g><g id="SvgjsG2469" class="apexcharts-datalabels" data:realIndex="2"></g></g><g id="SvgjsG2474" class="apexcharts-grid-borders"></g><line id="SvgjsLine2489" x1="-18.38575755032626" y1="0" x2="717.8309077176181" y2="0" stroke="#b6b6b6" stroke-dasharray="0" stroke-width="1" stroke-linecap="butt" class="apexcharts-ycrosshairs"></line><line id="SvgjsLine2490" x1="-18.38575755032626" y1="0" x2="717.8309077176181" y2="0" stroke-dasharray="0" stroke-width="0" stroke-linecap="butt" class="apexcharts-ycrosshairs-hidden"></line><g id="SvgjsG2491" class="apexcharts-xaxis" transform="translate(0, 0)"><g id="SvgjsG2492" class="apexcharts-xaxis-texts-g" transform="translate(0, -4)"><text id="SvgjsText2494" font-family="Helvetica, Arial, sans-serif" x="0" y="291.81760123443604" text-anchor="middle" dominant-baseline="auto" font-size="12px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-xaxis-label " style="font-family: Helvetica, Arial, sans-serif;"><tspan id="SvgjsTspan2495">Jan</tspan><title>Jan</title></text><text id="SvgjsText2497" font-family="Helvetica, Arial, sans-serif" x="63.585922742481074" y="291.81760123443604" text-anchor="middle" dominant-baseline="auto" font-size="12px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-xaxis-label " style="font-family: Helvetica, Arial, sans-serif;"><tspan id="SvgjsTspan2498">Feb</tspan><title>Feb</title></text><text id="SvgjsText2500" font-family="Helvetica, Arial, sans-serif" x="127.17184548496216" y="291.81760123443604" text-anchor="middle" dominant-baseline="auto" font-size="12px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-xaxis-label " style="font-family: Helvetica, Arial, sans-serif;"><tspan id="SvgjsTspan2501">Mar</tspan><title>Mar</title></text><text id="SvgjsText2503" font-family="Helvetica, Arial, sans-serif" x="190.75776822744325" y="291.81760123443604" text-anchor="middle" dominant-baseline="auto" font-size="12px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-xaxis-label " style="font-family: Helvetica, Arial, sans-serif;"><tspan id="SvgjsTspan2504">Apr</tspan><title>Apr</title></text><text id="SvgjsText2506" font-family="Helvetica, Arial, sans-serif" x="254.3436909699243" y="291.81760123443604" text-anchor="middle" dominant-baseline="auto" font-size="12px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-xaxis-label " style="font-family: Helvetica, Arial, sans-serif;"><tspan id="SvgjsTspan2507">May</tspan><title>May</title></text><text id="SvgjsText2509" font-family="Helvetica, Arial, sans-serif" x="317.92961371240534" y="291.81760123443604" text-anchor="middle" dominant-baseline="auto" font-size="12px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-xaxis-label " style="font-family: Helvetica, Arial, sans-serif;"><tspan id="SvgjsTspan2510">Jun</tspan><title>Jun</title></text><text id="SvgjsText2512" font-family="Helvetica, Arial, sans-serif" x="381.51553645488644" y="291.81760123443604" text-anchor="middle" dominant-baseline="auto" font-size="12px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-xaxis-label " style="font-family: Helvetica, Arial, sans-serif;"><tspan id="SvgjsTspan2513">Jul</tspan><title>Jul</title></text><text id="SvgjsText2515" font-family="Helvetica, Arial, sans-serif" x="445.10145919736755" y="291.81760123443604" text-anchor="middle" dominant-baseline="auto" font-size="12px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-xaxis-label " style="font-family: Helvetica, Arial, sans-serif;"><tspan id="SvgjsTspan2516">Aug</tspan><title>Aug</title></text><text id="SvgjsText2518" font-family="Helvetica, Arial, sans-serif" x="508.68738193984865" y="291.81760123443604" text-anchor="middle" dominant-baseline="auto" font-size="12px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-xaxis-label " style="font-family: Helvetica, Arial, sans-serif;"><tspan id="SvgjsTspan2519">Sep</tspan><title>Sep</title></text><text id="SvgjsText2521" font-family="Helvetica, Arial, sans-serif" x="572.2733046823298" y="291.81760123443604" text-anchor="middle" dominant-baseline="auto" font-size="12px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-xaxis-label " style="font-family: Helvetica, Arial, sans-serif;"><tspan id="SvgjsTspan2522">Oct</tspan><title>Oct</title></text><text id="SvgjsText2524" font-family="Helvetica, Arial, sans-serif" x="635.8592274248109" y="291.81760123443604" text-anchor="middle" dominant-baseline="auto" font-size="12px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-xaxis-label " style="font-family: Helvetica, Arial, sans-serif;"><tspan id="SvgjsTspan2525">Nov</tspan><title>Nov</title></text><text id="SvgjsText2527" font-family="Helvetica, Arial, sans-serif" x="699.445150167292" y="291.81760123443604" text-anchor="middle" dominant-baseline="auto" font-size="12px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-xaxis-label " style="font-family: Helvetica, Arial, sans-serif;"><tspan id="SvgjsTspan2528">Dec</tspan><title>Dec</title></text></g></g><g id="SvgjsG2546" class="apexcharts-yaxis-annotations"></g><g id="SvgjsG2547" class="apexcharts-xaxis-annotations"></g><g id="SvgjsG2548" class="apexcharts-point-annotations"></g><rect id="SvgjsRect2551" width="0" height="0" x="0" y="0" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fefefe" class="apexcharts-zoom-rect"></rect><rect id="SvgjsRect2552" width="0" height="0" x="0" y="0" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fefefe" class="apexcharts-selection-rect"></rect></g></svg><div class="apexcharts-tooltip apexcharts-theme-light"><div class="apexcharts-tooltip-title" style="font-family: Helvetica, Arial, sans-serif; font-size: 12px;"></div><div class="apexcharts-tooltip-series-group" style="order: 1;"><span class="apexcharts-tooltip-marker" style="background-color: rgb(64, 81, 137);"></span><div class="apexcharts-tooltip-text" style="font-family: Helvetica, Arial, sans-serif; font-size: 12px;"><div class="apexcharts-tooltip-y-group"><span class="apexcharts-tooltip-text-y-label"></span><span class="apexcharts-tooltip-text-y-value"></span></div><div class="apexcharts-tooltip-goals-group"><span class="apexcharts-tooltip-text-goals-label"></span><span class="apexcharts-tooltip-text-goals-value"></span></div><div class="apexcharts-tooltip-z-group"><span class="apexcharts-tooltip-text-z-label"></span><span class="apexcharts-tooltip-text-z-value"></span></div></div></div><div class="apexcharts-tooltip-series-group" style="order: 2;"><span class="apexcharts-tooltip-marker" style="background-color: rgb(10, 179, 156);"></span><div class="apexcharts-tooltip-text" style="font-family: Helvetica, Arial, sans-serif; font-size: 12px;"><div class="apexcharts-tooltip-y-group"><span class="apexcharts-tooltip-text-y-label"></span><span class="apexcharts-tooltip-text-y-value"></span></div><div class="apexcharts-tooltip-goals-group"><span class="apexcharts-tooltip-text-goals-label"></span><span class="apexcharts-tooltip-text-goals-value"></span></div><div class="apexcharts-tooltip-z-group"><span class="apexcharts-tooltip-text-z-label"></span><span class="apexcharts-tooltip-text-z-value"></span></div></div></div><div class="apexcharts-tooltip-series-group" style="order: 3;"><span class="apexcharts-tooltip-marker" style="background-color: rgb(240, 101, 72);"></span><div class="apexcharts-tooltip-text" style="font-family: Helvetica, Arial, sans-serif; font-size: 12px;"><div class="apexcharts-tooltip-y-group"><span class="apexcharts-tooltip-text-y-label"></span><span class="apexcharts-tooltip-text-y-value"></span></div><div class="apexcharts-tooltip-goals-group"><span class="apexcharts-tooltip-text-goals-label"></span><span class="apexcharts-tooltip-text-goals-value"></span></div><div class="apexcharts-tooltip-z-group"><span class="apexcharts-tooltip-text-z-label"></span><span class="apexcharts-tooltip-text-z-value"></span></div></div></div></div><div class="apexcharts-xaxistooltip apexcharts-xaxistooltip-bottom apexcharts-theme-light"><div class="apexcharts-xaxistooltip-text" style="font-family: Helvetica, Arial, sans-serif; font-size: 12px;"></div></div><div class="apexcharts-yaxistooltip apexcharts-yaxistooltip-0 apexcharts-yaxistooltip-left apexcharts-theme-light"><div class="apexcharts-yaxistooltip-text"></div></div></div></div>
                                </div>
                            </div>
                        </div><!-- end card body -->
                    </div><!-- end card -->

                </div>
                <!-- end col -->
                <div>
                    <div class="card">
                        <div class="card-header align-items-center d-flex" style="justify-content: space-between;">
                            <div><h4 class="card-title mb-0 flex-grow-1">Top 5 khoá học bán chạy nhất</h4></div>
                            {{-- <div class="flex-shrink-0">
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
                            </div> --}}
                        <div>
                            <select name="top-course" id="top-course" class="form-select">
                                <option value="0">Khoá mất phí</option>
                                <option value="1">Khoá miễn phí</option>                           
                            </select>
                        </div>
                        </div><!-- end card header -->

                        <div class="card-body">
                            <div class="table-responsive table-card">
                                <table class="table table-hover table-centered align-middle table-nowrap mb-0">
                                    <tbody>
                                        @foreach ($top5_bestseller_courses as $bestseller_course)
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
                                                                class="text-reset">{{$bestseller_course->name}}</a></h5>
                                                        <span class="text-muted">{{$bestseller_course->created_at}}</span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <h5 class="fs-14 my-1 fw-normal">{{number_format($bestseller_course->price, 0, ',', '.')}} đ</h5>
                                                <span class="text-muted">Giá</span>
                                            </td>
                                            <td>
                                                <h5 class="fs-14 my-1 fw-normal">{{$bestseller_course->orders_count}}</h5>
                                                <span class="text-muted">Đơn hàng</span>
                                            </td>
                                            <td>
                                                <h5 class="fs-14 my-1 fw-normal">{{number_format($bestseller_course->orders_sum_amount, 0, ',', '.')}} đ</h5>
                                                <span class="text-muted">Tổng doanh thu</span>
                                            </td>
                                        </tr>
                                        @endforeach
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
