import Swal from "sweetalert2"
//add categories
window.addCate = ()=>{
    $.ajax({
        data:$('#category-create').serialize(),
        type:"POST",
        //copy file
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        processData: false,
        url: 'categories/store',
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
            $('#error-create').html(err.message);

     }

    })
}
//Edit Cate
window.updateCate = (cate_id)=>{
    $.ajax({
        data:$(`#category-update${cate_id}`).serialize(),
        type:"PUT",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        processData: false,
        url: 'categories/update/'+cate_id,
        success: function (data) {
            Swal.fire(
                'Bạn đã cập nhật thành công'
              ).then(function(){
                location.reload();
              })
        },
        error:function(xhr,request,error){
            var err = eval("(" + xhr.responseText + ")");
            console.log(err.message)
            $('#error-edit').html(err.message);

     }

    })
}
//delete cate
window.deleteCate=(cate_id)=>{
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
                url: 'categories/delete/'+cate_id,
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
