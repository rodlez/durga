<?php include $this->resolve("partials/_header.php"); ?>

<?php
// Intelephense Error
/**  @var object $category */
?>

<section id="newsletter-create" class="bg-info py-4">
    <!-- Container -->
    <div class="container  bg-light">

        <div class="row">
            <!-- HEADER -->
            <div class="d-flex">
                <div class="p-2 flex-grow-1"><?php echo $sitemap ?></div>
                <div class="p-2">
                    <a class="link-dark text-decoration-none fw-bold" href="/admin/category">Back</a>
                </div>
            </div>
        </div>
        <hr class="hr-heading-page w-100 my-2">
        <h5 class="text-primary text-center py-4"><?php echo $header; ?></h5>

        <div class="row mb-2">
            <div class="col-8 offset-2">
                <form method="POST" class="grid grid-cols-1 gap-6">
                    <!-- CSRF TOKEN  -->
                    <?php include $this->resolve('./partials/_csrf.php'); ?>
                    <!-- Category -->
                    <div class="mb-4">
                        <label for="name" class="form-label">Category</label>
                        <div class="input-group">
                            <span class="input-group-text bg-primary">
                                <i class="fa fa-envelope fa-1x text-light"></i>
                            </span>
                            <input type="text" class="form-control" id="name" name="name" value="<?php echo $category->name; ?>" placeholder="">
                        </div>
                    </div>
                    <!-- Error Message -->
                    <?php if (array_key_exists('name', $errors)) : ?>
                        <div class="text-danger fst-italic mb-4 p-2 rounded"><?php echo ($errors['name'][0]); ?></div>
                    <?php endif; ?>
                    <!-- Language -->
                    <div class="mb-4">
                        <label for="lang" class="form-label">Language (Use ISO 639-2 Codes)</label>
                        <div class="input-group">
                            <span class="input-group-text bg-primary">
                                <i class="fa fa-envelope fa-1x text-light"></i>
                            </span>
                            <input type="text" class="form-control" id="lang" name="lang" value="<?php echo $category->lang; ?>" placeholder="">
                        </div>
                    </div>
                    <!-- Error Message -->
                    <?php if (array_key_exists('lang', $errors)) : ?>
                        <div class="text-danger fst-italic mb-4 p-2 rounded"><?php echo ($errors['lang'][0]); ?></div>
                    <?php endif; ?>
                    <!-- Send -->
                    <p>Created: <?php echo date("d/m/Y", strtotime($category->created_at)); ?> | Updated: <?php echo date("d/m/Y", strtotime($category->updated_at)); ?></p>
                    <div class="mb-5">
                        <div class="d-grid">
                            <button class="btn btn-primary" type="submit">Submit</button>
                        </div>
                    </div>
                </form>
            </div>

        </div>

    </div>
</section>


<?php include $this->resolve("partials/_footer.php"); ?>