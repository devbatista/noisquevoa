<?php $view('header'); ?>
<div class="container">
    <div class="row">
        <div class="col-6">
            <button type="button" inserirUsuario class="btn btn-primary" data-toggle="modal" data-target="#inserirUsuario">Adicionar usuário</button>
        </div>
        <div class="col-6">
            <button type="button" enviarEmail class="btn btn-primary pull-right" data-toggle="modal" data-target="#enviarEmail">Enviar email</button>
        </div>
    </div>

    <table class="table table-striped">
        <thead class="thead-dark">
            <tr>
                <th>ID</th>
                <th>NOME</th>
                <th>EMAIL</th>
                <th>AÇÕES</th>
            </tr>
        </thead>
        <tbody usuarios>

        </tbody>
    </table>
</div>

<!-- Modal para inserir usuário -->
<div class="modal fade" id="inserirUsuario" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form addUser>
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Inserir Usuário</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="form-group">
                        <label for="nome">Nome: </label>
                        <input type="text" class="form-control" id="nome" name="nome" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email: </label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                    <button inserir type="submit" class="btn btn-primary">Inserir</button>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- Fim modal inserção usuário -->

<!-- Modal para alterar usuário -->
<div class="modal fade" id="alterarUsuario" tabindex="-1" role="dialog" aria-labelledby="alteracaoUsuario" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form editUser>
            <input type="hidden" name="idEditar">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="alteracaoUsuario">Alterar Usuário</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="form-group">
                        <label for="nome">Nome: </label>
                        <input type="text" class="form-control" id="nome" name="nome" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email: </label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                    <button alterar type="submit" class="btn btn-primary">Salvar</button>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- Fim modal alteração usuário -->

<!-- Modal para alterar usuário -->
<div class="modal fade" id="enviarEmail" tabindex="-1" role="dialog" aria-labelledby="exampleEnviarEmail" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form sendEmail>
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleEnviarEmail">Enviar dados por email</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="form-group">
                        <label for="emailRelatorio">Enviar Para: </label>
                        <input type="text" class="form-control" id="emailRelatorio" name="emailRelatorio" required>
                    </div>

                    <div class="form-group">
                        <label for="nome">Selecionar dados de: </label>
                        <select class="custom-select" id="relatorio" name="relatorio" required>
                        </select>
                    </div>

                    <div tabela class="row d-none">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>NOME</th>
                                    <th>EMAIL</th>
                                </tr>
                            </thead>

                            <tbody id="dadosRelatorio">

                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                    <button PHPMailer type="submit" class="btn btn-primary">Enviar com PHPMailer</button>
                    <button mail type="submit" class="btn btn-primary">Enviar com mail</button>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- Fim modal alteração usuário -->


<?= $view('footer') ?>