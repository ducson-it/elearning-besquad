import 'bootstrap';
import $ from 'jquery';

window.$ = window.jquery = $
import Dropzone from "dropzone";
import axios from 'axios';
import Swal from "sweetalert2"


window.DeleteForumCmt = (id) => {
    Swal.fire({
        title: 'Bạn có chắc chắn muốn xóa?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Đồng ý xóa!'
    }).then((result) => {
        if (result.isConfirmed) {
            // Gửi yêu cầu xóa bằng Ajax
            $.ajax({
                url: '/forum-comment/forumCmt-delete/' + id,
                type: 'DELETE',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response) {
                    Swal.fire(
                        'Đã xóa thành công!',
                    ).then(() => {
                        // Chuyển hướng sau khi xóa thành công
                        window.location.reload();
                    });
                },
                error: function (xhr) {
                    Swal.fire(
                        'Đã xảy ra lỗi khi xóa.',
                    );
                }
            });
        }
    });
}

window.activeForumCmt = (id) => {
    Swal.fire({
        title: ' Bạn có chắc chắc? ',
        text: "Thay đổi trạng thái?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'cập nhật'
    }).then((result) => {
        if (result.isConfirmed) {
            // Gửi yêu cầu xóa bằng Ajax
            $.ajax({
                url: '/forum-comment/forumCmt-active/' + id,
                type: 'POST',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response) {
                    Swal.fire(
                        'Đã cập nhật!',
                        'Kịch hoạt thành công',
                        'success'
                    ).then(() => {
                        // Chuyển hướng sau khi xóa thành công
                        window.location.reload();
                    });
                },
                error: function (xhr) {
                    Swal.fire(
                        'Error!',
                        'Kích hoạt không thành công.',
                        'error'
                    );
                }
            });
        }
    });
}
