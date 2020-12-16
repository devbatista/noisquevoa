<link href="<?= $base ?>/assets/css/admin/posts.css" rel="stylesheet">

<div class="wrapper wrapper-content">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox ">
                <div class="buttons">
                    <div class="float-right">
                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target=".modal-inserir-post">Inserir Post</button>
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

<div class="modal fade modal-inserir-post" tabindex="-1" role="dialog" aria-labelledby="TituloModalCentralizado" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="TituloModalCentralizado">Adicionar Postagem</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="summernote">
                    <h3>Lorem Ipsum is simply</h3>
                    dummy text of the printing and typesetting industry. <strong>Lorem Ipsum has been the industry's</strong> standard dummy text ever since the 1500s,
                    when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic
                    typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with
                    <br />
                    <br />
                    <ul>
                        <li>Remaining essentially unchanged</li>
                        <li>Make a type specimen book</li>
                        <li>Unknown printer</li>
                    </ul>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                <button type="button" class="btn btn-danger">Inserir</button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript" src="<?= $base ?>/assets/js/admin/posts.js"></script>