<link href="<?= $base ?>/assets/css/admin/estatisticas.css" rel="stylesheet">

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
                        <div class="ibox-content" style="position: relative;height: 150px">
                            <canvas id="partidasChart"></canvas>
                        </div>
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
                                <div class="ibox-content">
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
                                    <div>
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
                                                <tr>
                                                    <th scope="row" style="color: rgb(136, 136, 136);">1º</th>
                                                    <td style="color: rgb(136, 136, 136);">Batista</td>
                                                    <td style="color: rgb(136, 136, 136);">5</td>
                                                    <td style="color: rgb(136, 136, 136);">57%</td>
                                                    <td style="color: rgb(136, 136, 136);">2,5</td>
                                                    <td style="color: rgb(136, 136, 136);">8</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row" style="color: rgb(136, 136, 136);">2º</th>
                                                    <td style="color: rgb(136, 136, 136);">Douglao</td>
                                                    <td style="color: rgb(136, 136, 136);">3</td>
                                                    <td style="color: rgb(136, 136, 136);">57%</td>
                                                    <td style="color: rgb(136, 136, 136);">2,5</td>
                                                    <td style="color: rgb(136, 136, 136);">8</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row" style="color: rgb(136, 136, 136);">3º</th>
                                                    <td style="color: rgb(136, 136, 136);">Vitao</td>
                                                    <td style="color: rgb(136, 136, 136);">3</td>
                                                    <td style="color: rgb(136, 136, 136);">57%</td>
                                                    <td style="color: rgb(136, 136, 136);">2,5</td>
                                                    <td style="color: rgb(136, 136, 136);">8</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row" style="color: rgb(136, 136, 136);">4º</th>
                                                    <td style="color: rgb(136, 136, 136);">0 Brabo</td>
                                                    <td style="color: rgb(136, 136, 136);">1</td>
                                                    <td style="color: rgb(136, 136, 136);">57%</td>
                                                    <td style="color: rgb(136, 136, 136);">2,5</td>
                                                    <td style="color: rgb(136, 136, 136);">8</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row" style="color: rgb(136, 136, 136);">5º</th>
                                                    <td style="color: rgb(136, 136, 136);">Andy</td>
                                                    <td style="color: rgb(136, 136, 136);">1</td>
                                                    <td style="color: rgb(136, 136, 136);">57%</td>
                                                    <td style="color: rgb(136, 136, 136);">2,5</td>
                                                    <td style="color: rgb(136, 136, 136);">8</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row" style="color: rgb(136, 136, 136);">6º</th>
                                                    <td style="color: rgb(136, 136, 136);">Fe</td>
                                                    <td style="color: rgb(136, 136, 136);">0</td>
                                                    <td style="color: rgb(136, 136, 136);">57%</td>
                                                    <td style="color: rgb(136, 136, 136);">2,5</td>
                                                    <td style="color: rgb(136, 136, 136);">0</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row" style="color: rgb(136, 136, 136);">7º</th>
                                                    <td style="color: rgb(136, 136, 136);">Savarino</td>
                                                    <td style="color: rgb(136, 136, 136);">0</td>
                                                    <td style="color: rgb(136, 136, 136);">57%</td>
                                                    <td style="color: rgb(136, 136, 136);">2,5</td>
                                                    <td style="color: rgb(136, 136, 136);">0</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row" style="color: rgb(136, 136, 136);">8º</th>
                                                    <td style="color: rgb(136, 136, 136);">Catito</td>
                                                    <td style="color: rgb(136, 136, 136);">0</td>
                                                    <td style="color: rgb(136, 136, 136);">57%</td>
                                                    <td style="color: rgb(136, 136, 136);">2,5</td>
                                                    <td style="color: rgb(136, 136, 136);">8</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row" style="color: rgb(136, 136, 136);">9º</th>
                                                    <td style="color: rgb(136, 136, 136);">Catito</td>
                                                    <td style="color: rgb(136, 136, 136);">0</td>
                                                    <td style="color: rgb(136, 136, 136);">57%</td>
                                                    <td style="color: rgb(136, 136, 136);">2,5</td>
                                                    <td style="color: rgb(136, 136, 136);">8</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row" style="color: rgb(136, 136, 136);">10º</th>
                                                    <td style="color: rgb(136, 136, 136);">Catito</td>
                                                    <td style="color: rgb(136, 136, 136);">0</td>
                                                    <td style="color: rgb(136, 136, 136);">57%</td>
                                                    <td style="color: rgb(136, 136, 136);">2,5</td>
                                                    <td style="color: rgb(136, 136, 136);">8</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row" style="color: rgb(136, 136, 136);">11º</th>
                                                    <td style="color: rgb(136, 136, 136);">Catito</td>
                                                    <td style="color: rgb(136, 136, 136);">0</td>
                                                    <td style="color: rgb(136, 136, 136);">57%</td>
                                                    <td style="color: rgb(136, 136, 136);">2,5</td>
                                                    <td style="color: rgb(136, 136, 136);">8</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row" style="color: rgb(136, 136, 136);">12º</th>
                                                    <td style="color: rgb(136, 136, 136);">Catito</td>
                                                    <td style="color: rgb(136, 136, 136);">0</td>
                                                    <td style="color: rgb(136, 136, 136);">57%</td>
                                                    <td style="color: rgb(136, 136, 136);">2,5</td>
                                                    <td style="color: rgb(136, 136, 136);">8</td>
                                                </tr>
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
                                    <div>
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
                                            <tbody classificacaoAssistencias>
                                                <tr>
                                                    <th scope="row" style="color: rgb(136, 136, 136);">1º</th>
                                                    <td style="color: rgb(136, 136, 136);">Batista</td>
                                                    <td style="color: rgb(136, 136, 136);">5</td>
                                                    <td style="color: rgb(136, 136, 136);">57%</td>
                                                    <td style="color: rgb(136, 136, 136);">2,5</td>
                                                    <td style="color: rgb(136, 136, 136);">8</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row" style="color: rgb(136, 136, 136);">2º</th>
                                                    <td style="color: rgb(136, 136, 136);">Douglao</td>
                                                    <td style="color: rgb(136, 136, 136);">3</td>
                                                    <td style="color: rgb(136, 136, 136);">57%</td>
                                                    <td style="color: rgb(136, 136, 136);">2,5</td>
                                                    <td style="color: rgb(136, 136, 136);">8</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row" style="color: rgb(136, 136, 136);">3º</th>
                                                    <td style="color: rgb(136, 136, 136);">Vitao</td>
                                                    <td style="color: rgb(136, 136, 136);">3</td>
                                                    <td style="color: rgb(136, 136, 136);">57%</td>
                                                    <td style="color: rgb(136, 136, 136);">2,5</td>
                                                    <td style="color: rgb(136, 136, 136);">8</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row" style="color: rgb(136, 136, 136);">4º</th>
                                                    <td style="color: rgb(136, 136, 136);">0 Brabo</td>
                                                    <td style="color: rgb(136, 136, 136);">1</td>
                                                    <td style="color: rgb(136, 136, 136);">57%</td>
                                                    <td style="color: rgb(136, 136, 136);">2,5</td>
                                                    <td style="color: rgb(136, 136, 136);">8</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row" style="color: rgb(136, 136, 136);">5º</th>
                                                    <td style="color: rgb(136, 136, 136);">Andy</td>
                                                    <td style="color: rgb(136, 136, 136);">1</td>
                                                    <td style="color: rgb(136, 136, 136);">57%</td>
                                                    <td style="color: rgb(136, 136, 136);">2,5</td>
                                                    <td style="color: rgb(136, 136, 136);">8</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row" style="color: rgb(136, 136, 136);">6º</th>
                                                    <td style="color: rgb(136, 136, 136);">Fe</td>
                                                    <td style="color: rgb(136, 136, 136);">0</td>
                                                    <td style="color: rgb(136, 136, 136);">57%</td>
                                                    <td style="color: rgb(136, 136, 136);">2,5</td>
                                                    <td style="color: rgb(136, 136, 136);">0</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row" style="color: rgb(136, 136, 136);">7º</th>
                                                    <td style="color: rgb(136, 136, 136);">Savarino</td>
                                                    <td style="color: rgb(136, 136, 136);">0</td>
                                                    <td style="color: rgb(136, 136, 136);">57%</td>
                                                    <td style="color: rgb(136, 136, 136);">2,5</td>
                                                    <td style="color: rgb(136, 136, 136);">0</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row" style="color: rgb(136, 136, 136);">8º</th>
                                                    <td style="color: rgb(136, 136, 136);">Catito</td>
                                                    <td style="color: rgb(136, 136, 136);">0</td>
                                                    <td style="color: rgb(136, 136, 136);">57%</td>
                                                    <td style="color: rgb(136, 136, 136);">2,5</td>
                                                    <td style="color: rgb(136, 136, 136);">8</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row" style="color: rgb(136, 136, 136);">9º</th>
                                                    <td style="color: rgb(136, 136, 136);">Catito</td>
                                                    <td style="color: rgb(136, 136, 136);">0</td>
                                                    <td style="color: rgb(136, 136, 136);">57%</td>
                                                    <td style="color: rgb(136, 136, 136);">2,5</td>
                                                    <td style="color: rgb(136, 136, 136);">8</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row" style="color: rgb(136, 136, 136);">10º</th>
                                                    <td style="color: rgb(136, 136, 136);">Catito</td>
                                                    <td style="color: rgb(136, 136, 136);">0</td>
                                                    <td style="color: rgb(136, 136, 136);">57%</td>
                                                    <td style="color: rgb(136, 136, 136);">2,5</td>
                                                    <td style="color: rgb(136, 136, 136);">8</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row" style="color: rgb(136, 136, 136);">11º</th>
                                                    <td style="color: rgb(136, 136, 136);">Catito</td>
                                                    <td style="color: rgb(136, 136, 136);">0</td>
                                                    <td style="color: rgb(136, 136, 136);">57%</td>
                                                    <td style="color: rgb(136, 136, 136);">2,5</td>
                                                    <td style="color: rgb(136, 136, 136);">8</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row" style="color: rgb(136, 136, 136);">12º</th>
                                                    <td style="color: rgb(136, 136, 136);">Catito</td>
                                                    <td style="color: rgb(136, 136, 136);">0</td>
                                                    <td style="color: rgb(136, 136, 136);">57%</td>
                                                    <td style="color: rgb(136, 136, 136);">2,5</td>
                                                    <td style="color: rgb(136, 136, 136);">8</td>
                                                </tr>
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
                                <div>
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
                                        <tbody classificacaoArtilharia>
                                            <tr>
                                                <th scope="row" style="color: rgb(136, 136, 136);">1º</th>
                                                <td style="color: rgb(136, 136, 136);">Batista</td>
                                                <td style="color: rgb(136, 136, 136);">5</td>
                                                <td style="color: rgb(136, 136, 136);">57%</td>
                                                <td style="color: rgb(136, 136, 136);">2,5</td>
                                                <td style="color: rgb(136, 136, 136);">8</td>
                                            </tr>
                                            <tr>
                                                <th scope="row" style="color: rgb(136, 136, 136);">2º</th>
                                                <td style="color: rgb(136, 136, 136);">Douglao</td>
                                                <td style="color: rgb(136, 136, 136);">3</td>
                                                <td style="color: rgb(136, 136, 136);">57%</td>
                                                <td style="color: rgb(136, 136, 136);">2,5</td>
                                                <td style="color: rgb(136, 136, 136);">8</td>
                                            </tr>
                                            <tr>
                                                <th scope="row" style="color: rgb(136, 136, 136);">3º</th>
                                                <td style="color: rgb(136, 136, 136);">Vitao</td>
                                                <td style="color: rgb(136, 136, 136);">3</td>
                                                <td style="color: rgb(136, 136, 136);">57%</td>
                                                <td style="color: rgb(136, 136, 136);">2,5</td>
                                                <td style="color: rgb(136, 136, 136);">8</td>
                                            </tr>
                                            <tr>
                                                <th scope="row" style="color: rgb(136, 136, 136);">4º</th>
                                                <td style="color: rgb(136, 136, 136);">0 Brabo</td>
                                                <td style="color: rgb(136, 136, 136);">1</td>
                                                <td style="color: rgb(136, 136, 136);">57%</td>
                                                <td style="color: rgb(136, 136, 136);">2,5</td>
                                                <td style="color: rgb(136, 136, 136);">8</td>
                                            </tr>
                                            <tr>
                                                <th scope="row" style="color: rgb(136, 136, 136);">5º</th>
                                                <td style="color: rgb(136, 136, 136);">Andy</td>
                                                <td style="color: rgb(136, 136, 136);">1</td>
                                                <td style="color: rgb(136, 136, 136);">57%</td>
                                                <td style="color: rgb(136, 136, 136);">2,5</td>
                                                <td style="color: rgb(136, 136, 136);">8</td>
                                            </tr>
                                            <tr>
                                                <th scope="row" style="color: rgb(136, 136, 136);">6º</th>
                                                <td style="color: rgb(136, 136, 136);">Fe</td>
                                                <td style="color: rgb(136, 136, 136);">0</td>
                                                <td style="color: rgb(136, 136, 136);">57%</td>
                                                <td style="color: rgb(136, 136, 136);">2,5</td>
                                                <td style="color: rgb(136, 136, 136);">0</td>
                                            </tr>
                                            <tr>
                                                <th scope="row" style="color: rgb(136, 136, 136);">7º</th>
                                                <td style="color: rgb(136, 136, 136);">Savarino</td>
                                                <td style="color: rgb(136, 136, 136);">0</td>
                                                <td style="color: rgb(136, 136, 136);">57%</td>
                                                <td style="color: rgb(136, 136, 136);">2,5</td>
                                                <td style="color: rgb(136, 136, 136);">0</td>
                                            </tr>
                                            <tr>
                                                <th scope="row" style="color: rgb(136, 136, 136);">8º</th>
                                                <td style="color: rgb(136, 136, 136);">Catito</td>
                                                <td style="color: rgb(136, 136, 136);">0</td>
                                                <td style="color: rgb(136, 136, 136);">57%</td>
                                                <td style="color: rgb(136, 136, 136);">2,5</td>
                                                <td style="color: rgb(136, 136, 136);">8</td>
                                            </tr>
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

<script type="text/javascript" src="<?= $base ?>/assets/js/admin/estatisticas.js"></script>