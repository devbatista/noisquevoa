<link href="<?= $base ?>/assets/plugins/dualListbox/bootstrap-duallistbox.min.css" rel="stylesheet">
<link href="<?= $base ?>/assets/css/admin/cadastrarEstatisticas.css" rel="stylesheet">

<div class="wrapper wrapper-content">
    <div class="row">
        <div class="col-lg-12">
            <div class="row">
                <div class="col-lg-12 col-sm-12">
                    <div class="ibox">
                        <div class="buttons d-none">
                            <div class="pull-left">
                                <button type="button" class="btn btn-danger">Voltar</button>
                            </div>
                        </div>
                        <div class="ibox-content">
                            <div class="row" style="margin-top: 10px">
                                <div class="cadastro">
                                    <h1 class="text-center">Inserir estatísticas</h1>
                                </div>
                                <div id="accordion">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade modal-marcar-wo" tabindex="-1" role="dialog" aria-labelledby="TituloModalCentralizado" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="TituloModalCentralizado">Marcar WO</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="id_partida_wo">
                <div class="form-check form-check-inline radio radio-danger">
                    <input class="form-check-input" type="radio" id="vitoria_wo" value="1" name="wo" checked>
                    <label class="form-check-label" for="vitoria_wo">Vitória</label>
                </div>
                <div class="form-check form-check-inline radio radio-danger">
                    <input class="form-check-input" type="radio" id="derrota_wo" value="0" name="wo">
                    <label class="form-check-label" for="derrota_wo">Derrota</label>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                <button type="button" class="btn btn-danger" salvarWO>Salvar partida</button>
            </div>
        </div>
    </div>
</div>

<script src="<?= $base ?>/assets/plugins/dualListbox/jquery.bootstrap-duallistbox.js"></script>
<script type="text/javascript" src="<?= $base ?>/assets/js/admin/cadastrarEstatisticas.js"></script>