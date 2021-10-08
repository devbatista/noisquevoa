<!-- Breadcrumb Section Begin -->
<section class="breadcrumb-section set-bg" data-setbg="<?= $base ?>/assets/site/img/breadcrumb-bg.jpg">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="bs-text">
                    <h2>Partidas</h2>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->

<!-- Schedule Section Begin -->
<section class="schedule-section spad">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-9">
                <div class="schedule-text">
                    <h4 class="st-title">Próximas partidas</h4>
                    <div class="st-table">
                        <table>
                            <tbody>
                                <?php foreach ($partidas as $partida) : ?>
                                    <tr>
                                        <td class="left-team">
                                            <img src="<?= $base ?>/assets/site/img/logo.png" alt="">
                                            <h4>Nois Que Voa</h4>
                                        </td>
                                        <td class="st-option">
                                            <div class="so-text"><?= $partida['local'] ?></div>
                                            <h4>VS</h4>
                                            <div class="so-text"><?= $partida['data'] ?></div>
                                        </td>
                                        <td class="right-team">
                                            <img src="<?= $base . $partida['logo_adversario'] ?>" alt="">
                                            <h4><?= $partida['adversario'] ?></h4>
                                        </td>
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-lg-9" style="margin-top: 80px;">
                <div class="schedule-text">
                    <h4 class="st-title">Últimos resultados</h4>
                    <div class="st-table">
                        <table>
                            <tbody>
                                <?php foreach ($resultados as $resultado) : ?>
                                    <tr>
                                        <td class="left-team">
                                            <img src="<?= $base . $resultado['nqv'] ?>" alt="">
                                            <h4>Nois Que Voa</h4>
                                        </td>
                                        <td class="st-option">
                                            <div class="so-text"><?= $resultado['local'] ?></div>
                                            <div class="st-placar">
                                            <?php if (isset($resultado['gols_pro2'])) : ?>
                                                    <h5><?= $resultado['gols_pro'] ?> : <?= $resultado['gols_contra'] ?></h5>
                                                    <h5><?= $resultado['gols_pro2'] ?> : <?= $resultado['gols_contra2'] ?></h5>
                                                <?php else : ?>
                                                    <h4 class="resultado"><?= $resultado['gols_pro'] ?> : <?= $resultado['gols_contra'] ?></h4>
                                                <?php endif ?>
                                            </div>
                                            <div class="so-text"><?= $resultado['local'] ?></div>
                                        </td>
                                        <td class="right-team">
                                            <img src="<?= $base . $resultado['logo_adversario'] ?>" alt="">
                                            <h4><?= $resultado['adversario'] ?></h4>
                                        </td>
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Schedule Section End -->