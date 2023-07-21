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
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
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
                            'Deleted!',
                            'Your file has been deleted.',
                            'success'
                          ).then(function(){
                            location.reload()
                          })
                    }
                
                },
        
            })
        }
      })
}