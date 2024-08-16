<?php include $this->resolve("partials/_header.php"); ?>
<?php
// Intelephense Error
/**  @var object $blog */
/**  @var object $images */
/**  @var object $blogTrans */
/**  @var array $tags */
// showNice($images);
?>

<!-- Blog -->
<section id="blog" class="blog bg-info py-4">
    <div class="container">
        <h2 class="fw-bold text-primary"><?php echo $blogTrans->title ?></h2>
        <hr class="hr-heading-page w-100">

        <p><?php echo $blog->author; ?> | <?php echo $blog->created_at ?> | <?php echo $category ?></p>
        <hr>

        <div class="row pb-4 pt-2">
            <div class="col-lg-12">
                <img src="<?php echo "/images/blog/" . $images[0]->storage_filename; ?>" class="img-fluid" alt="">
            </div>
            <div class="col-lg-12 mt-4">
                <p><?php echo $blogTrans->content ?></p>
            </div>
            <hr>
            <div class="row pb-4 pt-1">
                <div class="col-lg-3 text-light">
                    <?php foreach ($tags as $tag) : ?>
                        <span class="badge bg-warning fst-italic rounded-1 p-3"><?php echo $tag; ?></span>
                    <?php endforeach; ?>
                </div>
            </div>

        </div>

        <div class="col-lg-12 mb-4 text-center">
            <a href="/blog" class="btn btn-primary mt-4"><?php echo $blogContentText['button']; ?></a>
        </div>

    </div>
</section>

<?php include $this->resolve("partials/_footer.php"); ?>