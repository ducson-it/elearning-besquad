//hôm trước để tách từng file code thì nhận. hôm sau ko ăn js nữa ảo thật

import 'bootstrap';
import Swal from 'sweetalert2';
import axios from "axios";
import Dropzone  from "dropzone";

window.deleteblogs = (id) => {
    Swal.fire({
        icon: 'warning',
        title: 'Xóa',
        showConfirmButton: true,
        showCancelButton: true
    }).then(res => {
        if (res.isConfirmed) {
            // Gọi API để xóa
            axios.get('/blogs/delete/' + id)
                .then(apiRes => {
                    Swal.fire({
                        icon: 'success',
                        title: 'Deleted',
                        text: 'successfully!',
                        showConfirmButton: true
                    }).then(() => {
                        location.reload();
                    });
                })
                .catch(err => {
                    console.error(err);

                });
        }
    });
};
// upload ảnh
const metaToken = document.querySelector('meta[name="csrf-token"]');
let myDropzone = new Dropzone("#blogs-image-upload",{
    url:'/blogs/upload3',
    headers: {
        'X-CSRF-TOKEN':metaToken.getAttribute('content')
    }
});
myDropzone.on('complete', (file) => {
})

