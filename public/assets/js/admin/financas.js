var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));

elems.forEach(function(html) {
    var switchery = new Switchery(html, { color: 'rgb(220, 53, 69)' });
});

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

$("#selecionarMes").ionRangeSlider({
    grid: true,
    skin: 'big',
    from: new Date().getMonth(),
    values: [
        "Janeiro", "Fevereiro", "Março",
        "Abril", "Maio", "Junho",
        "Julho", "Agosto", "Setemnro",
        "Outubro", "Novembro", "Dezembro"
    ]
});

$('.switchery').click(function(e) {
    if ($(this).prev().prop('checked') == true) {
        $('#tipoDePagamento').modal('show');
    }
});