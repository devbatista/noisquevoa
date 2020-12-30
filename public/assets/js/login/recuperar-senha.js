$(document).ready(function() {
    let query = location.search.slice(1);
    let partes = query.split('&');
    let data = {};
    partes.forEach(function(parte) {
        let chaveValor = parte.split('=');
        let chave = chaveValor[0];
        let valor = chaveValor[1];
        data[chave] = valor;
    });

    $('input[name=email]').val(data.email);
});

$('form[alterarSenha]').on('submit', function(e) {
    e.preventDefault();
    $(this).ajaxSubmit({
        url: window.origin + '/alteracao-senha',
        dataType: 'json',
        type: 'post',
        beforeSubmit: () => {
            $('input[value="Alterar"]').attr('disabled', true).val('Alterando...');
        },
        success: (dados) => {
            if (dados.code === 0) {
                Swal.fire({
                    title: dados.msg,
                    showConfirmButton: true,
                    confirmButtonColor: '#d33',
                    confirmButtonText: 'Ok',
                }).then((result) => {
                    window.location.href = window.origin + '/admin';
                });
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

            $('input[value="Alterando..."]').removeAttr('disabled').val('Entrar');
        }
    });
});

function tamanhoSenha() {
    let senha = $('input[name=novaSenha]').val();

    if (senha.length < 8) {
        $('input[type=submit]').attr('disabled', true);

        if ($('#erroTamanhoSenha').length == 0) {
            $('input[name=confirmaNovaSenha]').after('<div id="erroTamanhoSenha">Mínimo de 8 caracteres</div>');
            return false;
        }
        if (senha.length == 0) {
            $('#erroTamanhoSenha').remove();
            $('input[type=submit]').removeAttr('disabled');
        }
        return false;
    }

    $('#erroTamanhoSenha').remove();
    return true;
}

$('input[name=novaSenha]').on('keyup', function() {
    tamanhoSenha();
});

function validarSenhas() {
    let senha = $('input[name=novaSenha]').val();
    let confirma = $('input[name=confirmaNovaSenha]').val();

    if (senha.length < 8) {
        if ($('#erroTamanhoSenha').length == 0 && $('#erroConfirmaSenha').length == 0) {
            $('input[name=confirmaNovaSenha]').after('<div id="erroTamanhoSenha">Mínimo de 8 caracteres</div>');
            return false;
        }
    }

    if (senha == confirma) {
        $('#erroConfirmaSenha').remove();
        $('input[type=submit]').removeAttr('disabled');
        return true;
    } else {
        if ($('#erroConfirmaSenha').length == 0) {
            $('input[name=confirmaNovaSenha]').after('<div id="erroConfirmaSenha">Senhas não conferem</div>')
            $('input[type=submit]').attr('disabled', true);
        }
        return false;
    }
}

$('input[name=confirmaNovaSenha]').on('keyup', function() {
    validarSenhas();
});