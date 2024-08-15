<!-- Footer -->
<footer class="footer bg-primary py-4">
    <div class="container">
        <div class="row">
            <div class="col-md-4 my-3">
                <img src="/images/web/footer-logo.png" alt="" width="150" />
            </div>
            <div class="col-md-4 my-3">
                <h6 class="text-light"><?php echo $footerLinks['title']; ?></h6>
                <ul class="list-unstyled">
                    <li class="text-dark fw-bold text-uppercase">
                        <?php echo $footerLinks['subtitle1']; ?>
                    </li>
                    <li class="text-warning">
                        <a href="#" class="footer-link"><?php echo $footerLinks['link1']; ?></a> |
                        <a href="/privacy" class="footer-link"><?php echo $footerLinks['link2']; ?></a>
                    </li>
                    <li>
                        <a href="#" class="footer-link"><?php echo $footerLinks['link3']; ?></a>
                    </li>
                    <li class="text-dark fw-bold text-uppercase">
                        <?php echo $footerLinks['subtitle2']; ?>
                    </li>
                    <li class="text-warning">
                        <a href="/" class="footer-link"><?php echo $footerLinks['link4']; ?></a> |
                        <a href="/about" class="footer-link"><?php echo $footerLinks['link5']; ?></a> |
                        <a href="/contacto" class="footer-link"><?php echo $footerLinks['link6']; ?></a> |
                        <a href="/blog" class="footer-link"><?php echo $footerLinks['link7']; ?></a>
                    </li>
                </ul>
            </div>
            <div class="col-md-4 my-3 footer-social">
                <div class="mb-4">
                    <a href="https://www.instagram.com/durgga_psicologia/" class="text-decoration-none" target="_blank">
                        <i class="fab fa-instagram fa-2x text-light mx-2"></i>
                    </a>
                    <a href="https://www.linkedin.com/in/mamen-carrasco-ben%C3%ADtez-20496956" class="text-decoration-none" target="_blank">
                        <i class="fab fa-linkedin fa-2x text-light mx-2"></i>
                    </a>
                </div>
                <p class="text-light">
                    <?php echo $footerLinks['socialText']; ?>
                </p>
                <div class="row">
                    <div class="col-12">
                        <i class="fa fa-phone fa-1x text-light mx-2"></i>
                        <a href="tel:34651786502" class="footer-link">+34 651786502</a>

                    </div>
                    <div class="col-12">
                        <i class="fa fa-envelope fa-1x text-light mx-2"></i>
                        <a href="mailto:info@durgga.com" class="footer-link">info@durgga.com</a>
                    </div>
                </div>
                <!--
                <p class="copyright">
                    web by <a href="https://www.xavrod.com" class="copyright-link" target="_blank">xavrod</a>
                </p>
                -->

            </div>
        </div>
    </div>
</footer>

<!-- To the Top Button -->
<button id="to-top" class="to-top-btn">
    <img src="/images/web/up-arrow.png" alt="" />
</button>

<!-- JS -->
<script src="/js/script.js"></script>
<script src="/js/bootstrap.bundle.min.js"></script>
</body>

</html>