import Swal from "sweetalert2"
$(document).ready(function () {
    $('#courseType').on("change", function () {
        var type = $(this).val()
        if (type == 45) {
            $('.price').hide()
            $('.price-sale').hide()
        } else {
            $('.price').show()
            $('.price-sale').show()
        }
    })
    //filter by categories
    $('select#selectCate').on('change',function(){
        const cate_id = $(this).val();
        var  msg = "";
        console.log(cate_id);
            $.ajax({
                type:"GET",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                rocessData: false,
                url:'courses/select/category/'+cate_id,
                success:function(data){
                    console.log(data)
                    data.forEach(function(value){
                        msg +=
                        `
                        <tr>
                            <th scope="row">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="chk_child"
                                        value="option1">
                                </div>
                            </th>
                            <td class="customer_name">${value.name}</td>
                            <td class="course-price">${(value.price)?value.price.toLocaleString():0}</td>
                            <td class="price-discount">${ value.discount ? value.discount : 0 }%</td>
                            <td class="cate">${ value.category.name }</td>
                            <td class="status"><span
                                    class="badge badge-soft-success text-uppercase">${ value.status == 1 ? 'Active' : 'Inactive' }</span>
                            </td>
                            <td class="course-image"><img
                                    src="${value.image}"
                                    alt="" width="100px"></td>
                            <td class="date">${value.created_at}</td>
                            <td>
                                <div class="d-flex gap-2">
                                    <div class="edit">
                                        <button class="btn btn-sm btn-success edit-item-btn"><a
                                                href="http://127.0.0.1:8000/courses/edit/${value.id}">Edit</a></button>
                                    </div>
                                    <div class="remove">
                                        <button class="btn btn-sm btn-danger remove-item-btn"
                                            onclick="deleteCourse(${value.id})">Remove</button>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        `
                    })
                    $('#course-content-list').replaceWith(`<tbody class="list form-check-all" id="course-content-list">${msg}</tbody>`)
                }
            })
        
    })
})
window.deleteCourse = (course_id) => {
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
                type: "DELETE",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                processData: false,
                url: 'courses/delete/' + course_id,
                success: function (data) {
                    if (data) {
                        Swal.fire(
                            'Deleted!',
                            'Your file has been deleted.',
                            'success'
                        ).then(function () {
                            location.reload()
                        })
                    }

                },

            })
        }
    })
}
