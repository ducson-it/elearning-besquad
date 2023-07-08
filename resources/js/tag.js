 console.log('ấdasdasdasd')
window.addTag = () => {
    $('#tag-form').submit(function(event) {
        event.preventDefault(); // Ngăn chặn hành vi mặc định của form (tải lại trang)

        var form = $(this);
        var url = form.attr('action');
        var formData = form.serialize();

        $.ajax({
            type: 'POST',
            url: url,
            data: formData,
            success: function(response) {
                // Xử lý kết quả thành công
                console.log(response);
                // Thực hiện các hành động khác sau khi gửi thành công
            },
            error: function(response) {
                // Xử lý lỗi
                var errors = response.responseJSON.errors;
                console.log(errors);
                // Hiển thị thông báo lỗi hoặc xử lý lỗi theo ý của bạn
            }
        });
    });
  }

