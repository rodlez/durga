<?php include $this->resolve("partials/_header.php"); ?>


<section id="tag-create" class="bg-info py-4">
    <!-- Container -->
    <div class="container  bg-light">

        <div class="row">
            <!-- HEADER -->
            <div class="d-flex">
                <div class="p-2 flex-grow-1"><?php echo $sitemap ?></div>
                <div class="p-2">
                    <!-- NEW tag -->
                    <a class="link-dark text-decoration-none fw-bold" href="/admin/tag">Back</a>
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
                    <!-- tag -->
                    <div class="mb-4">
                        <label for="tag" class="form-label">tag</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="tag" name="tag" value="<?php echo ($oldFormData['tag'] ?? ''); ?>" placeholder="">
                        </div>
                    </div>
                    <!-- Error Message -->
                    <?php if (array_key_exists('tag', $errors)) : ?>
                        <div class="text-danger fst-italic mb-4 p-2 rounded"><?php echo ($errors['tag'][0]); ?></div>
                    <?php endif; ?>
                    <!-- Send -->
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