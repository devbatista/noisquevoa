let equipes = [];
let partidas = [];

$(document).ready(function() {

    $.ajax({
        url: window.origin + '/admin/partidas/carregar-partidas',
        dataType: 'json',
        type: 'get',
        success: (dados) => {
            partidas = dados;
        }
    });

    $('input[name=cepLocal], input[name=add_cepLocal]').mask('00000-000');

    permissao();
});

window.onload = function() {
    setTimeout(() => {
        carregarPartidas(0);
        carregarEstatisticasEmAguardo();
    }, 500);
}

$('button[refresh]').click(function() {
    $('input[value=0]').click();
    carregarEstatisticasEmAguardo();
});

$('input[name=mostrar]').on('change', function() {
    let valor = $('input[name=mostrar]:checked').val();
    carregarPartidas(valor);
})

function carregarPartidas(val) {
    $('table[partidas]').DataTable().destroy();

    let html = '';
    let mandante;
    let visitante;
    let logo_mandante;
    let logo_visitante;
    let gols_mandante;
    let gols_visitante;

    $('tbody[partidas]').html(function() {
        $.each(partidas, function(index, value) {
            if (value.tipo_mv != 'Visitante') {
                mandante = '<b>' + value.nqv + '</b>';
                logo_mandante = window.origin + value.logo_nqv;
                gols_mandante = (value.gols_pro) ? '<b>' + value.gols_pro + '</b>' : '';
                visitante = value.adversario;
                logo_visitante = window.origin + value.logo_adversario;
                gols_visitante = (value.gols_contra) ? value.gols_contra : '';
            } else {
                visitante = '<b>' + value.nqv + '</b>';
                logo_visitante = window.origin + value.logo_nqv;
                gols_visitante = (value.gols_pro) ? '<b>' + value.gols_pro + '</b>' : '';
                mandante = value.adversario;
                logo_mandante = window.origin + value.logo_adversario;
                gols_mandante = (value.gols_contra) ? value.gols_contra : '';
            }

            let concluido = (value.concluido == 1) ? 'verEstatistica' : 'editarPartida';
            let modal = (value.concluido == 1) ? 'data-toggle="modal" data-target=".modal-estatisticas-unica"' : 'data-toggle="modal" data-target=".modal-editar-partida"';

            if (value.concluido == val && value.estatisticas == 1) {
                html += '<tr data-id="' + value.id_partida + '" ' + concluido + ' ' + modal + '>' +
                    '<td>' + value.data + ' - ' + value.horario + '</td>' +
                    '<td><img src="' + logo_mandante + '" alt=""></td>' +
                    '<td>' + mandante + '</td>' +
                    '<td>' + gols_mandante + '</td>' +
                    '<td>X</td>' +
                    '<td>' + gols_visitante + '</td>' +
                    '<td>' + visitante + '</td>' +
                    '<td><img src="' + logo_visitante + '" alt=""></td>' +
                    '<td>' + value.local + '</td>' +
                    '<td>' + value.liga + '</td>' +
                    '</tr>';
            };

            if (value.concluido == val && value.concluido != 1 && value.cancelado == 0) {
                html += '<tr data-id="' + value.id_partida + '" ' + concluido + ' ' + modal + '>' +
                    '<td>' + value.data + ' - ' + value.horario + '</td>' +
                    '<td><img src="' + logo_mandante + '" alt=""></td>' +
                    '<td>' + mandante + '</td>' +
                    '<td>' + gols_mandante + '</td>' +
                    '<td>X</td>' +
                    '<td>' + gols_visitante + '</td>' +
                    '<td>' + visitante + '</td>' +
                    '<td><img src="' + logo_visitante + '" alt=""></td>' +
                    '<td>' + value.local + '</td>' +
                    '<td>' + value.liga + '</td>' +
                    '</tr>';
            };

            if (val == 2 && value.cancelado == 1) {
                html += '<tr cancelado data-id="' + value.id_partida + '" data-toggle="tooltip" title="' + value.motivo_cancelamento + '">' +
                    '<td>' + value.data + ' - ' + value.horario + '</td>' +
                    '<td><img src="' + logo_mandante + '" alt=""></td>' +
                    '<td>' + mandante + '</td>' +
                    '<td>' + gols_mandante + '</td>' +
                    '<td>X</td>' +
                    '<td>' + gols_visitante + '</td>' +
                    '<td>' + visitante + '</td>' +
                    '<td><img src="' + logo_visitante + '" alt=""></td>' +
                    '<td>' + value.local + '</td>' +
                    '<td>' + value.liga + '</td>' +
                    '</tr>';
            };

            setTimeout(() => {
                $('[data-toggle="tooltip"]').tooltip();
            }, 150);
        });

        return html;
    });

    let order = (val == 1) ? '"desc"' : '"asc"';

    jQuery.extend(jQuery.fn.dataTableExt.oSort, {
        "date-br-pre": function(a) {
            if (a == null || a == "") {
                return 0;
            }
            var brDatea = a.split('/');
            return (brDatea[2] + brDatea[1] + brDatea[0]) * 1;
        },

        "date-br-asc": function(a, b) {
            return ((a < b) ? -1 : ((a > b) ? 1 : 0));
        },

        "date-br-desc": function(a, b) {
            return ((a < b) ? 1 : ((a > b) ? -1 : 0));
        }
    });

    $('table[partidas]').DataTable({
        "language": {
            "url": window.origin + "/assets/plugins/datatables/Portuguese-Brasil.json"
        },
        "columnDefs": [
            { type: 'date-br', targets: 0 }
        ],
        "ordering": false,
    });

    $('tr[verEstatistica]').on('click', function() {
        let id = $(this).data('id');
        modalEstatisticaUnica(id);
    });

    $('tr[editarPartida]').on('click', function() {
        let id = $(this).data('id');
        modalEditarPartida(id);
    });

    if ($(window).width() <= 640) {
        setTimeout(() => {
            let head = $('thead tr th');
            $.each(head, function(chave, valor) {
                if (chave == 0 || chave == 2 || chave == 6 || chave == 9) {
                    this.remove();
                }
            });

            let row = $('tbody tr');
            $.each(row, function(index, value) {
                $.each($(this).find('td'), function(i, v) {
                    if (i == 0 || i == 2 || i == 6 || i == 9) {
                        $(v).remove();
                    }
                });
            });
        }, 75);
    }
}

function modalEstatisticaUnica(id) {
    $.ajax({
        url: window.origin + '/admin/partidas/carregar-estatisticas-jogo/' + id,
        dataType: 'json',
        type: 'get',
        beforeSend: () => {

        },
        success: (dados) => {
            $('[data-horario]').html(function() {
                return '<div class="col-12">' +
                    dados.partida.data_hora_partida +
                    '</div>';
            });

            let sumula = '';
            if (dados.partida.sumula) {
                sumula = '<div sumula class="col-12 descritive-content">' +
                    'Mostrar súmula' +
                    '</div>' +
                    '<div class="col-12 content">' +
                    '<embed src="' + window.origin + dados.partida.sumula + '" width="100%" height="1115px" />' +
                    '</div>';
            } else {
                sumula = '<div class="col-12 descritive-content">' +
                    'Sem súmula' +
                    '</div>';
            }

            $('[placar-partida]').html(function() {
                return '<div class="col-2">' +
                    'NQV' +
                    '</div>' +
                    '<div class="col-2">' +
                    '<img src="' + window.origin + '/assets/img/times/noisquevoa.png" alt="">' +
                    '</div>' +
                    '<div class="col-1">' +
                    dados.partida.gols_pro +
                    '</div>' +
                    '<div class="col-2">' +
                    'X' +
                    '</div>' +
                    '<div class="col-1">' +
                    dados.partida.gols_contra +
                    '</div>' +
                    '<div class="col-2">' +
                    '<img src="' + window.origin + dados.partida.logo_equipe + '" alt="">' +
                    '</div>' +
                    '<div class="col-2">' +
                    dados.partida.abreviacao +
                    '</div>' +
                    '<div class="col-12 descritive-content">' +
                    'Jogadores' +
                    '</div>' +
                    '<table jogadores class="table table-hover text-left">' +
                    '<tbody>' +
                    '</tbody>' +
                    '</table>' +
                    '<div class="col-12 d-flex align-items-center" style="padding: 10px; border-top: 1px solid #fef">' +
                    '<img src="' + window.origin + '/assets/img/bola.png" alt=""><span>Gol</span>' +
                    '<img src="' + window.origin + '/assets/img/chuteira.png" alt=""><span>Assistência</span>' +
                    '<img src="' + window.origin + '/assets/img/apito.png" alt=""><span>Falta</span>' +
                    '<img src="' + window.origin + '/assets/img/cartao-amarelo.png" alt=""><span>Cartão Amarelo</span>' +
                    '<img src="' + window.origin + '/assets/img/cartao-vermelho.png" alt=""><span>Cartão Vermelho</span>' +
                    '</div>' +
                    '<div class="col-12 descritive-content">' +
                    'Local' +
                    '</div>' +
                    '<div class="col-12 content">' +
                    dados.partida.local_partida +
                    '</div>' +
                    sumula;
            });

            let html = '';
            let goals = '';
            let assists = '';
            let fouls = '';
            let yellowCards = '';
            let redCards = '';
            let quant = 0;
            $('table[jogadores] tbody').html(function() {
                $.each(dados.jogadores, function(a, j) {

                    let contGoals = 0;
                    $.each(dados.gols, function(i, g) {
                        if (j.id_usuario == g.id_usuario) {
                            contGoals++;
                        }
                    });
                    if (contGoals > 0) {
                        quant = (contGoals > 1) ? '(' + contGoals + ')' : '';
                        goals = '<td>' +
                            '<img src="' + window.origin + '/assets/img/bola.png" alt=""> ' + quant +
                            '</td>';
                    } else {
                        goals = '<td></td>';
                    }

                    let contAssists = 0;
                    $.each(dados.assistencias, function(i, a) {
                        if (j.id_usuario == a.id_usuario) {
                            contAssists++;
                        }
                    });
                    if (contAssists > 0) {
                        quant = (contAssists > 1) ? '(' + contAssists + ')' : '';
                        assists = '<td>' +
                            '<img src="' + window.origin + '/assets/img/chuteira.png" alt=""> ' + quant +
                            '</td>';
                    } else {
                        assists = '<td></td>';
                    }

                    let contFouls = 0;
                    $.each(dados.faltas, function(i, f) {
                        if (j.id_usuario == f.id_usuario) {
                            contFouls++;
                        }
                    });
                    if (contFouls > 0) {
                        quant = (contFouls > 1) ? '(' + contFouls + ')' : '';
                        fouls = '<td>' +
                            '<img src="' + window.origin + '/assets/img/apito.png" alt=""> ' + quant +
                            '</td>';
                    } else {
                        fouls = '<td></td>';
                    }

                    let contYellowCards = 0;
                    $.each(dados.cartoesAmarelos, function(i, y) {
                        if (j.id_usuario == y.id_usuario) {
                            contYellowCards++;
                        }
                    });
                    if (contYellowCards > 0) {
                        quant = (contYellowCards > 1) ? '(' + contYellowCards + ')' : '';
                        yellowCards = '<td>' +
                            '<img src="' + window.origin + '/assets/img/cartao-amarelo.png" alt=""> ' + quant +
                            '</td>';
                    } else {
                        yellowCards = '<td></td>';
                    }

                    let contRedCards = 0;
                    $.each(dados.cartoesVermelhos, function(i, r) {
                        if (j.id_usuario == r.id_usuario) {
                            contRedCards++;
                        }
                    });
                    if (contRedCards > 0) {
                        quant = (contRedCards > 1) ? '(' + contRedCards + ')' : '';
                        redCards = '<td>' +
                            '<img src="' + window.origin + '/assets/img/cartao-vermelho.png" alt=""> ' + quant +
                            '</td>';
                    } else {
                        redCards = '<td></td>';
                    }

                    html += '<tr data-id="' + this.id_usuario + '">' +
                        '<th>' + this.apelido + '</th>' +
                        goals +
                        assists +
                        fouls +
                        yellowCards +
                        redCards +
                        '</tr>';
                });
                return html;
            });

            $('embed').hide();
            $('[sumula]').text('Mostrar súmula');
        }
    }).done(function() {
        $('[sumula]').click(function() {
            $('embed').slideToggle(function() {
                if ($(this).is(':visible')) {
                    $('[sumula]').text('Esconder súmula');
                } else {
                    $('[sumula]').text('Mostrar súmula');
                }
            });
        });
    });
}

function modalEditarPartida(id) {
    carregarLigas();
    carregarLocais();
    $.each(partidas, function(i, v) {
        setTimeout(() => {
            if (this.id_partida == id) {
                let data_hora = this.data_formatada_js + 'T' + this.horario;
                $('input[name=id_partida]').val(id);
                $('input#editar_adversario').val(this.adversario).attr('disabled', true);
                $('input#editar_abreviacao').val(this.abreviacao).attr('disabled', true);
                $('select#editar_local').val(1);
                $('select#editar_liga').val(this.id_liga);
                $('input#dataHoraPartida').val(data_hora);
            }
        }, 250);
    });
}

function carregarEstatisticasEmAguardo() {
    let estatisticasEmAguardo = 0;

    $.each(partidas, function(i, v) {
        if (v.concluido == "1" && v.estatisticas == "0") {
            estatisticasEmAguardo++;
        }
    });

    if (estatisticasEmAguardo > 0) {
        $('.pull-left button').text('Estatísticas em aguardo (' + estatisticasEmAguardo + ')').removeClass('disabled');
    } else {
        $('.pull-left button').text('Estatísticas em aguardo (0)').addClass('disabled');
    }
}

$('.pull-left button').click(function(e) {
    e.preventDefault();
    if ($(this).hasClass('disabled') == false) {
        window.location = window.origin + '/admin/partidas/cadastrar-estatisticas';
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

$('button.cadastrarPartidas').click(function() {
    carregarEquipes();
    carregarLocais();
    carregarLigas();
});

function carregarEquipes() {
    $.ajax({
        url: window.origin + '/admin/partidas/carregar-equipes',
        dataType: 'json',
        type: 'get',
        success: (dados) => {
            equipes = dados;
            let html = '';

            $('datalist#adversario').html(function() {
                $.each(dados, function(i, v) {
                    html += '<option>' + this.nome + '</option>'
                });

                return html;
            });
        }
    });
}

function carregarAbreviacao() {
    let adversario = $('input[name=adversario]').val();

    if (adversario.length > 0) {
        $.each(equipes, function(i, v) {
            if (adversario == v.nome) {
                console.log(v);
                setTimeout(() => {
                    $('#abreviacao').val(v.abreviacao);
                    $('#logo').prev().text('Alterar logo do adversário:');
                }, 250);
            } else {
                setTimeout(() => {
                    $('#abreviacao').val('');
                    $('#logo').prev().text('Logo do adversário:');
                }, 200);
            }
        });
    } else {
        $('#abreviacao').val('');
        $('#logo').prev().text('Logo do adversário:');
    }
}

$('input[name=adversario]').on('keyup', function() {
    carregarAbreviacao();
});

$('input[name=adversario]').on('focusout', function() {
    carregarAbreviacao();
});

$('#abreviacao').on('focusout', function() {
    let abreviacao = $(this).val();
    abreviacao = abreviacao.toUpperCase();
    $(this).val(abreviacao);
});


function carregarLocais() {
    $.ajax({
        url: window.origin + '/admin/partidas/carregar-locais',
        dataType: 'json',
        type: 'get',
        beforeSend: () => {
            $('select#local').html('<option disabled selected value="none" style="color:#808080">Carregando...</option>')
            $('select#editar_local').html('<option disabled selected value="none" style="color:#808080">Carregando...</option>')
        },
        success: (dados) => {
            let html = '<option disabled selected value="0" style="color:#808080">Selecionar Local</option>';
            $('select#local').html(function() {
                $.each(dados, function(i, v) {
                    html += '<option value="' + this.id_local + '">' + this.nome + '</option>';
                });
                return html;
            });

            let html2 = '<option disabled selected value="0" style="color:#808080">Selecionar Local</option>';
            $('select#editar_local').html(function() {
                $.each(dados, function(i, v) {
                    html2 += '<option value="' + this.id_local + '">' + this.nome + '</option>';
                });
                return html2;
            });
        }
    });
}

function carregarLigas() {
    $.ajax({
        url: window.origin + '/admin/partidas/carregar-ligas',
        dataType: 'json',
        type: 'get',
        beforeSend: () => {
            $('select#liga').html('<option disabled selected value="none" style="color:#808080">Carregando...</option>')
            $('select#editar_liga').html('<option disabled selected value="none" style="color:#808080">Carregando...</option>')
        },
        success: (dados) => {
            let html = '<option disabled selected value="0" style="color:#808080">Selecionar Liga</option>';
            $('select#liga').html(function() {
                $.each(dados, function(i, v) {
                    html += '<option value="' + this.id_liga + '">' + this.nome + '</option>';
                });
                return html;
            });

            let html2 = '<option disabled selected value="0" style="color:#808080">Selecionar Liga</option>';
            $('select#editar_liga').html(function() {
                $.each(dados, function(i, v) {
                    html2 += '<option value="' + this.id_liga + '">' + this.nome + '</option>';
                });
                return html2;
            });
        }
    });
}

$('.cadastro-locais').click(function() {
    if ($(this).find('i').hasClass('fa-plus')) {
        $('.inserir-local').removeClass('d-none');
        $(this).find('i').removeClass('fa-plus').addClass('fa-minus');
    } else {
        $('.inserir-local').addClass('d-none');
        $(this).find('i').removeClass('fa-minus').addClass('fa-plus');

        $.each($('.inserir-local').find('input'), function() {
            $(this).val('').removeAttr('disabled');
        });
    }
});

$('input[name=cepLocal], input[name=add_cepLocal]').on('keyup', function(e) {
    let cep = $(this).val();
    let hasClass = $(this).hasClass('cepLocal')
    if (hasClass) {
        $('#enderecoLocal').val('').removeAttr('disabled');
        $('#bairroLocal').val('').removeAttr('disabled');
        $('#cidadeLocal').val('').removeAttr('disabled');
        $('#estadoLocal').val('').removeAttr('disabled');
    } else {
        $('input[name=add_enderecoLocal]').val('').removeAttr('disabled');
        $('input[name=add_bairroLocal]').val('').removeAttr('disabled');
        $('input[name=add_cidadeLocal]').val('').removeAttr('disabled');
        $('input[name=add_estadoLocal]').val('').removeAttr('disabled');
    }


    if (cep.length === 9) {
        $.ajax({
            url: 'https://viacep.com.br/ws/' + cep + '/json',
            dataType: 'json',
            success: (dados) => {
                if (Object.keys(dados).length > 0) {
                    if (hasClass) {
                        $('#enderecoLocal').val(dados.logradouro).attr('disabled', true);
                        $('#bairroLocal').val(dados.bairro).attr('disabled', true);
                        $('#cidadeLocal').val(dados.localidade).attr('disabled', true);
                        $('#estadoLocal').val(dados.uf).attr('disabled', true);
                    } else {
                        $('input[name=add_enderecoLocal]').val(dados.logradouro).attr('disabled', true);
                        $('input[name=add_bairroLocal]').val(dados.bairro).attr('disabled', true);
                        $('input[name=add_cidadeLocal]').val(dados.localidade).attr('disabled', true);
                        $('input[name=add_estadoLocal]').val(dados.uf).attr('disabled', true);
                    }
                }
            }
        });
    }
});

$('a.btn-secondary').click(function() {
    let data = {};
    if ($(this).hasClass('formInserir')) {
        data = {
            nome: $('#nomeLocal').val(),
            cep: $('#cepLocal').val(),
            endereco: $('#enderecoLocal').val(),
            numero: $('#numeroLocal').val(),
            complemento: $('#complementoLocal').val(),
            bairro: $('#bairroLocal').val(),
            cidade: $('#cidadeLocal').val(),
            estado: $('#estadoLocal').val(),
        }
    } else {
        data = {
            nome: $('input[name=add_nomeLocal]').val(),
            cep: $('input[name=add_cepLocal]').val(),
            endereco: $('input[name=add_enderecoLocal]').val(),
            numero: $('input[name=add_numeroLocal]').val(),
            complemento: $('input[name=add_complementoLocal]').val(),
            bairro: $('input[name=add_bairroLocal]').val(),
            cidade: $('input[name=add_cidadeLocal]').val(),
            estado: $('input[name=add_estadoLocal]').val(),
        }
    }

    $.ajax({
        url: window.origin + '/admin/partidas/cadastrar-local',
        dataType: 'json',
        type: 'post',
        data: data,
        success: (retorno) => {
            if (retorno.code === 1062) {
                swal.fire({
                    icon: 'error',
                    title: retorno.msg,
                    showConfirmButton: false,
                    showCancelButton: true,
                    cancelButtonColor: '#999',
                    cancelButtonText: 'Voltar'
                });
            } else {
                $.each($('.inserir-local').find('input'), function() {
                    $(this).val('').removeAttr('disabled');
                });

                $('.inserir-local').addClass('d-none');
                $(this).find('i').removeClass('fa-minus').addClass('fa-plus');

                carregarLocais();
            }
        }
    });
});

$('.modal-cadastro-partida').find('button.btn-danger').on('click', function(e) {
    e.preventDefault();
    $('form[cadastrarPartidas]').submit();
});

$('.modal-cadastro-partida, .modal-editar-partida').on('hidden.bs.modal', function(e) {
    if (!($('.inserir-local').hasClass('d-none'))) {
        $('.inserir-local').addClass('d-none');
        $(this).find('i').removeClass('fa-minus').addClass('fa-plus');
    }
});

$('button.btn-dark').on('click', function(e) {
    e.preventDefault();
    $(document).off('focusin.modal');
    let id = $(this).parent().parent().find('input[name=id_partida]').val();
    Swal.fire({
        title: 'Digite o motivo do cancelamento',
        input: 'text',
        inputAttributes: {
            autocapitalize: 'off'
        },
        showCancelButton: true,
        cancelButtonText: 'Fechar',
        confirmButtonText: 'Cancelar',
        confirmButtonColor: '#d33',
        showLoaderOnConfirm: false,
        preConfirm: (motivo) => {
            if (motivo.length > 0) {
                $.ajax({
                    url: window.origin + '/admin/partidas/cancelar-partidas',
                    data: { id, motivo },
                    type: 'post',
                    dataType: 'json',
                    success: (retorno) => {
                        if (retorno.code === 1) {
                            Swal.fire({
                                title: retorno.msg,
                                text: retorno.submsg,
                                showCancelButton: true,
                                showConfirmButton: false,
                            });

                            return false;
                        } else {
                            Swal.fire({
                                title: retorno.msg,
                                showCancelButton: false,
                                confirmButtonText: 'Ok',
                                confirmButtonColor: '#d33',
                            }).then(() => {
                                window.location.reload();
                            });
                        }
                    }
                });
            } else {
                Swal.fire({
                    title: 'Motivo inexistente',
                    text: 'Digite o motivo do cancelamento',
                    showCancelButton: true,
                    showConfirmButton: false,
                });
                return false;
            }
        }
    });
})

$('form[cadastrarPartidas]').on('submit', function(e) {
    e.preventDefault();
    $(this).ajaxSubmit({
        url: window.origin + '/admin/partidas/cadastrar-partida',
        dataType: 'json',
        type: 'post',
        success: (dados) => {
            if (dados.code == 0) {
                $('.modal-cadastro-partida').modal('hide');
                swal.fire({
                    title: 'Partida cadastrada com sucesso',
                    showConfirmButton: true,
                    showCancelButton: false,
                    confirmButtonColor: '#999',
                    confirmButtonText: 'OK'
                }).then(() => {
                    setTimeout(() => {
                        window.location.reload();
                    }, 350);
                });
                // carregarPartidas();
            } else {
                swal.fire({
                    icon: 'error',
                    title: dados.msg,
                    text: 'Tamanho permitido ' + dados.tamanho_permitido + ' / Tipos permitidos: ' + dados.tipos_permitidos,
                    showConfirmButton: false,
                    showCancelButton: true,
                    cancelButtonColor: '#999',
                    cancelButtonText: 'Voltar'
                });
            }
        },
        error: () => {
            swal.fire({
                icon: 'error',
                title: 'Erro ao cadastrar partida',
                text: 'Atualize a página e tente cadastrar novamente',
                showConfirmButton: false,
                showCancelButton: true,
                cancelButtonColor: '#999',
                cancelButtonText: 'Voltar'
            });
        }
    });
});