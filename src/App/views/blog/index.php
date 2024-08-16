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
        <h2 class="fw-bold text-primary"><?php echo $blogWebTexts['title']; ?></h2>
        <hr class="hr-heading-page w-100">


        <!-- Blog, 1 row 3 col per row with cards -->
        <section id="blog" class="blog bg-light py-5">
            <div class="container">
                <h5 class="text-center fw-bold text-primary pb-4">
                    <?php echo $blogWebTexts['subtitle']; ?>
                </h5>
                <!-- Blog Row 1 -->

                <div class="row mb-4 justify-content-center">

                    <?php foreach ($blogList as $blog) : ?>
                        <?php if ($blog->published === 1) : ?>
                            <div class="col-lg-4 col-md-4 my-4">
                                <div class="card">
                                    <a href="/blog/<?php echo $blog->blogId ?>">
                                        <img src="<?php echo "/images/blog/" . $blog->image; ?>" class="card-img" alt="" />
                                    </a>
                                    <div class="card-body">
                                        <h5 class="card-title"><?php echo $blog->title; ?></h5>
                                        <p class="card-text">
                                            <?php echo excerpt($blog->content, 50); ?>
                                            <a href="/blog/<?php echo $blog->blogId ?>" class="blog-link">Leer Más</a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; ?>

                </div>

                <div class="col-lg-12 my-4 text-center">
                    <a href="/" class="btn btn-primary mt-4"><?php echo $blogWebTexts['button']; ?></a>
                </div>

            </div>
        </section>


    </div>
</section>

<?php include $this->resolve("partials/_footer.php"); ?>