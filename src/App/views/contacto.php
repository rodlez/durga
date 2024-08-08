<?php include $this->resolve("partials/_header.php"); ?>

<!-- Section Start Here -->

<!-- Contacto-->
<section id="contacto" class="contacto bg-info py-4">
    <div class="container">
        <h2 class="fw-bold text-primary">Contacto</h2>
        <hr class="hr-heading-page" />
        <p class="text-secondary">Envia el formulario para consultar cualquier duda, también puedes contactar conmigo a través de mis redes sociales.</p>

        <div class="row py-2">

            <div class="col-md-4 order-2 order-md-1 contacto-info">
                <div class="row d-flex flex-column">
                    <div class="col contacto-foto">
                        <img src="images/mamen-contacto.jpg" class="img-fluid" alt="">
                    </div>
                    <div class="col contacto-name pt-2">
                        <h4 class="info-title">Mamen Carrasco</h4>
                        <p class="info-subtitle">Psicóloga y Terapeuta Gestalt</p>
                    </div>
                    <div class="col pt-4 px-1">
                        <a href="#" class="text-decoration-none">
                            <i class="fab fa-facebook fa-2x text-primary mx-2"></i>
                        </a>
                        <a href="#" class="text-decoration-none">
                            <i class="fab fa-instagram fa-2x text-primary mx-2"></i>
                        </a>
                        <a href="#" class="text-decoration-none">
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

                <form action="#" class="contacto-form p-4">

                    <div class="mb-4">
                        <label for="fullname" class="form-label">Nombre <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="fullname" name="fullname" value="" required>
                    </div>
                    <div class="mb-4">
                        <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-envelope" viewBox="0 0 16 16">
                                    <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4Zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1H2Zm13 2.383-4.708 2.825L15 11.105V5.383Zm-.034 6.876-5.64-3.471L8 9.583l-1.326-.795-5.64 3.47A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.741ZM1 11.105l4.708-2.897L1 5.383v5.722Z" />
                                </svg>
                            </span>
                            <input type="email" class="form-control" id="email" name="email" value="" required>
                        </div>
                    </div>
                    <div class="mb-4">
                        <label for="phone" class="form-label">Teléfono</label>
                        <div class="input-group">
                            <span class="input-group-text">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-telephone" viewBox="0 0 16 16">
                                    <path d="M3.654 1.328a.678.678 0 0 0-1.015-.063L1.605 2.3c-.483.484-.661 1.169-.45 1.77a17.568 17.568 0 0 0 4.168 6.608 17.569 17.569 0 0 0 6.608 4.168c.601.211 1.286.033 1.77-.45l1.034-1.034a.678.678 0 0 0-.063-1.015l-2.307-1.794a.678.678 0 0 0-.58-.122l-2.19.547a1.745 1.745 0 0 1-1.657-.459L5.482 8.062a1.745 1.745 0 0 1-.46-1.657l.548-2.19a.678.678 0 0 0-.122-.58L3.654 1.328zM1.884.511a1.745 1.745 0 0 1 2.612.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.678.678 0 0 0 .178.643l2.457 2.457a.678.678 0 0 0 .644.178l2.189-.547a1.745 1.745 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.634 18.634 0 0 1-7.01-4.42 18.634 18.634 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877L1.885.511z" />
                                </svg>
                            </span>
                            <input type="tel" class="form-control" id="phone" name="phone" value="">
                        </div>
                    </div>
                    <div class="mb-4">
                        <label for="interested" class="form-label">Asunto</label>
                        <select name="interested" id="interested" class="form-control">
                            <option>Selecciona...</option>
                            <option value="erp">Pedir Cita</option>
                            <option value="crm">Sesión de Exploración</option>
                            <option value="cms">Contratar Sesión</option>
                            <option value="sfa">Duda</option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label for="message" class="form-label">Mensaje <span class="text-danger">*</span></label>
                        <textarea class="form-control" id="message" name="message" rows="3" required></textarea>
                    </div>
                    <div class="mb-2">
                        <input type="checkbox" id="agree-check" required />
                        <label for="agree-check" class="form-check-label">
                            He leído y acepto la <a href="privacy.html" class="text-dark">Política de Privacidad</a>
                        </label>
                    </div>
                    <div class="mb-4">
                        <div class="d-grid">
                            <button class="btn btn-primary btn-lg" type="submit">Enviar</button>
                        </div>
                    </div>

                </form>

            </div>

        </div>
    </div>
</section>

<?php include $this->resolve("partials/_footer.php"); ?>