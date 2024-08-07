<?php include $this->resolve("partials/_header.php"); ?>

<!-- Section Start Here -->
<section id="#" class="py-4">
    <!-- Container -->
    <div class="container">
        <!-- Title -->
        <h2 class="fw-bold text-primary py-4 title-page"><?php echo $title; ?></h2>
        <hr class="hr-heading-page">
        <div class="row">
            <div class="col-8 offset-2 bg-light text-center">
                <h4><?php echo $subtitle; ?></h4>
            </div>

            <div class="col-8 offset-2 bg-light">
                <?php //showNice($errors) 
                ?>
                <!-- Form -->
                <form method="POST" class="contacto-form p-4">
                    <!-- CSRF TOKEN  -->
                    <?php include $this->resolve('partials/_csrf.php'); ?>
                    <!-- Username -->
                    <div class="mb-4">
                        <label for="userName" class="form-label">Username <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="userName" name="userName" value="<?php echo ($oldFormData['userName'] ?? ''); ?>" placeholder="">
                    </div>
                    <!-- Error Message -->
                    <?php if (array_key_exists('userName', $errors)) : ?>
                        <div class="bg-info text-danger mb-4"><?php echo ($errors['userName'][0]); ?></div>
                    <?php endif; ?>
                    <!-- Email -->
                    <div class="mb-4">
                        <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-envelope" viewBox="0 0 16 16">
                                    <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4Zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1H2Zm13 2.383-4.708 2.825L15 11.105V5.383Zm-.034 6.876-5.64-3.471L8 9.583l-1.326-.795-5.64 3.47A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.741ZM1 11.105l4.708-2.897L1 5.383v5.722Z" />
                                </svg>
                            </span>
                            <input type="email" class="form-control" id="email" name="email" value="<?php echo ($oldFormData['email'] ?? ''); ?>" placeholder="">
                        </div>
                    </div>
                    <!-- Error Message -->
                    <?php if (array_key_exists('email', $errors)) : ?>
                        <div class="bg-info text-danger mb-4"><?php echo ($errors['email'][0]); ?></div>
                    <?php endif; ?>
                    <!-- Phone -->
                    <div class="mb-4">
                        <label for="phone" class="form-label">Phone</label>
                        <div class="input-group">
                            <span class="input-group-text">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-telephone" viewBox="0 0 16 16">
                                    <path d="M3.654 1.328a.678.678 0 0 0-1.015-.063L1.605 2.3c-.483.484-.661 1.169-.45 1.77a17.568 17.568 0 0 0 4.168 6.608 17.569 17.569 0 0 0 6.608 4.168c.601.211 1.286.033 1.77-.45l1.034-1.034a.678.678 0 0 0-.063-1.015l-2.307-1.794a.678.678 0 0 0-.58-.122l-2.19.547a1.745 1.745 0 0 1-1.657-.459L5.482 8.062a1.745 1.745 0 0 1-.46-1.657l.548-2.19a.678.678 0 0 0-.122-.58L3.654 1.328zM1.884.511a1.745 1.745 0 0 1 2.612.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.678.678 0 0 0 .178.643l2.457 2.457a.678.678 0 0 0 .644.178l2.189-.547a1.745 1.745 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.634 18.634 0 0 1-7.01-4.42 18.634 18.634 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877L1.885.511z" />
                                </svg>
                            </span>
                            <input type="tel" class="form-control" id="phone" name="phone" value="<?php echo ($oldFormData['phone'] ?? ''); ?>" placeholder="" maxlength="9">
                        </div>
                    </div>
                    <!-- Error Message -->
                    <?php if (array_key_exists('phone', $errors)) : ?>
                        <div class="bg-info text-danger mb-4"><?php echo ($errors['phone'][0]); ?></div>
                    <?php endif; ?>
                    <!-- Age -->
                    <div class="mb-4">
                        <label for="age" class="form-label">Age <span class="text-danger">*</span></label>
                        <input type="number" class="form-control" id="age" name="age" value="<?php echo ($oldFormData['age'] ?? ''); ?>" placeholder="">
                    </div>
                    <!-- Error Message -->
                    <?php if (array_key_exists('age', $errors)) : ?>
                        <div class="bg-info text-danger mb-4"><?php echo ($errors['age'][0]); ?></div>
                    <?php endif; ?>
                    <!-- URL -->
                    <div class="mb-4">
                        <label for="socialMediaURL" class="form-label">Social Media Url <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="socialMediaURL" name="socialMediaURL" value="<?php echo ($oldFormData['socialMediaURL'] ?? ''); ?>" placeholder="">
                    </div>
                    <!-- Error Message -->
                    <?php if (array_key_exists('socialMediaURL', $errors)) : ?>
                        <div class="bg-info text-danger mb-4"><?php echo ($errors['socialMediaURL'][0]); ?></div>
                    <?php endif; ?>
                    <!-- Country -->
                    <div class="mb-4">
                        <label for="country" class="form-label">Country</label>
                        <select name="country" id="country" class="form-control">
                            <option value="Spain">Spain</option>
                            <option value="USA" <?php echo (isset($oldFormData['country']) && ($oldFormData['country'] === 'USA')) ? 'selected' : ''; ?>>USA</option>
                            <option value="Canada" <?php echo (isset($oldFormData['country']) && ($oldFormData['country'] === 'Canada')) ? 'selected' : ''; ?>>Canada</option>
                            <option value="Mexico" <?php echo (isset($oldFormData['country']) && ($oldFormData['country'] === 'Mexico')) ? 'selected' : ''; ?>>Mexico</option>
                            <option value="Invalid">Invalid Country</option>
                        </select>
                    </div>
                    <!-- Error Message -->
                    <?php if (array_key_exists('country', $errors)) : ?>
                        <div class="bg-info text-danger mb-4"><?php echo ($errors['country'][0]); ?></div>
                    <?php endif; ?>
                    <!-- Password -->
                    <div class="mb-4">
                        <label for="password" class="form-label">Password <span class="text-danger">*</span></label>
                        <input type="password" class="form-control" id="password" name="password" value="" placeholder="">
                    </div>
                    <!-- Error Message -->
                    <?php if (array_key_exists('password', $errors)) : ?>
                        <div class="bg-info text-danger mb-4"><?php echo ($errors['password'][0]); ?></div>
                    <?php endif; ?>
                    <!-- Confirm Password -->
                    <div class="mb-4">
                        <label for="confirmPassword" class="form-label">Confirm Password <span class="text-danger">*</span></label>
                        <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" value="" placeholder="">
                    </div>
                    <!-- Error Message -->
                    <?php if (array_key_exists('confirmPassword', $errors)) : ?>
                        <div class="bg-info text-danger mb-4"><?php echo ($errors['confirmPassword'][0]); ?></div>
                    <?php endif; ?>
                    <!-- Terms of service -->
                    <div class="mb-2">
                        <input <?php echo $oldFormData['tos'] ?? false ? 'checked' : ''; ?> type="checkbox" id="agree-check" name="tos" />
                        <label for="agree-check" class="form-check-label">
                            I accept the <a href="#" class="text-dark">terms of service</a>
                        </label>
                    </div>
                    <!-- Error Message -->
                    <?php if (array_key_exists('tos', $errors)) : ?>
                        <div class="bg-info text-danger mb-4"><?php echo ($errors['tos'][0]); ?></div>
                    <?php endif; ?>
                    <!-- Send -->
                    <div class="mb-4">
                        <div class="d-grid">
                            <button class="btn btn-primary btn-lg" type="submit">Send</button>
                        </div>
                    </div>

                </form>
                <?php showNice($oldFormData); ?>
            </div>

        </div>
    </div>
</section>


<?php include $this->resolve("partials/_footer.php"); ?>