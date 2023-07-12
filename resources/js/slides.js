import 'bootstrap';
import Dropzone from "dropzone";
import Swal from 'sweetalert2';
import axios from "axios";
window.deletesliders = (id) => {
    Swal.fire({
        icon: 'warning',
        title: 'Xóa',
        showConfirmButton: true,
        showCancelButton: true
    }).then(res => {
        if (res.isConfirmed) {
            // Gọi API để xóa
            axios.get('/slider/delete/' + id)
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
// ****************************88888upload file
const metaToken = document.querySelector('meta[name="csrf-token"]');

let myDropzone = new Dropzone("#sliders-image-upload",{
    url:'/sliders/upload2',
    headers: {
        'X-CSRF-TOKEN':metaToken.getAttribute('content')
    }
});
myDropzone.on('complete', (file) => {
    document.querySelector('input[name="image"]').setAttribute('value', file.xhr.response)
})


