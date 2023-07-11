import 'bootstrap';
import Swal from 'sweetalert2';
import axios from "axios";
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

//
// import Quill from "quill";
// import ImageResize from 'quill-image-resize';
// // Register ImageResize module
// import ImageUploader from "quill-image-uploader";
// Quill.register('modules/imageResize', ImageResize);
// Quill.register("modules/imageUploader", ImageUploader);
//
// //Destroy Quill Editor
// // import QuillMarkdown from 'quilljs-markdown';
// var toolbarOptions =
//     [
//         ['bold', 'italic', 'underline', 'strike'],
//         ['blockquote', 'code-block'],
//
//         [{'header': 1}, {'header': 2}],
//         [{'list': 'ordered'}, {'list': 'bullet'}],
//         [{'script': 'sub'}, {'script': 'super'}],
//         [{'indent': '-1'}, {'indent': '+1'}],
//         [{'direction': 'rtl'}],
//
//         [{'header': [1, 2, 3, 4, 5, 6, false]}],
//         ['link','image','video'],
//         ['clean']
//     ]
// // quill editor create blog
//
// const editor = new Quill('#quillEditor', {
//     modules:{
//         syntax:false,
//         toolbar: toolbarOptions,
//         imageResize: {
//             displayStyles: {
//                 backgroundColor: 'black',
//                 border: 'none',
//                 color: 'white'
//             },
//             modules: [ 'Resize', 'DisplaySize', 'Toolbar' ]
//         },
//         imageUploader: {
//             upload: (file) => {
//                 return new Promise((resolve,reject)=>{
//                     const metaToken = document.querySelector('meta[name="csrf-token"]')
//                     var formData = new FormData();
//                     formData.append('file', file);
//
//                     $.ajax({
//                         type: "POST",
//                         url: 'media/upload',
//                         headers: {
//                             'X-CSRF-TOKEN': metaToken.getAttribute('content')
//                         },
//                         data : formData,
//                         processData: false,  // tell jQuery not to process the data
//                         contentType: false,  // tell jQuery not to set contentType
//                         success : function(data) {
//                             resolve(data['path']);
//                         }
//                     });
//                 })
//             },
//         },
//     },
//     theme: 'snow',
//     placeholder: 'Enter your content',
// });
//
// editor.setHTML = (html) => {
//     editor.root.innerHTML = html;
// };
//
// // get html content
// editor.getHTML = () => {
//     return editor.root.innerHTML;
// };
// editor.on('text-change', () => {
//     document.querySelector('#content').value = editor.getHTML()
//     // $('#content').val(editor.container.firstChild.innerHTML);
// });
