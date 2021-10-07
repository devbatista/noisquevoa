<!-- Hero Section Begin -->
<section class="hero-section set-bg" data-setbg="<?= $base ?>/assets/site/img/nqv.jpeg">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="hs-item">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="hs-text">
                                    <h4>Nois Que Voa Futsal e Samba</h4>
                                    <h2>Força e União</h2>
                                    <a href="#" class="primary-btn">Quem somos</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Hero Section End -->

<!-- Trending News Section Begin -->
<div class="trending-news-section">
    <div class="container">
        <div class="tn-title"><i class="fa fa-caret-right"></i> Últimas postagens</div>
        <div class="news-slider owl-carousel">
            <div class="nt-item">Em jogo pegado finalmente saiu nossa vitória</div>
            <div class="nt-item">Nois Que Voa FS entra na futliga como mandante</div>
        </div>
    </div>
</div>
<!-- Trending News Section End -->

<!-- Match Section Begin -->
<section class="match-section set-bg" data-setbg="<?= $base ?>/assets/site/img/bg-home-partidas.jpg">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="ms-content">
                    <h4>Próximas partidas</h4>
                    <?php foreach ($partidas as $partida) : ?>
                        <div class="mc-table">
                            <table>
                                <tbody>
                                    <tr>
                                        <td class="left-team">
                                            <img src="<?= $base . $partida['nqv'] ?>" alt="">
                                            <h6>Nois Que Voa</h6>
                                        </td>
                                        <td class="mt-content">
                                            <div class="mc-op"><?= $partida['local'] ?></div>
                                            <h4>VS</h4>
                                            <div class="mc-op"><?= $partida['data'] ?></div>
                                        </td>
                                        <td class="right-team">
                                            <img src="<?= $base . $partida['logo_adversario'] ?>" alt="">
                                            <h6><?= $partida['adversario'] ?></h6>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    <?php endforeach ?>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="ms-content">
                    <h4>Resultados recentes</h4>
                    <?php foreach ($resultados as $resultado) : ?>
                        <div class="mc-table">
                            <table>
                                <tbody>
                                    <tr>
                                        <td class="left-team">
                                            <img src="<?= $base . $resultado['nqv'] ?>" alt="">
                                            <h6>Nois Que Voa</h6>
                                        </td>
                                        <td class="mt-content">
                                            <div class="mc-op"><?= $resultado['local'] ?></div>
                                            <div>
                                                <?php if (isset($resultado['gols_pro2'])) : ?>
                                                    <h5><?= $resultado['gols_pro'] ?> : <?= $resultado['gols_contra'] ?></h5>
                                                    <h5><?= $resultado['gols_pro2'] ?> : <?= $resultado['gols_contra2'] ?></h5>
                                                <?php else : ?>
                                                    <h4 class="resultado"><?= $resultado['gols_pro'] ?> : <?= $resultado['gols_contra'] ?></h4>
                                                <?php endif ?>
                                            </div>
                                            <div class="mc-op"><?= $resultado['data'] ?></div>
                                        </td>
                                        <td class="right-team">
                                            <img src="<?= $base . $resultado['logo_adversario'] ?>" alt="">
                                            <h6><?= $resultado['adversario'] ?></h6>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    <?php endforeach ?>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Match Section End -->

<!-- Fotos Section Begin -->
<section class="fotos-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 p-0">
                <div class="section-title">
                    <h3>Galeria de <span>Fotos</span></h3>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3 col-sm-6 p-0">
                <div class="soccer-item set-bg" data-setbg="<?= $base ?>/assets/site/img/soccer/soccer-1.jpg">
                    <div class="si-tag">Futliga</div>
                    <div class="si-text">
                        <h5><a href="#">Counting Your Chicken Before They Hatch</a></h5>
                        <ul>
                            <li><i class="fa fa-calendar"></i> May 19, 2019</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6 p-0">
                <div class="soccer-item set-bg" data-setbg="<?= $base ?>/assets/site/img/soccer/soccer-2.jpg">
                    <div class="si-tag">Futliga</div>
                    <div class="si-text">
                        <h5><a href="#">Hypnotherapy For Motivation Getting The Drive Back</a></h5>
                        <ul>
                            <li><i class="fa fa-calendar"></i> May 19, 2019</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6 p-0">
                <div class="soccer-item set-bg" data-setbg="<?= $base ?>/assets/site/img/soccer/soccer-3.jpg">
                    <div class="si-tag">Futliga</div>
                    <div class="si-text">
                        <h5><a href="#">Astronomy Binoculars A Great Alternative</a></h5>
                        <ul>
                            <li><i class="fa fa-calendar"></i> May 19, 2019</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6 p-0">
                <div class="soccer-item set-bg" data-setbg="<?= $base ?>/assets/site/img/soccer/soccer-4.jpg">
                    <div class="si-tag">Futliga</div>
                    <div class="si-text">
                        <h5><a href="#">Decorate For Less With Art Posters</a></h5>
                        <ul>
                            <li><i class="fa fa-calendar"></i> May 19, 2019</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Soccer Section End -->

<!-- Latest Section Begin -->
<section class="latest-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title">
                    <h3>Últimas <span>Postagens</span></h3>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="news-item left-news">
                            <div class="ni-pic set-bg" data-setbg="<?= $base ?>/assets/site/img/news/latest-b.jpg">
                                <div class="ni-tag">Soccer</div>
                            </div>
                            <div class="ni-text">
                                <h4><a href="#">Once You Learn These Hard Truths About Life, You'll Become</a></h4>
                                <ul>
                                    <li><i class="fa fa-calendar"></i> May 19, 2019</li>
                                </ul>
                                <p>It’s that time again when people start thinking about their New Years
                                    Resolutions. Usually they involve, losing weight, quitting smoking, and joining
                                    a gym, just to mention a few.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="news-item">
                            <div class="ni-pic">
                                <img src="<?= $base ?>/assets/site/img/news/ln-1.jpg" alt="">
                            </div>
                            <div class="ni-text">
                                <h5><a href="#">How To Quit Smoking Using Zyban</a></h5>
                                <ul>
                                    <li><i class="fa fa-calendar"></i> May 19, 2019</li>
                                </ul>
                            </div>
                        </div>
                        <div class="news-item">
                            <div class="ni-pic">
                                <img src="<?= $base ?>/assets/site/img/news/ln-2.jpg" alt="">
                            </div>
                            <div class="ni-text">
                                <h5><a href="#">Decorate For Less With Art Posters</a></h5>
                                <ul>
                                    <li><i class="fa fa-calendar"></i> May 19, 2019</li>
                                </ul>
                            </div>
                        </div>
                        <div class="news-item">
                            <div class="ni-pic">
                                <img src="<?= $base ?>/assets/site/img/news/ln-3.jpg" alt="">
                            </div>
                            <div class="ni-text">
                                <h5><a href="#">Home Business Advertising Ideas</a></h5>
                                <ul>
                                    <li><i class="fa fa-calendar"></i> May 19, 2019</li>
                                </ul>
                            </div>
                        </div>
                        <div class="news-item">
                            <div class="ni-pic">
                                <img src="<?= $base ?>/assets/site/img/news/ln-4.jpg" alt="">
                            </div>
                            <div class="ni-text">
                                <h5><a href="#">Lasik Doesn T Stop Your Eyes From Aging</a></h5>
                                <ul>
                                    <li><i class="fa fa-calendar"></i> May 19, 2019</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Latest Section End -->

<!-- Eleno Section Begin -->
<section class="elenco-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="section-title">
                    <h3><span>Elenco</span></h3>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="news-item elenco-item set-bg" data-setbg="<?= $base ?>/assets/site/img/news/popular-b.jpg">
                            <div class="ni-tag tenis">Tenis</div>
                            <div class="ni-text">
                                <h5><a href="#">England reach World Cup last 16 with hard-fought win over
                                        Argentina</a></h5>
                                <ul>
                                    <li><i class="fa fa-calendar"></i> May 19, 2019</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="news-item elenco-item set-bg" data-setbg="<?= $base ?>/assets/site/img/news/popular-b.jpg">
                            <div class="ni-tag football">Football</div>
                            <div class="ni-text">
                                <h5><a href="#">We are playing history and Argentina at the World Cup, says Phil
                                        Neville</a></h5>
                                <ul>
                                    <li><i class="fa fa-calendar"></i> May 19, 2019</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="section-title">
                    <h3>Siga-<span>nos</span></h3>
                </div>
                <div class="follow-links">
                    <ul>
                        <li class="facebook">
                            <i class="fa fa-facebook"></i>
                            <div class="fl-name">Facebook</div>
                            <span class="fl-fan">2.530 Fans</span>
                        </li>
                        <li class="twitter">
                            <i class="fa fa-twitter"></i>
                            <div class="fl-name">Twitter</div>
                            <span class="fl-fan">2.046 Fans</span>
                        </li>
                        <li class="google">
                            <i class="fa fa-google"></i>
                            <div class="fl-name">Google</div>
                            <span class="fl-fan">1.170 Fans</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Elenco Section End -->

<!-- Patrocinadores Section Begin -->
<!-- Criar a sessão dos patrocinadores aqui -->
<!-- Patrocinadores Section End -->