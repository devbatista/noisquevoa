let dados = {};

$(document).ready(function() {
    $.ajax({
        url: window.origin + '/admin/home/dados',
        type: 'get',
        dataType: 'json',
        success: (e) => {
            dados = e;

            carregarDados();
        }
    });
});

function carregarDados() {
    $.each($('h5'), function(i, v) {
        if ($(v).text() == 'Jogos') {
            $(this).parent().parent().find('h1.no-margins').text(dados.qtdJogos);
        }

        if ($(v).text() == 'Vitórias') {
            $(this).parent().parent().find('h1.no-margins').text(dados.vitorias);
        }

        if ($(v).text() == 'Derrotas') {
            $(this).parent().parent().find('h1.no-margins').text(dados.derrotas);
        }

        if ($(v).text() == 'Empates') {
            $(this).parent().parent().find('h1.no-margins').text(dados.empates);
        }

        if ($(v).text() == 'Próximas partidas') {
            proximasPartidas($(this).parent().parent());
        }

        if ($(v).text() == 'Partidas anteriores') {
            partidasAnteriores($(this).parent().parent());
        }

        if ($(v).text() == 'Assistências') {
            assistencias();
        }

        if ($(v).text() == 'Artilharia') {
            artilharia();
        }
    });
}

function proximasPartidas(element) {

    let proxPartidas = dados.proximas_partidas;
    let ibox = $(element).find('.ibox-title');
    let html = '';

    ibox.after(function() {
        if (Object.keys(proxPartidas).length > 0) {
            $.each(proxPartidas, function(i, v) {
                let mandante = v.tipo_mv == 'Mandante' ? window.origin + v.nqv : window.origin + v.adversario;
                let visitante = v.tipo_mv == 'Visitante' ? window.origin + v.nqv : window.origin + v.adversario;

                html += '<div class="ibox-content">' +
                    '<div class="row justify-content-center liga">' +
                    '<span class="text-muted">' + v.liga + '</span>' +
                    '</div>' +
                    '<div class="row justify-content-center">' +
                    '<span class="text-muted"><b>' + v.data + '</b> ' + v.local + ' <b>' + v.horario + '</b></span>' +
                    '</div>' +
                    '<div class="row" style="margin-top: 10px">' +
                    '<div class="col-5 text-center mandante">' +
                    '<img src="' + mandante + '" alt="Nois Que Voa" class="mandante">' +
                    '</div>' +
                    '<div class="col-2 versus text-muted">X</div>' +
                    '<div class="col-5 text-center visitante">' +
                    '<img src="' + visitante + '" alt="Visitante" class="visitante">' +
                    '</div>' +
                    '</div>' +
                    '</div>';
            });
        } else {

            html += '<div class="ibox-content"> Não há próximas partidas cadastradas </div>';
        }
        return html;
    });
}

function partidasAnteriores(element) {

    let partidasAnteriores = dados.partidas_anteriores;
    let ibox = $(element).find('.ibox-title');
    let html = '';

    ibox.after(function() {
        if (Object.keys(partidasAnteriores).length > 0) {
            $.each(partidasAnteriores, function(i, v) {
                let mandante;
                let visitante;
                let gols_mandante;
                let gols_visitante;

                if (v.tipo_mv == 'Mandante' || v.tipo_mv == 'Neutro') {
                    gols_mandante = v.gols_pro;
                    gols_visitante = v.gols_contra;
                    mandante = window.origin + v.nqv;
                    visitante = window.origin + v.adversario;
                } else {
                    gols_visitante = v.gols_pro;
                    gols_mandante = v.gols_contra;
                    visitante = window.origin + v.nqv;
                    mandante = window.origin + v.adversario;
                }

                html += '<div class="ibox-content">' +
                    '<div class="row justify-content-center liga">' +
                    '<span class="text-muted">' + v.liga + '</span>' +
                    '</div>' +
                    '<div class="row justify-content-center">' +
                    '<span class="text-muted"><b>' + v.data + '</b> ' + v.local + ' <b>' + v.horario + '</b></span>' +
                    '</div>' +
                    '<div class="row" style="margin-top: 10px">' +
                    '<div class="col-3 text-center mandante">' +
                    '<img src="' + mandante + '" alt="Nois Que Voa" class="mandante">' +
                    '</div>' +
                    '<div class="col-2 placar-resultado text-muted">' + gols_mandante + '</div>' +
                    '<div class="col-2 versus text-grey-opacity">X</div>' +
                    '<div class="col-2 placar-resultado text-muted">' + gols_visitante + '</div>' +
                    '<div class="col-3 text-center visitante">' +
                    '<img src="' + visitante + '" alt="Visitante" class="visitante">' +
                    '</div>' +
                    '</div>' +
                    '</div>';
            });
        } else {
            html += '<div class="ibox-content"> Ainda não houve partida nessa temporada </div>';
        }

        return html;
    });
}

function assistencias() {

    let assistencias = dados.assistencia;
    let html = '';

    $('tbody[classificacaoAssistencias]').append(function() {
        if (Object.keys(assistencias).length > 0) {
            $.each(assistencias, function(i, v) {
                let pos = i + 1;

                html += '<tr>' +
                    '<th scope="row">' + pos + 'º</th>' +
                    '<td>' + this.apelido + '</td>' +
                    '<td>' + this.assistencias + '</td>' +
                    '<td>' + this.jogos + '</td>' +
                    '</tr>';
            });
        } else {

        }

        return html;
    });

    $('td, th[scope=row]').css('color', '#888');
}

function artilharia() {

    let artilharia = dados.artilharia;
    let html = '';

    $('tbody[classificacaoArtilharia]').append(function() {
        if (Object.keys(artilharia).length > 0) {
            $.each(artilharia, function(i, v) {
                let pos = i + 1;

                html += '<tr>' +
                    '<th scope="row">' + pos + 'º</th>' +
                    '<td>' + this.apelido + '</td>' +
                    '<td>' + this.gols + '</td>' +
                    '<td>' + this.jogos + '</td>' +
                    '</tr>';
            });
        } else {

        }

        return html;
    });

    $('td, th[scope=row]').css('color', '#888');
}