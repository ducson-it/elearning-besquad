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
const elUpload = document.querySelector('#sliders-img-upload')
if(elUpload){
    let myDropzone = new Dropzone("#sliders-img-upload",{
        url:'/media/upload2',
        headers: {
            'X-CSRF-Token': metaToken.getAttribute('content')
        }
    });
    myDropzone.on('complete', (file) => {

    })
}


