function formatar(mascara, documento) {
    var i = documento.value.length;
    var saida = mascara.substring(0, 1);
    var texto = mascara.substring(i)

    if (texto.substring(0, 1) != saida) {
        documento.value += texto.substring(0, 1);
    }
}

$('form[login]').on('submit', function(e) {
    e.preventDefault();
    $(this).ajaxSubmit({
        url: window.origin + '/login/autentica',
        dataType: 'json',
        type: 'post',
        success: (dados) => {
            if (dados.code === 0) {
                window.location.href = window.origin + '/admin';
            } else if (dados.code > 0) {
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
                });
            }
        }
    });
});

$('form[login] a').click(function(e) {
    e.preventDefault();
    $('form[login]').addClass('d-none');
    $('form[esqueciSenha]').removeClass('d-none');
    $('form[esqueciSenha]').parent().find('h2').text('Alterar senha');
})

$('form[esqueciSenha]').on('submit', function(e) {
    e.preventDefault();
    $(this).ajaxSubmit({
        url: window.origin + '/email/esqueci_minha_senha',
        dataType: 'json',
        type: 'post',
        success: (dados) => {
            console.log(dados);
            if (dados.code == 0) {
                return true;
            }

            if (dados.code == 1) {
                swal.fire({
                    icon: 'error',
                    title: 'Oops',
                    text: dados.msg,
                    showConfirmButton: false,
                    showCancelButton: true,
                    cancelButtonColor: '#d33',
                    cancelButtonText: 'Voltar'
                });

                return false;
            }

            if (dados.code == 2) {
                swal.fire({
                    icon: 'error',
                    title: dados.msg,
                    showConfirmButton: false,
                    showCancelButton: true,
                    cancelButtonColor: '#d33',
                    cancelButtonText: 'Voltar'
                });

                return false;
            }
        }
    });
});

$('form[esqueciSenha] a').click(function(e) {
    e.preventDefault();
    $('form[esqueciSenha]').addClass('d-none');
    $('form[login]').removeClass('d-none');
    $('form[esqueciSenha]').parent().find('h2').text('Faça o login');
})