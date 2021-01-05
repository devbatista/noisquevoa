<!DOCTYPE html>
<html lang="pt-br">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Nois Que Voa - Administração</title>

    <link rel="shortcut icon" type="image/x-icon" href="<?= $base ?>/assets/img/favicon.ico">

    <link href="<?= $base ?>/assets/plugins/bootstrap/bootstrap.min.css" rel="stylesheet">
    <link href="<?= $base ?>/assets/plugins/icon-awesome/css/font-awesome.css" rel="stylesheet">

    <!-- Toastr style -->
    <link href="<?= $base ?>/assets/plugins/toastr/toastr.min.css" rel="stylesheet">

    <!-- Jquery UI -->
    <link rel="stylesheet" href="<?= $base ?>/assets/plugins/jquery-ui/jquery-ui.min.css">

    <!-- Datatables -->
    <link href="<?= $base ?>/assets/plugins/datatables/datatables.min.css" rel="stylesheet">

    <!-- Gritter -->
    <link href="<?= $base ?>/assets/plugins/gritter/jquery.gritter.css" rel="stylesheet">

    <link href="<?= $base ?>/assets/css/admin/animate.css" rel="stylesheet">
    <link href="<?= $base ?>/assets/css/admin/admin.css" rel="stylesheet">

    <!-- Summernote -->
    <link href="<?= $base ?>/assets/plugins/summernote/summernote.min.css" rel="stylesheet">

    <!-- SweetAlert -->
    <link rel="stylesheet" href="<?= $base ?>/assets/plugins/sweetalert/sweetalert.css">

    <!-- Awesome Bootstrap -->
    <link href="<?= $base ?>/assets/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css" rel="stylesheet">

    <!-- Switchery -->
    <link href="<?= $base ?>/assets/plugins/switchery/switchery.css" rel="stylesheet">

    <!-- scripts -->
    <script src="<?= $base ?>/assets/plugins/jquery/jquery.min.js"></script>
    <script src="<?= $base ?>/assets/js/admin/popper.min.js"></script>
    <script src="<?= $base ?>/assets/plugins/bootstrap/bootstrap.min.js"></script>
    <script src="<?= $base ?>/assets/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="<?= $base ?>/assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>

    <!-- Flot -->
    <script src="<?= $base ?>/assets/plugins/flot/jquery.flot.js"></script>
    <script src="<?= $base ?>/assets/plugins/flot/jquery.flot.tooltip.min.js"></script>
    <script src="<?= $base ?>/assets/plugins/flot/jquery.flot.spline.js"></script>
    <script src="<?= $base ?>/assets/plugins/flot/jquery.flot.resize.js"></script>
    <script src="<?= $base ?>/assets/plugins/flot/jquery.flot.pie.js"></script>

    <!-- Peity -->
    <script src="<?= $base ?>/assets/plugins/peity/jquery.peity.min.js"></script>
    <script src="<?= $base ?>/assets/plugins/peity/peity-demo.js"></script>

    <!-- Custom and plugin javascript -->
    <script src="<?= $base ?>/assets/js/admin/inspinia.js"></script>
    <script src="<?= $base ?>/assets/plugins/pace/pace.min.js"></script>

    <!-- jQuery UI -->
    <script src="<?= $base ?>/assets/plugins/jquery-ui/jquery-ui.min.js"></script>

    <!-- SweetAlert -->
    <script type="text/javascript" src="<?= $base ?>/assets/plugins/sweetalert/sweetalert.js"></script>

    <!-- GITTER -->
    <script src="<?= $base ?>/assets/plugins/gritter/jquery.gritter.min.js"></script>

    <!-- Sparkline -->
    <script src="<?= $base ?>/assets/plugins/sparkline/jquery.sparkline.min.js"></script>

    <!-- Sparkline demo data  -->
    <script src="<?= $base ?>/assets/plugins/sparkline/sparkline-demo.js"></script>

    <!-- ChartJS-->
    <script src="<?= $base ?>/assets/plugins/chartJs/Chart.min.js"></script>

    <!-- Toastr -->
    <script src="<?= $base ?>/assets/plugins/toastr/toastr.min.js"></script>

    <!-- Mask -->
    <script src="<?= $base ?>/assets/plugins/jquery-mask/jquery-mask.js"></script>

    <!-- Datatables -->
    <script src="<?= $base ?>/assets/plugins/datatables/datatables.min.js"></script>

    <!-- Summernote -->
    <script src="<?= $base ?>/assets/plugins/summernote/summernote.min.js"></script>

    <!-- Validator -->
    <script type="text/javascript" src="<?= $base ?>/assets/plugins/validator/validator.min.js"></script>

    <!-- Jquery Form -->
    <script type="text/javascript" src="<?= $base ?>/assets/plugins/jquery-form/jquery-form.js"></script>
    
    <!-- Switchery -->
    <script src="<?= $base ?>/assets/plugins/switchery/switchery.js"></script>

    <!-- Admin -->
    <script src="<?= $base ?>/assets/js/admin/index.js"></script>

</head>

<body data-id="<?= $_SESSION['logado']['id_usuario'] ?>" presidencia="<?= $_SESSION['logado']['presidencia'] ?>" diretoria="<?= $_SESSION['logado']['diretoria'] ?>" jogador="<?= $_SESSION['logado']['jogador'] ?>">
    <div id="wrapper">
        <nav class="navbar-default navbar-static-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav metismenu" id="side-menu">
                    <li class="nav-header">
                        <div class="dropdown profile-element">
                            <img alt="image" class="rounded-circle" src="<?= $base . $_SESSION['logado']['foto'] ?>" />
                            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                <span class="block m-t-xs font-bold"><?= $_SESSION['logado']['nome'] ?></span>
                                <span class="text-muted text-xs block"><?= $_SESSION['logado']['cargo'] ?><b class="caret"></b></span>
                            </a>
                            <ul class="dropdown-menu animated fadeInRight m-t-xs">
                                <li><a class="dropdown-item" href="<?= $base ?>/admin/perfil">Perfil</a></li>
                                <li class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="<?= $base ?>/logout">Logout</a></li>
                            </ul>
                        </div>
                        <div class="logo-element">
                            NQV
                        </div>
                    </li>
                    <li>
                        <a href="<?= $base ?>/admin"><i class="fa fa-home"></i> <span class="nav-label">Home</span></a>
                    </li>
                    <li>
                        <a href="<?= $base ?>/admin/partidas"><i class="fa fa-list-alt"></i> <span class="nav-label">Partidas</span></a>
                    </li>
                    <li>
                        <a href="<?= $base ?>/admin/estatisticas"><i class="fa fa-clipboard"></i> <span class="nav-label">Estatísticas</span></a>
                    </li>
                    <li>
                        <a href="<?= $base ?>/admin/elenco"><i class="fa fa-users"></i> <span class="nav-label">Elenco</span></a>
                    </li>
                    <li>
                        <a href="<?= $base ?>/admin/diretoria"><i class="fa fa-cogs"></i> <span class="nav-label">Diretoria</span></a>
                    </li>
                    <li>
                        <a href="<?= $base ?>/admin/ligas"><i class="fa fa-tasks"></i> <span class="nav-label">Ligas</span></a>
                    </li>
                    <li class="dropright d-none">
                        <a href="#" role="button" id="dropdownMenuLink" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-envelope"></i> <span class="nav-label">Convite</span></a>
                        <div class="dropdown-menu">
                            <form class="p-4" enviarConvite>
                                <div class="form-group">
                                    <h4>Enviar cadastro</h4>
                                </div>
                                <div class="form-group">
                                    <label for="exampleDropdownFormEmail2">Email</label>
                                    <input type="email" name="convite" class="form-control" id="exampleDropdownFormEmail2" placeholder="email@exemplo.com">
                                </div>

                                <div class="form-group">
                                    <label for="exampleDropdownFormName">Nome</label>
                                    <input type="text" name="nomeConvite" class="form-control" id="exampleDropdownFormName" placeholder="Nome">
                                </div>

                                <button type="submit" class="btn btn-danger">Enviar</button>
                            </form>
                        </div>
                    </li>

                    <li>
                        <a href="<?= $base ?>/admin/posts"><i class="fa fa-sticky-note"></i> <span class="nav-label">Posts</span></a>
                    </li>

                    <li class="financas d-none">
                        <a href="<?= $base ?>/admin/financas"><i class="fa fa-money"></i> <span class="nav-label">Finanças</span></a>
                    </li>
                </ul>
            </div>
        </nav>
        <div id="page-wrapper" class="gray-bg dashbard-1">
            <div class="row border-bottom">
                <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
                    <div class="navbar-header">
                        <a class="navbar-minimalize minimalize-styl-2 btn btn-danger " href="#"><i class="fa fa-bars"></i> </a>
                    </div>
                    <ul class="nav navbar-top-links navbar-right">
                        <li>
                            <a href="<?= $base ?>/logout">
                                <i class="fa fa-sign-out"></i> Log out
                            </a>
                        </li>
                    </ul>

                </nav>
            </div>