<link href="<?= $base ?>/assets/css/admin/elenco.css" rel="stylesheet">

<div class="wrapper wrapper-content">
    <div class="row">
        <div class="col-lg-12">
            <div class="row">
                <div class="col-lg-12 col-sm-12" elenco>
                    <div class="buttons d-none">
                        <div class="pull-left col-lg-6 col-12 p-0">
                            <button type="button" class="btn btn-danger disabled pull-left" data-target=".modal-aprovar-cadastro">Aprovar Cadastro</button>
                        </div>
                        <div class="pull-right col-lg-6 col-12 p-0">
                            <button type="button" class="btn btn-danger pull-right" data-toggle="modal" data-target=".modal-cadastro-elenco">Cadastrar Jogador/Comissão Técnica</button>
                        </div>
                    </div>
                    <div class="mostrarElenco">

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
                            <input type="text" class="form-control" id="cpf" placeholder="Digite o CPF" name="cpf" required>
                        </div>

                        <div class="form-group">
                            <label for="">Tipo: </label><br>
                            <div class="form-check form-check-inline checkbox checkbox-danger">
                                <input class="form-check-input" type="checkbox" id="jogador" value="1" name="jogador">
                                <label class="form-check-label" for="jogador">Jogador</label>
                            </div>
                            <div class="form-check form-check-inline checkbox checkbox-danger">
                                <input class="form-check-input" type="checkbox" id="diretoria" value="1" name="diretoria">
                                <label class="form-check-label" for="diretoria">Diretoria</label>
                            </div>
                            <div class="form-check form-check-inline checkbox checkbox-danger">
                                <input class="form-check-input" type="checkbox" id="comissao_tecnica" value="1" name="comissao_tecnica">
                                <label class="form-check-label" for="comissao_tecnica">Comissão Técnica</label>
                            </div>
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
                <button type="button" class="btn btn-danger">Adicionar</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade modal-editar-elenco" tabindex="-1" role="dialog" aria-labelledby="TituloModalCentralizado" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="TituloModalCentralizado">Edição de cadastro</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="cadastro">
                    <h1 class="text-center">Editar Membro</h1>
                    <form editar action="" data-toggle="validator" method="POST">
                        <div class="form-group">
                            <label for="editNome">Nome: </label>
                            <input type="text" class="form-control" id="editNome" placeholder="Digite seu nome" name="nome" required>
                        </div>

                        <div class="form-group">
                            <label for="editApelido">Apelido: </label>
                            <input type="text" class="form-control" id="editApelido" placeholder="Digite seu apelido" name="apelido" required>
                        </div>

                        <div class="form-group">
                            <label for="editEmail">Email: </label>
                            <input type="email" class="form-control" id="editEmail" placeholder="email@dominio.com" name="email" required>
                        </div>

                        <div class="form-group">
                            <label for="editCPF">CPF: </label>
                            <input type="text" class="form-control" id="editCPF" placeholder="Digite seu CPF" name="cpf" required>
                        </div>

                        <div class="form-group">
                            <label for="editWhatsapp">Whatsapp/celular: </label>
                            <input type="text" class="form-control" id="editWhatsapp" placeholder="(XX) XXXXX-XXXX" name="whatsapp" required>
                        </div>

                        <div class="form-group">
                            <label for="">Tipo: </label><br>
                            <div class="form-check form-check-inline checkbox checkbox-danger">
                                <input class="form-check-input" type="checkbox" id="editJogador" value="1" name="jogador">
                                <label class="form-check-label" for="editJogador">Jogador</label>
                            </div>
                            <div class="form-check form-check-inline checkbox checkbox-danger">
                                <input class="form-check-input" type="checkbox" id="editDiretoria" value="1" name="diretoria">
                                <label class="form-check-label" for="editDiretoria">Diretoria</label>
                            </div>
                            <div class="form-check form-check-inline checkbox checkbox-danger">
                                <input class="form-check-input" type="checkbox" id="editComissao_tecnica" value="1" name="comissao_tecnica">
                                <label class="form-check-label" for="editComissao_tecnica">Comissão Técnica</label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="editNascimento">Data de nascimento: </label>
                            <input type="date" class="form-control" id="editNascimento" name="nascimento" required>
                        </div>

                        <div class="form-group">
                            <label for="editPosicao">Posição</label>
                            <select disabled class="form-control" id="editPosicao" name="posicao" required>
                            </select>
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer modal-footer-editar">
                <button type="button" class="btn btn-dark">Desativar</button>
                <button type="button" class="btn btn-danger pull-right">Salvar mudanças</button>
                <button type="button" class="btn btn-secondary pull-right" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade modal-aprovar-cadastro" tabindex="-1" role="dialog" aria-labelledby="TituloModalCentralizado" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="TituloModalCentralizado">Aprovar Cadastro</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript" src="<?= $base ?>/assets/js/admin/elenco.js"></script>