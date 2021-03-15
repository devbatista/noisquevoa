let equipes = [];
let partidas = [];
let jogadores = [];

$(document).ready(function() {
    carregarDados();

    itemMenuAtivar();

    permissao();
});

function dualListSelect() {
    $('.dual_select').bootstrapDualListbox({
        filterTextClear: 'mostrar tudo',
        filterPlaceHolder: 'Filtro',
        moveSelectedLabel: 'Mover selecionados',
        moveAllLabel: 'Mover todos',
        removeSelectedLabel: 'Remover selecionados',
        removeAllLabel: 'Remover todos',
        infoText: 'Mostrando {0}',
        infoTextFiltered: '<span class="label label-warning">Filtrando</span> {0} de {1}',
        infoTextEmpty: "Lista vazia"
    });
}

function loadPage() {
    if (partidas.length == 0) {
        $('.ibox-content').html('<h1>Não há partidas para serem cadastradas</h1>');
        return false;
    }

    let accordion = $('#accordion');
    accordion.html('');
    let html = '';

    $.each(partidas, function(i, v) {
        html = '';

        accordion.append(function() {
            html += '<div class="card">' +
                '<div class="card-header" id="heading' + v.id_partida + '">' +
                '<h5 class="mb-0 text-center">' +
                '<button class="btn btn-link" data-toggle="collapse" data-target="#collapse' + v.id_partida + '" aria-expanded="true" aria-controls="collapse' + v.id_partida + '" data-id="' + v.id_partida + '">' +
                '' + v.nois_que_voa + ' x ' + v.adversario + ' - ' + v.data_hora_partida +
                '</button>' +
                '</h5>' +
                '</div>';

            return html;
        });
    })

    $('button[data-toggle=collapse]').on('click', function(e) {
        let coID = $(this).data('id');
        if ($('.card-body').length > 0) {
            swal.fire({
                icon: 'error',
                title: 'Cadastre as estatísticas que estão em aberto!',
                showConfirmButton: false,
                showCancelButton: true,
                cancelButtonColor: '#999',
                cancelButtonText: 'Voltar'
            });
            return false;
        }
        // $('button[data-toggle=collapse]').parent().parent().parent().find('.card-body').remove()
        collapsePartida($(this));
        dualListSelect();
    });
}

function itemMenuAtivar() {
    let listaMenu = $('ul.metismenu li a');
    listaMenu.each(function(i, v) {
        if (this.href == window.origin + "/admin/partidas") {
            $(this).parent().addClass('active');
        }
    });
}

function carregarDados() {
    $.ajax({
        url: window.origin + '/admin/partidas/cadastrar-estatisticas/carregar-dados',
        type: 'GET',
        dataType: 'json',
        success: (dados) => {
            jogadores = dados.jogadores;
            partidas = dados.jogos;

            loadPage();
        }
    });
}

function inputsFalta(tempo, elem, qtd = false) {
    let qtdFaltas = (qtd) ? qtd : $(elem).val();
    let jogadoresParticipantes = $('select[name="jogadores[]"]').val()
    let elemento = $('input#qtdFaltas' + tempo).parent();
    let proxElemen = $('input#qtdFaltas' + tempo).parent().next();

    while (proxElemen.length > 0) {
        proxElemen.remove()
        proxElemen = $('input#qtdFaltas' + tempo).parent().next();
    }

    for (let i = qtdFaltas; i >= 1; i--) {
        let html = '';
        elemento.after(function() {
            html += '<div class="form-row col-12">' +
                '<select class="custom-select" name="falta' + tempo + '_' + i + '">';

            if (jogadoresParticipantes.length > 0) {
                html += '<option disabled selected>Jogadores</option>';

                $.each(jogadoresParticipantes, function(i, v) {
                    $.each(jogadores, function(a, b) {
                        if (v == b.id_usuario) {
                            html += '<option value="' + b.id_usuario + '">' + b.apelido + '</option>';
                        }
                    });
                });
            } else {
                html += '<option disabled selected>Selecione os que jogaram</option>';
            }

            html += '</select>' +
                '</div>';

            return html
        });
    }
}

function inputsCartao(cor, elem, qtd = false) {
    let qtdCartoes = (qtd) ? qtd : $(elem).val();
    let jogadoresParticipantes = $('select[name="jogadores[]"]').val()
    let elemento = $('input#qtdCartoes' + cor).parent();
    let proxElemen = $('input#qtdCartoes' + cor).parent().next();

    while (proxElemen.length > 0) {
        proxElemen.remove()
        proxElemen = $('input#qtdCartoes' + cor).parent().next();
    }

    for (let i = 1; i <= qtdCartoes; i++) {
        let html = '';
        elemento.after(function() {
            html += '<div class="form-row col-12">' +
                '<select class="custom-select" name="cartao' + cor + '_' + i + '">';

            if (jogadoresParticipantes.length > 0) {
                html += '<option disabled selected>Jogadores</option>';

                $.each(jogadoresParticipantes, function(i, v) {
                    $.each(jogadores, function(a, b) {
                        if (v == b.id_usuario) {
                            html += '<option value="' + b.id_usuario + '">' + b.apelido + '</option>';
                        }
                    });
                });
            } else {
                html += '<option disabled selected>Selecione os que jogaram</option>';
            }

            html += '</select>' +
                '</div>';

            return html
        });
    }
}

$('.pull-left button').click(function(e) {
    e.preventDefault();
    if ($(this).hasClass('disabled') == false) {
        window.location = window.origin + '/admin/partidas';
    }
});

function permissao() {
    let presidencia = $('body').attr('presidencia');
    let diretoria = $('body').attr('diretoria');
    if (presidencia == 1 || diretoria == 1) {
        $('div.buttons').removeClass('d-none');
    } else {
        $('div.buttons').remove();
        $('div.inserir-local').remove();
    }
}

function collapsePartida(elem) {
    let html = '';
    let id = $(elem).data('id');
    let adversario = ';'

    $.each(partidas, function(i, v) {
        if (this.id_partida == id) {
            adversario = this.adversario;
        }
    })

    let optionsJogadores = '';
    $.each(jogadores, function(i, v) {
        optionsJogadores += '<option value="' + v.id_usuario + '">' + v.apelido + '</option>';
    })
    let htmlJogadores = '<div style="margin-bottom: 15px; width: 100%">' +
        '<img class="iconeEstatistica" src="' + window.origin + '/assets/img/jogador.png" alt="">' +
        '<span>Jogadores participantes</span>' +
        '</div>' +
        '<div style="width: 100%;">' +
        '<select class="form-control dual_select" name="jogadores[]" multiple multipart="form-data">' +
        optionsJogadores +
        '</select>' +
        '</div>';

    let htmlGols = '<div style="margin: 15px 0; width: 100%">' +
        '<img class="iconeEstatistica" src="' + window.origin + '/assets/img/bola.png" alt="">' +
        '<span>Gols marcados</span>' +
        '</div>' +
        '<div class="w-100">' +
        '</div>';

    let htmlAssistencias = '<div style="margin: 15px 0; width: 100%">' +
        '<img class="iconeEstatistica" src="' + window.origin + '/assets/img/chuteira.png" alt="">' +
        '<span>Assistências</span>' +
        '</div>' +
        '<div class="w-100">' +
        '</div>';

    let htmlFaltas = '<div style="margin: 15px 0; width: 100%">' +
        '<img class="iconeEstatistica" src="' + window.origin + '/assets/img/apito.png" alt="">' +
        '<span>Faltas</span>' +
        '</div>' +
        '<div class="w-100">' +
        '<div class="form-row">' +
        '<div class="form-group col-md-6">' +
        '<div class="form-row col-12">' +
        '<div class="cadastroFalta"> 1º tempo </div>' +
        '<input type="number" class="form-control" id="qtdFaltas1" name="qtdFaltas1" placeholder="Quantidade...">' +
        '</div>' +
        '</div>' +
        '<div class="form-group col-md-6">' +
        '<div class="form-row col-12">' +
        '<div class="cadastroFalta"> 2º tempo </div>' +
        '<input type="number" class="form-control" id="qtdFaltas2" name="qtdFaltas2" placeholder="Quantidade...">' +
        '</div>' +
        '</div>' +
        '</div>' +
        '</div>';

    let htmlCartoes = '<div style="margin: 15px 0; width: 100%">' +
        '<img class="iconeEstatistica" src="' + window.origin + '/assets/img/apito.png" alt="">' +
        '<span>Cartões</span>' +
        '</div>' +
        '<div class="w-100">' +
        '<div class="form-row">' +
        '<div class="form-group col-md-6">' +
        '<div class="form-row col-12">' +
        '<img class="cadastroCartoes" src="' + window.origin + '/assets/img/cartao-amarelo.png" alt="">' +
        '<input type="number" class="form-control" id="qtdCartoesAmarelo" placeholder="Quantidade de cartões amarelos..." name="qtdCartoesAmarelo">' +
        '</div>' +
        '</div>' +
        '<div class="form-group col-md-6">' +
        '<div class="form-row col-12">' +
        '<img class="cadastroCartoes" src="' + window.origin + '/assets/img/cartao-vermelho.png" alt="">' +
        '<input type="number" class="form-control" id="qtdCartoesVermelho" placeholder="Quantidade de cartões Vermelhos..." name="qtdCartoesVermelho">' +
        '</div>' +
        '</div>' +
        '</div>' +
        '</div>';

    $(elem).parent().parent().parent().append(function() {
        html += '<div id="collapse' + id + '" class="collapse" aria-labelledby="heading' + id + '" data-parent="#accordion">' +
            '<div class="card-body text-center">' +
            '<form enviarEstatistica action="" data-id="' + id + '" enctype="multipart/form-data">' +
            '<input type="hidden" name="id_partida" value="' + id + '">' +
            '<div class="form-row">' +
            '<div class="col-4">' +
            '<label for="">Nois Que Voa</label>' +
            '</div>' +
            '<div class="col-1">' +
            '<input type="number" class="form-control placar" name="placar-nqv">' +
            '</div>' +
            '<div class="col-2">' +
            'X' +
            '</div>' +
            '<div class="col-1">' +
            '<input type="number" class="form-control placar" name="placar-vis">' +
            '</div>' +
            '<div class="col-4">' +
            '<label for="">' + adversario + '</label>' +
            '</div>' +
            '</div>' +
            '<div class="form-row">' +
            '<div class="col-3">' +
            '<button type="button" class="btn btn-danger" data-show="mostrarJogadores">Jogadores participantes</button>' +
            '</div>' +
            '<div class="col-3">' +
            '<button type="button" class="btn btn-danger" data-show="mostrarGols">Gols Marcados</button>' +
            '</div>' +
            '<div class="col-2">' +
            '<button type="button" class="btn btn-danger" data-show="mostrarAssistencias">Assistências</button>' +
            '</div>' +
            '<div class="col-2">' +
            '<button type="button" class="btn btn-danger" data-show="mostrarFaltas">Faltas</button>' +
            '</div>' +
            '<div class="col-2">' +
            '<button type="button" class="btn btn-danger" data-show="mostrarCartoes">Cartoes</button>' +
            '</div>' +
            '</div>' +

            '<div class="form-row estatisticasPartida mostrarJogadores">' +
            htmlJogadores +
            '</div>' +

            '<div class="form-row estatisticasPartida mostrarGols">' +
            htmlGols +
            '</div>' +

            '<div class="form-row estatisticasPartida mostrarAssistencias">' +
            htmlAssistencias +
            '</div>' +

            '<div class="form-row estatisticasPartida mostrarFaltas">' +
            htmlFaltas +
            '</div>' +

            '<div class="form-row estatisticasPartida mostrarCartoes">' +
            htmlCartoes +
            '</div>' +

            '<hr>' +
            '<div class="form-row">' +
            '<div class="pull-left">' +
            '<div class="fileinput fileinput-new" data-provides="fileinput">' +
            '<span class="btn btn-danger btn-file"><span class="fileinput-new">Adicionar súmula</span>' +
            '<span class="fileinput-exists">Alterar súmula</span><input type="file" name="sumula" /></span>' +
            '<span class="fileinput-filename"></span>' +
            '<a href="#" class="close fileinput-exists" data-dismiss="fileinput" style="float: none;margin-left: 5px;">×</a>' +
            '</div>' +
            '</div>' +
            '<div class="pull-right">' +
            '<button type="button" class="btn btn-danger" salvar>Salvar</button>' +
            '</div>' +
            '</div>' +
            '</form>' +
            '</div>' +
            '</div>';

        return html;
    });

    $('.mostrarJogadores, .mostrarGols, .mostrarAssistencias, .mostrarCartoes, .mostrarFaltas').hide();
    $('.form-row .btn-danger').attr('disabled', true);

    $('.form-row .placar').on('blur', function() {
        let placar = [];
        let placar_nqv = $('input[name=placar-nqv]').val();
        $.each($('.placar'), function(i, v) {
            placar[i] = $(this).val().length;
        })

        if (placar[0] > 0 && placar[1] > 0) {
            $('.form-row .btn-danger').removeAttr('disabled');
            $('.form-row.pull-right .btn-danger').attr('disabled', true)
        } else {
            $('.form-row .btn-danger').attr('disabled', true);
            $('.mostrarJogadores, .mostrarGols, .mostrarAssistencias, .mostrarCartoes, .mostrarFaltas').hide();
        }

        if (placar_nqv == 0) {
            $('button[data-show=mostrarGols], button[data-show=mostrarAssistencias]').attr('disabled', true);
        } else {
            let html = '';
            $('.mostrarGols .w-100').html(function() {
                for (let i = 1; i <= placar_nqv; i++) {
                    html += '<div class="form-row">' +
                        '<div class="form-group col-md-6 d-flex flex-row">' +
                        '<label style="font-size: 25px;margin-right: 15px;">' + i + 'º</label>' +
                        '<select class="custom-select" name="gol_' + i + '">' +
                        '<option selected disabled>Selecione os que jogaram...</option>' +
                        '</select>' +
                        '</div>' +
                        '<div class="form-group col-md-3">' +
                        '<input type="text" class="form-control" placeholder="Tempo" name="tempoGol_' + i + '" disabled>' +
                        '</div>' +
                        '<div class="form-group col-md-3">' +
                        '<input type="text" class="form-control" placeholder="Período" name="periodoGol_' + i + '" disabled>' +
                        '</div>' +
                        '</div>';
                }

                return html;
            });

            html = '';
            $('.mostrarAssistencias .w-100').html(function() {
                for (let i = 1; i <= placar_nqv; i++) {
                    html += '<div class="form-row">' +
                        '<div class="form-group col-md-12 d-flex flex-row">' +
                        '<label style="font-size: 25px;margin-right: 15px;">' + i + 'º</label>' +
                        '<select class="custom-select" name="assistencia_' + i + '">' +
                        '<option selected>Selecione os que jogaram...</option>' +
                        '</select>' +
                        '</div>' +
                        '</div>';
                }

                return html;
            });
        }

        $('input[placeholder=Tempo]').mask('00:00');
        $('input[placeholder=Período]').mask('0');
    });

    $('.form-row .btn-danger').click(function(e) {
        let mostrar = $(this).data('show');

        $('.estatisticasPartida').each(function(i, v) {
            if ($(this).hasClass(mostrar)) {
                $(this).slideToggle();
            } else {
                $(this).hide('slow');
            }
        })
    });

    $('select[name="jogadores[]"]').on('change', function() {
        let jogadoresParticipantes = $('select[name="jogadores[]"]').val()
        let inputGols = $('.mostrarGols').find('input');
        let inputAssists = $('.mostrarAssistencias').find('input');

        let options = '';

        $('.mostrarGols select, .mostrarAssistencias select').html(() => {
            if (jogadoresParticipantes.length > 0) {
                options = '<option selected disabled>Jogadores...</option>';
                $.each(jogadoresParticipantes, function(i, v) {
                    $.each(jogadores, function(a, b) {
                        if (v == b.id_usuario) {
                            options += '<option value="' + b.id_usuario + '">' + b.apelido + '</option>';
                        }
                    });
                });
                inputGols.removeAttr('disabled');
                inputAssists.removeAttr('disabled');
            } else {
                options = '<option selected disabled>Selecione os que jogaram...</option>';
                inputGols.attr('disabled', true);
                inputAssists.attr('disabled', true);
            }

            return options;
        });

        $('.estatisticasPartida input[type=text], .estatisticasPartida input[type=number]').val('');
        inputsFalta(1, null, 0);
        inputsFalta(2, null, 0);

        $('.mostrarGols select').append('<option>Gol contra</option>')
        $('.mostrarAssistencias select').append('<option>Sem assistência</option>')
    })

    $('input#qtdFaltas1').on('blur', function() {
        inputsFalta(1, $(this));
    });

    $('input#qtdFaltas2').on('blur', function() {
        inputsFalta(2, $(this));
    });

    $('input#qtdCartoesAmarelo').on('blur', function() {
        inputsCartao('Amarelo', $(this));
    });

    $('input#qtdCartoesVermelho').on('blur', function() {
        inputsCartao('Vermelho', $(this));
    });

    $('button[salvar]').on('click', function(e) {
        e.preventDefault();
        let validar = validarDadosEstatistica();

        if (!validar) {
            swal.fire({
                icon: 'error',
                title: 'Preencha todos os campos dentro dos itens',
                showConfirmButton: false,
                showCancelButton: true,
                cancelButtonColor: '#999',
                cancelButtonText: 'Voltar'
            });
        } else {
            $('form[enviarEstatistica]').ajaxSubmit({
                url: window.origin + '/admin/partidas/cadastrar-estatisticas/enviar-dados',
                dataType: 'json',
                type: 'post',
                beforeSubmit: () => {

                },
                success: (dados) => {
                    if (dados.code == 0) {
                        swal.fire({
                            icon: 'success',
                            title: dados.msg,
                            showConfirmButton: true,
                            confirmButtonColor: '#d33',
                            confirmButtonText: 'Ok',
                        }).then((result) => {
                            window.location.href = window.origin + '/admin/partidas/cadastrar-estatisticas';
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
                        });
                    }
                }
            });
        }
    });
}

function validarDadosEstatistica() {
    let dadosFalse = [];
    contFalse = 0;
    let dadosJogadores = $('select[name="jogadores[]"]').val();

    if (dadosJogadores.length == 0) {
        dadosFalse.push('jogadores');
    }

    if ($('input[name=placar-nqv]').val() > 0) {
        $.each($('.mostrarGols input, .mostrarGols select'), function(i, v) {
            if ($(this).val() == '' || $(this).val() == null) {
                contFalse++;
            }
        });
        (contFalse) ? dadosFalse.push('gols'): contFalse = 0;

        $.each($('.mostrarAssistencias select'), function(i, v) {
            if ($(this).val() == '' || $(this).val() == null) {
                contFalse++;
            }
        });
        (contFalse) ? dadosFalse.push('assistencias'): contFalse = 0;
    }

    $.each($('.mostrarFaltas input, .mostrarFaltas select'), function(i, v) {
        if ($(this).val() == '' || $(this).val() == null) {
            contFalse++;
        }
    });
    (contFalse) ? dadosFalse.push('faltas'): contFalse = 0;

    $.each($('.mostrarCartoes input, .mostrarFaltas select'), function(i, v) {
        if ($(this).val() == '' || $(this).val() == null) {
            contFalse++;
        }
    });
    (contFalse) ? dadosFalse.push('cartoes'): contFalse = 0;

    if (dadosFalse.length > 0) {
        return false;
    } else {
        return true;
    }
}