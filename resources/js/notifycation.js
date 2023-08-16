import 'bootstrap';
import $ from 'jquery';

window.$ = window.jquery = $
import axios from 'axios';
import Swal from "sweetalert2"

window.selectpicker = () => {
    $('.list-select-user').select2();
};
window.DeleteNotify = (id) => {
    Swal.fire({
        title: 'Bạn chắc chắn muốn xóa?',
        text: "Bạn không thể lấy lại dữ liệu đã xóa!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Bạn thực sự muốn xóa?'
    }).then((result) => {
        if (result.isConfirmed) {
            // Gửi yêu cầu xóa bằng Ajax
            $.ajax({
                url: '/notify/delete-notify/' + id,
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
window.deleteNotifyCheckbox = (selectedIds) => {
    // Gửi yêu cầu xóa bằng Ajax
    $.ajax({
        url: '/notify/delete-notify-checkbox',
        type: 'POST',
        data: {
            _token: $('meta[name="csrf-token"]').attr('content'),
            selectedIds: selectedIds
        },
        success: function (response) {
            // Xóa các hàng đã chọn từ giao diện
            selectedIds.forEach(function (notifyId) {
                const row = document.querySelector(`tr[data-notify-id="${notifyId}"]`);
                if (row) {
                    row.remove();
                }
            });

            Swal.fire(
                'Đã xóa thành công.',
            );
        },
        error: function (xhr) {
            Swal.fire(
                'Xảy ra lỗi trong quá trình xóa.',
            );
        }
    });
}

window.deleteMultipleNotify = () => {
    // Lấy danh sách tất cả các checkbox đã được tích
    const checkboxes = document.querySelectorAll('#NotifyTable tbody input[type="checkbox"]:checked');

    // Tạo một mảng để lưu trữ các ID đã chọn
    const selectedIds = [];

    // Lặp qua từng checkbox đã được tích và lưu trữ ID vào mảng
    checkboxes.forEach(function (checkbox) {
        const row = checkbox.closest('tr');
        const notifyId = row.dataset.notifyId;
        selectedIds.push(notifyId);

        // Xóa hàng khỏi bảng
        row.remove();
    });
    console.log(selectedIds)
    // Gọi hàm xóa trên backend và gửi mảng các ID đã chọn
    deleteNotifyCheckbox(selectedIds);
}

// window.clickIread = () => {
//     $('.form-check-input').on('change', function () {
//         var notifyId = $(this).data('notify-id'); // Lấy id của thông báo từ data-attribute
//         var isChecked = $(this).prop('checked'); // Kiểm tra trạng thái tích/nhấp vào checkbox
//         updateIread(notifyId, isChecked);
//     });

//     function updateIread(notifyId, isChecked) {
//         // Gửi yêu cầu cập nhật thông báo đã đọc thông qua Ajax
//         axios.post(`/notify/update-isread/${notifyId}`, {is_read: isChecked})
//             .then(response => {
//                 if (response.data.success) {
//                     // Cập nhật thành công (không cần làm gì)
//                     window.location.reload();
//                 } else {
//                     console.log(response.data.message);
//                 }
//             })
//             .catch(error => {
//                 console.log(error);
//             });
//     }
// };
// window.clickIread();
