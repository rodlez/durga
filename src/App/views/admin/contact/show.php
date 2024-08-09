<?php include $this->resolve("partials/_header.php"); ?>

<?php
// Intelephense Error
/**  @var object $contact */
//showNice($contact);
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

        <div class="row bg-light justify-content-center p-4 mb-5">
            <div class="col-lg-2 bg-warning text-light text-uppercase fw-400 my-2 p-2 rounded">
                Date
            </div>
            <div class="col-lg-8 offset-lg-1 bg-info text-primary my-2 p-2 rounded">
                <?php echo $contact->created_at; ?>
            </div>
            <div class="col-lg-2 <?php echo ($contact->status === 0) ? 'bg-danger' : 'bg-success'; ?> text-light text-uppercase fw-400 my-2 p-2 rounded">
                Answer
            </div>
            <div class="col-lg-8 offset-lg-1 bg-info text-primary my-2 p-2 rounded">
                <?php echo ($contact->status === 0) ? 'No' : 'YES'; ?>
            </div>
            <div class="col-lg-2 bg-warning text-light text-uppercase fw-400 my-2 p-2 rounded">
                Nombre
            </div>
            <div class="col-lg-8 offset-lg-1 bg-info text-primary my-2 p-2 rounded">
                <?php echo $contact->name; ?>
            </div>
            <div class="col-lg-2 bg-warning text-light text-uppercase fw-400 my-2 p-2 rounded">
                Email
            </div>
            <div class="col-lg-8 offset-lg-1 bg-info text-primary my-2 p-2 rounded">
                <?php echo $contact->email; ?>
            </div>
            <div class="col-lg-2 bg-warning text-light text-uppercase fw-400 my-2 p-2 rounded">
                Phone
            </div>
            <div class="col-lg-8 offset-lg-1 bg-info text-primary my-2 p-2 rounded">
                <?php echo $contact->phone; ?>
            </div>
            <div class="col-lg-2 bg-warning text-light text-uppercase fw-400 my-2 p-2 rounded">
                Subject
            </div>
            <div class="col-lg-8 offset-lg-1 bg-info text-primary my-2 p-2 rounded">
                <?php echo $contact->subject; ?>
            </div>
            <div class="col-lg-2 bg-warning text-light text-uppercase fw-400 my-2 p-2 rounded">
                Message
            </div>
            <div class="col-lg-8 offset-lg-1 bg-info text-primary my-2 p-2 rounded">
                <p class="p-2"><?php echo $contact->message; ?></p>
            </div>
            <div class="col-lg-2 bg-warning text-light text-uppercase fw-400 my-2 p-2 rounded">
                Comments
            </div>
            <div class="col-lg-8 offset-lg-1 bg-info text-primary my-2 p-2 rounded">
                <p class="p-2"><?php echo $contact->comments; ?></p>
            </div>

        </div>

        <hr class="hr-heading-page w-100 my-2">

        <div class="row bg-light justify-content-center align-items-center py-4">
            <!-- BUTTONS -->
            <div class="col-lg-4 my-2">
                <a href="/admin/contact" class="btn btn-dark w-100" role="button">Edit</a>
            </div>
            <div class="col-lg-4 my-2">
                <a href="/admin/contact" class="btn btn-success w-100" role="button">Answer</a>
            </div>
            <div class="col-lg-4 my-2">
                <a href="/admin/contact" class="btn btn-warning w-100" role="button">Back</a>
            </div>
        </div>
    </div>



    </div>
</section>



<?php include $this->resolve("partials/_footer.php"); ?>