<?php $view('header'); ?>

<section id="header">
    <div class="bg-opacity-black"></div>
</section>

<header id="menu">
    <div class="nav-bg-gray"></div>
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <div class="itens-menu">
                <ul class="navbar-nav">
                    <li class="nav-item active">
                        <a href="" class="nav-link">HOME</a>
                    </li>
                    <li class="nav-item">
                        <a href="" class="nav-link">SOBRE</a>
                    </li>
                    <li class="nav-item">
                        <a href="" class="nav-link">ÁREAS DE ATUAÇÃO</a>
                    </li>
                    <li class="nav-item">
                        <a href="" class="nav-link">NOTÍCIAS</a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= $base ?>/admin" class="nav-link">ADMIN</a>
                    </li>
                    <li class="nav-item">
                        <a href="" class="nav-link">CONTATO</a>
                    </li>
                    <li class="nav-item">
                        <a href="" class="nav-link"><i class="fa fa-search"></i></a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>

<section id="salve"></section>


<?= $view('footer') ?>