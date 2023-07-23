import 'bootstrap';
import $ from 'jquery';

window.$ = window.jquery = $
import Dropzone from "dropzone";
import axios from 'axios';
import Swal from "sweetalert2"

const metaToken = document.querySelector('meta[name="csrf-token"]');
const UserUpload = document.querySelector('#user-img-upload');

if (UserUpload) {
    let myDropzone = new Dropzone("#user-img-upload", {
        url: '/user/upload',
        headers: {
            'X-CSRF-TOKEN': metaToken.getAttribute('content')
        },
        acceptedFiles: "image/*",
    });
    myDropzone.on('complete', file => {
        console.log(file.xhr.response);
        document.querySelector('input[name="image"]').setAttribute('value', file.xhr.response);
    })
}

window.DeleteUser = (id) => {
    Swal.fire({
        title: 'Bạn có chắc chắn muốn xóa?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            // Gửi yêu cầu xóa bằng Ajax
            $.ajax({
                url: '/user/delete-user/' + id,
                type: 'DELETE',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response) {
                    Swal.fire(
                        'Deleted!',
                        'Đã xóa thành công !',
                        'success'
                    ).then(() => {
                        // Chuyển hướng sau khi xóa thành công
                        window.location.reload();
                    });
                },
                error: function (xhr) {
                    Swal.fire(
                        'Error!',
                        'Đã xảy ra lỗi khi xóa.',
                        'error'
                    );
                }
            });
        }
    });
}

window.activeUser = (id) => {
    console.log(id)
    Swal.fire({
        title: ' Bạn chắc chắn ? ',
        text: "Thay đổi trạng thái tài khoản này ?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, update it!'
    }).then((result) => {
        if (result.isConfirmed) {
            // Gửi yêu cầu xóa bằng Ajax
            $.ajax({
                url: '/user/user-active/' + id,
                type: 'POST',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response) {
                    Swal.fire(
                        'Updated!',
                        'Đã cập nhật trường active thành công',
                        'success'
                    ).then(() => {
                        // Chuyển hướng sau khi xóa thành công
                        window.location.reload();
                    });
                },
                error: function (xhr) {
                    Swal.fire(
                        'Error!',
                        'Không thể cập nhật trường active.',
                        'error'
                    );
                }
            });
        }
    });
}

//
window.deleteUserCheckbox = (selectedIds) => {
    // Gửi yêu cầu xóa bằng Ajax
    $.ajax({
        url: '/user/delete-user-checkbox',
        type: 'POST',
        data: {
            _token: $('meta[name="csrf-token"]').attr('content'),
            selectedIds: selectedIds
        },
        success: function (response) {
            // Xóa các hàng đã chọn từ giao diện
            selectedIds.forEach(function (userId) {
                const row = document.querySelector(`tr[data-user-id="${userId}"]`);
                if (row) {
                    row.remove();
                }
            });
            selectedIds = [];
            Swal.fire(
                'Deleted!',
                'Your records have been deleted.',
                'success'
            );
        },
        error: function (xhr) {
            Swal.fire(
                'Error!',
                'An error occurred while deleting the records.',
                'error'
            );
        }
    });
}

window.deleteMultipleUser = () => {
    // Lấy danh sách tất cả các checkbox đã được tích
    const checkboxes = document.querySelectorAll('#userTable tbody input[type="checkbox"]:checked');

    // Tạo một mảng để lưu trữ các ID đã chọn
    const selectedIds = [];

    // Lặp qua từng checkbox đã được tích và lưu trữ ID vào mảng
    checkboxes.forEach(function (checkbox) {
        const row = checkbox.closest('tr');
        const userId = row.dataset.userId;
        selectedIds.push(userId);

        // Xóa hàng khỏi bảng
        row.remove();
    });
    console.log(selectedIds)
    // Gọi hàm xóa trên backend và gửi mảng các ID đã chọn
    deleteUserCheckbox(selectedIds);
}


