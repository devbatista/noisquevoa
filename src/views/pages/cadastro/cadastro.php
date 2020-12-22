<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cadastro - Nois Que Voa</title>
    <link rel="shortcut icon" type="image/x-icon" href="<?= $base ?>/assets/img/favicon.ico">
    <link rel="stylesheet" href="<?= $base ?>/assets/plugins/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="<?= $base ?>/assets/plugins/icon-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?= $base ?>/assets/plugins/jquery-ui/jquery-ui-min.css">
    <link rel="stylesheet" href="<?= $base ?>/assets/plugins/sweetalert/sweetalert.css">
    <link href="<?= $base ?>/assets/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= $base ?>/assets/css/cadastro/cadastro.css">
</head>

<body>

    <div class="area rounded">
        <div class="cadastro">
            <h1 class="text-center">Cadastro - Nois Que Voa Sport Club</h1>
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
                    <label for="senha">Senha: </label>
                    <input type="password" class="form-control" id="senha" placeholder="**********" name="senha" required>
                </div>

                <div class="form-group">
                    <label for="confirmarSenha">Confirmar senha: </label>
                    <input type="password" class="form-control" id="confirmarSenha" placeholder="**********" name="confirmarSenha" required>
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
                    <label for="nascimento">Data de nascimento: </label>
                    <input type="date" class="form-control" id="nascimento" name="nascimento" required>
                </div>

                <div class="form-group">
                    <label for="nascimento">Posição</label>
                    <select disabled class="form-control" id="posicao" name="posicao" required>
                    </select>
                </div>

                <button type="submit" class="btn btn-lg btn-danger pull-right">Enviar</button>
            </form>
        </div>
    </div>

    <script type="text/javascript" src="<?= $base ?>/assets/plugins/jquery/jquery.min.js"></script>
    <script type="text/javascript" src="<?= $base ?>/assets/plugins/jquery-form/jquery-form.js"></script>
    <script type="text/javascript" src="<?= $base ?>/assets/plugins/jquery-mask/jquery-mask.js"></script>
    <script type="text/javascript" src="<?= $base ?>/assets/plugins/bootstrap/bootstrap.min.js"></script>
    <script type="text/javascript" src="<?= $base ?>/assets/plugins/jquery-ui/jquery-ui-min.js"></script>
    <script type="text/javascript" src="<?= $base ?>/assets/plugins/sweetalert/sweetalert.js"></script>
    <script type="text/javascript" src="<?= $base ?>/assets/plugins/validator/validator.min.js"></script>
    <script type="text/javascript" src="<?= $base ?>/assets/js/cadastro/cadastro.js"></script>
</body>

</html>