<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cadastro - Nois Que Voa</title>
    <link rel="shortcut icon" type="image/x-icon" href="<?= $base ?>/assets/img/favicon.ico">
    <link rel="stylesheet" href="<?= $base ?>/assets/plugins/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="<?= $base ?>/assets/plugins/icon-awesome/css/font-awesome.min.css">
    <link href="<?= $base ?>/assets/plugins/iCheck/custom.css" rel="stylesheet">
    <link href="<?= $base ?>/assets/plugins/steps/jquery.steps.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= $base ?>/assets/plugins/jquery-ui/jquery-ui.min.css">
    <link rel="stylesheet" href="<?= $base ?>/assets/plugins/sweetalert/sweetalert.css">
    <link href="<?= $base ?>/assets/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= $base ?>/assets/css/cadastro/cadastro.css">
    <link rel="stylesheet" href="<?= $base ?>/assets/css/cadastro/style.css">
</head>

<body>

    <div class="area rounded">
        <div class="ibox">
            <div class="ibox-title">
                <h5>Nois Que Voa Futsal e Samba</h5>
            </div>
            <div class="ibox-content">
                <h2>
                    Cadastro
                </h2>
                <p>
                    Nois Que Voa Futsal e Samba
                </p>

                <form cadastrar id="form" action="#" class="wizard-big" form cadastrar action="" data-toggle="validator" method="POST" enctype="multipart/form-data">
                    <h1>Acesso</h1>
                    <fieldset>
                        <h2>Informações de acesso</h2>
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="form-group">
                                    <label>Email *</label>
                                    <input id="email" name="email" type="email" class="form-control required email">
                                </div>
                                <div class="form-group">
                                    <label>Senha *</label>
                                    <div class="input-group">
                                        <input id="senha" name="senha" type="password" class="form-control required">
                                        <div class="input-group-prepend eye">
                                            <div class="input-group-text"><i class="fa fa-eye"></i></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Confirmar senha *</label>
                                    <div class="input-group">
                                        <input id="confirmarSenha" name="confirmarSenha" type="password" class="form-control required">
                                        <div class="input-group-prepend eye">
                                            <div class="input-group-text"><i class="fa fa-eye"></i></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="text-center">
                                    <div style="margin-top: 20px">
                                        <i class="fa fa-sign-in" style="font-size: 180px;color: #e5e5e5 "></i>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </fieldset>
                    <h1>Perfil</h1>
                    <fieldset>
                        <h2>Informações do perfil</h2>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Nome completo *</label>
                                    <input id="nome" name="nome" type="text" class="form-control required">
                                </div>
                                <div class="form-group">
                                    <label>Apelido *</label>
                                    <input id="apelido" name="apelido" type="text" class="form-control required">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>CPF *</label>
                                    <input id="cpf" name="cpf" type="text" class="form-control required">
                                </div>
                                <div class="form-group">
                                    <label>Whatsapp/celular *</label>
                                    <input id="whatsapp" name="whatsapp" type="text" class="form-control required">
                                </div>
                            </div>
                        </div>
                    </fieldset>

                    <h1>Complementares</h1>
                    <fieldset>
                        <h2>Informações do perfil</h2>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Foto (centralizada)</label>
                                    <div class="custom-file">
                                        <input id="foto" type="file" class="custom-file-input" name="foto">
                                        <label for="foto" class="custom-file-label">Escolher foto...</label>
                                    </div>
                                </div>
                                <label for="">Tipo: *</label><br>
                                <div class="form-check form-check-inline checkbox checkbox-danger">
                                    <input type="checkbox" class="form-check-input" id="jogador" value="1" name="jogador">
                                    <label for="jogador" class="form-check-label">Jogador</label>
                                </div>
                                <div class="form-check form-check-inline checkbox checkbox-danger">
                                    <input type="checkbox" class="form-check-input" id="comissao_tecnica" value="1" name="comissao_tecnica">
                                    <label for="comissao_tecnica" class="form-check-label">Comissão Técnica</label>
                                </div>
                                <div class="form-check form-check-inline checkbox checkbox-danger">
                                    <input type="checkbox" class="form-check-input" id="diretoria" value="1" name="diretoria">
                                    <label for="diretoria" class="form-check-label">Diretoria</label>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <div class="form-group">
                                        <label for="nascimento">Data de nascimento: *</label>
                                        <input type="date" class="form-control" id="nascimento" name="nascimento" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="nascimento">Posição:</label>
                                    <select disabled class="form-control" id="posicao" name="posicao" required>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </fieldset>

                    <h1>Termos e Condições</h1>
                    <fieldset>
                        <h2>Termos e Condições</h2>
                        <div class="form-check form-check-inline checkbox checkbox-danger">
                            <input class="form-check-input" type="checkbox" id="termos-e-condicoes" value="1" name="termos-e-condicoes" required>
                            <label class="form-check-label" for="">Declaro que li e aceito os <b><a class="termos-e-condicoes" href="<?= $base ?>/assets/files/politica-de-privacidade.pdf" target="_blank">Termos e Condições</a></b></label>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>

    </div>

    <script type="text/javascript" src="<?= $base ?>/assets/plugins/jquery/jquery.min.js"></script>
    <script type="text/javascript" src="<?= $base ?>/assets/js/admin/popper.min.js"></script>
    <script type="text/javascript" src="<?= $base ?>/assets/plugins/jquery-form/jquery-form.js"></script>
    <script type="text/javascript" src="<?= $base ?>/assets/plugins/jquery-mask/jquery-mask.js"></script>
    <script type="text/javascript" src="<?= $base ?>/assets/plugins/bootstrap/bootstrap.min.js"></script>
    <script type="text/javascript" src="<?= $base ?>/assets/plugins/jquery-ui/jquery-ui.min.js"></script>
    <script type="text/javascript" src="<?= $base ?>/assets/plugins/sweetalert/sweetalert.js"></script>
    <script type="text/javascript" src="<?= $base ?>/assets/plugins/validator/validator.min.js"></script>
    <script type="text/javascript" src="<?= $base ?>/assets/plugins/steps/jquery.steps.min.js"></script>
    <script type="text/javascript" src="<?= $base ?>/assets/plugins/validate/jquery.validate.min.js"></script>
    <script type="text/javascript" src="<?= $base ?>/assets/plugins/validate/jquery.messages-ptBR.js"></script>
    <script type="text/javascript" src="<?= $base ?>/assets/js/cadastro/cadastro.js"></script>
</body>

</html>