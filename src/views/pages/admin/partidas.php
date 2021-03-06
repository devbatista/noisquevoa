<link href="<?= $base ?>/assets/css/admin/partidas.css" rel="stylesheet">
<link href="<?= $base ?>/assets/css/admin/responsive/partidas.css" rel="stylesheet">

<div class="wrapper wrapper-content">
    <div class="row">
        <div class="col-lg-12">
            <div class="row">
                <div class="col-lg-12 col-sm-12">
                    <div class="ibox">
                        <div class="buttons d-none">
                            <div class="pull-left">
                                <button type="button" class="btn btn-danger disabled">Estatística em aguardo (0)</button>
                            </div>
                            <div class="pull-right">
                                <button type="button" class="btn btn-danger cadastrarPartidas" data-toggle="modal" data-target=".modal-cadastro-partida">Cadastrar partidas</button>
                            </div>
                        </div>
                        <div class="ibox-content">
                            <div class="form-group">
                                <label for="">Mostrar</label><br>
                                <div class="form-check form-check-inline radio radio-danger">
                                    <input class="form-check-input" type="radio" id="proximas" value="0" name="mostrar" checked>
                                    <label class="form-check-label" for="proximas">Próximas</label>
                                </div>
                                <div class="form-check form-check-inline radio radio-danger">
                                    <input class="form-check-input" type="radio" id="anteriories" value="1" name="mostrar">
                                    <label class="form-check-label" for="anteriories">Anteriores</label>
                                </div>
                                <div class="form-check form-check-inline radio radio-danger">
                                    <input class="form-check-input" type="radio" id="cancelados" value="2" name="mostrar">
                                    <label class="form-check-label" for="cancelados">Cancelados</label>
                                </div>
                                <div class="pull-right">
                                    <button class="btn btn-danger" refresh>Recarregar <i class="fa fa-refresh"></i></button>
                                </div>
                            </div>
                            <div class="row" style="margin-top: 10px">
                                <div class="table-responsive">
                                    <table partidas class="table table-hover">
                                        <thead class="thead-danger">
                                            <tr>
                                                <th>Data/hora</th>
                                                <th></th>
                                                <th>Mandante</th>
                                                <th>#</th>
                                                <th>X</th>
                                                <th>#</th>
                                                <th>Visitante</th>
                                                <th></th>
                                                <th>Local</th>
                                                <th>Liga</th>
                                            </tr>
                                        </thead>
                                        <tbody partidas>
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

<div class="modal fade modal-cadastro-partida" tabindex="-1" role="dialog" aria-labelledby="TituloModalCentralizado" aria-hidden="true">
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
                    <form cadastrarPartidas action="" data-toggle="validator" method="POST">
                        <div class="form-group">
                            <label for="adversario">Adversario: </label>
                            <input type="text" class="form-control" list="adversario" placeholder="Digite o adversario" name="adversario" required>
                            <datalist id="adversario">
                            </datalist>
                        </div>

                        <div class="form-group">
                            <label for="abreviacao">Abreviação: </label>
                            <input type="text" class="form-control" id="abreviacao" placeholder="ADV" name="abreviacao" required maxlength="3">
                        </div>

                        <div class="form-group">
                            <label for="logo">Logo do adversário: </label>
                            <input type="file" class="form-control-file" id="logo" name="logo">
                        </div>

                        <div class="form-group">
                            <label for="local">Local: </label>
                            <div class="input-group">
                                <select class="form-control" id="local" name="local" required>
                                </select>
                                <div class="input-group-prepend cadastro-locais">
                                    <div class="input-group-text"><i class="fa fa-plus"></i></div>
                                </div>
                            </div>
                        </div>

                        <div class="inserir-local d-none">
                            <div class="form-row">
                                <div class="form-group col-7">
                                    <input type="text" class="form-control" id="nomeLocal" placeholder="Nome do Local" name="nomeLocal">
                                </div>
                                <div class="form-group col-5">
                                    <input type="text" class="form-control cepLocal" id="cepLocal" placeholder="CEP" name="cepLocal">
                                </div>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" id="enderecoLocal" placeholder="Endereço" name="enderecoLocal">
                            </div>
                            <div class="form-row">
                                <div class="form-group col-3">
                                    <input type="text" class="form-control" id="numeroLocal" placeholder="Nº" name="numeroLocal">
                                </div>
                                <div class="form-group col-3">
                                    <input type="text" class="form-control" id="complementoLocal" placeholder="Comp" name="complementoLocal">
                                </div>
                                <div class="form-group col-6">
                                    <input type="text" class="form-control" id="bairroLocal" placeholder="Bairro" name="bairroLocal">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-8">
                                    <input type="text" class="form-control" id="cidadeLocal" placeholder="Cidade" name="cidadeLocal">
                                </div>
                                <div class="form-group col-2">
                                    <input type="text" class="form-control" id="estadoLocal" placeholder="UF" name="estadoLocal">
                                </div>
                                <div class="form-group col-2">
                                    <a class="btn btn-secondary formInserir">Inserir</a>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="liga">Liga: </label>
                            <select class="form-control" id="liga" name="liga" required>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="">Tipo: </label><br>
                            <div class="form-check form-check-inline radio radio-danger">
                                <input class="form-check-input" type="radio" id="mandante" value="1" name="tipo_mv" checked>
                                <label class="form-check-label" for="mandante">Mandante</label>
                            </div>
                            <div class="form-check form-check-inline radio radio-danger">
                                <input class="form-check-input" type="radio" id="visitante" value="2" name="tipo_mv">
                                <label class="form-check-label" for="visitante">Visitante</label>
                            </div>
                            <div class="form-check form-check-inline radio radio-danger">
                                <input class="form-check-input" type="radio" id="neutro" value="3" name="tipo_mv">
                                <label class="form-check-label" for="neutro">Neutro</label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="">Quadros</label><br>
                            <div class="form-check form-check-inline radio radio-danger">
                                <input class="form-check-input" type="radio" id="1quadro" value="1" name="quadros">
                                <label class="form-check-label" for="1quadro">1 Quadro</label>
                            </div>
                            <div class="form-check form-check-inline radio radio-danger">
                                <input class="form-check-input" type="radio" id="2quadros" value="2" name="quadros" checked>
                                <label class="form-check-label" for="2quadros">2 Quadros</label>
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

<div class="modal fade modal-editar-partida" tabindex="-1" role="dialog" aria-labelledby="TituloModalCentralizado" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="TituloModalCentralizado">Editar</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="cadastro">
                    <h1 class="text-center">Editar Partida</h1>
                    <form editarPartida action="" data-toggle="validator" method="POST">
                        <input type="hidden" name="id_partida">
                        <div class="form-group">
                            <label for="adversario">Adversario: </label>
                            <input type="text" class="form-control" id="editar_adversario" placeholder="Digite o adversario" name="editar_adversario" required>
                        </div>

                        <div class="form-group">
                            <label for="abreviacao">Abreviação: </label>
                            <input type="text" class="form-control" id="editar_abreviacao" placeholder="ADV" name="editar_abreviacao" required maxlength="3">
                        </div>

                        <div class="form-group">
                            <label for="local">Local: </label>
                            <div class="input-group">
                                <select class="form-control" id="editar_local" name="local" required>
                                </select>
                                <div class="input-group-prepend cadastro-locais">
                                    <div class="input-group-text"><i class="fa fa-plus"></i></div>
                                </div>
                            </div>
                        </div>

                        <div class="inserir-local d-none">
                            <div class="form-row">
                                <div class="form-group col-7">
                                    <input type="text" class="form-control" placeholder="Nome do Local" name="add_nomeLocal">
                                </div>
                                <div class="form-group col-5">
                                    <input type="text" class="form-control addCepLocal" placeholder="CEP" name="add_cepLocal">
                                </div>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Endereço" name="add_enderecoLocal">
                            </div>
                            <div class="form-row">
                                <div class="form-group col-3">
                                    <input type="text" class="form-control" placeholder="Nº" name="add_numeroLocal">
                                </div>
                                <div class="form-group col-3">
                                    <input type="text" class="form-control" placeholder="Comp" name="add_complementoLocal">
                                </div>
                                <div class="form-group col-6">
                                    <input type="text" class="form-control" placeholder="Bairro" name="add_bairroLocal">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-8">
                                    <input type="text" class="form-control" placeholder="Cidade" name="add_cidadeLocal">
                                </div>
                                <div class="form-group col-2">
                                    <input type="text" class="form-control" placeholder="UF" name="add_estadoLocal">
                                </div>
                                <div class="form-group col-2">
                                    <a class="btn btn-secondary formEditar">Inserir</a>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="liga">Liga: </label>
                            <select class="form-control" id="editar_liga" name="editar_liga" required>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="data_hora_partida">Data/Hora da partida: </label>
                            <input type="datetime-local" class="form-control" id="dataHoraPartida" name="dataHoraPartida" required>
                        </div>

                    </form>
                </div>
            </div>
            <div class="modal-footer d-block">
                <button type="button" class="btn btn-dark">Cancelar Partida</button>
                <button type="button" class="btn btn-danger pull-right">Editar</button>
                <button type="button" class="btn btn-secondary pull-right" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade modal-estatisticas-unica" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title">Estatísticas do jogo</h2>
                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center">
                <div class="row justify-content-center" data-horario>
                    <div class="col-12">
                        Sabado, 31/12/2020 - 17h45
                    </div>
                </div>
                <div class="row justify-content-center" style="font-size: 30px; margin-top: 20px" placar-partida>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript" src="<?= $base ?>/assets/js/admin/partidas.js"></script>