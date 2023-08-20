// import { Chart } from 'chart.js/auto'
// let myChart = null;
//
// $(document).ready(function () {
//     var monthList = [];
//     var orderCancelList = [];
//     var orderCompleteList = [];
//     window.Statistic = (time) => {
//         var msg = '';
//         var statistic_result = ''
//         var time = time;
//         $.ajax({
//             type: "GET",
//             url: '/statistic-business',
//             data: {
//                 'time': time
//             },
//             headers: {
//                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//             },
//             success: function (data) {
//                 if (data.status) {
//                     statistic_result = data.data
//                     console.log(statistic_result)
//                     monthList = statistic_result.monthList;
//                     orderCancelList = statistic_result.order_cancel_list;
//                     orderCompleteList = statistic_result.order_complete_list;
//                     console.log(orderCancelList);
//                 }
//                 msg = `
//                 <div class="row g-0 text-center" id="statistic">
//                 <div class="col-6 col-sm-2">
//                                     <div class="p-3 border border-dashed border-start-0">
//                                         <h5 class="mb-1"><span class="counter-value" data-target="7585">${statistic_result.order_all}</span>
//                                         </h5>
//                                         <p class="text-muted mb-0">Đơn hàng</p>
//                                     </div>
//                                 </div>
//                                 <!--end col-->
//                                 <div class="col-6 col-sm-3">
//                                     <div class="p-3 border border-dashed border-start-0">
//                                         <h5 class="mb-1">${new Intl.NumberFormat('vi-VN').format(statistic_result.revenue_all)}</span> Đ
//                                         </h5>
//                                         <p class="text-muted mb-0">Doanh thu</p>
//                                     </div>
//                                 </div>
//                                 <!--end col-->
//                                 <div class="col-6 col-sm-2">
//                                     <div class="p-3 border border-dashed border-start-0">
//                                         <h5 class="mb-1"><span class="counter-value" data-target="367">${statistic_result.order_complete}</span>
//                                         </h5>
//                                         <p class="text-muted mb-0">Hoàn thành</p>
//                                     </div>
//                                 </div>
//                                 <div class="col-6 col-sm-2">
//                                     <div class="p-3 border border-dashed border-start-0">
//                                         <h5 class="mb-1"><span class="counter-value" data-target="367">${statistic_result.order_cancel}</span>
//                                         </h5>
//                                         <p class="text-muted mb-0">Huỷ bỏ</p>
//                                     </div>
//                                 </div>
//                                 <!--end col-->
//                                 <div class="col-6 col-sm-3">
//                                     <div class="p-3 border border-dashed border-start-0 border-end-0">
//                                         <h5 class="mb-1 text-success"><span class="counter-value"
//                                                 data-target="18.92">${statistic_result.conversion_rate}</span>%</h5>
//                                         <p class="text-muted mb-0">Tỷ lệ chuyển đổi</p>
//                                     </div>
//                                 </div>
//                 </div>
//                 `
//                 $('#statistic').replaceWith(msg)
//
//                 //chart
//                 if (myChart != null) {
//                     console.log('----quannguyen----');
//                     myChart.destroy()
//                 }
//
//                 myChart = new Chart(document.getElementById('myChart'), {
//                     type: 'bar',
//                     data: {
//                         labels: monthList,
//                         datasets: [{
//                             label: "Đơn hàng",
//                             data: orderCompleteList,
//                             backgroundColor: "#0ab39c",
//                             borderColor: 'transparent',
//                             borderWidth: 2.5,
//                             barPercentage: 0.4,
//                         }, {
//                             label: "Huỷ bỏ",
//                             startAngle: 2,
//                             data: orderCancelList,
//                             backgroundColor: "#f1963b",
//                             borderColor: 'transparent',
//                             borderWidth: 2.5,
//                             barPercentage: 0.4,
//                         }]
//                     },
//                     options: {
//                         scales: {
//                             yAxes: [{
//                                 gridLines: {},
//                                 ticks: {
//                                     stepSize: 15,
//                                 },
//                             }],
//                             xAxes: [{
//                                 gridLines: {
//                                     display: false,
//                                 }
//                             }]
//                         }
//                     }
//                 })
//
//             }
//         })
//     }
//     $('select#top-course').on('change', function () {
//         var course_type = $(this).val();
//         var msg = '';
//         $.ajax({
//             type: "POST",
//             url: '/top-course',
//             data: {
//                 'course_type': course_type
//             },
//             headers: {
//                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//             },
//             success: function (data) {
//                 console.log(data)
//                 data.forEach(function (value) {
//                     msg += `
//                     <tr>
//                     <td>
//                         <div class="d-flex align-items-center">
//                             <div class="avatar-sm bg-light rounded p-1 me-2">
//                                 <img src="assets/images/products/img-1.png" alt=""
//                                     class="img-fluid d-block">
//                             </div>
//                             <div>
//                                 <h5 class="fs-14 my-1"><a
//                                         href="apps-ecommerce-product-details.html"
//                                         class="text-reset">${value.name}</a></h5>
//                                 <span class="text-muted">${value.created_at}</span>
//                             </div>
//                         </div>
//                     </td>
//                     <td>
//                         <h5 class="fs-14 my-1 fw-normal">${(value.price) ? value.price.toLocaleString() : 0} đ</h5>
//                         <span class="text-muted">Giá</span>
//                     </td>
//                     <td>
//                         <h5 class="fs-14 my-1 fw-normal">${value.orders_count}</h5>
//                         <span class="text-muted">Đơn hàng</span>
//                     </td>
//                     <td>
//                         <h5 class="fs-14 my-1 fw-normal">${(value.orders_sum_amount) ? value.orders_sum_amount.toLocaleString() : 0}</h5>
//                         <span class="text-muted">Tổng doanh thu</span>
//                     </td>
//                 </tr>
//                     `
//                 })
//                 $('#show-top-course').html(msg);
//
//             }
//         })
//     })
//
// })
