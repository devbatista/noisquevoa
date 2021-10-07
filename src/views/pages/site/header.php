<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Nois Que Voa Futsal e Samba">
    <meta name="keywords" content="Specer, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?= $header['titulo'] ?></title>

    <!-- Favico -->
    <link rel="shortcut icon" type="image/x-icon" href="<?= $base ?>/assets/site/img/favicon.ico">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900&display=swap" rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="<?= $base ?>/assets/site/css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="<?= $base ?>/assets/site/css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="<?= $base ?>/assets/site/css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="<?= $base ?>/assets/site/css/magnific-popup.css" type="text/css">
    <link rel="stylesheet" href="<?= $base ?>/assets/plugins/sweetalert/sweetalert.css">
    <link rel="stylesheet" href="<?= $base ?>/assets/site/css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="<?= $base ?>/assets/site/css/style.css" type="text/css">
</head>

<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    <!-- Offcanvas Menu Section Begin -->
    <div class="offcanvas-menu-overlay"></div>
    <div class="offcanvas-menu-wrapper">
        <div class="canvas-close">
            <i class="fa fa-close"></i>
        </div>
        <div class="search-btn search-switch">
            <i class="fa fa-search"></i>
        </div>
        <div class="header__top--canvas">
            <div class="ht-info">
                <ul>
                    <li>20:00 - May 19, 2019</li>
                    <li><a href="<?= $base ?>/contato">Contato</a></li>
                    <li><a href="#">Login</a></li>
                </ul>
            </div>
            <div class="ht-links">
                <a href="#"><i class="fa fa-facebook"></i></a>
                <a href="#"><i class="fa fa-vimeo"></i></a>
                <a href="#"><i class="fa fa-twitter"></i></a>
                <a href="#"><i class="fa fa-google-plus"></i></a>
                <a href="#"><i class="fa fa-instagram"></i></a>
            </div>
        </div>
        <ul class="main-menu mobile-menu">
            <li class="active"><a href="<?= $base ?>">Home</a></li>
            <li><a href="club.html">Club</a></li>
            <li><a href="schedule.html">Schedule</a></li>
            <li><a href="result.html">Results</a></li>
            <li><a href="#">Sport</a></li>
            <li><a href="#">Pages</a>
                <ul class="dropdown">
                    <li><a href="blog.html">Blog</a></li>
                    <li><a href="blog-details.html">Blog Details</a></li>
                    <li><a href="#">Schedule</a></li>
                    <li><a href="#">Results</a></li>
                </ul>
            </li>
            <li><a href="contact.html">Contact Us</a></li>
        </ul>
        <div id="mobile-menu-wrap"></div>
    </div>
    <!-- Offcanvas Menu Section End -->

    <!-- Header Section Begin -->
    <header class="header-section">
        <div class="header__top">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="ht-info">
                            <ul class="header-info">
                                <li>20:00 - May 19, 2019</li>
                                <li><a href="<?= $base ?>/contato">Contato</a></li>
                                <?php if (!isset($_SESSION['logado'])) : ?>
                                    <li class="login-switch">Login</li>
                                <?php else : ?>
                                    <li class="logado"><a href="#" id="dropdownAdmin" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Olá, <?= $_SESSION['logado']['apelido'] ?></a>
                                        <div class="dropdown-menu" aria-labelledby="dropdownAdmin">
                                            <a class="dropdown-item" href="<?= $base ?>/admin">Acessar Painel</a>
                                            <a class="dropdown-item" href="" logout>Logout</a>
                                        </div>
                                    </li>
                                <?php endif ?>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="ht-links">
                            <a href="https://fb.com/NoisQueVoaFS" target="_blank"><i class="fa fa-facebook"></i></a>
                            <a href="https://instagram.com/noisquevoafs" target="_blank"><i class="fa fa-instagram"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="header__nav">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="nav-menu">
                            <ul class="main-menu">
                                <li class="<?= ($uri == '/') ? 'active' : '' ?>"><a href="<?= $base ?>">Home</a></li>
                                <li class="<?= ($uri == '/quem-somos') ? 'active' : '' ?>"><a href="<?= $base ?>/quem-somos">Quem somos</a></li>
                                <li class="<?= ($uri == '/partidas') ? 'active' : '' ?>"><a href="<?= $base ?>/partidas">Partidas</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="logo">
                            <a href="<?= $base ?>"><img src="<?= $base ?>/assets/site/img/logo.png" alt=""></a>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="nav-menu">
                            <ul class="main-menu">
                                <li class="<?= ($uri == '/resultados') ? 'active' : '' ?>" disabled>Elenco</li>
                                <li class="<?= ($uri == '/noticias') ? 'active' : '' ?>"><a href="<?= $base ?>/noticias">Notícias</a></li>
                                <li class="<?= ($uri == '/fotos') ? 'active' : '' ?>" disabled style="margin: 0">Fotos</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- Header End -->