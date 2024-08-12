<?php include $this->resolve("partials/_header.php"); ?>
<?php
// Intelephense Error
/**  @var object $blogList */
/**  @var object $images */
/**  @var object $blogTotal */
//showNice($blogTotal);
?>

<!-- Blog -->
<section id="blog" class="blog bg-info py-4">
    <div class="container">
        <h2 class="fw-bold text-primary"><?php echo escapeChar($title); ?></h2>
        <hr class="hr-heading-page">


        <!-- Blog, 1 row 3 col per row with cards -->
        <section id="blog" class="blog bg-light py-5">
            <div class="container">
                <h2 class="text-center fw-bold text-primary pb-4">
                    Blog
                </h2>
                <!-- Blog Row 1 -->

                <div class="row mb-4 justify-content-center">

                    <?php foreach ($blogTotal as $blog) : ?>

                        <div class="col-lg-4 col-md-4 my-4">
                            <div class="card">
                                <img src="<?php echo "/images/blog/" . $blog['images']->storage_filename; ?>" class="card-img" alt="" />
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo $blog['data']->title; ?></h5>
                                    <p class="card-text">
                                        <?php echo excerpt($blog['data']->content, 50); ?>
                                        <a href="/blog/<?php echo $blog['data']->id; ?>" class="blog-link">Leer Más</a>
                                    </p>
                                </div>
                            </div>
                        </div>


                    <?php endforeach; ?>

                </div>

            </div>
        </section>


    </div>
</section>

<?php include $this->resolve("partials/_footer.php"); ?>