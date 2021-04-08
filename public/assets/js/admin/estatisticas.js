let base = {};
let dados = {};

window.onload = function() {
    let startDate = moment().startOf('year');
    let endDate = moment();

    let periodo = { startDate, endDate };

    function cb(startDate, endDate) {
        $('#reportrange span').html(startDate.format('DD/MM/YYYY') + ' - ' + endDate.format('DD/MM/YYYY'));
    }

    moment.locale('pt-br');

    $('#reportrange').daterangepicker({
        dateFormat: 'dd/mm/yyyy',
        startDate: startDate,
        endDate: endDate,
        applyButtonClasses: 'btn-danger',
        ranges: {
            'Últimos 7 dias': [moment().subtract(6, 'days'), moment()],
            'Últimos 30 dias': [moment().subtract(29, 'days'), moment()],
            'Mês Atual': [moment().startOf('month'), moment().endOf('month')],
            'Mês Anterior': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],
            'Ano Atual': [moment().startOf('year'), moment().endOf('year')],
            'Ano Anterior': [moment().subtract(1, 'year').startOf('year'), moment().subtract(1, 'year').endOf('year')],
        },
        opens: 'left',
        locale: {
            'format': 'DD/MM/YYYY',
            'separator': ' - ',
            'applyLabel': 'Aplicar',
            'cancelLabel': 'Cancelar',
            'customRangeLabel': 'Personalizado',
            'daysOfWeek': [
                'Dom',
                'Seg',
                'Ter',
                'Qua',
                'Qui',
                'Sex',
                'Sab'
            ],
            'monthNames': [
                'Jan',
                'Fev',
                'Mar',
                'Abr',
                'Mai',
                'Jun',
                'Jul',
                'Ago',
                'Set',
                'Out',
                'Nov',
                'Dez'
            ],
            'firstDay': 0
        }
    }, cb).on('apply.daterangepicker', function(ev, pic) {
        let data = {
            startDate: pic.startDate.format('MM/DD/YYYY') + ' 00:00:00',
            endDate: pic.endDate.format('MM/DD/YYYY') + ' 23:59:59',
        };
        window.vdeChart.destroy();
        // window.partidasChart.destroy();
        window.myPie.destroy();
        window.barChart.destroy();

        window.slickPartidas.slick('unslick');

        carregarEstatisticas(data);
    });

    cb(startDate, endDate);

    $.ajax({
        url: window.origin + '/assets/estatisticas/dados',
        dataType: 'json',
        type: 'get',
        success: (e) => {
            base = e;
            carregarEstatisticas(periodo);
        }
    });
}

function carregarEstatisticas(data) {
    let startDate = new Date(data.startDate);
    let endDate = new Date(data.endDate);

    let jogadores = getInfo(startDate, endDate, base.jogadores, true);

    let partidas = getInfo(startDate, endDate, base.partidas);
    let qtdPartidas = partidas.length;

    let gols = getInfo(startDate, endDate, base.gols);
    let qtdGols = gols.length;
    let qtdGolsSofridos = 0;

    let assistencias = getInfo(startDate, endDate, base.assistencia);

    let faltas = getInfo(startDate, endDate, base.faltas);
    let qtdFaltas = faltas.length;

    let cartoesAmarelos = getInfo(startDate, endDate, base.cartoes_amarelos);
    let qtdCartoesAmarelos = cartoesAmarelos.length;

    let cartoesVermelhos = getInfo(startDate, endDate, base.cartoes_vermelhos);
    let qtdCartoesVermelhos = cartoesVermelhos.length;

    let qtdVitorias = 0;
    let qtdEmpates = 0;
    let qtdDerrotas = 0;

    let qtdGolsPorTempo = {
        1: 0,
        2: 0,
    };

    $.each(partidas, function(i, v) {
        if (this.gols_pro > this.gols_contra) {
            qtdVitorias++;
        } else if (this.gols_pro == this.gols_contra) {
            qtdEmpates++;
        } else {
            qtdDerrotas++;
        }

        qtdGolsSofridos = qtdGolsSofridos + parseInt(this.gols_contra);
    });

    $.each(gols, function(i, v) {
        if (this.periodo == 1) {
            qtdGolsPorTempo[1]++;
        } else {
            qtdGolsPorTempo[2]++;
        }
    });

    dados = { jogadores, partidas, qtdPartidas, gols, qtdGols, qtdGolsSofridos, assistencias, faltas, qtdFaltas, cartoesAmarelos, qtdCartoesAmarelos, cartoesVermelhos, qtdCartoesVermelhos, qtdVitorias, qtdEmpates, qtdDerrotas, qtdGolsPorTempo };

    visualizarEstatisticas();
}

function getInfo(startDate, endDate, base, jogadores = false) {
    let retorno = [];
    if (jogadores) {
        $.each(base, function(i, v) {
            let dataHoraCriado = new Date(this.dt_hr_criado);
            let dataHoraDstv;
            if (this.dt_hr_desativado) { dataHoraDstv = new Date(this.dt_hr_desativado); } else { dataHoraDstv = endDate; }
            if (dataHoraCriado < startDate || dataHoraDstv >= endDate) {
                retorno[i] = this;
            }
        });
    } else {
        $.each(base, function(i, v) {
            let dataHora = new Date(this.dt_hora);
            if (dataHora > startDate && dataHora < endDate) {
                retorno[i] = this;
            }
        });
    }
    retorno = retorno.filter(function(el) {
        return el != null;
    });
    return retorno;
}

function visualizarEstatisticas() {
    $('.jogosNoPeriodo h1').html(dados.qtdPartidas);
    slidePartidas();
    carregarGraficos();

    $.each(dados, function(i, v) {
        if (i.indexOf('qtd')) {
            organizarClassificacoes(i);
        }
    });
}

function organizarClassificacoes(table) {
    if (table == 'gols') {
        let jogadores = [];
        $.each(dados.jogadores, function(i, v) {
            jogadores[this.id_usuario] = {
                apelido: this.apelido,
                id_usuario: this.id_usuario,
            };
        });
        jogadores = jogadores.filter(function(el) {
            return el != null;
        });

        let tempGols = {};
        $.each(jogadores, function(i, v) {
            tempGols[i] = {
                jogador: v.apelido,
                gols: salvarQtdUnit(v.apelido, dados.gols),
                jogos: salvarQtdJogos(v.id_usuario),
            }
        });

        let classGols = [];
        let gols = dados.qtdGols;
        if (gols > 0) {
            $.each(tempGols, function(i, v) {
                let percent = ((this.gols * 100) / gols).toFixed(0);
                let calculoMedia = this.gols / this.jogos
                let media = (calculoMedia) ? calculoMedia.toFixed(2) : 0;
                classGols[i] = {
                    jogador: this.jogador,
                    qtd: this.gols,
                    jogos: this.jogos,
                    percent: percent,
                    media: media,
                }
            });
            classGols.sort(function(a, b) {
                if (a.qtd < b.qtd) return 1;
                if (a.qtd > b.qtd) return -1;
                return 0;
            });
        }

        inserirClassificacaoNaTela(classGols, table);
        return;
    }

    if (table == 'assistencias') {
        let jogadores = [];
        $.each(dados.jogadores, function(i, v) {
            jogadores[this.id_usuario] = {
                apelido: this.apelido,
                id_usuario: this.id_usuario,
            };
        });
        jogadores = jogadores.filter(function(el) {
            return el != null;
        });

        let tempAssists = {};
        $.each(jogadores, function(i, v) {
            tempAssists[i] = {
                jogador: v.apelido,
                assistencias: salvarQtdUnit(v.apelido, dados.assistencias),
                jogos: salvarQtdJogos(v.id_usuario),
            }
        });

        let classAssists = [];
        let assistencias = dados.assistencias.length;
        if (assistencias > 0) {
            $.each(tempAssists, function(i, v) {
                let percent = ((this.assistencias * 100) / assistencias).toFixed(0);
                let calculoMedia = this.assistencias / this.jogos
                let media = (calculoMedia) ? calculoMedia.toFixed(2) : 0;
                classAssists[i] = {
                    jogador: this.jogador,
                    qtd: this.assistencias,
                    jogos: this.jogos,
                    percent: percent,
                    media: media,
                }
            });
            classAssists.sort(function(a, b) {
                if (a.qtd < b.qtd) return 1;
                if (a.qtd > b.qtd) return -1;
                return 0;
            });
        }

        inserirClassificacaoNaTela(classAssists, table);
        return;
    }

    if (table == 'faltas') {
        let jogadores = [];
        $.each(dados.jogadores, function(i, v) {
            jogadores[this.id_usuario] = {
                apelido: this.apelido,
                id_usuario: this.id_usuario,
            };
        });
        jogadores = jogadores.filter(function(el) {
            return el != null;
        });

        let tempFouls = {};
        $.each(jogadores, function(i, v) {
            tempFouls[i] = {
                jogador: v.apelido,
                faltas: salvarQtdUnit(v.apelido, dados.faltas),
                jogos: salvarQtdJogos(v.id_usuario),
            }
        });

        let classFouls = [];
        let faltas = dados.qtdFaltas;
        if (faltas > 0) {
            $.each(tempFouls, function(i, v) {
                let percent = ((this.faltas * 100) / faltas).toFixed(0);
                let calculoMedia = this.faltas / this.jogos
                let media = (calculoMedia) ? calculoMedia.toFixed(2) : 0;
                classFouls[i] = {
                    jogador: this.jogador,
                    qtd: this.faltas,
                    jogos: this.jogos,
                    percent: percent,
                    media: media,
                }
            });
            classFouls.sort(function(a, b) {
                if (a.qtd < b.qtd) return 1;
                if (a.qtd > b.qtd) return -1;
                return 0;
            });
        }

        inserirClassificacaoNaTela(classFouls, table);
        return;
    }

    if (table == 'cartoesAmarelos') {
        let jogadores = [];
        $.each(dados.jogadores, function(i, v) {
            jogadores[this.id_usuario] = {
                apelido: this.apelido,
                id_usuario: this.id_usuario,
            };
        });
        jogadores = jogadores.filter(function(el) {
            return el != null;
        });

        let tempCA = {};
        $.each(jogadores, function(i, v) {
            tempCA[i] = {
                jogador: v.apelido,
                cartoesAmarelos: salvarQtdUnit(v.apelido, dados.cartoesAmarelos),
                jogos: salvarQtdJogos(v.id_usuario),
            }
        });

        let classCA = [];
        let cartoesAmarelos = dados.qtdCartoesAmarelos;
        if (cartoesAmarelos > 0) {
            $.each(tempCA, function(i, v) {
                let percent = ((this.cartoesAmarelos * 100) / cartoesAmarelos).toFixed(0);
                let calculoMedia = this.cartoesAmarelos / this.jogos
                let media = (calculoMedia) ? calculoMedia.toFixed(2) : 0;
                classCA[i] = {
                    jogador: this.jogador,
                    qtd: this.cartoesAmarelos,
                    jogos: this.jogos,
                    percent: percent,
                    media: media,
                }
            });
            classCA.sort(function(a, b) {
                if (a.qtd < b.qtd) return 1;
                if (a.qtd > b.qtd) return -1;
                return 0;
            });
        }

        inserirClassificacaoNaTela(classCA, table);
        return;
    }

    if (table == 'cartoesVermelhos') {
        let jogadores = [];
        $.each(dados.jogadores, function(i, v) {
            jogadores[this.id_usuario] = {
                apelido: this.apelido,
                id_usuario: this.id_usuario,
            };
        });
        jogadores = jogadores.filter(function(el) {
            return el != null;
        });

        let tempCV = {};
        $.each(jogadores, function(i, v) {
            tempCV[i] = {
                jogador: v.apelido,
                cartoesVermelhos: salvarQtdUnit(v.apelido, dados.cartoesVermelhos),
                jogos: salvarQtdJogos(v.id_usuario),
            }
        });

        let classCV = [];
        let cartoesVermelhos = dados.qtdCartoesVemelhos;
        if (cartoesVermelhos > 0) {
            $.each(tempCV, function(i, v) {
                let percent = ((this.cartoesVermelhos * 100) / cartoesVermelhos).toFixed(0);
                let calculoMedia = this.cartoesVermelhos / this.jogos
                let media = (calculoMedia) ? calculoMedia.toFixed(2) : 0;
                classCV[i] = {
                    jogador: this.jogador,
                    qtd: this.cartoesVermelhos,
                    jogos: this.jogos,
                    percent: percent,
                    media: media,
                }
            });
            classCV.sort(function(a, b) {
                if (a.qtd < b.qtd) return 1;
                if (a.qtd > b.qtd) return -1;
                return 0;
            });
        }

        inserirClassificacaoNaTela(classCV, table);
        return;
    }
}

function salvarQtdUnit(nome, data) {
    let count = 0;
    $.each(data, function(i, v) {
        if (this.jogador == nome) {
            count++;
        }
    })
    return count;
}

function salvarQtdJogos(id) {
    let count = 0;
    $.each(dados.partidas, function(i, v) {
        if (this.quem_jogou.indexOf(id) != -1) {
            count++;
        }
    });
    return count;
}

function inserirClassificacaoNaTela(data, table) {
    let html = '';
    $('tbody[' + table + ']').html(function() {
        if (Object.keys(data).length > 0) {
            $.each(data, function(i, v) {
                let pos = i + 1;

                html += '<tr>' +
                    '<th scope="row">' + pos + 'º</th>' +
                    '<td>' + this.jogador + '</td>' +
                    '<td>' + this.qtd + '</td>' +
                    '<td>' + this.percent + '%</td>' +
                    '<td>' + this.media + '</td>' +
                    '<td>' + this.jogos + '</td>' +
                    '</tr>';
            });
        } else {
            html += '<th colspan="6">Sem dados no período</th>';
        }

        return html;
    });

    $('td, th[scope=row]').css('color', '#888');
}

function carregarGraficos() {
    let doughnutData = {
        labels: ["Vitórias", "Derrotas", "Empates"],
        datasets: [{
            data: [dados.qtdVitorias, dados.qtdDerrotas, dados.qtdEmpates],
            backgroundColor: ["#dc3545", "#fbb1b8", "#dedede"]
        }]
    };
    let doughnutOptions = {
        responsive: true
    };
    let vde = document.getElementById("vdeChart").getContext("2d");
    window.vdeChart = new Chart(vde, { type: 'doughnut', data: doughnutData, options: doughnutOptions });

    // ================================================================================================ //

    let randomScalingFactor = function() {
        return (Math.random() > 0.5 ? 1.0 : 1.0) * Math.round(Math.random() * 10);
    };

    let line1 = [];
    let line2 = [];

    // let Xaxis = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];

    let Xaxis = [];
    let hora = [];
    let partida = [];
    $.each(dados.partidas, function(i, v) {
        let arrayDtHora = this.dt_hora.split(' ');
        let partida = 'NQV ' + this.gols_pro + ' x ' + this.gols_contra + ' ' + this.abreviacao;
        Xaxis.push(arrayDtHora[0]);
        line1.push(randomScalingFactor());
    });
    let config = {
        type: 'line',
        data: {
            labels: Xaxis,
            datasets: [{
                label: "1º quadro",
                backgroundColor: 'rgb(200, 53, 69)',
                borderColor: 'rgb(200, 53, 69)',
                data: line1,
                fill: false,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            title: {
                display: false,
                text: 'Chart.js Line Chart'
            },
            tooltips: {
                mode: 'index',
                intersect: false,
            },
            scales: {
                xAxes: [{
                    display: true,
                    scaleLabel: {
                        display: false,
                        labelString: 'Month'
                    }
                }],
                yAxes: [{
                    display: true,
                    scaleLabel: {
                        display: true,
                    },
                }]
            }
        }
    };
    // let ctx = document.getElementById("partidasChart").getContext("2d");
    // window.partidasChart = new Chart(ctx, config);

    // ================================================================================================ //

    var configPie = {
        type: 'pie',
        data: {
            datasets: [{
                data: [
                    dados.qtdGolsPorTempo[1],
                    dados.qtdGolsPorTempo[2],
                ],
                backgroundColor: [
                    'rgb(200, 53, 69)',
                    'rgb(220, 220, 220)',
                ],
            }],
            labels: [
                '1º tempo',
                '2º tempo',
            ]
        },
        options: {
            responsive: true
        }
    };

    var ctx3 = document.getElementById('golsChart').getContext('2d');
    window.myPie = new Chart(ctx3, configPie);

    // ================================================================================================ //

    var barData = {
        labels: ["Gols Marcados", "Gols Sofridos", "Faltas", "C. Amarelos", "C. Vermelhos"],
        datasets: [{
            backgroundColor: 'rgba(220,53,69,0.5)',
            borderColor: "rgba(220,53,69,0.7)",
            pointBackgroundColor: "rgba(220,53,69,1)",
            pointBorderColor: "#fff",
            data: [dados.qtdGols, dados.qtdGolsSofridos, dados.qtdFaltas, dados.qtdCartoesAmarelos, dados.qtdCartoesVermelhos]
        }]
    };

    var barOptions = {
        legend: {
            display: false,
        },
        responsive: true,
        scales: {
            yAxes: [{
                display: true,
                ticks: {
                    beginAtZero: true,
                }
            }]
        }
    };

    var ctx2 = document.getElementById("estatisticasGeraisChart").getContext("2d");
    window.barChart = new Chart(ctx2, { type: 'bar', data: barData, options: barOptions });
}

function slidePartidas() {
    $('.slidePartidas').html(function() {
        let html = '';
        if (dados.qtdPartidas > 0) {
            $.each(dados.partidas, function(i, v) {
                html += '<div>' +
                    '<div class="ibox-content" data-id="' + this.id_partida + '">' +
                    '<div class="row text-center">' +
                    '<div class="col-12">' +
                    '<h5>' + this.dt_hora + '</h5>' +
                    '</div>' +
                    '</div>' +
                    '<div class="row d-flex justify-content-center align-items-center">' +
                    '<div class="col-4">' +
                    '<img src="' + window.origin + '/assets/img/times/noisquevoa.png" alt="">' +
                    '</div>' +
                    '<div class="col-1">' +
                    this.gols_pro +
                    '</div>' +
                    '<div class="col-1">' +
                    'X' +
                    '</div>' +
                    '<div class="col-1">' +
                    this.gols_contra +
                    '</div>' +
                    '<div class="col-4">' +
                    '<img src="' + window.origin + this.logo_adversario + '" alt="">' +
                    '</div>' +
                    '</div>' +
                    '</div>' +
                    '</div>';
            });
        } else {
            html += '<h3>Sem dados no período</h3>'
        }
        return html;
    });

    let qtd = (dados.qtdPartidas >= 3) ? 3 : dados.qtdPartidas;
    let qtd2 = (dados.qtdPartidas >= 2) ? 2 : 1;
    let infinite = (dados.qtdPartidas >= 3) ? true : false;

    window.slickPartidas = $('.slidePartidas').slick({
        infinite: infinite,
        slidesToShow: qtd,
        slidesToScroll: 1,
        centerMode: true,
        responsive: [{
                breakpoint: 1920,
                settings: {
                    slidesToShow: qtd,
                    slidesToScroll: 3,
                    infinite: true,
                    dots: true
                }
            },
            {
                breakpoint: 1490,
                settings: {
                    slidesToShow: qtd2,
                    slidesToScroll: 1
                }
            },
            {
                breakpoint: 1024,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            }
        ]
    });
}