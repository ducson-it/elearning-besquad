import { forEach } from "lodash"

$(document).ready(function(){
    $('select#course_id').on('change',function(){
        var course_id = $(this).val()
        var msg = ''
        $.ajax({
            type:"POST",
            url:'/lessons/select/module',
            data:{
                'course_id':course_id
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success:function(data){
                data.forEach(function(value){
                    msg +=`<option value="${value.id}">${value.name}</option>`
                })
                $('#module_id').html(msg)
            }
        })
    })
//     $('#uploadVideo').on('change',function(){
//         const file_video = $("#uploadVideo");
// var formData = new FormData();
//     formData.append("file",file_video[0].files[0]);
//                 $.ajax({
//                     type: "POST",
//                     url: 'video/upload',
//                     headers: {
//                         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//                     },
//                     data : formData,
//                     processData: false,  // tell jQuery not to process the data
//                     contentType: false,  // tell jQuery not to set contentType
//                     success : function(data) {
//                         console.log(data)
//                     }
//                 });

//             })
})
//delete lesson
window.deleteLesson = (course_id)=>{
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
                url: 'lesson/delete/'+course_id,
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