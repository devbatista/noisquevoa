<!-- Footer Section Begin -->
<footer class="footer-section set-bg" data-setbg="<?= $base ?>/assets/site/img/bg-footer.jpg">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-6">
                <div class="fs-logo">
                    <div class="logo">
                        <a href="./index.html"><img src="<?= $base ?>/assets/site/img/logo.png" alt=""></a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 offset-lg-1">
                <div class="fs-logo">
                    <ul>
                        <li><i class="fa fa-envelope"></i> diretoria@noisquevoa.com.br</li>
                        <li><i class="fa fa-phone"></i> (11) 98681-9042</li>
                        <li><i class="fa fa-thumb-tack"></i> Rua Bento Rodrigues Bastos, 193, Capela do Socorro, São Paulo</li>
                        <li><i class="fa fa-clock-o"></i> Todo sábado às 10h00</li>
                    </ul>
                    <div class="fs-social">
                        <a href="#"><i class="fa fa-facebook"></i></a>
                        <a href="#"><i class="fa fa-instagram"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="fs-widget">
                    <h4>Recent News</h4>

                    <div class="fw-item">
                        <h5><a href="#">England win shows they have the spark to go far at World Cup</a></h5>
                        <ul>
                            <li><i class="fa fa-calendar"></i> May 19, 2019</li>
                        </ul>
                    </div>
                    <div class="fw-item">
                        <h5><a href="#">Sri Lanka v Australia: Cricket World Cup 2019 – live!</a></h5>
                        <ul>
                            <li><i class="fa fa-calendar"></i> May 19, 2019</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="copyright-option">
            <div class="row">
                <div class="col-lg-12">
                    <div class="co-text">
                        <p>Copyright &copy;<?= date('Y') ?> Todos os direitos reservados | Criado e desenvolvidor por <a href="https://www.devbatista.com" target="_blank">DevBatista</a></p>
                    </div>
                    <div class="co-widget">
                        <ul>
                            <li><a href="#">Copyright notification</a></li>
                            <li><a href="#">Terms of Use</a></li>
                            <li><a href="#">Privacy Policy</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- Footer Section End -->

<!-- Search model Begin -->
<div class="login-model">
    <div class="h-100 d-flex align-items-center justify-content-center">
        <div class="login-close-switch"><i class="fa fa-close"></i></div>
        <form loginSite class="login-model-form">
            <input type="email" name="email" placeholder="Email" required><br><br>
            <input type="password" name="senha" placeholder="*******" required><br><br><br>
            <button type="submit" class="btn btn-danger">Login</button>
        </form>
    </div>
</div>
<!-- Search model end -->

<!-- Js Plugins -->
<script src="<?= $base ?>/assets/site/js/jquery-3.3.1.min.js"></script>
<script src="<?= $base ?>/assets/plugins/jquery-form/jquery-form.js"></script>
<script src="<?= $base ?>/assets/site/js/popper.min.js"></script>
<script src="<?= $base ?>/assets/site/js/bootstrap.min.js"></script>
<script src="<?= $base ?>/assets/site/js/jquery.magnific-popup.min.js"></script>
<script src="<?= $base ?>/assets/site/js/jquery.slicknav.js"></script>
<script src="<?= $base ?>/assets/plugins/sweetalert/sweetalert.js"></script>
<script src="<?= $base ?>/assets/site/js/owl.carousel.min.js"></script>
<script src="<?= $base ?>/assets/site/js/main.js"></script>

</body>

</html>