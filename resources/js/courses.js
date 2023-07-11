  import Swal from "sweetalert2"
  $(document).ready(function(){
        $('#courseType').on("change",function(){
            var type = $(this).val()
            if(type == 45){
                $('.price').hide()
                $('.price-sale').hide()
            }else{
                $('.price').show()
                $('.price-sale').show()
            }
    })

    })
window.deleteCourse = (course_id)=>{
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
                url: 'courses/delete/'+course_id,
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