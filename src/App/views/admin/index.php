<?php include $this->resolve("partials/_header.php"); ?>

<!-- Section Start Here -->
<section id="#" class="py-4">
    <!-- Container -->
    <div class="container">
        <!-- Title -->
        <h2 class="fw-bold text-primary py-4 title-page"><?php echo escapeChar($title); ?></h2>
        <hr class="hr-heading-page">
        <p><?php echo $sitemap; ?></p>

        <div class="row">

            <div class="col-10 offset-1 bg-light my-2">
                <a href="/admin/newsletter" class="btn btn-primary">Newsletter</a>
            </div>

            <div class="col-10 offset-1 bg-light my-2">
                <a href="/admin/newsletter/send" class="btn btn-primary">Enviar Newsletter</a>
            </div>

            <div class="col-10 offset-1 bg-light my-2">
                <a href="/admin/contact" class="btn btn-primary">Contact</a>
            </div>

            <div class="col-10 offset-1 bg-light my-2">
                <a href="/admin/blog" class="btn btn-primary">Blog</a>
            </div>

            <div class="col-10 offset-1 bg-light my-2">
                <a href="/admin/category" class="btn btn-primary">Blog Categories</a>
            </div>

            <div class="col-10 offset-1 bg-light my-2">
                <a href="/admin/tag" class="btn btn-primary">Blog Tags</a>
            </div>

        </div>

    </div>
</section>

<?php include $this->resolve("partials/_footer.php"); ?>