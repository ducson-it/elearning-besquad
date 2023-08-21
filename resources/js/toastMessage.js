import Toastify from 'toastify-js';

window.toastMessage = function(message, type = 'success', duration = 3000) {
    Toastify({
        text: message,
        duration: duration,
        newWindow: true,
        close: true,
        gravity: 'bottom', // Position the notification at the bottom
        position: 'right', // Position the notification to the right
        backgroundColor: type === 'error' ? '#FF0000' : '#00FF00',
    }).showToast();
}
