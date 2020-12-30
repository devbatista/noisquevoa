$(document).ready(function() {
    $('input[name=cpf]').mask('000.000.000-00');

    permissao();
    carregarDiretoria();
});

function permissao() {
    let presidencia = $('body').attr('presidencia');
    let diretoria = $('body').attr('diretoria');
    if (presidencia == 1 || diretoria == 1) {
        $('div.buttons').removeClass('d-none');
        getAprovarCadastro();
    } else {
        $('div.buttons').remove();
        $('.modal').remove();

        setTimeout(() => {
            $('.wrapper-content .ibox-content').hover(function() {
                $(this).css('cursor', 'auto');
            });
        }, 50);
    }
}

function carregarDiretoria() {
    $.ajax({
        url: window.origin + '/admin/diretoria/carregar_diretoria',
        dataType: 'json',
        type: 'get',
        success: (dados) => {
            let countData = Object.keys(dados).length;
            let element = $('div.mostrarDiretoria');

            if (countData > 0) {
                let html = '';

                element.html(function() {
                    $.each(dados, function(i, v) {
                        html += '<div class="ibox">' +
                            '<div class="ibox-content" data-id="' + this.id + '">' +
                            '<div class="row" style="margin-top: 10px">' +
                            '<div class="col-5 text-center imgDiretoria">' +
                            '<img src="' + window.origin + this.foto + '" alt="Diretoria" class="imgDiretoria">' +
                            '</div>' +
                            '<div class="col-7 dadosDiretoria text-muted">' +
                            '<div class="row">' +
                            '<b>Nome:</b>&nbsp; ' + this.nome +
                            '</div>' +
                            '<div class="row">' +
                            '<b>Apelido:</b>&nbsp; ' + this.apelido +
                            '</div>' +
                            '<div class="row">' +
                            '<b>Celular:</b>&nbsp; ' + this.celular +
                            '</div>' +
                            '<div class="row">' +
                            '<b>Email:</b>&nbsp; ' + this.email +
                            '</div>' +
                            '<div class="row">' +
                            '<b>Data de nascimento:</b>&nbsp; ' + this.dt_nascimento +
                            '</div>' +
                            '</div>' +
                            '</div>' +
                            '</div>' +
                            '</div>';
                    });

                    return html;
                });
            } else {
                element.html('<h5>Não há diretores cadastrados');
            }

            abrirModalEditarDiretoria();
        }
    });
}

function abrirModalEditarDiretoria() {
    $('.wrapper-content .ibox-content').click(function() {
        $('.modal-editar-diretoria').modal('show');

        let id = $(this).data('id');

        $.ajax({
            url: window.origin + '/admin/diretoria/carregar_por_id/' + id,
            dataType: 'json',
            type: 'get',
            success: (dados) => {
                console.log(dados);
                let countData = Object.keys(dados).length;
                let element = $('form[editar]');

                if (countData > 0) {
                    $.each(dados, function(i, v) {
                        element.attr('data-id', this.id);
                        element.find('input[name=nome]').val(this.nome);
                        element.find('input[name=apelido]').val(this.apelido);
                        element.find('input[name=email]').val(this.email).attr('disabled', true);
                        element.find('input[name=cpf]').val(this.cpf).attr('disabled', true);
                        element.find('input[name=whatsapp]').val(this.celular);
                        if (this.jogador == 1) {
                            element.find('input[name=jogador]').prop('checked', true);
                            element.find('input[name=comissao_tecnica]').attr('disabled', true);
                        } else {
                            element.find('input[name=jogador]').prop('checked', false);
                            element.find('input[name=comissao_tecnica]').removeAttr('disabled');
                        }
                        if (this.diretoria == 1) {
                            element.find('input[name=diretoria]').prop('checked', true);
                        } else {
                            element.find('input[name=diretoria]').prop('checked', false);
                        }
                        if (this.comissao_tecnica == 1) {
                            element.find('input[name=comissao_tecnica]').prop('checked', true);
                            element.find('input[name=jogador]').attr('disabled', true);
                        } else {
                            element.find('input[name=comissao_tecnica]').prop('checked', false);
                            element.find('input[name=jogador]').removeAttr('disabled');
                        }
                        element.find('input[name=nascimento]').val(this.dt_nascimento).attr('disabled', true);
                        if (this.posicao != null) {
                            element.find('option[value=' + this.posicao + ']').prop("selected", true);
                            element.find('select').removeAttr('disabled');
                        } else {
                            element.find("option[value=0]").prop("selected", true);
                            element.find('select').attr('disabled', true);
                        }
                        element.parent().parent().next().find('button.btn-dark').attr('data-id', this.id);
                    });
                }
            }
        });
    });
}

function getAprovarCadastro() {
    $.ajax({
        url: window.origin + '/admin/diretoria/aprovacao_cadastros',
        dataType: 'json',
        type: 'get',
        success: (dados) => {
            let countData = Object.keys(dados).length;
            let element = $('.modal-aprovar-cadastro').find('.modal-body');

            if (countData > 0) {
                $('.float-left button').text('Aprovar Cadastro (' + countData + ')').removeClass('disabled').attr('data-toggle', 'modal');

                let html = '';

                element.html(function() {
                    $.each(dados, function(i, v) {
                        html += '<div class="ibox">' +
                            '<div class="ibox-content">' +
                            '<div class="row" style="margin-top: 10px">' +
                            '<div class="col-5 text-center imgAprovacao">' +
                            '<img src="' + window.origin + this.foto + '" alt="Diretoria" class="imgAprovacao">' +
                            '</div>' +
                            '<div class="col-7 dadosAprovar text-muted">' +
                            '<div class="row">' +
                            '<b>Nome:</b>&nbsp; ' + this.nome +
                            '</div>' +
                            '<div class="row">' +
                            '<b>Celular:</b>&nbsp; ' + this.celular +
                            '</div>' +
                            '<div class="row">' +
                            '<b>Email:</b>&nbsp; ' + this.email +
                            '</div>' +
                            '<div class="row">' +
                            '<b>Aprovar:</b>&nbsp; <button aprovar type="button" class="btn btn-sm btn-danger" data-id="' + this.id + '"><i class="fa fa-check"></i></button><button desaprovar type="button" class="btn btn-sm btn-dark" data-id="' + this.id + '"><i class="fa fa-times"></i></button>' +
                            '</div>' +
                            '</div>' +
                            '</div>' +
                            '</div>' +
                            '</div>';
                    });

                    return html;
                })
            } else {
                $('.float-left button').text('Aprovar Cadastro (0)').addClass('disabled');

                element.html('<h5>Não há cadastro a serem aprovados</h5>');

                $('.float-left button').removeAttr('data-toggle');
            }

            aprovarCadastro();
            desaprovarCadastro();

        }
    });
}

function aprovarCadastro() {
    $('button[aprovar]').click(function(e) {
        e.preventDefault();
        let id = $(this).data('id');

        Swal.fire({
            title: 'Deseja mesmo aprovar o cadastro?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#999',
            confirmButtonText: 'Sim, Aprovar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: window.origin + '/admin/diretoria/aprovar_cadastro/' + id,
                    dataType: 'json',
                    type: 'put',
                });
                getAprovarCadastro();
                carregarDiretoria();
            }
        });
    });
}

function desaprovarCadastro() {
    $('button[desaprovar]').click(function(e) {
        e.preventDefault();
        let id = $(this).data('id');

        Swal.fire({
            title: 'Deseja mesmo desaprovar o cadastro?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#999',
            confirmButtonText: 'Sim, Desaprovar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: window.origin + '/admin/diretoria/desativar_usuario/' + id,
                    dataType: 'json',
                    type: 'put',
                });
                getAprovarCadastro();
                carregarDiretoria();
            }
        });
    });
}

// Adicionar
$('.modal-cadastro-diretoria').find('button.btn-danger').click(function(e) {
    $('form[cadastrar]').submit();
});

$('form[cadastrar]').on('submit', function(event) {
    event.preventDefault();
    $('form[cadastrar]').ajaxSubmit({
        url: window.origin + '/admin/diretoria/cadastrar_diretoria',
        dataType: 'json',
        type: 'post',
        success: (e) => {
            Swal.fire({
                title: e.msg,
                showCancelButton: false,
                confirmButtonColor: '#d33',
                confirmButtonText: 'Ok!',
            });

            if (e.code == 0) {
                $('.modal-cadastro-diretoria').modal('hide');
                carregarDiretoria();
            }
        }
    });
});

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

// Editar
$('.modal-editar-diretoria').find('button.btn-danger').click(function(e) {
    $('form[editar]').submit();
});

$('form[editar]').on('submit', function(event) {
    event.preventDefault();
    $('form[editar]').ajaxSubmit({
        url: window.origin + '/admin/diretoria/alterar_diretoria/' +
            $(this).attr('data-id'),
        dataType: 'json',
        type: 'post',
        success: (e) => {
            Swal.fire({
                title: e.msg,
                showCancelButton: false,
                confirmButtonColor: '#d33',
                confirmButtonText: 'Ok!',
            });

            $('.modal-editar-diretoria').modal('hide');
            carregarDiretoria();
        }
    });
});

$('.modal-editar-diretoria').find('button.btn-dark').click(function(e) {
    let id = $(this).attr('data-id');

    Swal.fire({
        title: 'Deseja mesmo desativar o cadastro?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#999',
        confirmButtonText: 'Sim, Desativar',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: window.origin + '/admin/diretoria/desativar_usuario/' + id,
                dataType: 'json',
                type: 'put'
            });
            getAprovarCadastro();
            carregarDiretoria();
            $('.modal-editar-diretoria').modal('hide');
        }
    });
});