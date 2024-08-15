<?php include $this->resolve("partials/_header.php"); ?>
<!-- Section Start Here -->

<!-- About -->
<section id="about" class="about bg-info py-4">
    <div class="container">
        <h2 class="fw-bold text-primary"><?php echo $content['title']; ?></h2>
        <hr class="hr-heading-page">

        <div class="row">
            <div class="col-lg-5 about-img">
                <img src="./images/web/mamen-about.jpg" class="img-fluid" alt="">
            </div>
            <div class="col-lg-7 bg-warning p-4 about-card">
                <h3 class="about-title"><?php echo $content['header']; ?></h3>
                <p class="text-light my-0"><?php echo $content['subtitle']; ?></p>
                <hr class="hr-heading-pages">
                <span class="about-text">
                    <?php echo $content['boxText']; ?>
                </span>
            </div>

            <div class="col-lg-12 my-5 bg-info">
                <?php echo $content['contentText']; ?>
            </div>


        </div>

        <div class="col-lg-12 my-2 text-center">
            <a href="/" class="btn btn-primary mt-2"><?php echo $content['button']; ?></a>
        </div>

    </div>
</section>

<?php include $this->resolve("partials/_footer.php"); ?>