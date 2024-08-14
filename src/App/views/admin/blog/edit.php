<?php include $this->resolve("partials/_header.php"); ?>

<?php
// Intelephense Error
/**  @var object $blog */
/**  @var array $tags */
/**  @var array $selectedTags */
/**  @var array $categories */
//showNice($categories);
?>

<section id="contact-table" class="bg-info py-4">
    <div class="container bg-light">
        <div class="row">
            <!-- FLASH MESSAGE CRUD -->
            <?php if (!empty($_SESSION['CRUDMessage'])) : ?>
                <div class="d-flex align-items-center text-white rounded px-2 <?php echo (substr($_SESSION['CRUDMessage'], 0, 5) === 'Error') ? "bg-danger" : "bg-success" ?>">
                    <div class="p-2 flex-grow-1">
                        <?php echo $_SESSION['CRUDMessage']; ?>
                    </div>
                    <div class="p-2">
                        <a class="link-light text-decoration-none" href="/admin/contact">X</a>
                    </div>
                </div>
                <?php unset($_SESSION['CRUDMessage']); ?>
            <?php endif; ?>
            <!-- HEADER -->
            <div class="d-flex">
                <div class="p-2 flex-grow-1"><?php echo $sitemap ?></div>
                <div class="p-2">
                    <!-- NEW contact -->
                    <a class="link-primary" href="/admin/blog/<?php echo $blog->id ?>">Back</a>
                </div>
            </div>
        </div>

        <hr class="hr-heading-page w-100 my-2">

        <div class="row text-center my-4">
            <h4 class="text-primary"><?php echo $header; ?></h4>
        </div>

        <hr>

        <!-- Form -->
        <form method="POST" class="contacto-form p-4">
            <!-- CSRF TOKEN  -->
            <?php include $this->resolve('partials/_csrf.php'); ?>

            <div class="row bg-light justify-content-center p-4 mb-5">
                <!-- DATE -->
                <div class="col-lg-2 bg-warning text-light text-uppercase fw-400 my-2 p-2 rounded">
                    Created
                </div>
                <div class="col-lg-8 offset-lg-1 bg-info text-primary my-2 p-2 rounded">
                    <input value="<?php echo $blog->formatted_date ?>" name="date" type="date" class="form-control" />
                </div>
                <!-- Error Message -->
                <?php if (array_key_exists('date', $errors)) : ?>
                    <div class="col-lg-2">
                    </div>
                    <div class="col-lg-8 offset-lg-1 text-danger fst-italic my-0 px-2 rounded">
                        <?php echo ($errors['date'][0]); ?>
                    </div>
                <?php endif; ?>
                <!-- Published  -->
                <div class="col-lg-2 <?php echo ($blog->published === 0) ? 'bg-danger' : 'bg-success'; ?> text-light text-uppercase fw-400 my-2 p-2 rounded">
                    Published
                </div>
                <div class="col-lg-8 offset-lg-1 bg-info text-primary my-2 p-2 rounded">
                    <select name="published" id="published" class="form-control">
                        <option value="0" <?php echo ($blog->published === 0) ? "selected" : "" ?>>No</option>
                        <option value="1" <?php echo ($blog->published === 1) ? "selected" : "" ?>>Yes</option>
                    </select>
                </div>
                <!-- Author -->
                <div class="col-lg-2 bg-warning text-light text-uppercase fw-400 my-2 p-2 rounded">
                    Author
                </div>
                <div class="col-lg-8 offset-lg-1 bg-info text-primary my-2 p-2 rounded">
                    <input type="text" class="form-control border-2" id="author" name="author" value="<?php echo $blog->author; ?>" maxlength="250">
                </div>
                <!-- Error Message -->
                <?php if (array_key_exists('author', $errors)) : ?>
                    <div class="col-lg-2">
                    </div>
                    <div class="col-lg-8 offset-lg-1 text-danger fst-italic my-0 px-2 rounded">
                        <?php echo ($errors['author'][0]); ?>
                    </div>
                <?php endif; ?>
                <!-- Title -->
                <div class="col-lg-2 bg-warning text-light text-uppercase fw-400 my-2 p-2 rounded">
                    Title
                </div>
                <div class="col-lg-8 offset-lg-1 bg-info text-primary my-2 p-2 rounded">
                    <input type="text" class="form-control border-2" id="title" name="title" value="<?php echo $blog->title; ?>" maxlength="250">
                </div>
                <!-- Error Message -->
                <?php if (array_key_exists('title', $errors)) : ?>
                    <div class="col-lg-2">
                    </div>
                    <div class="col-lg-8 offset-lg-1 text-danger fst-italic my-0 px-2 rounded">
                        <?php echo ($errors['title'][0]); ?>
                    </div>
                <?php endif; ?>
                <!-- Send -->
                <div class="col-lg-2">
                </div>
                <div class="col-lg-8 offset-lg-1 my-2 p-2 rounded">
                    <button class="btn btn-secondary w-100" type="submit">Submit</button>
                </div>

                <!-- Back -->
                <div class="col-lg-2">
                </div>
                <div class="col-lg-8 offset-lg-1 my-2 p-2 rounded">
                    <a href="/admin/blog/<?php echo $blog->id; ?>" class="btn btn-warning w-100" role="button">Back</a>
                </div>

            </div>

        </form>

    </div>

    </div>
</section>



<?php include $this->resolve("partials/_footer.php"); ?>