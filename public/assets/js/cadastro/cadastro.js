$(document).ready(function() {
    $("#wizard").steps();
    $("#form").steps({
        bodyTag: "fieldset",
        onStepChanging: function(event, currentIndex, newIndex) {
            // Always allow going backward even if the current step contains invalid fields!
            if (currentIndex > newIndex) {
                return true;
            }

            // Forbid suppressing "Warning" step if the user is to young
            if (newIndex === 3 && Number($("#age").val()) < 18) {
                return false;
            }

            var form = $(this);

            // Clean up if user went backward before
            if (currentIndex < newIndex) {
                // To remove error styles
                $(".body:eq(" + newIndex + ") label.error", form).remove();
                $(".body:eq(" + newIndex + ") .error", form).removeClass("error");
            }

            // Disable validation on fields that are disabled or hidden.
            form.validate().settings.ignore = ":disabled,:hidden";

            // Start validation; Prevent going forward if false
            return form.valid();
        },
        onStepChanged: function(event, currentIndex, priorIndex) {
            // Suppress (skip) "Warning" step if the user is old enough.
            if (currentIndex === 2 && Number($("#age").val()) >= 18) {
                $(this).steps("next");
            }

            // Suppress (skip) "Warning" step if the user is old enough and wants to the previous step.
            if (currentIndex === 2 && priorIndex === 3) {
                $(this).steps("previous");
            }
        },
        onFinishing: function(event, currentIndex) {
            var form = $(this);

            // Disable validation on fields that are disabled.
            // At this point it's recommended to do an overall check (mean ignoring only disabled fields)
            form.validate().settings.ignore = ":disabled";

            // Start validation; Prevent form submission if false
            return form.valid();
        },
        onFinished: function(event, currentIndex) {
            var form = $(this);

            // Submit form input
            form.submit();
        }
    }).validate({
        errorPlacement: function(error, element) {
            if (element.is('#senha') || element.is('#confirmarSenha')) {
                console.log(element.parent().prev().append(error));
            } else if (element.is('#termos-e-condicoes')) {
                element.parent().before(error)
                element.parent().before('<br>');
            } else {
                element.before(error);
            }
        },
        rules: {
            confirm: {
                equalTo: "#password"
            }
        }
    });

    $('.custom-file-input').on('change', function() {
        let fileName = $(this).val().split('\\').pop();
        $(this).next('.custom-file-label').addClass("selected").html(fileName);
    });

    $('input[name=cpf]').mask('000.000.000-00');
    $('input[name=whatsapp]').mask('(00) 00000-0000');

    $('.eye').on('mousedown', function() {
        $(this).parent().find('input').attr('type', 'text');
    });

    $('.eye').on('mouseup', function() {
        $(this).parent().find('input').attr('type', 'password');
    });

    setTimeout(() => {
        carregarPosicao();

        $('input[name=jogador]').on('click', function() {
            let posicao = $('select[name=posicao]');
            if ($('input[name=jogador]').is(':checked') == true) {
                posicao.removeAttr('disabled');
                posicao.attr('required', true);
            } else {
                $('select[name=posicao]').val('0');
                posicao.attr('disabled', true);
                posicao.removeAttr('required');
            }
        })
    }, 1000);

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
});

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

$('form[cadastrar]').on('submit', function(e) {
    e.preventDefault();
    $('form').ajaxSubmit({
        url: window.origin + '/cadastro/enviar',
        dataType: 'json',
        type: 'post',
        success: (dados) => {
            if (dados.code === 0) {
                Swal.fire({
                    title: dados.msg,
                    text: 'Aguarde a aprovação pela diretoria',
                    showConfirmButton: true,
                    confirmButtonColor: '#d33',
                    confirmButtonText: 'Ok',
                }).then((result) => {
                    window.location.href = window.origin;
                });
            } else if (dados.code == 1062 || dados.code != 2) {
                swal.fire({
                    icon: 'error',
                    title: dados.msg,
                    showConfirmButton: false,
                    showCancelButton: true,
                    cancelButtonColor: '#999',
                    cancelButtonText: 'Voltar'
                });
            } else if (dados.code == 2) {
                swal.fire({
                    icon: 'error',
                    title: dados.msg,
                    text: 'Tipos permitidos: ' + dados.tipos_permitidos + ' / Tamanho permitido: ' + dados.tamanho_permitido,
                    showConfirmButton: false,
                    showCancelButton: true,
                    cancelButtonColor: '#999',
                    cancelButtonText: 'Voltar'
                })
            } else {
                swal.fire({
                    icon: 'error',
                    title: 'Erro na requisição',
                    text: 'Atualize a página e tente novamente...',
                    showConfirmButton: false,
                    showCancelButton: true,
                    cancelButtonColor: '#999',
                    cancelButtonText: 'Voltar'
                })
            }
        }
    });
});

$('input[name=diretoria]').on('click', function() {
    let diretoria = $('input[name=diretoria]');
    let jogador = $('input[name=jogador]');
    let posicao = $('select[name=posicao]');
    if (diretoria.is(':checked') == true) {
        jogador.removeAttr('required');
        posicao.removeAttr('required');
    } else {
        jogador.attr('required', true);
        posicao.attr('required', true);
    }
});