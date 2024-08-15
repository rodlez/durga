<?php include $this->resolve("partials/_header.php"); ?>

<!-- Section Start Here -->

<!-- Contacto-->
<section id="contacto" class="contacto bg-info py-4">
    <div class="container">
        <h2 class="fw-bold text-primary"><?php echo $content['title']; ?></h2>
        <hr class="hr-heading-page" />
        <p class="text-secondary"><?php echo $content['header']; ?></p>

        <div class="row py-2">

            <div class="col-md-4 order-2 order-md-1 contacto-info">
                <div class="row d-flex flex-column">
                    <div class="col contacto-foto">
                        <img src="images/web/mamen-contacto.jpg" class="img-fluid" alt="">
                    </div>
                    <div class="col contacto-name pt-2">
                        <h4 class="info-title">Mamen Carrasco</h4>
                        <p class="info-subtitle"><?php echo $content['subtitle']; ?></p>
                    </div>
                    <div class="col pt-4 px-1">
                        <a href="https://www.instagram.com/durgga_psicologia/" class="text-decoration-none" target="_blank">
                            <i class="fab fa-instagram fa-2x text-primary mx-2"></i>
                        </a>
                        <a href="https://www.linkedin.com/in/mamen-carrasco-ben%C3%ADtez-20496956" class="text-decoration-none" target="_blank">
                            <i class="fab fa-linkedin fa-2x text-primary mx-2"></i>
                        </a>
                    </div>
                    <div class="col text-warning pt-4 px-2">
                        <i class="fa fa-phone fa-1x mx-2"></i>
                        <a href="tel:34651786502">+34 651786502</a>
                    </div>
                    <div class="col text-warning px-2">
                        <i class="fa fa-envelope fa-1x mx-2"></i>
                        <a href="mailto:contact@site.com">info@durgga.com</a>
                    </div>
                    <div class="col text-warning px-2">
                        <i class="fa fa-house fa-1x mx-2"></i>
                        Sant Cugat del Vallès (Barcelona)
                    </div>
                    <!-- Map 
                        <div class="col map pt-4">
                            <iframe
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1241.5303553091994!2d-0.14076024298621118!3d51.51210217963597!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x487604d502268421%3A0x6a7d62889992f993!2sRegent+St%2C+Soho%2C+London+W1B+5TH%2C+UK!5e0!3m2!1sen!2sro!4v1476174541049" 
                                allowfullscreen>
                            </iframe>
                        </div>   
                        -->
                </div>
            </div>

            <div class="col-md-8 order-1 order-md-2">

                <!-- Form -->
                <form method="POST" class="contacto-form p-4">
                    <!-- CSRF TOKEN  -->
                    <?php include $this->resolve('partials/_csrf.php'); ?>
                    <!-- Nombre -->
                    <div class="mb-4">
                        <label for="name" class="form-label"><?php echo $content['name']; ?> <span class="text-primary">*</span></label>
                        <input type="text" class="form-control" id="name" name="name" value="<?php echo ($oldFormData['name'] ?? ''); ?>" placeholder="">
                    </div>
                    <!-- Error Message -->
                    <?php if (array_key_exists('name', $errors)) : ?>
                        <div class="bg-warning text-white fw-italics rounded mb-4 p-2"><?php echo ($errors['name'][0]); ?></div>
                    <?php endif; ?>
                    <!-- Email -->
                    <div class="mb-4">
                        <label for="email" class="form-label"><?php echo $content['email']; ?> <span class="text-primary">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text bg-primary">
                                <i class="fa fa-envelope fa-1x text-light"></i>
                            </span>
                            <input type="email" class="form-control" id="email" name="email" value="<?php echo ($oldFormData['email'] ?? ''); ?>" placeholder="">
                        </div>
                    </div>
                    <!-- Error Message -->
                    <?php if (array_key_exists('email', $errors)) : ?>
                        <div class="bg-warning text-white fw-italics rounded mb-4 p-2"><?php echo ($errors['email'][0]); ?></div>
                    <?php endif; ?>
                    <!-- Phone -->
                    <div class="mb-4">
                        <label for="phone" class="form-label"><?php echo $content['phone']; ?> <span class="text-primary">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text bg-primary">
                                <i class="fa fa-phone fa-1x text-light"></i>
                            </span>
                            <input type="tel" class="form-control" id="phone" name="phone" value="<?php echo ($oldFormData['phone'] ?? ''); ?>" placeholder="" maxlength="9">
                        </div>
                    </div>
                    <!-- Error Message -->
                    <?php if (array_key_exists('phone', $errors)) : ?>
                        <div class="bg-warning text-white fw-italics rounded mb-4 p-2"><?php echo ($errors['phone'][0]); ?></div>
                    <?php endif; ?>
                    <!-- Asunto -->
                    <div class="mb-4">
                        <label for="subject" class="form-label"><?php echo $content['subject']; ?></label>
                        <select name="subject" id="subject" class="form-control">
                            <option value="Pedir Cita" <?php echo (isset($asunto) && ($asunto === '1')) ? 'selected' : ''; ?>><?php echo $content['subject1']; ?></option>
                            <option value="Contratar Sesión" <?php echo (isset($asunto) && ($asunto === '2')) ? 'selected' : ''; ?>><?php echo $content['subject2']; ?></option>
                            <option value="Sesión de Exploración" <?php echo (isset($asunto) && ($asunto === '3')) ? 'selected' : ''; ?>><?php echo $content['subject3']; ?></option>
                            <option value="Otra Consulta" <?php echo (isset($asunto) && ($asunto === '4')) ? 'selected' : ''; ?>><?php echo $content['subject4']; ?></option>
                        </select>
                    </div>
                    <!-- Error Message -->
                    <?php if (array_key_exists('subject', $errors)) : ?>
                        <div class="bg-warning text-white fw-italics rounded mb-4 p-2"><?php echo ($errors['subject'][0]); ?></div>
                    <?php endif; ?>
                    <!-- Mensaje -->
                    <div class="mb-4">
                        <div class="col">
                            <label for="message" class="form-label"><?php echo $content['message']; ?> <span class="text-primary">*</span></label>
                        </div>
                        <div class="col">
                            <textarea name="message" rows="4" cols="50" class="w-100 rounded"><?php echo ($oldFormData['message'] ?? ''); ?></textarea>
                        </div>
                    </div>
                    <!-- Error Message -->
                    <?php if (array_key_exists('message', $errors)) : ?>
                        <div class="bg-warning text-white fw-italics rounded mb-4 p-2"><?php echo ($errors['message'][0]); ?></div>
                    <?php endif; ?>
                    <!-- Terms of service -->
                    <div class="mb-2">
                        <input <?php echo $oldFormData['tos'] ?? false ? 'checked' : ''; ?> type="checkbox" id="agree-check" name="tos" />
                        <label for="agree-check" class="form-check-label">
                            <?php echo $content['tos']; ?> <a href="/privacy" class="text-dark"><?php echo $content['privacy']; ?></a>
                        </label>
                    </div>
                    <!-- Error Message -->
                    <?php if (array_key_exists('tos', $errors)) : ?>
                        <div class="bg-warning text-white fw-italics rounded mb-4 p-2"><?php echo ($errors['tos'][0]); ?></div>
                    <?php endif; ?>
                    <!-- Send -->
                    <div class="mb-4">
                        <div class="d-grid">
                            <button class="btn btn-secondary btn-lg" type="submit">Enviar</button>
                        </div>
                    </div>

                </form>

            </div>

        </div>

        <div class="col-lg-12 my-4 text-center">
            <a href="/" class="btn btn-primary mt-4"><?php echo $content['button']; ?></a>
        </div>

    </div>
</section>

<?php include $this->resolve("partials/_footer.php"); ?>