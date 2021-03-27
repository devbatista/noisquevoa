$(document).ready(function() {
    $('input[name=cpf]').mask('000.000.000-00');
    $('input[name=whatsapp]').mask('(00) 00000-0000');

    permissao();

    carregarElenco();
});

function permissao() {
    let presidencia = $('body').attr('presidencia');
    let diretoria = $('body').attr('diretoria');
    if (presidencia == 1 || diretoria == 1) {
        $('div.buttons').removeClass('d-none');
        carregarPosicao();
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

function carregarPosicao() {
    $.ajax({
        url: window.origin + '/cadastro/getPosicoes',
        dataType: 'json',
        type: 'get',
        success: (dados) => {
            let html = '<option disabled selected value="0" style="color:#808080">Sem posição</option>';
            $('select#posicao').html(function() {
                $.each(dados, function(i, v) {
                    html += '<option value="' + this.id_posicao + '">' + this.nome + '</option>';
                });
                return html;
            });

            let htmlAvulso = '<option disabled selected value="0" style="color:#808080">Posição</option>';
            $('select#posicao_avulso').html(function() {
                $.each(dados, function(i, v) {
                    htmlAvulso += '<option value="' + this.id_posicao + '">' + this.nome + '</option>';
                });
                return htmlAvulso;
            });

            let htmlEdit = '<option disabled selected value="0" style="color:#808080">Sem posição</option>';
            $('select#editPosicao').html(function() {
                $.each(dados, function(i, v) {
                    htmlEdit += '<option value="' + this.id_posicao + '">' + this.nome + '</option>';
                });
                return htmlEdit;
            });
        }
    })
}

function carregarElenco() {
    $.ajax({
        url: window.origin + '/admin/elenco/carregar_elenco',
        dataType: 'json',
        type: 'get',
        success: (dados) => {
            let countData = Object.keys(dados).length;
            let element = $('div.mostrarElenco');

            if (countData > 0) {
                let html = '';

                element.html(function() {
                    $.each(dados, function(i, v) {
                        if (this.posicao) {
                            html += '<div class="ibox">' +
                                '<div class="ibox-content" data-id="' + this.id + '">' +
                                '<div class="row" style="margin-top: 10px">' +
                                '<div class="col-5 text-center imgElenco">' +
                                '<img src="' + window.origin + this.foto + '" alt="Elenco" class="imgElenco">' +
                                '</div>' +
                                '<div class="col-7 dadosElenco text-muted">' +
                                '<div class="row titulo">' +
                                '<b>' + this.posicao + '</b>' +
                                '</div>' +
                                '<div class="row">' +
                                '<b>Nome:</b>&nbsp; ' + this.nome +
                                '</div>' +
                                '<div class="row">' +
                                '<b>Apelido:</b>&nbsp; ' + this.apelido +
                                '</div>' +
                                '<div class="row">' +
                                '<b>Data de nascimento:</b>&nbsp; ' + this.dt_nascimento +
                                '</div>' +
                                '</div>' +
                                '</div>' +
                                '</div>' +
                                '</div>';
                        } else {
                            html += '<div class="ibox">' +
                                '<div class="ibox-content" data-id="' + this.id + '">' +
                                '<div class="row" style="margin-top: 10px">' +
                                '<div class="col-5 text-center imgElenco">' +
                                '<img src="' + window.origin + this.foto + '" alt="Elenco" class="imgElenco">' +
                                '</div>' +
                                '<div class="col-7 dadosElenco text-muted">' +
                                '<div class="row titulo">' +
                                '<b>Comissão Técnica</b>&nbsp; ' +
                                '</div>' +
                                '<div class="row">' +
                                '<b>Nome:</b>&nbsp; ' + this.nome +
                                '</div>' +
                                '<div class="row">' +
                                '<b>Apelido:</b>&nbsp; ' + this.apelido +
                                '</div>' +
                                '<div class="row">' +
                                '<b>Data de nascimento:</b>&nbsp; ' + this.dt_nascimento +
                                '</div>' +
                                '</div>' +
                                '</div>' +
                                '</div>' +
                                '</div>';
                        }
                    });

                    return html;
                })
            } else {
                element.html('<h5>Não há jogadores/comissão técnica cadastrados');
            }

            abrirModalEditarElenco();
        }
    });
}

function abrirModalEditarElenco() {
    $('.wrapper-content .ibox-content').click(function() {
        $('.modal-editar-elenco').modal('show');

        let id = $(this).data('id');

        $.ajax({
            url: window.origin + '/admin/elenco/carregar_por_id/' + id,
            dataType: 'json',
            type: 'get',
            success: (dados) => {
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
                            // element.find('input[name=comissao_tecnica]').attr('disabled', true);
                        } else {
                            element.find('input[name=jogador]').prop('checked', false);
                            // element.find('input[name=comissao_tecnica]').removeAttr('disabled');
                        }
                        if (this.diretoria == 1) {
                            element.find('input[name=diretoria]').prop('checked', true);
                        } else {
                            element.find('input[name=diretoria]').prop('checked', false);
                        }
                        if (this.comissao_tecnica == 1) {
                            element.find('input[name=comissao_tecnica]').prop('checked', true);
                            // element.find('input[name=jogador]').attr('disabled', true);
                        } else {
                            element.find('input[name=comissao_tecnica]').prop('checked', false);
                            // element.find('input[name=jogador]').removeAttr('disabled');
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
        url: window.origin + '/admin/elenco/aprovacao_cadastros',
        dataType: 'json',
        type: 'get',
        success: (dados) => {
            let countData = Object.keys(dados).length;
            let element = $('.modal-aprovar-cadastro').find('.modal-body');

            if (countData > 0) {
                $('.pull-left button').text('Aprovar Cadastro (' + countData + ')').removeClass('disabled').attr('data-toggle', 'modal');

                let html = '';

                element.html(function() {
                    $.each(dados, function(i, v) {
                        if (this.posicao) {
                            html += '<div class="ibox">' +
                                '<div class="ibox-content">' +
                                '<div class="row" style="margin-top: 10px">' +
                                '<div class="col-5 text-center imgAprovacao">' +
                                '<img src="' + window.origin + this.foto + '" alt="Nois Que Voa" class="imgAprovacao">' +
                                '</div>' +
                                '<div class="col-7 dadosAprovar text-muted">' +
                                '<div class="row tituloAprovar">' +
                                '<b>' + this.posicao + '</b>' +
                                '</div>' +
                                '<div class="row">' +
                                '<b>Nome:</b>&nbsp; ' + this.apelido +
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
                        } else {
                            html += '<div class="ibox">' +
                                '<div class="ibox-content">' +
                                '<div class="row" style="margin-top: 10px">' +
                                '<div class="col-5 text-center imgAprovacao">' +
                                '<img src="' + window.origin + this.foto + '" alt="Nois Que Voa" class="imgAprovacao">' +
                                '</div>' +
                                '<div class="col-7 dadosAprovar text-muted">' +
                                '<div class="row tituloAprovar">' +
                                '<b>Comissão Técnica</b>' +
                                '</div>' +
                                '<div class="row">' +
                                '<b>Nome:</b>&nbsp; ' + this.apelido +
                                '</div>' +
                                '<div class="row">' +
                                '<b>Celular:</b>&nbsp; ' + this.celular +
                                '</div>' +
                                '<div class="row">' +
                                '<b>Email:</b>&nbsp; ' + this.email +
                                '</div>' +
                                '<div class="row">' +
                                '<b>Aprovar:</b>&nbsp; <button aprovar type="button" class="btn btn-sm btn-danger" data-id="' + this.id + '"><i class="fa fa-check"></i></button>' +
                                '</div>' +
                                '</div>' +
                                '</div>' +
                                '</div>' +
                                '</div>';
                        }
                    });

                    return html;
                })
            } else {
                $('.pull-left button').text('Aprovar Cadastro (0)').addClass('disabled');

                element.html('<h5>Não há cadastro a serem aprovados</h5>');

                $('.pull-left button').removeAttr('data-toggle');
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
                    url: window.origin + '/admin/elenco/aprovar_cadastro/' + id,
                    dataType: 'json',
                    type: 'put',
                });
                getAprovarCadastro();
                carregarElenco();

                $('.modal-aprovar-cadastro').modal('hide');
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
                    url: window.origin + '/admin/elenco/desativar_usuario/' + id,
                    dataType: 'json',
                    type: 'put',
                });
                getAprovarCadastro();
                carregarDiretoria();

                $('.modal-aprovar-cadastro').modal('hide');
            }
        });
    });
}

$('input[name=jogador]').on('click', function() {
    let posicao = $('select[name=posicao]');
    let comissao_tecnica = $('input[name=comissao_tecnica]');
    if ($('input[name=jogador]').is(':checked') == true) {
        posicao.removeAttr('disabled');
        posicao.attr('required', true);
        // comissao_tecnica.attr('disabled', true);
    } else {
        $('select[name=posicao]').val('0');
        posicao.attr('disabled', true);
        posicao.removeAttr('required');
        // comissao_tecnica.removeAttr('disabled');
    }
});

// $('input[name=comissao_tecnica]').on('click', function() {
//     let jogador = $('input[name=jogador]');
//     let posicao = $('select[name=posicao]');
//     if ($('input[name=comissao_tecnica]').is(':checked') != true) {
//         jogador.removeAttr('disabled');
//         jogador.attr('required', true);
//     } else {
//         $('input[name=jogador]').prop('checked', false)
//         $('select[name=jogador]').val('0');
//         jogador.attr('disabled', true);
//         jogador.removeAttr('required');
//         posicao.attr('disabled', true);
//         posicao.removeAttr('required');
//     }
// });

// Editar usuário 
$('.modal-editar-elenco').find('button.btn-danger').click(function(e) {
    $('form[editar]').submit();
});

$('form[editar]').on('submit', function(event) {
    event.preventDefault();
    $('form[editar]').ajaxSubmit({
        url: window.origin + '/admin/elenco/alterar_usuario/' +
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

            $('.modal-editar-elenco').modal('hide');
            carregarElenco();
        }
    });
});

// Adicionar usuário
$('.modal-cadastro-elenco').find('button.btn-danger').click(function(e) {
    $('form[cadastrar]').submit();
});

$('form[cadastrar]').on('submit', function(event) {
    event.preventDefault();
    $('form[cadastrar]').ajaxSubmit({
        url: window.origin + '/admin/elenco/cadastrar_usuario',
        dataType: 'json',
        type: 'post',
        success: (e) => {
            Swal.fire({
                title: e.msg,
                showCancelButton: false,
                confirmButtonColor: '#d33',
                confirmButtonText: 'Ok!',
            });

            $('.modal-cadastro-elenco').modal('hide');
            carregarElenco();
        }
    });
});

// Desativar usuário (é como se fosse deletar, porém o sistema vai marcar apenas como desativado)
$('.modal-editar-elenco').find('button.btn-dark').click(function(e) {
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
                url: window.origin + '/admin/elenco/desativar_usuario/' + id,
                dataType: 'json',
                type: 'put'
            });
            getAprovarCadastro();
            carregarElenco();
            $('.modal-editar-elenco').modal('hide');
        }
    });
});

$('.modal-cadastro-avulso .btn-danger').on('click', function(e){
    $('form[cadastrarAvulso]').submit();
})

$('form[cadastrarAvulso]').on('submit', function(e){
    e.preventDefault();
    $(this).ajaxSubmit({
        url: window.origin + '/admin/elenco/cadastrar_avulso',
        dataType: 'json',
        type: 'post',
        beforeSubmit: () => {

        },
        success: (retorno) => {
            if(retorno.code === 0) {
                Swal.fire({
                    title: retorno.msg,
                    icon: 'success',
                    showCancelButton: false,
                    confirmButtonColor: '#d33',
                }).then(() => {
                    window.location.reload();
                });
            } else {
                Swal.fire({
                    title: retorno.msg,
                    icon: 'error',
                    showCancelButton: true,
                    showConfirmButton: false,
                    cancelButtonColor: '#999',
                    cancelButtonText: 'voltar',
                }).then(()=>{
                    $('.modal-cadastro-avulso').modal('hide');
                });
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