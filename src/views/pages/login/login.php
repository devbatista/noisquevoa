<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Nois Que Voa - Administração</title>
    <link rel="stylesheet" href="<?= $base ?>/assets/plugins/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="<?= $base ?>/assets/plugins/icon-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?= $base ?>/assets/css/login/login.css">
</head>

<body>

    <div class="area text-center mb-5 bg-white rounded">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-5 align-self-center">
                <img class="logo" src="<?= $base ?>/assets/img/noisquevoa.png" alt="">
            </div>
            <div class="col-lg-6 col-md-6 col-sm-5">
                <h2>Faça o login</h2>

                <form action="<?= $base ?>/login/autentica" method="POST">

                    <input type="email" name="email" placeholder="Email" class="form-control">
                    <input type="password" name="senha" placeholder="Senha" class="form-control">

                    <label class="remember" for="remember">
                        <a href="">Esqueci minha senha</a>                        
                    </label>

                    <input type="submit" class="btn btn-danger btn-block" value="Entrar">

                </form>

                <p class="gray padding">2020</p>
            </div>
        </div>
    </div>

    <script type="text/javascript" src="<?= $base ?>/assets/plugins/jquery/jquery.min.js"></script>
    <script type="text/javascript" src="<?= $base ?>/assets/plugins/bootstrap/bootstrap.min.js"></script>
    <script type="text/javascript" src="<?= $base ?>/assets/js/login/login.js"></script>
</body>

</html>