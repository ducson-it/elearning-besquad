import 'bootstrap';
import Swal from 'sweetalert2';
window.deletesliders = (id) => {
    Swal.fire({
        icon: 'warning',
        title: 'Xóa',
        showConfirmButton: true,
        showCancelButton: true
    }).then(res => {
        if (res.isConfirmed) {
            // Gọi API để xóa
            axios.delete('/slider/destroy/' + id)
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

