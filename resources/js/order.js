import Swal from "sweetalert2"
document.addEventListener('DOMContentLoaded', function () {
    //select user
    $(function () {
        $('#user_id').select2({
            placeholder: 'Select...',
            allowClear: true,
            ajax: {
                delay: 230,
                url: '/orders/search/user',
                dataType: 'json',
                data: function (params) {
                    return {
                        search: params.term
                    };
                },
                processResults: function (data) {
                    return {
                        results: $.map(data, function (user) {
                            return {
                                text: `${user.name}`,
                                id: `${user.id}`,
                            }
                        }),
                    };
                },
                cache: true
            },
        });
    });
    //show price_course after choose course
    $('select#course_id').on('change',function(){
        var course_id = $(this).val()
        var msg = ''
        var total_amount = ''
        $.ajax({
            type:"GET",
            url:'/orders/select/course/'+course_id,
            processData:false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success:function(data){
                console.log(data);
                    msg = `<input type="number" name="price" id="price" class="form-control" value = "${data.price}">`;
                    total_amount = `<input type="number" name="amount" id="total_amount" class="form-control" value = "${data.price}">`;
                    $('#price').replaceWith(msg);
                    $(('#total_amount')).replaceWith(total_amount);
            }
        })
    })
});
window.voucherVerify = ()=>{
    const voucher = $('#voucher').val();
    const price = $('#price').val();
    console.log(price);
    var msg = '';
    $.ajax({
        type:"GET",
        url:'/orders/voucher/check/'+voucher,
        processData:false,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success:function(data){
            if(data.status == true){
                msg = `<input type="number" name="amount" id="total_amount" class="form-control" value = "${price-(data.data[0].value*price/100)}">`;
                    $('#total_amount').replaceWith(msg);
                    $('#error-voucher').html(`Đã áp dụng voucher giảm giá : ${data.data[0].value}%`);
            }else{
                $('#error-voucher').html(data.message)
            }
        }
    })
}
window.PaymentVerify = (order_id,type)=>{
    $.ajax({
        type:"POST",
        url:'/orders/payment/'+type+'/'+order_id,
        processData:false,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success:function(data){
            if(data.status == true){
                Swal.fire(
                    data.message,
                    'Dữ liệu đã được xóa.',
                ).then(function () {
                    location.reload()
                })
            }
        }
    })
}
