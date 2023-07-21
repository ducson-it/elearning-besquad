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
                'Bạn đã thêm thành công',
                'You clicked the button!',
                'success'
              ).then(function(){
                location.reload();
              })
        },
        error:function(xhr,request,error){
            var err = eval("(" + xhr.responseText + ")");
            console.log(err.message)
            $('#error').html(err.message);

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
                'Bạn đã cập nhật thành công',
                'You clicked the button!',
                'success'
              ).then(function(){
                location.reload();
              })
        },
        error:function(xhr,request,error){
            var err = eval("(" + xhr.responseText + ")");
            console.log(err.message)
            $('#error').html(err.message);

     }

    })
}
//delete cate
window.deleteCate=(cate_id)=>{
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
                url: 'categories/delete/'+cate_id,
                success: function (data) {
                    Swal.fire(
                        'Deleted!',
                        'Your file has been deleted.',
                        'success'
                      ).then(function(){
                        location.reload()
                      })
                },

            })
        }
      })
}
