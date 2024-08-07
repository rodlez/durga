<?php include $this->resolve("partials/_header.php"); ?>

<!-- Section Start Here -->
<section id="#" class="py-4">
    <!-- Container -->
    <div class="container">
        <!-- Title -->
        <h2 class="fw-bold text-primary py-4 title-page text-center"><?php echo $title; ?></h2>
        <hr class="hr-heading-page w-100">
        <div class="row">

            <div class="col-10 offset-1 bg-light">
                <?php //showNice($errors) 
                ?>
                <!-- Form -->
                <form method="POST" class="contacto-form p-4">
                    <!-- CSRF TOKEN  -->
                    <?php include $this->resolve('partials/_csrf.php'); ?>
                    <!-- Email -->
                    <div class="mb-4">
                        <label for="email" class="form-label">Email</label>
                        <div class="input-group">
                            <span class="input-group-text bg-primary">
                                <i class="fa fa-envelope fa-1x text-light"></i>
                            </span>
                            <input type="email" class="form-control" id="email" name="email" value="<?php echo ($oldFormData['email'] ?? ''); ?>" placeholder="">
                        </div>
                    </div>
                    <!-- Error Message -->
                    <?php if (array_key_exists('email', $errors)) : ?>
                        <div class="bg-info text-danger mb-4"><?php echo ($errors['email'][0]); ?></div>
                    <?php endif; ?>
                    <!-- Password -->
                    <div class="mb-4">
                        <label for="password" class="form-label">Password</label>
                        <div class="input-group ">
                            <span class="input-group-text bg-primary">
                                <i class="fa fa-lock fa-1x text-light"></i>
                            </span>
                            <input type="password" class="form-control" id="password" name="password" value="" placeholder="">
                        </div>
                    </div>
                    <!-- Error Message -->
                    <?php if (array_key_exists('password', $errors)) : ?>
                        <div class="bg-info text-danger mb-4"><?php echo ($errors['password'][0]); ?></div>
                    <?php endif; ?>
                    <!-- Forgot Password -->
                    <div class="mb-4">
                        <div class="d-grid">
                            Forgot your Password?
                        </div>
                    </div>
                    <!-- Send -->
                    <div class="mb-4">
                        <div class="d-grid">
                            <button class="btn btn-primary btn-lg" type="submit">Submit</button>
                        </div>
                    </div>

                </form>
                <?php showNice($oldFormData); ?>
            </div>

        </div>
    </div>
</section>


<?php include $this->resolve("partials/_footer.php"); ?>