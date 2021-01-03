let equipes = [];

$(document).ready(function() {
    $('table').DataTable({
        "language": {
            "url": window.origin + "/assets/plugins/datatables/Portuguese-Brasil.json"
        }
    });

    $('input[name=cepLocal]').mask('00000-000');

    permissao();
});

function permissao() {
    let presidencia = $('body').attr('presidencia');
    let diretoria = $('body').attr('diretoria');
    if (presidencia == 1 || diretoria == 1) {
        $('div.buttons').removeClass('d-none');

        carregarEquipes();
        carregarLocais();
        carregarLigas();
    } else {
        $('div.buttons').remove();
        $('div.inserir-local').remove();
    }
}

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
    let adversario = $('input[name=adversario]').val()

    if (adversario.length > 0) {
        $.each(equipes, function(i, v) {
            if (this.nome == adversario) {
                $('#abreviacao').val(this.abreviacao);
                $('#logo').prev().text('Alterar logo do adversário:');
            } else {
                $('#abreviacao').val('');
                $('#logo').prev().text('Logo do adversário:');
            }
        });
    } else {
        $('#abreviacao').val('');
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
        },
        success: (dados) => {
            let html = '<option disabled selected value="0" style="color:#808080">Selecionar Local</option>';

            $('select#local').html(function() {
                $.each(dados, function(i, v) {
                    html += '<option value="' + this.id_local + '">' + this.nome + '</option>';
                });
                return html;
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
        },
        success: (dados) => {
            let html = '<option disabled selected value="0" style="color:#808080">Selecionar Liga</option>';

            $('select#liga').html(function() {
                $.each(dados, function(i, v) {
                    html += '<option value="' + this.id_liga + '">' + this.nome + '</option>';
                });
                return html;
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

$('input[name=cepLocal]').on('keyup', function(e) {
    let cep = $(this).val();
    $('#enderecoLocal').val('').removeAttr('disabled');
    $('#bairroLocal').val('').removeAttr('disabled');
    $('#cidadeLocal').val('').removeAttr('disabled');
    $('#estadoLocal').val('').removeAttr('disabled');

    if (cep.length === 9) {
        $.ajax({
            url: 'https://viacep.com.br/ws/' + cep + '/json',
            dataType: 'json',
            success: (dados) => {
                if (Object.keys(dados).length > 0) {
                    $('#enderecoLocal').val(dados.logradouro).attr('disabled', true);
                    $('#bairroLocal').val(dados.bairro).attr('disabled', true);
                    $('#cidadeLocal').val(dados.localidade).attr('disabled', true);
                    $('#estadoLocal').val(dados.uf).attr('disabled', true);
                }
            }
        });
    }
});

$('a.btn').click(function() {
    let data = {
        nome: $('#nomeLocal').val(),
        cep: $('#cepLocal').val(),
        endereco: $('#enderecoLocal').val(),
        numero: $('#numeroLocal').val(),
        complemento: $('#complementoLocal').val(),
        bairro: $('#bairroLocal').val(),
        cidade: $('#cidadeLocal').val(),
        estado: $('#estadoLocal').val(),
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

$('form[cadastrarPartidas]').on('submit', function(e) {
    e.preventDefault();
    $(this).ajaxSubmit({
        url: window.origin + '/admin/partidas/cadastrar-partida',
        dataType: 'json',
        type: 'post',
        success: (dados) => {
            if (dados.code == 0) {
                swal.fire({
                    title: 'Partida cadastrada com sucesso',
                    showConfirmButton: true,
                    showCancelButton: false,
                    confirmButtonColor: '#999',
                    confirmButtonText: 'OK'
                });

                $('modal-cadastro-partida').modal('hide');
                // carregarPartidas();
            } else {
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