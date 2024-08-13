<?php include $this->resolve("partials/_header.php"); ?>

<section id="#" class="bg-info py-4">
    <!-- Container -->
    <div class="container">

        <h4 class="text-primary"><?php echo $title; ?></h4>

        <div class="row bg-primary justify-content-center align-items-center text-center p-2">

            <div class="col-md-4 py-2">
                <!-- Card -->
                <div class="card mb-2 rounded-2 border-0 p-2">
                    <a href="/admin/newsletter" class="text-decoration-none">
                        <div class="card-body text-center">
                            <!-- Icon -->
                            <i class="fa-regular fa-envelope fa-2x text-primary bg-light rounded-circle p-2 my-2"></i>
                            <!-- Title -->
                            <h5 class="card-title text-primary fw-bold">Newsletter List</h5>
                        </div>
                    </a>
                </div>
            </div>

            <div class="col-md-4 py-2">
                <!-- Card -->
                <div class="card mb-2 rounded-2 border-0 p-2">
                    <a href="/admin/newsletter/send" class="text-decoration-none">
                        <div class="card-body text-center">
                            <!-- Icon -->
                            <i class="fa-regular fa-envelope fa-2x text-primary bg-light rounded-circle p-2 my-2"></i>
                            <!-- Title -->
                            <h5 class="card-title text-primary fw-bold">Send Newsletter</h5>
                        </div>
                    </a>
                </div>
            </div>

            <div class="col-md-4 py-2">
                <!-- Card -->
                <div class="card mb-2 rounded-2 border-0 p-2">
                    <a href="/admin/contact" class="text-decoration-none">
                        <div class="card-body text-center">
                            <!-- Icon -->
                            <i class="fa-regular fa-address-book fa-2x text-primary bg-light rounded-circle p-2 my-2"></i>
                            <!-- Title -->
                            <h5 class="card-title text-primary fw-bold">Contact List</h5>
                        </div>
                    </a>
                </div>
            </div>

            <div class="col-md-4 py-2">
                <!-- Card -->
                <div class="card mb-2 rounded-2 border-0 p-2">
                    <a href="/admin/blog" class="text-decoration-none">
                        <div class="card-body text-center">
                            <!-- Icon -->
                            <i class="fa-brands fa-blogger fa-2x text-primary bg-light rounded-circle p-2 my-2"></i>
                            <!-- Title -->
                            <h5 class="card-title text-primary fw-bold">Blog</h5>
                        </div>
                    </a>
                </div>
            </div>

            <div class="col-md-4 py-2">
                <!-- Card -->
                <div class="card mb-2 rounded-2 border-0 p-2">
                    <a href="/admin/category" class="text-decoration-none">
                        <div class="card-body text-center">
                            <!-- Icon -->
                            <i class="fa-brands fa-blogger fa-2x text-primary bg-light rounded-circle p-2 my-2"></i>
                            <!-- Title -->
                            <h5 class="card-title text-primary fw-bold">Blog Categories</h5>
                        </div>
                    </a>
                </div>
            </div>

            <div class="col-md-4 py-2">
                <!-- Card -->
                <div class="card mb-2 rounded-2 border-0 p-2">
                    <a href="/admin/tag" class="text-decoration-none">
                        <div class="card-body text-center">
                            <!-- Icon -->
                            <i class="fa-brands fa-blogger fa-2x text-primary bg-light rounded-circle p-2 my-2"></i>
                            <!-- Title -->
                            <h5 class="card-title text-primary fw-bold">Blog Tags</h5>
                        </div>
                    </a>
                </div>
            </div>

        </div>

    </div>
</section>

<?php include $this->resolve("partials/_footer.php"); ?>