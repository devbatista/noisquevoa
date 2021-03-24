$(document).ready(function(){
    swal.fire({
        icon: 'error',
        title: 'Em Breve',
        showConfirmButton: false,
        showCancelButton: true,
        cancelButtonColor: '#999',
        cancelButtonText: 'Voltar'
    }).then(() => {
        window.location.href = window.origin+'/admin';
    });
});