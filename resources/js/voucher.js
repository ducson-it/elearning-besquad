import Swal from 'sweetalert2';
window.DeleteVoucher = (id) => {
    Swal.fire({
        title: 'Bạn có chắc chắn muốn xóa voucher này?',
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
                url: '/voucher/voucher-delete/' + id,
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
                        'Đã xảy ra lỗi khi xóa voucher.',
                        'error'
                    );
                }
            });
        }
    });
}
