<link href="<?= $base ?>/assets/css/admin/ligas.css" rel="stylesheet">

<div class="wrapper wrapper-content">
    <div class="row">
        <div class="col-lg-12">
            <div class="row">
                <div class="col-lg-12 col-sm-12">
                    <div class="ibox">
                        <div class="buttons d-none">
                            <div class="pull-right">
                                <button type="button" class="btn btn-danger cadastrarLigas" data-toggle="modal" data-target=".modal-cadastro-ligas">Cadastrar ligas</button>
                            </div>
                        </div>
                        <div class="mostrarLigas">
                            <div class="ibox">
                                <div class="ibox-content">
                                    <div class="row" style="margin-top: 10px">
                                        <div class="col-5 text-center imgLiga"><img src="<?= $base ?>/assets/img/ligas/1.png" alt="Elenco" class="imgLiga"></div>
                                        <div class="col-7 dadosLiga text-muted">
                                            <div class="row titulo"><b>Futliga</b></div>
                                            <div class="row site">https://www.futliga.com.br</div>
                                            <div class="row icons">
                                                <button class="btn btn-secondary">
                                                    <i class="fa fa-cog"></i>
                                                </button>
                                                <button class="btn btn-danger">
                                                    <i class="fa fa-trash"></i>
                                                </button>
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
    </div>
</div>

<div class="modal fade modal-cadastro-ligas" tabindex="-1" role="dialog" aria-labelledby="TituloModalCentralizado" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <form cadastrarLiga action="" data-toggle="validator" method="POST" enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="modal-title" id="TituloModalCentralizado">Cadastro</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="cadastro">
                        <h1 class="text-center">Cadastrar Liga</h1>

                        <div class="form-group">
                            <label for="nome">Nome: </label>
                            <input type="text" class="form-control" placeholder="Digite o nome da liga" name="nome" required>
                        </div>

                        <div class="form-group">
                            <label for="site">Site: </label>
                            <input type="text" class="form-control" id="site" placeholder="Site (deixe vazio caso não tenha)" name="site">
                        </div>

                        <div class="form-group">
                            <label for="logo">Logo da liga: </label>
                            <input type="file" class="form-control-file" id="logo" name="logo">
                        </div>


                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                    <button type="submit" class="btn btn-danger">Cadastrar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script type="text/javascript" src="<?= $base ?>/assets/js/admin/ligas.js"></script>