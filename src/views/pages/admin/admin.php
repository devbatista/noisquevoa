<div class="row">
    <div class="col-lg-3">
        <div class="ibox ">
            <div class="ibox-title">
                <span class="label label-danger float-right"><?= date('Y') ?></span>
                <h5>Jogos</h5>
            </div>
            <div class="ibox-content">
                <h1 class="no-margins"><b>0</b></h1>
            </div>
        </div>
    </div>
    <div class="col-lg-3">
        <div class="ibox ">
            <div class="ibox-title">
                <span class="label label-danger float-right"><?= date('Y') ?></span>
                <h5>Vitórias</h5>
            </div>
            <div class="ibox-content">
                <h1 class="no-margins"><b>0</b></h1>
            </div>
        </div>
    </div>
    <div class="col-lg-3">
        <div class="ibox ">
            <div class="ibox-title">
                <span class="label label-danger float-right"><?= date('Y') ?></span>
                <h5>Derrotas</h5>
            </div>
            <div class="ibox-content">
                <h1 class="no-margins"><b>0</b></h1>
            </div>
        </div>
    </div>
    <div class="col-lg-3">
        <div class="ibox ">
            <div class="ibox-title">
                <span class="label label-danger float-right"><?= date('Y') ?></span>
                <h5>Empates</h5>
            </div>
            <div class="ibox-content">
                <h1 class="no-margins"><b>0</b></h1>
            </div>
        </div>
    </div>
</div>
<div class="wrapper wrapper-content">
    <div class="row">
        <div class="col-lg-12">
            <div class="row">
                <div class="col-lg-4">
                    <div class="ibox ">
                        <div class="ibox-title">
                            <h5>Próximas partidas</h5>
                        </div>
                        <!-- <div class="ibox-content">

                        </div>
                        <div class="ibox-content">
                            
                        </div> -->
                    </div>
                    <div class="ibox ">
                        <div class="ibox-title">
                            <h5>Partidas anteriores</h5>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="ibox ">
                        <div class="ibox-title">
                            <h5>Classificação Futliga</h5>
                        </div>
                        <div class="ibox-content">
                            <div>
                                <table class="table text-center p-0">
                                    <thead>
                                        <tr>
                                            <th scope="col">POS</th>
                                            <th scope="col">TIME</th>
                                            <th scope="col">PTS</th>
                                            <th scope="col">JGS</th>
                                        </tr>
                                    </thead>
                                    <tbody classificacaoFutLiga>
                                        <tr>
                                            <th scope="row">1º</th>
                                            <td style="padding: 3px"><img src="<?= $base ?>/assets/img/escudo.jpg" alt="NQV" class="imgClassificacao"></td>
                                            <td>0</td>
                                            <td>0</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="ibox ">
                        <div class="ibox-title">
                            <h5>Assistências</h5>
                        </div>
                        <div class="ibox-content">
                            <div>
                                <table class="table text-center p-0">
                                    <thead>
                                        <tr>
                                            <th scope="col">POS</th>
                                            <th scope="col">JOGADOR</th>
                                            <th scope="col">ASS</th>
                                            <th scope="col">JGS</th>
                                        </tr>
                                    </thead>
                                    <tbody classificacaoAssistencias>
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="ibox ">
                        <div class="ibox-title">
                            <h5>Artilharia</h5>
                        </div>
                        <div class="ibox-content">
                            <div>
                                <table class="table text-center p-0">
                                    <thead>
                                        <tr>
                                            <th scope="col">POS</th>
                                            <th scope="col">JOGADOR</th>
                                            <th scope="col">GOLS</th>
                                            <th scope="col">JGS</th>
                                        </tr>
                                    </thead>
                                    <tbody classificacaoArtilharia>
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>
</div>

<script type="text/javascript" src="<?= $base ?>/assets/js/admin/admin.js"></script>