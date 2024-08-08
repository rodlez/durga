<?php include $this->resolve("partials/_header.php"); ?>

<?php
// Intelephense Error
/**  @var object $email */
showNice($email);
?>

<!-- Section Start Here -->
<section id="newsletter-create" class="bg-info py-4">
    <!-- Container -->
    <div class="container  bg-light">

        <div class="row">
            <!-- HEADER -->
            <div class="d-flex">
                <div class="p-2 flex-grow-1"><?php echo $sitemap ?></div>
                <div class="p-2">
                    <!-- NEW Newsletter -->
                    <a class="link-dark text-decoration-none fw-bold" href="/admin/newsletter">Back</a>
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
                    <!-- Email -->
                    <div class="mb-4">
                        <label for="email" class="form-label">Email</label>
                        <div class="input-group">
                            <span class="input-group-text bg-primary">
                                <i class="fa fa-envelope fa-1x text-light"></i>
                            </span>
                            <input type="email" class="form-control" id="email" name="email" value="<?php echo $email->email; ?>" placeholder="">
                        </div>
                    </div>
                    <!-- Error Message -->
                    <?php if (array_key_exists('email', $errors)) : ?>
                        <div class="text-danger fst-italic mb-4 p-2 rounded"><?php echo ($errors['email'][0]); ?></div>
                    <?php endif; ?>
                    <!-- FLASH MESSAGE CRUD -->
                    <?php if (!empty($_SESSION['CRUDMessage'])) : ?>
                        <div class="d-flex align-items-center text-white rounded mb-4 px-2 <?php echo (substr($_SESSION['CRUDMessage'], 0, 5) === 'Error') ? "bg-danger" : "bg-success" ?>">
                            <div class="p-2 flex-grow-1">
                                <?php echo $_SESSION['CRUDMessage']; ?>
                            </div>
                            <div class="p-2">
                                <a class="link-light text-decoration-none" href="/admin/newsletter/<?php echo $email->id; ?>">X</a>
                            </div>
                        </div>
                        <?php unset($_SESSION['CRUDMessage']); ?>
                    <?php endif; ?>
                    <!-- Send -->
                    <p>Created: <?php echo date("d/m/Y", strtotime($email->created_at)); ?> | Updated: <?php echo date("d/m/Y", strtotime($email->updated_at)); ?></p>
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