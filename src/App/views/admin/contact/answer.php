<?php include $this->resolve("partials/_header.php"); ?>

<?php
// Intelephense Error
/**  @var object $contact */
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

        <!-- Form -->
        <form method="POST" class="contacto-form p-4">
            <!-- CSRF TOKEN  -->
            <?php include $this->resolve('partials/_csrf.php'); ?>

            <div class="row bg-light justify-content-center p-4 mb-5">
                <!-- CONTACT INFO -->
                <div class="col-lg-2">
                </div>
                <div class="col-lg-8 offset-lg-1 bg-primary text-white text-center my-2 p-2 rounded">
                    CONTACT INFO
                </div>
                <!-- DATE -->
                <div class="col-lg-2 bg-warning text-light text-center text-uppercase fw-400 my-2 p-2 rounded">
                    Date
                </div>
                <div class="col-lg-8 offset-lg-1 bg-info text-primary my-2 p-2 rounded">
                    <?php echo $contact->formatted_date ?>
                </div>
                <!-- NAME -->
                <div class="col-lg-2 bg-warning text-light text-center text-uppercase fw-400 my-2 p-2 rounded">
                    Name
                </div>
                <div class="col-lg-8 offset-lg-1 bg-info text-primary my-2 p-2 rounded">
                    <?php echo $contact->name; ?>
                </div>
                <!-- EMAIL -->
                <div class="col-lg-2 bg-warning text-light text-center text-uppercase fw-400 my-2 p-2 rounded">
                    Email
                </div>
                <div class="col-lg-8 offset-lg-1 bg-info text-primary my-2 p-2 rounded">
                    <?php echo $contact->email; ?>
                </div>
                <!-- PHONE -->
                <div class="col-lg-2 bg-warning text-light text-center text-uppercase fw-400 my-2 p-2 rounded">
                    Phone
                </div>
                <div class="col-lg-8 offset-lg-1 bg-info text-primary my-2 p-2 rounded">
                    <?php echo $contact->phone; ?>
                </div>
                <?php if ($contact->comments) : ?>
                    <!-- COMMENTS -->
                    <div class="col-lg-2 bg-warning text-light text-center text-uppercase fw-400 my-2 p-2 rounded">
                        Comments
                    </div>
                    <div class="col-lg-8 offset-lg-1 bg-info text-primary my-2 p-2 rounded">
                        <?php echo $contact->comments; ?>
                    </div>
                <?php endif; ?>
                <!-- MESSAGE -->
                <div class="col-lg-2 bg-warning text-light text-center text-uppercase fw-400 my-2 p-2 rounded">
                    Message
                </div>
                <div class="col-lg-8 offset-lg-1 bg-info text-primary my-2 p-2 rounded">
                    <?php echo $contact->message; ?>
                </div>
                <!-- SUBJECT -->
                <div class="col-lg-2 bg-warning text-light text-center text-uppercase fw-400 my-2 p-2 rounded">
                    Subject
                </div>
                <div class="col-lg-8 offset-lg-1 bg-info text-primary my-2 p-2 rounded">
                    <?php echo $contact->subject; ?>
                </div>
                <!-- FORM ANSWER TO CONTACT -->
                <div class="col-lg-2">
                </div>
                <div class="col-lg-8 offset-lg-1 bg-dark text-center text-white my-4 p-2 rounded">
                    ANSWER TO THE CLIENT
                </div>
                <!-- RESUBJECT -->
                <div class="col-lg-2 bg-secondary text-center text-light text-uppercase fw-400 my-2 p-2 rounded">
                    Subject
                </div>
                <div class="col-lg-8 offset-lg-1 bg-info text-primary my-2 p-2 rounded">
                    <input type="text" class="form-control border-2" id="subject" name="subject" value="Durga Respuesta: <?php echo $contact->subject; ?>" maxlength="50">
                </div>
                <!-- Error Message -->
                <?php if (array_key_exists('subject', $errors)) : ?>
                    <div class="col-lg-2">
                    </div>
                    <div class="col-lg-8 offset-lg-1 text-danger fst-italic my-0 px-2 rounded">
                        <?php echo ($errors['subject'][0]); ?>
                    </div>
                <?php endif; ?>
                <!-- ANSWER -->
                <div class="col-lg-2 bg-secondary text-center text-light text-uppercase fw-400 my-2 p-2 rounded">
                    Answer
                </div>
                <div class="col-lg-8 offset-lg-1 bg-info text-primary my-2 p-2 rounded">
                    <textarea name="answer" id="trumbowyg-editor" rows="10" cols="50" class="w-100 rounded"><?php include $this->resolve('partials/_mailanswer.php'); ?></textarea>
                </div>
                <!-- Error Message -->
                <?php if (array_key_exists('answer', $errors)) : ?>
                    <div class="col-lg-2">
                    </div>
                    <div class="col-lg-8 offset-lg-1 text-danger fst-italic my-0 px-2 rounded">
                        <?php echo ($errors['answer'][0]); ?>
                    </div>
                <?php endif; ?>
                <!-- Original question message -->
                <input value="<?php echo $contact->message; ?>" name="message" type="hidden" />
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
                    <a href="/admin/contact/<?php echo $contact->id ?>" class="btn btn-warning w-100" role="button">Back</a>
                </div>

            </div>

        </form>

    </div>

    </div>
</section>



<?php include $this->resolve("partials/_footer.php"); ?>