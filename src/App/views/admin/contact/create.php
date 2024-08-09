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

        <div class="row text-center my-4">
            <h4 class="text-primary"><?php echo $header; ?></h4>
        </div>

        <hr>

        <!-- Form -->
        <form method="POST" class="contacto-form p-4">
            <!-- CSRF TOKEN  -->
            <?php include $this->resolve('partials/_csrf.php'); ?>

            <div class="row bg-light justify-content-center p-4 mb-5">
                <!-- ANSWER  -->
                <div class="col-lg-2 bg-warning text-light text-uppercase fw-400 my-2 p-2 rounded">
                    Answer
                </div>
                <div class="col-lg-8 offset-lg-1 bg-info text-primary my-2 p-2 rounded">
                    <select name="status" id="status" class="form-control">
                        <option value="0" <?php echo (isset($oldFormData['status']) && ($oldFormData['status'] === '0')) ? 'selected' : ''; ?>>No</option>
                        <option value="1" <?php echo (isset($oldFormData['status']) && ($oldFormData['status'] === '1')) ? 'selected' : ''; ?>>Yes</option>
                    </select>
                </div>
                <!-- Error Message -->
                <?php if (array_key_exists('status', $errors)) : ?>
                    <div class="col-lg-2">
                    </div>
                    <div class="col-lg-8 offset-lg-1 text-danger fst-italic my-0 px-2 rounded">
                        <?php echo ($errors['status'][0]); ?>
                    </div>
                <?php endif; ?>
                <!-- NAME -->
                <div class="col-lg-2 bg-warning text-light text-uppercase fw-400 my-2 p-2 rounded">
                    Name
                </div>
                <div class="col-lg-8 offset-lg-1 bg-info text-primary my-2 p-2 rounded">
                    <input type="text" class="form-control border-2" id="name" name="name" value="<?php echo ($oldFormData['name'] ?? ''); ?>" maxlength="50">
                </div>
                <!-- Error Message -->
                <?php if (array_key_exists('name', $errors)) : ?>
                    <div class="col-lg-2">
                    </div>
                    <div class="col-lg-8 offset-lg-1 text-danger fst-italic my-0 px-2 rounded">
                        <?php echo ($errors['name'][0]); ?>
                    </div>
                <?php endif; ?>
                <!-- EMAIL -->
                <div class="col-lg-2 bg-warning text-light text-uppercase fw-400 my-2 p-2 rounded">
                    Email
                </div>
                <div class="col-lg-8 offset-lg-1 bg-info text-primary my-2 p-2 rounded">
                    <input type="email" class="form-control border-2" id="email" name="email" value="<?php echo ($oldFormData['email'] ?? ''); ?>" maxlength="50">
                </div>
                <!-- Error Message -->
                <?php if (array_key_exists('email', $errors)) : ?>
                    <div class="col-lg-2">
                    </div>
                    <div class="col-lg-8 offset-lg-1 text-danger fst-italic my-0 px-2 rounded">
                        <?php echo ($errors['email'][0]); ?>
                    </div>
                <?php endif; ?>
                <!-- PHONE -->
                <div class="col-lg-2 bg-warning text-light text-uppercase fw-400 my-2 p-2 rounded">
                    Phone
                </div>
                <div class="col-lg-8 offset-lg-1 bg-info text-primary my-2 p-2 rounded">
                    <input type="tel" class="form-control" id="phone" name="phone" value="<?php echo ($oldFormData['phone'] ?? ''); ?>" maxlength="9">
                </div>
                <!-- Error Message -->
                <?php if (array_key_exists('phone', $errors)) : ?>
                    <div class="col-lg-2">
                    </div>
                    <div class="col-lg-8 offset-lg-1 text-danger fst-italic my-0 px-2 rounded">
                        <?php echo ($errors['phone'][0]); ?>
                    </div>
                <?php endif; ?>
                <!-- SUBJECT -->
                <div class="col-lg-2 bg-warning text-light text-uppercase fw-400 my-2 p-2 rounded">
                    Subject
                </div>
                <div class="col-lg-8 offset-lg-1 bg-info text-primary my-2 p-2 rounded">
                    <select name="subject" id="subject" class="form-control">
                        <option value="Pedir Cita">Pedir Cita</option>
                        <option value="Contratar Sesión">Contratar Sesión</option>
                        <option value="Sesión de Exploración">Sesión de Exploración</option>
                        <option value="Otra Consulta">Otra Consulta</option>
                    </select>
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
                <div class="col-lg-2 bg-warning text-light text-uppercase fw-400 my-2 p-2 rounded">
                    Message
                </div>
                <div class="col-lg-8 offset-lg-1 bg-info text-primary my-2 p-2 rounded">
                    <textarea name="message" rows="4" cols="50" class="w-100 rounded"><?php echo ($oldFormData['message'] ?? ''); ?></textarea>
                </div>
                <!-- Error Message -->
                <?php if (array_key_exists('message', $errors)) : ?>
                    <div class="col-lg-2">
                    </div>
                    <div class="col-lg-8 offset-lg-1 text-danger fst-italic my-0 px-2 rounded">
                        <?php echo ($errors['message'][0]); ?>
                    </div>
                <?php endif; ?>
                <div class="col-lg-2 bg-warning text-light text-uppercase fw-400 my-2 p-2 rounded">
                    Comments
                </div>
                <div class="col-lg-8 offset-lg-1 bg-info text-primary my-2 p-2 rounded">
                    <textarea name="comments" rows="4" cols="50" class="w-100 rounded"></textarea>
                </div>
                <!-- Send -->
                <div class="col-lg-2">
                </div>
                <div class="col-lg-8 offset-lg-1 my-2 p-2 rounded">
                    <button class="btn btn-secondary w-100" type="submit">Submit</button>
                </div>

            </div>

        </form>

    </div>

    </div>
</section>



<?php include $this->resolve("partials/_footer.php"); ?>