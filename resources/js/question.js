import Swal from "sweetalert2"
//add question
window.addQuestion = ()=>{
    $.ajax({
        data:$('#question-create').serialize(),
        type:"POST",
        //copy file
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        processData: false,
        url: 'questions/store',
        success: function (data) {
            Swal.fire(
                'Bạn đã thêm thành công'
              ).then(function(){
                location.reload();
              })
        },
        error:function(xhr,request,error){
            var err = eval("(" + xhr.responseText + ")");
            console.log(err.message)
            $('#error-name').html(err.message);

     }

    })
}
//Edit question
window.updateQuestion = (question_id)=>{
    $.ajax({
        data:$(`#question-update${question_id}`).serialize(),
        type:"PUT",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        processData: false,
        url: 'questions/update/'+question_id,
        success: function (data) {
            if(data.status){
                Swal.fire(
                    'Bạn đã cập nhật thành công'
                  ).then(function(){
                    location.reload();
                  })
            }
        },
        error:function(xhr,request,error){
            var err = eval("(" + xhr.responseText + ")");
            console.log(err.message)
            $('#error-edit').html(err.message);

     }

    })
}
//delete question
window.deleteQuestion=(question_id)=>{
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
                url: 'questions/delete/'+question_id,
                success: function (data) {
                    Swal.fire(
                        'Dữ liệu đã được xóa.',
                      ).then(function(){
                        location.reload()
                      })
                },

            })
        }
      })
}
