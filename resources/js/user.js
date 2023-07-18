import 'bootstrap';
import $ from 'jquery';
window.$ = window.jquery = $
import Dropzone from "dropzone";

const metaToken = document.querySelector('meta[name="csrf-token"]');
const UserUpload = document.querySelector('#user-img-upload');

if(UserUpload){
    let myDropzone = new Dropzone("#user-img-upload",{
        url: '/user/upload',
        headers: {
            'X-CSRF-TOKEN': metaToken.getAttribute('content')
        },
        acceptedFiles: "image/*",
    });
    myDropzone.on('complete', file=>{
        console.log(file.xhr.response);
        document.querySelector('input[name="image"]').setAttribute('value',file.xhr.response);
    })
}

