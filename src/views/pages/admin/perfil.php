<link rel="stylesheet" href="<?= $base ?>/assets/css/admin/perfil.css">

<div class="area rounded">
    <div class="cadastro">
        <h1 class="text-center">Cadastro - Nois Que Voa Sport Club</h1>
        <form perfil action="" method="POST" enctype="multipart/form-data" data-id="<?= $_SESSION['logado']['id_usuario'] ?>">
            <input type="hidden" name="id">

            <div class="form-group">
                <label for="nome">Nome:</label>
                <input type="text" class="form-control" id="nome" placeholder="Digite seu nome" name="nome" required>
            </div>

            <div class="form-group">
                <label for="apelido">Apelido:</label>
                <input type="text" class="form-control" id="apelido" placeholder="Digite seu apelido" name="apelido" required>
            </div>

            <div class="form-group">
                <label for="foto">Foto (centralizada): </label>
                <input type="file" class="form-control-file" id="foto" name="foto">
            </div>

            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" placeholder="email@dominio.com" name="email" required>
            </div>

            <div class="form-group ">
                <label for="senha">Senha:</label>
                <div class="input-group">
                    <input type="password" class="form-control" id="senha" placeholder="**********" name="senha">
                    <div class="input-group-prepend eye">
                        <div class="input-group-text"><i class="fa fa-eye"></i></div>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="confirmarSenha">Confirmar senha:</label>
                <div class="input-group">
                    <input type="password" class="form-control" id="confirmarSenha" placeholder="**********" name="confirmarSenha">
                    <div class="input-group-prepend eye">
                        <div class="input-group-text"><i class="fa fa-eye"></i></div>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="cpf">CPF:</label>
                <input type="text" class="form-control" id="cpf" placeholder="Digite seu CPF" name="cpf" required>
            </div>

            <div class="form-group">
                <label for="whatsapp">Whatsapp/celular:</label>
                <input type="text" class="form-control" id="whatsapp" placeholder="(XX) XXXXX-XXXX" name="whatsapp" required>
            </div>

            <div class="form-group">
                <label for="nascimento">Data de nascimento:</label>
                <input type="date" class="form-control" id="nascimento" name="nascimento" required>
            </div>

            <div class="form-group">
                <label for="posicao">Posição:</label>
                <select class="form-control" id="posicao" name="posicao" required>
                </select>
            </div>

            <button type="submit" class="btn btn-lg btn-danger pull-right">Alterar</button>
        </form>
    </div>
</div>

<script type="text/javascript" src="<?= $base ?>/assets/js/admin/perfil.js"></script>