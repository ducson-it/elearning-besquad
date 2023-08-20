import { forEach } from "lodash"
import Swal from "sweetalert2"
$(document).ready(function(){
    $('select#course_id').on('change',function(){
        var course_id = $(this).val()
        var msg = '';
        var quiz = '';
        $.ajax({
            type:"POST",
            url:'/lessons/select/course',
            data:{
                'course_id':course_id
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success:function(data){
                data.modules.forEach(function(value){
                    msg +=`<option value="${value.id}">${value.name}</option>`
                })
                $('#module_id').html(msg);
                data.quiz.forEach(function(value){
                    quiz +=`<option value="${value.id}">${value.name}</option>`
                })
                $('#quiz_id').html(quiz)
            }
        })
    })
    function selectCourse(){
        console.log('---fsdfds---')
        var course_id = $('#course_id').val()
        var module_id = $('#module_id').val()
        var quiz_id = $('#quiz_id').val()

        var msg = ''
        var quiz = ''
        $.ajax({
            type:"POST",
            url:'/lessons/select/course',
            data:{
                'course_id':course_id
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success:function(data){
                data.modules.forEach(function(value){
                    msg +=`<option value="${value.id}" ${value.id == module_id? 'selected':''}>${value.name}</option>`
                })
                $('#module_id').html(msg)
                data.quiz.forEach(function(value){
                    quiz +=`<option value="${value.id}" ${value.id == quiz_id? 'selected':''}>${value.name}</option>`
                })
                $('#quiz_id').html(quiz)
            }
        })
    }
    selectCourse()
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
$('select#video').on('change',function(){
    var video_id = $(this).val()
        var msg = ''
        $.ajax({
            type:"GET",
            url:'/lessons/select/video/'+video_id,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success:function(data){
                msg = `
                <div style="width:200px" id="showVideo">
                    ${data.embed_code}
                </div>
                `
                $('#showVideo').html(msg)
                $('#time').html(
                    `
                    <input class="form-control" type="hidden" name="time" value="${data.plays}">
                    `
                )
            }
        })
})
})
function selectLessonType(){
    var lesson_type = $('#lesson_type').val();
    if(lesson_type == 1){
        $('#video-select').show();
        $('#quiz-select').hide();
    }else{
        $('#quiz-select').show();
        $('#video-select').hide();

    }
}
selectLessonType();
$('select#lesson_type').on('change',function(){
    selectLessonType();
})
//delete lesson
window.deleteLesson = (lesson_id)=>{
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
                url: 'lessons/delete/'+lesson_id,
                success: function (data) {
                    if(data){
                        Swal.fire(
                            'Dữ liệu đã được xóa.'
                          ).then(function(){
                            location.reload()
                          })
                    }

                },

            })
        }
      })
}
