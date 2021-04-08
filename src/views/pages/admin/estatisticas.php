<link href="<?= $base ?>/assets/css/admin/estatisticas.css" rel="stylesheet">
<link href="<?= $base ?>/assets/css/admin/responsive/estatisticas.css" rel="stylesheet">

<div class="wrapper wrapper-content">
    <div class="row">
        <div class="col-lg-12">
            <div class="row">
                <div class="col-lg-12 col-sm-12">
                    <div class="ibox">
                        <div class="pull-right">
                            <div id="reportrange" class="form-control">
                                <i class="fa fa-calendar"></i>
                                <span>28/02/2021 - 29/03/2021</span> <b class="caret"></b>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="visualizacaoEstatisticas">

                <div class="row">
                    <div class="col-lg-3">
                        <div class="ibox jogosNoPeriodo">
                            <div class="ibox-title">
                                <h5>Jogos no período</h5>
                            </div>
                            <div class="ibox-content">
                                <h1 class="no-margins"></h1>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-9">
                        <div class="ibox ">
                            <div class="ibox-title">
                                <h5>Partidas</h5>
                            </div>
                            <div class="slidePartidas">
                                <div>
                                    <div class="ibox-content">
                                        <div class="row text-center">
                                            <div class="col-12">
                                                <h5>Data e hora partida</h5>
                                            </div>
                                        </div>
                                        <div class="row d-flex justify-content-center align-items-center">
                                            <div class="col-4">
                                                <img src="<?= $base ?>/assets/img/times/noisquevoa.png" alt="">
                                            </div>
                                            <div class="col-1">
                                                2
                                            </div>
                                            <div class="col-1">
                                                X
                                            </div>
                                            <div class="col-1">
                                                1
                                            </div>
                                            <div class="col-4">
                                                <img src="<?= $base ?>/assets/img/times/3.png" alt="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <div class="ibox-content">
                                        <h2>Slide 2</h2>
                                        <p>
                                            Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem
                                            Ipsum has been the industry's standard dummy text ever since the 1500s, when an
                                            unknown printer took a galley of type and scrambled it to make a type specimen
                                            book. It has survived not only five centuries, but also the leap.
                                        </p>
                                    </div>
                                </div>
                                <div>
                                    <div class="ibox-content">
                                        <h2>Slide 3</h2>
                                        <p>
                                            Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem
                                            Ipsum has been the industry's standard dummy text ever since the 1500s, when an
                                            unknown printer took a galley of type and scrambled it to make a type specimen
                                            book. It has survived not only five centuries, but also the leap.
                                        </p>
                                    </div>
                                </div>
                                <div>
                                    <div class="ibox-content">
                                        <h2>Slide 4</h2>
                                        <p>
                                            Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem
                                            Ipsum has been the industry's standard dummy text ever since the 1500s, when an
                                            unknown printer took a galley of type and scrambled it to make a type specimen
                                            book. It has survived not only five centuries, but also the leap.
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <!-- <div class="ibox-content" style="position: relative;height: 150px">
                            <canvas id="partidasChart"></canvas>
                        </div> -->
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-8">
                        <div class="row">
                            <div class="col-12">
                                <div class="ibox ">
                                    <div class="ibox-title">
                                        <h5>Estatísticas Gerais</h5>
                                    </div>
                                    <div class="ibox-content" style="padding-left: 0">
                                        <canvas id="estatisticasGeraisChart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="ibox ">
                                    <div class="ibox-title">
                                        <h5>Artilharia</h5>
                                    </div>
                                    <div class="ibox-content">
                                        <div class="table-responsive-md">
                                            <table class="table text-center p-0">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">POS</th>
                                                        <th scope="col">JOGADOR</th>
                                                        <th scope="col">GOLS</th>
                                                        <th scope="col">%</th>
                                                        <th scope="col">MED</th>
                                                        <th scope="col">JGS</th>
                                                    </tr>
                                                </thead>
                                                <tbody gols>

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="ibox ">
                                    <div class="ibox-title">
                                        <h5>Assistências</h5>
                                    </div>
                                    <div class="ibox-content">
                                        <div class="table-responsive">
                                            <table class="table text-center p-0">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">POS</th>
                                                        <th scope="col">JOGADOR</th>
                                                        <th scope="col">ASS</th>
                                                        <th scope="col">%</th>
                                                        <th scope="col">MED</th>
                                                        <th scope="col">JGS</th>
                                                    </tr>
                                                </thead>
                                                <tbody assistencias>

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="ibox ">
                                    <div class="ibox-title">
                                        <h5>Cartões Amarelos</h5>
                                    </div>
                                    <div class="ibox-content">
                                        <div class="table-responsive">
                                            <table class="table text-center p-0">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">POS</th>
                                                        <th scope="col">JOGADOR</th>
                                                        <th scope="col">CA</th>
                                                        <th scope="col">%</th>
                                                        <th scope="col">MED</th>
                                                        <th scope="col">JGS</th>
                                                    </tr>
                                                </thead>
                                                <tbody cartoesAmarelos>

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="ibox ">
                                    <div class="ibox-title">
                                        <h5>Cartões Vermelhos</h5>
                                    </div>
                                    <div class="ibox-content">
                                        <div class="table-responsive">
                                            <table class="table text-center p-0">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">POS</th>
                                                        <th scope="col">JOGADOR</th>
                                                        <th scope="col">CV</th>
                                                        <th scope="col">%</th>
                                                        <th scope="col">MED</th>
                                                        <th scope="col">JGS</th>
                                                    </tr>
                                                </thead>
                                                <tbody cartoesVermelhos>

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 p-0">
                        <div class="col-lg-12">
                            <div class="ibox">
                                <div class="ibox-title">
                                    <h5>V/D/E</h5>
                                </div>
                                <div class="ibox-content">
                                    <canvas id="vdeChart"></canvas>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="ibox">
                                <div class="ibox-title">
                                    <h5>Gols por tempo</h5>
                                </div>
                                <div class="ibox-content">
                                    <canvas id="golsChart"></canvas>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="ibox">
                                <div class="ibox-title">
                                    <h5>Faltas</h5>
                                </div>
                                <div class="ibox-content">
                                    <div class="table-responsive">
                                        <table class="table text-center p-0">
                                            <thead>
                                                <tr>
                                                    <th scope="col">POS</th>
                                                    <th scope="col">JOGADOR</th>
                                                    <th scope="col">FALTAS</th>
                                                    <th scope="col">%</th>
                                                    <th scope="col">MEDIA</th>
                                                    <th scope="col">JGS</th>
                                                </tr>
                                            </thead>
                                            <tbody faltas>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript" src="<?= $base ?>/assets/js/admin/estatisticas.js"></script>