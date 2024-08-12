<?php include $this->resolve("partials/_header.php"); ?>
<?php
// Intelephense Error
/**  @var object $blog */
/**  @var object $images */
/**  @var object $blogTotal */
/**  @var array $tags */
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

                <h4><?php echo $blog->title ?></h4>

                <h5><?php echo $blog->subtitle ?></h5>

                <p><?php echo $blog->author ?></p>

                <p><?php echo $category ?></p>

                <p><?php echo $blog->created_at ?></p>

                <img src="<?php echo "/images/blog/" . $images[0]->storage_filename; ?>" width="150" alt="image">

                <p><?php echo $blog->content ?></p>

                <div class="col-lg-2 bg-warning text-light text-uppercase fw-400 my-2 p-2 rounded">
                    Tags
                </div>
                <div class="col-lg-8 offset-lg-1 bg-info text-primary my-2 p-2 rounded">
                    <?php foreach ($tags as $tag) :
                        echo "$tag | ";
                    endforeach;
                    ?>
                </div>

            </div>
        </section>


    </div>
</section>

<?php include $this->resolve("partials/_footer.php"); ?>