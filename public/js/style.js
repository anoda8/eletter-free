const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    customClass: {
        popup: 'colored-toast',
    },
    didOpen: (toast) => {
        toast.addEventListener('mouseenter', Swal.stopTimer)
        toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
})

window.addEventListener('show-alert', event => {
    Toast.fire({
        icon: event.detail[0].icon,
        title: event.detail[0].message,
        // background: backgrounD,
    })
})

window.addEventListener('close-modal', event => {
    closeModalBootstrap(event.detail[0].modalName);
})

function closeModalBootstrap(modalId){
    var myModalEl = document.getElementById(modalId);
    var myModal = bootstrap.Modal.getInstance(myModalEl);
    myModal.hide();
}
