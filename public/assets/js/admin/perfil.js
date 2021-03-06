$(document).ready(function() {
    carregarPosicao();
    carregarDados();

    $('input[name=cpf]').mask('000.000.000-00');
    $('input[name=whatsapp]').mask('(00) 00000-0000');

    $('.eye').on('mousedown', function() {
        $(this).parent().find('input').attr('type', 'text');
    });

    $('.eye').on('mouseup', function() {
        $(this).parent().find('input').attr('type', 'password');
    });
});

function carregarDados() {
    let id = $('form[perfil]').attr('data-id');
    $.ajax({
        url: window.origin + '/admin/perfil/getData/' + id,
        dataType: 'json',
        type: 'get',
        success: (dados) => {
            if (Object.keys(dados).length > 0) {
                $('input[name=id]').val(dados.id_usuario);
                $('input[name=nome]').val(dados.nome);
                $('input[name=apelido]').val(dados.apelido);
                $('input[name=email]').val(dados.email);
                $('input[name=cpf]').val(dados.cpf);
                $('input[name=whatsapp]').val(dados.celular);
                $('input[name=nascimento]').val(dados.dt_nascimento);
                $('option[value=' + dados.posicao + ']').prop("selected", true);

                if (dados.posicao == 0 || dados.posicao == null) {
                    $('select[name=posicao]').attr('disabled', true);
                }
            }
        }
    });
}

function carregarPosicao() {
    $.ajax({
        url: window.origin + '/cadastro/getPosicoes',
        dataType: 'json',
        success: (dados) => {
            let html = '<option disabled selected value="0" style="color:#808080">Sem posição</option>';
            $('select#posicao').html(function() {
                $.each(dados, function(i, v) {
                    html += '<option value="' + this.id_posicao + '">' + this.nome + '</option>';
                });
                return html;
            });
        }
    })
}

function tamanhoSenha() {
    let senha = $('input[name=senha]').val();

    if (senha.length < 8) {
        if ($('#erroTamanhoSenha').length == 0) {
            $('input[name=senha]').parent().after('<div id="erroTamanhoSenha">Mínimo de 8 caracteres</div>');
        }
        if (senha.length == 0) {
            $('#erroTamanhoSenha').remove();
        }
        return false;
    }

    $('#erroTamanhoSenha').remove();
    return true;
}

function validarSenhas() {
    let senha = $('input[name=senha]').val();
    let confirma = $('input[name=confirmarSenha]').val();

    if (senha == confirma) {
        $('#erroConfirmaSenha').remove();
        return true;
    } else {
        if ($('#erroConfirmaSenha').length == 0) {
            $('input[name=confirmarSenha]').parent().after('<div id="erroConfirmaSenha">Senhas não conferem</div>')
        }
        return false;
    }
}

function validaCPF(cpf) {
    if (typeof cpf !== "string") return false;
    cpf = cpf.replace(/[\s.-]*/igm, '');
    if (!cpf ||
        cpf.length != 11 ||
        cpf == "00000000000" ||
        cpf == "11111111111" ||
        cpf == "22222222222" ||
        cpf == "33333333333" ||
        cpf == "44444444444" ||
        cpf == "55555555555" ||
        cpf == "66666666666" ||
        cpf == "77777777777" ||
        cpf == "88888888888" ||
        cpf == "99999999999"
    ) {
        return false;
    }
    var soma = 0;
    var resto;
    for (var i = 1; i <= 9; i++)
        soma = soma + parseInt(cpf.substring(i - 1, i)) * (11 - i);
    resto = (soma * 10) % 11;
    if ((resto == 10) || (resto == 11)) resto = 0;
    if (resto != parseInt(cpf.substring(9, 10))) return false;
    soma = 0;
    for (var i = 1; i <= 10; i++)
        soma = soma + parseInt(cpf.substring(i - 1, i)) * (12 - i);
    resto = (soma * 10) % 11;
    if ((resto == 10) || (resto == 11)) resto = 0;
    if (resto != parseInt(cpf.substring(10, 11))) return false;
    return true
}

$('input[name=cpf]').on('keyup', function(e) {
    let cpf = $(this).val();
    let validador = validaCPF(cpf);
    if (cpf.length == 0) {
        $('#cpfInvalido').remove();
        return false;
    }
    if (cpf.length === 14) {
        if (!validador) {
            if ($('#cpfInvalido').length == 0) {
                $('input[name=cpf]').after('<div id="cpfInvalido">CPF Inválido</div>');
            }
            return false;
        } else {
            $('#cpfInvalido').remove();
            return true;
        }
    }
});

$('input[name=senha]').on('keyup', function() {
    tamanhoSenha();
});

$('input[name=confirmarSenha]').on('keyup', function() {
    validarSenhas();
});

$('form[perfil]').on('submit', function(e) {
    e.preventDefault();
    $(this).ajaxSubmit({
        url: window.origin + '/admin/perfil/alterar-dados',
        dataType: 'json',
        type: 'post',
        success: (dados) => {
            if (dados.code > 0) {
                swal.fire({
                    icon: 'error',
                    title: dados.msg,
                    showConfirmButton: false,
                    showCancelButton: true,
                    cancelButtonColor: '#999',
                    cancelButtonText: 'Voltar'
                });
            } else {
                Swal.fire({
                    title: dados.msg,
                    showConfirmButton: true,
                    confirmButtonColor: '#d33',
                    confirmButtonText: 'Ok',
                }).then((result) => {
                    carregarDados();
                });
            }
        },
        error: () => {
            swal.fire({
                icon: 'warning',
                title: 'Erro ao enviar os dados, tente novamente!',
                showConfirmButton: false,
                showCancelButton: true,
                cancelButtonColor: '#999',
                cancelButtonText: 'Voltar'
            });
        }
    });
});