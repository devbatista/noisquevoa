<link href="<?= $base ?>/assets/css/admin/diretoria.css" rel="stylesheet">

<div class="wrapper wrapper-content">
    <div class="row">
        <div class="col-lg-12">
            <div class="row">
                <div class="col-lg-12 col-sm-12" diretoria>
                <div class="buttons">
                        <div class="float-left">
                            <button type="button" class="btn btn-danger disabled" data-target=".modal-aprovar-cadastro">Aprovar Cadastro</button>
                        </div>
                        <div class="float-right">
                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target=".modal-cadastro-diretoria">Cadastrar Diretor</button>
                        </div>
                    </div>
                    <div class="mostrarDiretoria">

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade modal-cadastro-diretoria" tabindex="-1" role="dialog" aria-labelledby="TituloModalCentralizado" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="TituloModalCentralizado">Diretoria</h5>
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

<div class="modal fade modal-editar-diretoria" tabindex="-1" role="dialog" aria-labelledby="TituloModalCentralizado" aria-hidden="true">
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
                    <h1 class="text-center">Editar Diretoria</h1>
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
                            <input type="text" class="form-control" id="editCPF" placeholder="Digite o CPF" name="cpf" required>
                        </div>

                        <div class="form-group">
                            <label for="editWhatsapp">Whatsapp/celular: </label>
                            <input type="text" class="form-control" id="editWhatsapp" placeholder="(XX) XXXXX-XXXX" name="whatsapp" required>
                        </div>

                        <div class="form-group">
                            <label for="editNascimento">Data de nascimento: </label>
                            <input type="date" class="form-control" id="editNascimento" name="nascimento" required>
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

<script type="text/javascript" src="<?= $base ?>/assets/js/admin/diretoria.js"></script>