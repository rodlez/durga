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
                    <!-- Tag -->
                    <div class="mb-4">
                        <label for="name" class="form-label">Tag</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="name" name="name" value="<?php echo ($oldFormData['name'] ?? ''); ?>" placeholder="">
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
                            <input type="text" class="form-control" id="lang" name="lang" value="<?php echo ($oldFormData['lang'] ?? ''); ?>" placeholder="">
                        </div>
                    </div>
                    <!-- Error Message -->
                    <?php if (array_key_exists('lang', $errors)) : ?>
                        <div class="text-danger fst-italic mb-4 p-2 rounded"><?php echo ($errors['lang'][0]); ?></div>
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