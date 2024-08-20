<?php include $this->resolve("partials/_header.php"); ?>

<!-- Section Start Here -->

<!-- Contacto-->
<section id="contacto" class="contacto bg-info py-4">
    <div class="container">
        <h2 class="fw-bold text-primary"><?php echo $content['title']; ?></h2>
        <hr class="hr-heading-page" />

        <div class="row py-2">

            <div class="col-lg-12">
                <?php echo $content['content']; ?>
            </div>

        </div>

        <div class="col-lg-12 my-4 text-center">
            <a href="/" class="btn btn-primary mt-4"><?php echo $content['button']; ?></a>
        </div>

    </div>
</section>

<?php include $this->resolve("partials/_footer.php"); ?>