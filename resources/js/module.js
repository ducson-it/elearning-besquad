import Swal from "sweetalert2"
document.addEventListener('DOMContentLoaded', function () {
    $(function () {
        $('#course_id').select2({
            placeholder: 'Select...',
            allowClear: true,
            ajax: {
                delay: 230,
                url: '/modules/search/course',
                dataType: 'json',
                data: function (params) {
                    return {
                        search: params.term
                    };
                },
                processResults: function (data) {
                    return {
                        results: $.map(data, function (course) {
                            return {
                                text: `${course.name}`,
                                id: `${course.id}`,
                            }
                        }),
                    };
                },
                cache: true
            },
        });
    });
});

window.deleteModule = (module_id)=>{
    Swal.fire({
        title: 'Bạn có chắc chắn xóa?',
        text: "Bạn không thể lấy lại dữ liệu đã xóa!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Đồng ý xóa!'
      }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                type:"DELETE",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                processData: false,
                url: 'modules/delete/'+module_id,
                success: function (data) {
                    if(data){
                        Swal.fire(
                            'Dữ liệu đã được xóa.',
                          ).then(function(){
                            location.reload()
                          })
                    }

                },

            })
        }
      })
}
