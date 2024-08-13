<?php include $this->resolve("partials/_header.php"); ?>
<?php
// Intelephense Error
/**  @var object $blogList */
/**  @var object $images */
/**  @var object $blogTotal */
/**  @var array $tags */
//showNice($tags);
?>

<!-- Blog -->
<section id="blog" class="blog bg-info py-4">
    <div class="container">
        <h2 class="fw-bold text-primary"><?php echo $content['title']; ?></h2>
        <hr class="hr-heading-page">


        <!-- Blog, 1 row 3 col per row with cards -->
        <section id="blog" class="blog bg-light py-5">
            <div class="container">
                <h5 class="text-center fw-bold text-primary pb-4">
                    <?php echo $content['subtitle']; ?>
                </h5>
                <!-- Blog Row 1 -->

                <div class="row mb-4 justify-content-center">

                    <?php foreach ($blogTotal as $blog) : ?>
                        <?php if ($blog['data']->published === 1) : ?>
                            <div class="col-lg-4 col-md-6 my-4">
                                <div class="card">
                                    <a href="/blog/<?php echo $blog['data']->id; ?>" class="blog-link">
                                        <img src="<?php echo "/images/blog/" . $blog['images']->storage_filename; ?>" class="card-img" alt="" />
                                    </a>
                                    <div class="card-body">
                                        <h5 class="card-title"><?php echo $blog['data']->title; ?></h5>
                                        <p class="card-text">
                                            <?php echo excerpt($blog['data']->content, 100); ?>
                                        </p>
                                        <hr class="text-primary hr-heading w-100">
                                        <a href="/blog/<?php echo $blog['data']->id; ?>" class="blog-link">Leer Más</a>

                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; ?>

                </div>

                <div class="col-lg-12 my-4 text-center">
                    <a href="/" class="btn btn-primary mt-4"><?php echo $content['button']; ?></a>
                </div>

            </div>
        </section>


    </div>
</section>

<?php include $this->resolve("partials/_footer.php"); ?>