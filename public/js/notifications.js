function showNotification(icon, title, message, timer = 2000) {
    Swal.fire({
        icon: icon,
        title: title,
        text: message,
        position: 'center',
        showConfirmButton: icon === 'error',
        timer: icon === 'success' ? timer : null,
        timerProgressBar: icon === 'success',
        confirmButtonColor: '#6e6edb'
    });
}