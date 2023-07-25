window.Statistic = (time)=>{
    var msg = '';
    var statistic_result = ''
    var time = time;
        $.ajax({
            type:"GET",
            url:'/statistic-business',
            data:{
                'time':time
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success:function(data){
                if(data.status){
                    statistic_result = data.data
                }
                msg = `
                <div class="row g-0 text-center" id="statistic">
                <div class="col-6 col-sm-3">
                                    <div class="p-3 border border-dashed border-start-0">
                                        <h5 class="mb-1"><span class="counter-value" data-target="7585">${statistic_result.order_all}</span>
                                        </h5>
                                        <p class="text-muted mb-0">Đơn hàng</p>
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-6 col-sm-3">
                                    <div class="p-3 border border-dashed border-start-0">
                                        <h5 class="mb-1">${new Intl.NumberFormat('vi-VN').format(statistic_result.revenue_all)}</span> Đ
                                        </h5>
                                        <p class="text-muted mb-0">Doanh thu</p>
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-6 col-sm-3">
                                    <div class="p-3 border border-dashed border-start-0">
                                        <h5 class="mb-1"><span class="counter-value" data-target="367">${statistic_result.order_cancel}</span>
                                        </h5>
                                        <p class="text-muted mb-0">Huỷ bỏ</p>
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-6 col-sm-3">
                                    <div class="p-3 border border-dashed border-start-0 border-end-0">
                                        <h5 class="mb-1 text-success"><span class="counter-value"
                                                data-target="18.92">${statistic_result.conversion_rate}</span>%</h5>
                                        <p class="text-muted mb-0">Tỷ lệ chuyển đổi</p>
                                    </div>
                                </div>
                </div>
                `
                $('#statistic').replaceWith(msg)
            }
        })
}