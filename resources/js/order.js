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
            minimumInputLength: 1
        });
    });
    //show price_course after choose course
    $('select#course_id').on('change',function(){
        var course_id = $(this).val()
        var msg = ''
        $.ajax({
            type:"GET",
            url:'/orders/select/course/'+course_id,
            processData:false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success:function(data){
                console.log(data);
                    msg = `<input type="number" name="amount" id="total_amount" class="form-control" value = "${data.price}">`;
                    $('#total_amount').replaceWith(msg);
            }
        })
    })
});
