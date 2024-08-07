<?php include $this->resolve("partials/_header.php"); ?>

<!-- Section Start Here -->
<section id="#" class="py-4">
    <!-- Container -->
    <div class="container">
        <!-- Title -->
        <h2 class="fw-bold text-primary py-4 title-page"><?php echo escapeChar($title); ?></h2>
        <hr class="hr-heading-page">
        <div class="row">

            <div class="col-10 offset-1 bg-light">

                <h1><?php echo $title; ?></h1>
            </div>

            <div class="col-10 offset-1">
                Gracias por suscribirte.
                <a href="/" class="btn btn-primary">Volver</a>
            </div>

        </div>

    </div>
</section>



<?php include $this->resolve("partials/_footer.php"); ?>