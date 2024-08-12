<?php include $this->resolve("partials/_header.php"); ?>
<?php
// Intelephense Error
/**  @var object $blog */
/**  @var object $images */
/**  @var object $blogTotal */
/**  @var array $tags */
// showNice($images);
?>

<!-- Blog -->
<section id="blog" class="blog bg-info py-4">
    <div class="container">
        <h2 class="fw-bold text-primary text-center"><?php echo escapeChar($title); ?></h2>
        <hr class="hr-heading-page w-100">


        <h4 class="text-start fw-bold text-primary pb-0">
            <?php echo $blog->title ?>
        </h4>
        <p><?php echo $blog->author; ?> | <?php echo $blog->created_at ?> | <?php echo $category ?></p>
        <hr>

        <div class="row pb-4 pt-2">
            <div class="col-lg-12">
                <img src="<?php echo "/images/blog/" . $images[0]->storage_filename; ?>" class="img-fluid" alt="">
            </div>
            <div class="col-lg-12 mt-4">


                <p><?php echo $blog->content ?></p>



            </div>
            <hr>
            <div class="row pb-4 pt-1">
                <div class="col-lg-3 text-ligh">
                    <?php foreach ($tags as $tag) : ?>
                        <span class="badge bg-primary fst-italic rounded-1 p-3"><?php echo $tag; ?></span>
                    <?php endforeach; ?>
                </div>
            </div>

        </div>

        <div class="col-lg-12 mb-4 text-center">
            <a href="/blog" class="fw-bolder text-decoration-none">Volver</a>
        </div>


    </div>
</section>

<?php include $this->resolve("partials/_footer.php"); ?>