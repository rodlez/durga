<?php include $this->resolve("partials/_header.php"); ?>

<!-- Section Start Here -->
<section id="category-create" class="bg-info py-4">
    <!-- Container -->
    <div class="container  bg-light">

        <div class="row">
            <!-- HEADER -->
            <div class="d-flex">
                <div class="p-2 flex-grow-1"><?php echo $sitemap ?></div>
                <div class="p-2">
                    <a class="link-dark text-decoration-none fw-bold" href="/admin/blog">Back</a>
                </div>
            </div>
        </div>
        <hr class="hr-heading-page w-100 my-2">
        <h5 class="text-primary text-center py-4"><?php echo $header; ?></h5>


        <div class="row mb-2">
            <div class="col-8 offset-2">
                <form enctype="multipart/form-data" method="POST" class="grid grid-cols-1 gap-6">
                    <!-- CSRF TOKEN  -->
                    <?php include $this->resolve('./partials/_csrf.php'); ?>
                    <!-- Image -->
                    <div class="mb-4">
                        <label for="image" class="form-label">Image File (jpg, png or pdf)</label>
                        <input name="image" id="image" type="file" class="" />
                    </div>
                    <!-- Error Message -->
                    <?php if (array_key_exists('image', $errors)) : ?>
                        <div class="text-danger fst-italic mb-4 p-2 rounded">
                            <?php echo ($errors['image'][0]); ?>
                        </div>
                    <?php endif; ?>
                    <div class="mb-5">
                        <div class="d-grid">
                            <button class="btn btn-primary" type="submit">Upload</button>
                        </div>
                    </div>
                </form>
            </div>

        </div>

    </div>

</section>

<?php include $this->resolve("partials/_footer.php"); ?>