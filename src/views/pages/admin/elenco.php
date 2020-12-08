<link href="<?= $base ?>/assets/css/admin/elenco.css" rel="stylesheet">

<div class="wrapper wrapper-content">
    <div class="row">
        <div class="col-lg-12">
            <div class="row">
                <div class="col-lg-12 col-sm-12" elenco>
                    <div class="ibox ">
                        <div class="buttons">
                            <div class="float-left">
                                <button type="button" class="btn btn-danger disabled">Aprovar Cadastro (0)</button>
                            </div>
                            <div class="float-right">
                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target=".modal-cadastro-elenco">Cadastrar Jogador/Comissão Técnica</button>
                            </div>
                        </div>
                        <div class="ibox-content">
                            <div class="row" style="margin-top: 10px">
                                <div class="col-5 text-center imgElenco">
                                    <img src="<?= $base ?>/assets/img/avatar.png" alt="Nois Que Voa" class="imgElenco">
                                </div>
                                <div class="col-7 dadosElenco text-muted">
                                    <div class="row">
                                        <b>Nome:</b>&nbsp; Fulano da Silva
                                    </div>
                                    <div class="row">
                                        <b>Apelido:</b>&nbsp; Fulano
                                    </div>
                                    <div class="row">
                                        <b>Posição:</b>&nbsp; Goleiro
                                    </div>
                                    <div class="row">
                                        <b>Número camisa:</b>&nbsp; 1
                                    </div>
                                    <div class="row">
                                        <b>Data de nascimento:</b>&nbsp; 13/09/1994
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="ibox ">
                        <div class="ibox-content">
                            <div class="row" style="margin-top: 10px">
                                <div class="col-5 text-center imgElenco">
                                    <img src="<?= $base ?>/assets/img/avatar.png" alt="Nois Que Voa" class="imgElenco">
                                </div>
                                <div class="col-7 dadosElenco text-muted">
                                    <div class="row">
                                        <b>Nome:</b>&nbsp; Fulano da Silva
                                    </div>
                                    <div class="row">
                                        <b>Apelido:</b>&nbsp; Fulano
                                    </div>
                                    <div class="row">
                                        <b>Posição:</b>&nbsp; Goleiro
                                    </div>
                                    <div class="row">
                                        <b>Número camisa:</b>&nbsp; 12
                                    </div>
                                    <div class="row">
                                        <b>Data de nascimento:</b>&nbsp; 13/09/1994
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="ibox ">
                        <div class="ibox-content">
                            <div class="row" style="margin-top: 10px">
                                <div class="col-5 text-center imgElenco">
                                    <img src="<?= $base ?>/assets/img/avatar.png" alt="Nois Que Voa" class="imgElenco">
                                </div>
                                <div class="col-7 dadosElenco text-muted">
                                    <div class="row">
                                        <b>Nome:</b>&nbsp; Fulano da Silva
                                    </div>
                                    <div class="row">
                                        <b>Apelido:</b>&nbsp; Fulano
                                    </div>
                                    <div class="row">
                                        <b>Posição:</b>&nbsp; Fixo
                                    </div>
                                    <div class="row">
                                        <b>Número camisa:</b>&nbsp; 3
                                    </div>
                                    <div class="row">
                                        <b>Data de nascimento:</b>&nbsp; 13/09/1994
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="ibox ">
                        <div class="ibox-content">
                            <div class="row" style="margin-top: 10px">
                                <div class="col-5 text-center imgElenco">
                                    <img src="<?= $base ?>/assets/img/avatar.png" alt="Nois Que Voa" class="imgElenco">
                                </div>
                                <div class="col-7 dadosElenco text-muted">
                                    <div class="row">
                                        <b>Nome:</b>&nbsp; Fulano da Silva
                                    </div>
                                    <div class="row">
                                        <b>Apelido:</b>&nbsp; Fulano
                                    </div>
                                    <div class="row">
                                        <b>Posição:</b>&nbsp; Fixo
                                    </div>
                                    <div class="row">
                                        <b>Número camisa:</b>&nbsp; 4
                                    </div>
                                    <div class="row">
                                        <b>Data de nascimento:</b>&nbsp; 13/09/1994
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
                    <h1 class="text-center">Novo Membro</h1>
                    <form cadastrar action="" data-toggle="validator" method="POST">
                        <div class="form-group">
                            <label for="nome">Nome: </label>
                            <input type="text" class="form-control" id="nome" placeholder="Digite seu nome" name="nome" required>
                        </div>

                        <div class="form-group">
                            <label for="apelido">Apelido: </label>
                            <input type="text" class="form-control" id="apelido" placeholder="Digite seu apelido" name="apelido" required>
                        </div>

                        <div class="form-group">
                            <label for="email">Email: </label>
                            <input type="email" class="form-control" id="email" placeholder="email@dominio.com" name="email" required>
                        </div>

                        <div class="form-group">
                            <label for="cpf">CPF: </label>
                            <input type="text" class="form-control" id="cpf" placeholder="Digite seu CPF" name="cpf" required>
                        </div>

                        <div class="form-group">
                            <label for="whatsapp">Whatsapp/celular: </label>
                            <input type="text" class="form-control" id="whatsapp" placeholder="(XX) XXXXX-XXXX" name="whatsapp" required>
                        </div>

                        <div class="form-group">
                            <label for="">Tipo: </label><br>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="jogador" value="1" name="jogador">
                                <label class="form-check-label" for="jogador">Jogador</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="diretoria" value="1" name="diretoria">
                                <label class="form-check-label" for="diretoria">Diretoria</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="comissao_tecnica" value="1" name="comissao_tecnica">
                                <label class="form-check-label" for="comissao_tecnica">Comissão Técnica</label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="nascimento">Data de nascimento: </label>
                            <input type="date" class="form-control" id="nascimento" name="nascimento" required>
                        </div>

                        <div class="form-group">
                            <label for="nascimento">Posição</label>
                            <select disabled class="form-control" id="posicao" name="posicao" required>
                            </select>
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                <button type="button" class="btn btn-danger">Salvar mudanças</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade modal-editar-elenco" tabindex="-1" role="dialog" aria-labelledby="TituloModalCentralizado" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="TituloModalCentralizado">Título do modal</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="cadastro">
                    <h1 class="text-center">Editar Membro</h1>
                    <form cadastrar action="" data-toggle="validator" method="POST">
                        <div class="form-group">
                            <label for="nome">Nome: </label>
                            <input type="text" class="form-control" id="nome" placeholder="Digite seu nome" name="nome" required>
                        </div>

                        <div class="form-group">
                            <label for="apelido">Apelido: </label>
                            <input type="text" class="form-control" id="apelido" placeholder="Digite seu apelido" name="apelido" required>
                        </div>

                        <div class="form-group">
                            <label for="email">Email: </label>
                            <input type="email" class="form-control" id="email" placeholder="email@dominio.com" name="email" required>
                        </div>

                        <div class="form-group">
                            <label for="cpf">CPF: </label>
                            <input type="text" class="form-control" id="cpf" placeholder="Digite seu CPF" name="cpf" required>
                        </div>

                        <div class="form-group">
                            <label for="whatsapp">Whatsapp/celular: </label>
                            <input type="text" class="form-control" id="whatsapp" placeholder="(XX) XXXXX-XXXX" name="whatsapp" required>
                        </div>

                        <div class="form-group">
                            <label for="">Tipo: </label><br>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="jogador" value="1" name="jogador">
                                <label class="form-check-label" for="jogador">Jogador</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="diretoria" value="1" name="diretoria">
                                <label class="form-check-label" for="diretoria">Diretoria</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="comissao_tecnica" value="1" name="comissao_tecnica">
                                <label class="form-check-label" for="comissao_tecnica">Comissão Técnica</label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="nascimento">Data de nascimento: </label>
                            <input type="date" class="form-control" id="nascimento" name="nascimento" required>
                        </div>

                        <div class="form-group">
                            <label for="nascimento">Posição</label>
                            <select disabled class="form-control" id="posicao" name="posicao" required>
                            </select>
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                <button type="button" class="btn btn-danger">Salvar mudanças</button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript" src="<?= $base ?>/assets/js/admin/elenco.js"></script>