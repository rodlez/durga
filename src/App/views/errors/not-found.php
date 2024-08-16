<?php include $this->resolve("partials/_header.php"); ?>

<section class="sesion mb-0 bg-light sesion-bg">
    <div class="container">
        <div class="row">
            <div class="col-12 py-4">
                <div class="text-center py-6 rounded-4 sesion-card">
                    <div class="w-75 m-auto sesion-text">
                        <h2 class="display-5 fw-bold text-light"><?php echo $content['subtitle']; ?></h2>
                        <p class="text-light mt-4">
                            <?php echo $content['content']; ?>
                        </p>
                        <div class="col my-4">
                            <a href="https://www.instagram.com/durgga_psicologia/" class="text-decoration-none" target="_blank">
                                <i class="fab fa-instagram fa-2x text-light mx-2"></i>
                            </a>
                            <a href="https://www.linkedin.com/in/mamen-carrasco-ben%C3%ADtez-20496956" class="text-decoration-none" target="_blank">
                                <i class="fab fa-linkedin fa-2x text-light mx-2"></i>
                            </a>
                        </div>

                        <a href="/" class="btn btn-primary mt-4">
                            <?php echo $content['button']; ?>
                        </a>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include $this->resolve("partials/_footer.php"); ?>