<?php include $this->resolve("partials/_header.php"); ?>

<?php
// Intelephense Error
/**  @var object $newsletterList */
//showNice($errors);
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
                        <a class="link-light text-decoration-none" href="/admin/newsletter">X</a>
                    </div>
                </div>
                <?php unset($_SESSION['CRUDMessage']); ?>
            <?php endif; ?>
            <!-- HEADER -->
            <div class="d-flex">
                <div class="p-2 flex-grow-1"><?php echo $sitemap ?></div>
                <div class="p-2">
                    <!-- Back -->
                    <a class="link-primary" href="/admin/newsletter">Back</a>
                </div>
            </div>
        </div>

        <hr class="hr-heading-page w-100 my-2">

        <!-- Form -->
        <form method="POST" class="contacto-form p-4">
            <!-- CSRF TOKEN  -->
            <?php include $this->resolve('partials/_csrf.php'); ?>

            <div class="row bg-light justify-content-center p-4 mb-5">

                <!-- NEWSLETTER FORM TO SEND -->
                <div class="col-lg-2">
                </div>
                <div class="col-lg-8 offset-lg-1 bg-dark text-center text-white my-4 p-2 rounded">
                    NEWSLETTER
                </div>
                <!-- RESUBJECT -->
                <div class="col-lg-2 bg-secondary text-center text-light text-uppercase fw-400 my-2 p-2 rounded">
                    Subject
                </div>
                <div class="col-lg-8 offset-lg-1 bg-info text-primary my-2 p-2 rounded">
                    <input type="text" class="form-control border-2" id="subject" name="subject" placeholder="Titulo Newsletter" maxlength="250">
                </div>
                <!-- Error Message -->
                <?php if (array_key_exists('subject', $errors)) : ?>
                    <div class="col-lg-2">
                    </div>
                    <div class="col-lg-8 offset-lg-1 text-danger fst-italic my-0 px-2 rounded">
                        <?php echo ($errors['subject'][0]); ?>
                    </div>
                <?php endif; ?>
                <!-- MESSAGE -->
                <div class="col-lg-2 bg-secondary text-center text-light text-uppercase fw-400 my-2 p-2 rounded">
                    Message
                </div>
                <div class="col-lg-8 offset-lg-1 bg-info text-primary my-2 p-2 rounded">
                    <textarea name="answer" id="trumbowyg-editor" rows="10" cols="50" class="w-100 rounded"><?php include $this->resolve('partials/_newsletterTemplate.php'); ?></textarea>
                </div>
                <!-- Error Message -->
                <?php if (array_key_exists('answer', $errors)) : ?>
                    <div class="col-lg-2">
                    </div>
                    <div class="col-lg-8 offset-lg-1 text-danger fst-italic my-0 px-2 rounded">
                        <?php echo ($errors['answer'][0]); ?>
                    </div>
                <?php endif; ?>
                <!-- Submit -->
                <div class="col-lg-2">
                </div>
                <div class="col-lg-8 offset-lg-1 my-2 p-2 rounded">
                    <button class="btn btn-secondary w-100" type="submit">Submit</button>
                </div>
                <!-- Back -->
                <div class="col-lg-2">
                </div>
                <div class="col-lg-8 offset-lg-1 my-2 p-2 rounded">
                    <a href="/admin/newsletter" class="btn btn-warning w-100" role="button">Back</a>
                </div>

            </div>

        </form>

    </div>

    </div>
</section>



<?php include $this->resolve("partials/_footer.php"); ?>