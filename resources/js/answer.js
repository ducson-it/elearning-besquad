import Swal from "sweetalert2"
//add question
window.addAnswer = ()=>{
    $.ajax({
        data:$('#answer-create').serialize(),
        type:"POST",
        //copy file
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        processData: false,
        url: 'answers/store',
        success: function (data) {
            Swal.fire(
                'Bạn đã thêm thành công',
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
window.updateAnswer = (answer_id)=>{
    $.ajax({
        data:$(`#answer-update${answer_id}`).serialize(),
        type:"PUT",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        processData: false,
        url: 'answers/update/'+answer_id,
        success: function (data) {
            if(data.status){
                Swal.fire(
                    'Bạn đã cập nhật thành công',
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
window.deleteAnswer=(answer_id)=>{
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
                url: 'answers/delete/'+answer_id,
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
