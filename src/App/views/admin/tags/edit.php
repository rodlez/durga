<?php include $this->resolve("partials/_header.php"); ?>

<?php
// Intelephense Error
/**  @var object $tag */
?>

<section id="newsletter-create" class="bg-info py-4">
    <!-- Container -->
    <div class="container  bg-light">

        <div class="row">
            <!-- HEADER -->
            <div class="d-flex">
                <div class="p-2 flex-grow-1"><?php echo $sitemap ?></div>
                <div class="p-2">
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
                            <span class="input-group-text bg-primary">
                                <i class="fa fa-envelope fa-1x text-light"></i>
                            </span>
                            <input type="text" class="form-control" id="tag" name="tag" value="<?php echo $tag->name; ?>" placeholder="">
                        </div>
                    </div>
                    <!-- Error Message -->
                    <?php if (array_key_exists('tag', $errors)) : ?>
                        <div class="text-danger fst-italic mb-4 p-2 rounded"><?php echo ($errors['tag'][0]); ?></div>
                    <?php endif; ?>
                    <!-- Send -->
                    <p>Created: <?php echo date("d/m/Y", strtotime($tag->created_at)); ?> | Updated: <?php echo date("d/m/Y", strtotime($tag->updated_at)); ?></p>
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


<section class="max-w-2xl mx-auto my-12 p-4 bg-white shadow-md border border-gray-200 rounded">
    <!-- FLASH MESSAGE CRUD -->
    <?php if (!empty($_SESSION['CRUDMessage'])) : ?>
        <div class="row my-2">
            <?php if (substr($_SESSION['CRUDMessage'], 0, 5) === 'Error') :
            ?><div class="col p-2 text-white bg-danger rounded"><?php echo $_SESSION['CRUDMessage']; ?></div>
            <?php else : ?>
                <div class="col p-2 text-white bg-success rounded"><?php echo $_SESSION['CRUDMessage']; ?></div>
            <?php endif; ?>
        </div>
    <?php unset($_SESSION['CRUDMessage']);
    endif; ?>
    <!-- Header -->
    <div class="row">
        <h6><?php echo $sitemap ?></h6>
    </div>
    <hr />
    <form method="POST" class="grid grid-cols-1 gap-6">
        <!-- CSRF TOKEN  -->
        <?php include $this->resolve('./partials/_csrf.php'); ?>

        <label class="block">
            <span class="text-gray-700"><?php echo $header ?></span>
            <input value="<?php echo $tag->name ?>" name="tag" type="text" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" placeholder="" />
            <?php if (array_key_exists('tag', $errors)) : ?>
                <div class="bg-gray-100 mt-2 p-2 text-red-500"><?php echo ($errors['tag'][0]); ?></div>
            <?php endif; ?>
        </label>
        <p>Created: <?php echo date("d/m/Y", strtotime($tag->created_at)); ?> | Updated: <?php echo date("d/m/Y", strtotime($tag->updated_at)); ?></p>
        <button type="submit" class="block w-full py-2 bg-indigo-600 text-white rounded">
            Submit
        </button>
    </form>

    <div class="d-grid mt-2 gap-2">
        <a href="/admin/tag" class="btn btn-primary" role="button">Back</a>
    </div>

</section>

<?php include $this->resolve("partials/_footer.php"); ?>