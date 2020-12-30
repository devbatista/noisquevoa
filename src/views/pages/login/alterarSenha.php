<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Nois Que Voa - Administração</title>
    <link rel="shortcut icon" type="image/x-icon" href="<?= $base ?>/assets/img/favicon.ico">
    <link rel="stylesheet" href="<?= $base ?>/assets/plugins/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="<?= $base ?>/assets/plugins/icon-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?= $base ?>/assets/plugins/jquery-ui/jquery-ui.min.css">
    <link rel="stylesheet" href="<?= $base ?>/assets/plugins/sweetalert/sweetalert.css">
    <link rel="stylesheet" href="<?= $base ?>/assets/css/login/recuperar-senha.css">
</head>

<body>

    <div class="area text-center mb-5 bg-white rounded">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-5 align-self-center">
                <img class="logo" src="<?= $base ?>/assets/img/noisquevoa.png" alt="">
            </div>
            <div class="col-lg-6 col-md-6 col-sm-5">
                <h2>Alterar senha</h2>

                <!-- Form de alteração de senha -->
                <form alterarSenha action="" method="POST" data-toggle="validator">

                    <input type="hidden" name="email">

                    <input type="password" name="novaSenha" placeholder="Nova senha" class="form-control" required>
                    <input type="password" name="confirmaNovaSenha" placeholder="Confirme" class="form-control" required>

                    <label class="remember" for="remember">
                        <!-- <a href="">Esqueci minha senha</a>                         -->
                    </label>

                    <input type="submit" class="btn btn-danger btn-block" value="Alterar">

                </form>

                <p class="gray padding"><?= date('Y') ?></p>
            </div>
        </div>
    </div>

    <script type="text/javascript" src="<?= $base ?>/assets/plugins/jquery/jquery.min.js"></script>
    <script type="text/javascript" src="<?= $base ?>/assets/plugins/jquery-form/jquery-form.js"></script>
    <script type="text/javascript" src="<?= $base ?>/assets/plugins/bootstrap/bootstrap.min.js"></script>
    <script type="text/javascript" src="<?= $base ?>/assets/plugins/jquery-ui/jquery-ui.min.js"></script>
    <script type="text/javascript" src="<?= $base ?>/assets/plugins/sweetalert/sweetalert.js"></script>
    <script type="text/javascript" src="<?= $base ?>/assets/plugins/validator/validator.min.js"></script>
    <script type="text/javascript" src="<?= $base ?>/assets/js/login/recuperar-senha.js"></script>
</body>

</html>