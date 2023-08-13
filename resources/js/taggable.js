import 'bootstrap';
import $ from 'jquery';

window.$ = window.jquery = $
import axios from 'axios';
import Swal from "sweetalert2"

window.showDeleteTaggable = (id) => {
    Swal.fire({
        title: 'Bạn chắc chắn muốn xóa?',
        text: "Bạn không thể lấy lại dữ liệu đã xóa!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Đồng ý xóa!'
    }).then((result) => {
        if (result.isConfirmed) {
            // Gửi yêu cầu xóa bằng Ajax
            $.ajax({
                url: '/tag/delete-taggable/' + id,
                type: 'DELETE',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response) {
                    Swal.fire(
                        'Đã xóa thành công.',
                    ).then(() => {
                        // Chuyển hướng sau khi xóa thành công
                        window.location.reload();
                    });
                },
                error: function (xhr) {
                    Swal.fire(
                        'Xảy ra lỗi trong quá trình xóa.',
                    );
                }
            });
        }
    });
}

//

window.deleteMultiple = () => {
    // Lấy danh sách tất cả các checkbox đã được tích
    const checkboxes = document.querySelectorAll('#customerTable tbody input[type="checkbox"]:checked');

    // Tạo một mảng để lưu trữ các ID đã chọn
    const selectedIds = [];

    // Lặp qua từng checkbox đã được tích và lưu trữ ID vào mảng
    checkboxes.forEach(function (checkbox) {
        const row = checkbox.closest('tr');
        const taggableId = row.dataset.taggableId;
        selectedIds.push(taggableId);

        // Xóa hàng khỏi bảng
        row.remove();
    });
    console.log(selectedIds)
    // Gọi hàm xóa trên backend và gửi mảng các ID đã chọn
    deleteTaggables(selectedIds);
}
