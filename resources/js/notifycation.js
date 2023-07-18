
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
        title: 'Are you sure?',
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
                url: '/notify/delete-notify/' + id,
                type: 'DELETE',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response) {
                    Swal.fire(
                        'Deleted!',
                        'Your record has been deleted.',
                        'success'
                    ).then(() => {
                        // Chuyển hướng sau khi xóa thành công
                        window.location.reload();
                    });
                },
                error: function (xhr) {
                    Swal.fire(
                        'Error!',
                        'An error occurred while deleting the record.',
                        'error'
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

