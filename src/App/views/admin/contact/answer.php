<?php include $this->resolve("partials/_header.php"); ?>

<?php
// Intelephense Error
/**  @var object $contact */
//showNice($contact);
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
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
                    <a class="link-primary" href="/admin/contact">Back</a>
                </div>
            </div>
        </div>

        <hr class="hr-heading-page w-100 my-2">

        <div class="row text-center my-4">
            <h4 class="text-primary"><?php echo $header; ?></h4>
        </div>

        <hr>

        <h1><?php echo $resultado; ?></h1>

        <h3><?php echo $contact->name; ?></h3>

        <h3><?php echo $contact->email; ?></h3>



        <hr class="hr-heading-page w-100 my-2">

        <div class="row bg-light justify-content-center align-items-center py-4">
            <!-- BUTTONS -->
            <div class="col-lg-4 my-2">
                <a href="/admin/contact" class="btn btn-warning w-100" role="button">Back</a>
            </div>
        </div>
    </div>



    </div>
</section>



<?php include $this->resolve("partials/_footer.php"); ?>