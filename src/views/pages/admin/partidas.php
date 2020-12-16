<link href="<?= $base ?>/assets/css/admin/partidas.css" rel="stylesheet">

<div class="wrapper wrapper-content">
    <div class="row">
        <div class="col-lg-12">
            <div class="row">
                <div class="col-lg-12 col-sm-12">
                    <div class="ibox ">
                        <div class="buttons">
                            <div class="float-left">
                                <button type="button" class="btn btn-danger disabled">Estatística em aguardo (0)</button>
                            </div>
                            <div class="float-right">
                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target=".modal-cadastro-elenco">Cadastrar partidas</button>
                            </div>
                        </div>
                        <div class="ibox-content">
                            <div class="row" style="margin-top: 10px">
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead class="thead-danger">
                                            <tr>
                                                <th scope="col">Data/hora</th>
                                                <th scope="col"></th>
                                                <th scope="col">Mandante</th>
                                                <th scope="col">#</th>
                                                <th scope="col">X</th>
                                                <th scope="col">#</th>
                                                <th scope="col">Visitante</th>
                                                <th scope="col"></th>
                                                <th scope="col">Local</th>
                                                <th scope="col">Liga</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>13/09/2020 - 10h00</td>
                                                <td><img src="<?= $base ?>/assets/img/noisquevoa.png" alt=""></td>
                                                <td><b>Nois Que Voa</b></td>
                                                <td></td>
                                                <td>X</td>
                                                <td></td>
                                                <td>Visitante</td>
                                                <td><img src="<?= $base ?>/assets/img/escudo.jpg" alt=""></td>
                                                <td>CDC Vila Friburgo</td>
                                                <td>Futliga</td>
                                            </tr>
                                            <tr>
                                                <td>13/09/2020 - 10h00</td>
                                                <td><img src="<?= $base ?>/assets/img/noisquevoa.png" alt=""></td>
                                                <td><b>Nois Que Voa</b></td>
                                                <td></td>
                                                <td>X</td>
                                                <td></td>
                                                <td>Visitante</td>
                                                <td><img src="<?= $base ?>/assets/img/escudo.jpg" alt=""></td>
                                                <td>CDC Vila Friburgo</td>
                                                <td>Futliga</td>
                                            </tr>
                                            <tr>
                                                <td>13/09/2020 - 10h00</td>
                                                <td><img src="<?= $base ?>/assets/img/noisquevoa.png" alt=""></td>
                                                <td><b>Nois Que Voa</b></td>
                                                <td></td>
                                                <td>X</td>
                                                <td></td>
                                                <td>Visitante</td>
                                                <td><img src="<?= $base ?>/assets/img/escudo.jpg" alt=""></td>
                                                <td>CDC Vila Friburgo</td>
                                                <td>Futliga</td>
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

<div class="modal fade modal-cadastro-elenco" tabindex="-1" role="dialog" aria-labelledby="TituloModalCentralizado" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="TituloModalCentralizado">Cadastro</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="cadastro">
                    <h1 class="text-center">Inserir Partida</h1>
                    <form cadastrar action="" data-toggle="validator" method="POST">
                        <div class="form-group">
                            <label for="adversario">Adversario: </label>
                            <input type="text" class="form-control" id="adversario" placeholder="Digite o adversario" name="adversario" required>
                        </div>

                        <div class="form-group">
                            <label for="local">Local: </label>
                            <input type="text" class="form-control" id="local" placeholder="Local da partida" name="local" required>
                        </div>

                        <div class="form-group">
                            <label for="liga">Liga: </label>
                            <input type="text" class="form-control" id="liga" placeholder="Liga/Campeonato" name="liga" required>
                        </div>

                        <div class="form-group">
                            <label for="">Tipo: </label><br>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" id="mandante" value="1" name="tipo_mv">
                                <label class="form-check-label" for="mandante">Mandante</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" id="visitante" value="2" name="tipo_mv">
                                <label class="form-check-label" for="visitante">Visitante</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" id="neutro" value="3" name="tipo_mv">
                                <label class="form-check-label" for="neutro">Neutro</label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="data_hora_partida">Data/Hora da partida: </label>
                            <input type="datetime-local" class="form-control" id="data_hora_partida" name="data_hora_partida" required>
                        </div>

                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                <button type="button" class="btn btn-danger">Cadastrar</button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript" src="<?= $base ?>/assets/js/admin/partidas.js"></script>