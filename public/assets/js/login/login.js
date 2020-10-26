function formatar(mascara, documento) {
    var i = documento.value.length;
    var saida = mascara.substring(0, 1);
    var texto = mascara.substring(i)

    if (texto.substring(0, 1) != saida) {
        documento.value += texto.substring(0, 1);
    }
}

$('form').on('submit', function(e) {
    e.preventDefault();
    $('form').ajaxSubmit({
        url: window.origin + '/login/autentica',
        dataType: 'json',
        type: 'post',
        success: (dados) => {
            console.log(dados);
            if (dados.code === 0) {
                window.location.href = window.origin + '/admin';
            } else if (dados.code === 1 || dados.code === 2) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: dados.msg,
                    showConfirmButton: false,
                    showCancelButton: true,
                    cancelButtonColor: '#d33',
                    cancelButtonText: 'Voltar'
                });
            } else {
                swal.fire({
                    icon: 'error',
                    title: 'Oops',
                    text: 'Atualize a página e tente novamente...',
                    showConfirmButton: false,
                    showCancelButton: true,
                    cancelButtonColor: '#d33',
                    cancelButtonText: 'Voltar'
                })
            }
        }
    });
});