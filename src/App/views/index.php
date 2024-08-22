<?php include $this->resolve("partials/_header.php"); ?>

<?php
// Intelephense Error
/**  @var object $blogList */
/**  @var object $images */
/**  @var object $blogTotal */
/**  @var object $blog */
//showNice($blogList);
/*foreach ($blogTotal as $blog) {
    showNice($blog['data']->author);
    showNice($blog['images']->storage_filename);
} */
?>


<!-- Header, 1 col -->
<header class="header position-relative">
    <div class="container">
        <div class="row">
            <div class="col-md-10 pt-5">
                <h1 class="xl-text text-white fw-700 mt-3"><?php echo $header['title']; ?></h1>
                <h5 class="text-primary mt-2 fw-bold"><?php echo $header['subtitle']; ?></h5>
                <p class="lead text-white fw-semibold">
                    <?php echo $header['text']; ?>
                </p>
                <a href="/contacto?asunto=1" class="btn btn-primary text-white"><?php echo $header['button']; ?></a>
            </div>
        </div>
    </div>
</header>

<?php
/*
<!-- Sintomas test 1 3 column TODO: 1 COLUMN IN MOBILE -->
<section class="pt-5 pb-5">
    <div class="container">
        <div class="row">
            <div class="col-6">
                <h3 class="mb-3">Carousel cards title </h3>
            </div>

            <div class="col-6 text-end">
                <a class="btn btn-primary mb-3 mr-1" data-bs-target="#carouselExampleIndicators2" role="button" data-bs-slide="prev">
                    <i class="fa fa-arrow-left"></i>
                </a>
                <a class="btn btn-primary mb-3 " data-bs-target="#carouselExampleIndicators2" role="button" data-bs-slide="next">
                    <i class="fa fa-arrow-right"></i>
                </a>
            </div>

            <div class="col-12 bg-primary">
                <div id="carouselExampleIndicators2" class="carousel slide" data-ride="carousel">

                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <div class="row">

                                <div class="col-md-4 mb-3">
                                    <div class="card">
                                        <img class="img-fluid" alt="100%x280" src="https://images.unsplash.com/photo-1532781914607-2031eca2f00d?ixlib=rb-0.3.5&amp;q=80&amp;fm=jpg&amp;crop=entropy&amp;cs=tinysrgb&amp;w=1080&amp;fit=max&amp;ixid=eyJhcHBfaWQiOjMyMDc0fQ&amp;s=7c625ea379640da3ef2e24f20df7ce8d">
                                        <div class="card-body">
                                            <h4 class="card-title">Special title treatment</h4>
                                            <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>

                                        </div>

                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <div class="card">
                                        <img class="img-fluid" alt="100%x280" src="https://images.unsplash.com/photo-1517760444937-f6397edcbbcd?ixlib=rb-0.3.5&amp;q=80&amp;fm=jpg&amp;crop=entropy&amp;cs=tinysrgb&amp;w=1080&amp;fit=max&amp;ixid=eyJhcHBfaWQiOjMyMDc0fQ&amp;s=42b2d9ae6feb9c4ff98b9133addfb698">
                                        <div class="card-body">
                                            <h4 class="card-title">Special title treatment</h4>
                                            <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>

                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <div class="card">
                                        <img class="img-fluid" alt="100%x280" src="https://images.unsplash.com/photo-1532712938310-34cb3982ef74?ixlib=rb-0.3.5&amp;q=80&amp;fm=jpg&amp;crop=entropy&amp;cs=tinysrgb&amp;w=1080&amp;fit=max&amp;ixid=eyJhcHBfaWQiOjMyMDc0fQ&amp;s=3d2e8a2039c06dd26db977fe6ac6186a">
                                        <div class="card-body">
                                            <h4 class="card-title">Special title treatment</h4>
                                            <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>

                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="carousel-item">
                            <div class="row">

                                <div class="col-md-4 mb-3">
                                    <div class="card">
                                        <img class="img-fluid" alt="100%x280" src="https://images.unsplash.com/photo-1532771098148-525cefe10c23?ixlib=rb-0.3.5&amp;q=80&amp;fm=jpg&amp;crop=entropy&amp;cs=tinysrgb&amp;w=1080&amp;fit=max&amp;ixid=eyJhcHBfaWQiOjMyMDc0fQ&amp;s=3f317c1f7a16116dec454fbc267dd8e4">
                                        <div class="card-body">
                                            <h4 class="card-title">Special title treatment</h4>
                                            <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>

                                        </div>

                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <div class="card">
                                        <img class="img-fluid" alt="100%x280" src="https://images.unsplash.com/photo-1532715088550-62f09305f765?ixlib=rb-0.3.5&amp;q=80&amp;fm=jpg&amp;crop=entropy&amp;cs=tinysrgb&amp;w=1080&amp;fit=max&amp;ixid=eyJhcHBfaWQiOjMyMDc0fQ&amp;s=ebadb044b374504ef8e81bdec4d0e840">
                                        <div class="card-body">
                                            <h4 class="card-title">Special title treatment</h4>
                                            <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>

                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <div class="card">
                                        <img class="img-fluid" alt="100%x280" src="https://images.unsplash.com/photo-1506197603052-3cc9c3a201bd?ixlib=rb-0.3.5&amp;q=80&amp;fm=jpg&amp;crop=entropy&amp;cs=tinysrgb&amp;w=1080&amp;fit=max&amp;ixid=eyJhcHBfaWQiOjMyMDc0fQ&amp;s=0754ab085804ae8a3b562548e6b4aa2e">
                                        <div class="card-body">
                                            <h4 class="card-title">Special title treatment</h4>
                                            <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>

                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="carousel-item">
                            <div class="row">

                                <div class="col-md-4 mb-3">
                                    <div class="card">
                                        <img class="img-fluid" alt="100%x280" src="https://images.unsplash.com/photo-1507525428034-b723cf961d3e?ixlib=rb-0.3.5&amp;q=80&amp;fm=jpg&amp;crop=entropy&amp;cs=tinysrgb&amp;w=1080&amp;fit=max&amp;ixid=eyJhcHBfaWQiOjMyMDc0fQ&amp;s=ee8417f0ea2a50d53a12665820b54e23">
                                        <div class="card-body">
                                            <h4 class="card-title">Special title treatment</h4>
                                            <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>

                                        </div>

                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <div class="card">
                                        <img class="img-fluid" alt="100%x280" src="https://images.unsplash.com/photo-1532777946373-b6783242f211?ixlib=rb-0.3.5&amp;q=80&amp;fm=jpg&amp;crop=entropy&amp;cs=tinysrgb&amp;w=1080&amp;fit=max&amp;ixid=eyJhcHBfaWQiOjMyMDc0fQ&amp;s=8ac55cf3a68785643998730839663129">
                                        <div class="card-body">
                                            <h4 class="card-title">Special title treatment</h4>
                                            <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>

                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <div class="card">
                                        <img class="img-fluid" alt="100%x280" src="https://images.unsplash.com/photo-1532763303805-529d595877c5?ixlib=rb-0.3.5&amp;q=80&amp;fm=jpg&amp;crop=entropy&amp;cs=tinysrgb&amp;w=1080&amp;fit=max&amp;ixid=eyJhcHBfaWQiOjMyMDc0fQ&amp;s=5ee4fd5d19b40f93eadb21871757eda6">
                                        <div class="card-body">
                                            <h4 class="card-title">Special title treatment</h4>
                                            <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
*/
?>




<!-- Terapia, relative to position absolute the vertical decoration -->
<section id="terapia" class="terapia mt-2 mb-5 position-relative">
    <div class="container">
        <div class="row pt-5">
            <div class="col-lg-6">
                <h2 class="fw-bold text-primary"><?php echo $terapia['title']; ?></h2>
                <hr class="hr-heading" />
                <?php echo $terapia['text']; ?>
            </div>
            <div class="col-lg-6 text-center">
                <img src="./images/web/terapia.svg" alt="" class="img-fluid rounded-2">
            </div>
        </div>
    </div>
    <img src="./images/web/vertical-decoration-left.svg" alt="" class="vertical-decoration position-absolute d-none d-lg-block">
</section>

<?php
/*
<!-- Sintomas, 2 row 4 col per row with cards -->
<section id="sintomas" class="sintomas bg-info py-5">
    <div class="container">
        <h2 class="text-center fw-bold text-primary pb-4">
            <?php echo $sintomas['title']; ?>
        </h2>
        <!-- Sintomas Row 1 -->
        <div class="row mb-4">
            <div class="col-lg-3 col-md-6">
                <div class="card border-0">
                    <img src="./images/web/sintomas1.jpg" class="card-img" alt="" />
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $sintomas['card1Title']; ?></h5>
                        <p class="card-text">
                            <?php echo $sintomas['card1Text']; ?>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="card border-0">
                    <img src="./images/web/sintomas2.jpg" class="card-img" alt="" />
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $sintomas['card2Title']; ?></h5>
                        <p class="card-text">
                            <?php echo $sintomas['card2Text']; ?>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="card border-0">
                    <img src="./images/web/sintomas3.jpg" class="card-img" alt="" />
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $sintomas['card3Title']; ?></h5>
                        <p class="card-text">
                            <?php echo $sintomas['card3Text']; ?>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="card border-0">
                    <img src="./images/web/sintomas4.jpg" class="card-img" alt="" />
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $sintomas['card4Title']; ?></h5>
                        <p class="card-text">
                            <?php echo $sintomas['card4Text']; ?>
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sintomas Row 2 -->
        <div class="row mb-4">
            <div class="col-lg-3 col-md-6">
                <div class="card border-0">
                    <img src="./images/web/sintomas5.jpg" class="card-img" alt="" />
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $sintomas['card5Title']; ?></h5>
                        <p class="card-text">
                            <?php echo $sintomas['card5Text']; ?>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="card border-0">
                    <img src="./images/web/sintomas6.jpg" class="card-img" alt="" />
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $sintomas['card6Title']; ?></h5>
                        <p class="card-text">
                            <?php echo $sintomas['card6Text']; ?>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="card border-0">
                    <img src="./images/web/sintomas7.jpg" class="card-img" alt="" />
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $sintomas['card7Title']; ?></h5>
                        <p class="card-text">
                            <?php echo $sintomas['card7Text']; ?>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="card border-0">
                    <img src="./images/web/sintomas8.jpg" class="card-img" alt="" />
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $sintomas['card8Title']; ?></h5>
                        <p class="card-text">
                            <?php echo $sintomas['card8Text']; ?>
                        </p>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>
*/
?>

<!-- Sintomas Test 2 -->
<section id="sintomas" class="sintomas bg-info py-5">
    <div class="container">
        <h2 class="text-center fw-bold text-primary pb-4">
            <?php echo $sintomas['title']; ?>
        </h2>
        <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">

            <div class="carousel-inner">
                <div class="carousel-item active">
                    <div class="card border-0">
                        <img src="./images/web/sintomas1.jpg" class="card-img" alt="" />
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $sintomas['card1Title']; ?></h5>
                            <p class="card-text">
                                <?php echo $sintomas['card1Text']; ?>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="card border-0">
                        <img src="./images/web/sintomas2.jpg" class="card-img" alt="" />
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $sintomas['card2Title']; ?></h5>
                            <p class="card-text">
                                <?php echo $sintomas['card2Text']; ?>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="card border-0">
                        <img src="./images/web/sintomas3.jpg" class="card-img" alt="" />
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $sintomas['card3Title']; ?></h5>
                            <p class="card-text">
                                <?php echo $sintomas['card3Text']; ?>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="card border-0">
                        <img src="./images/web/sintomas4.jpg" class="card-img" alt="" />
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $sintomas['card4Title']; ?></h5>
                            <p class="card-text">
                                <?php echo $sintomas['card4Text']; ?>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="card border-0">
                        <img src="./images/web/sintomas5.jpg" class="card-img" alt="" />
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $sintomas['card5Title']; ?></h5>
                            <p class="card-text">
                                <?php echo $sintomas['card5Text']; ?>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="card border-0">
                        <img src="./images/web/sintomas6.jpg" class="card-img" alt="" />
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $sintomas['card6Title']; ?></h5>
                            <p class="card-text">
                                <?php echo $sintomas['card6Text']; ?>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="card border-0">
                        <img src="./images/web/sintomas7.jpg" class="card-img" alt="" />
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $sintomas['card7Title']; ?></h5>
                            <p class="card-text">
                                <?php echo $sintomas['card7Text']; ?>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="card border-0">
                        <img src="./images/web/sintomas8.jpg" class="card-img" alt="" />
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $sintomas['card8Title']; ?></h5>
                            <p class="card-text">
                                <?php echo $sintomas['card8Text']; ?>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>

            <?php /*
            <!-- Carousel bullet points -->
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="3" aria-label="Slide 4"></button>
            </div>
            */ ?>
        </div>

    </div>
</section>

<!-- Sesión Exploracion, 1 col -->
<section class="sesion mb-5 bg-light sesion-bg">
    <div class="container">
        <div class="row">
            <div class="col-12 py-6">
                <div class="text-center py-6 rounded-4 sesion-card">
                    <div class="w-75 m-auto sesion-text">
                        <h2 class="display-5 fw-bold text-light"><?php echo $exploracion['title']; ?></h2>
                        <p class="text-light mt-4">
                            <?php echo $exploracion['subtitle']; ?>
                        </p>
                        <a href="/contacto?asunto=3" class="btn btn-primary mt-4">
                            <?php echo $exploracion['button']; ?>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Método 2, relative to position absolute the orange vertical decoration -->
<section id="metodo" class="metodo mt-2 mb-5 position-relative">
    <div class="container">
        <div class="row pt-5">
            <div class="col-lg-6 d-none d-lg-block">
                <img src="./images/web/metodo.jpg" alt="" class="img-fluid rounded-2">
            </div>
            <div class="col-lg-6">
                <h2 class="fw-bold text-primary"><?php echo $metodo['title']; ?></h2>
                <hr class="hr-heading" />
                <p>
                    <?php echo $metodo['subtitle']; ?>
                </p>
                <div class="d-flex gap-3">
                    <!-- Number, title and text-->
                    <div class="number">
                        <span class="bg-warning text-white py-1 px-3 fs-3 rounded-circle">
                            1
                        </span>
                    </div>
                    <div class="mt-2">
                        <h3 class="fs-4 title"><?php echo $metodo['point1Ttitle']; ?></h3>
                        <p>
                            <?php echo $metodo['point1Text']; ?>
                        </p>
                    </div>
                </div>
                <div class="d-flex gap-3">
                    <!-- Number, title and text-->
                    <div class="number">
                        <span class="bg-warning text-white py-1 px-3 fs-3 rounded-circle">
                            2
                        </span>
                    </div>
                    <div class="mt-2">
                        <h3 class="fs-4 title"><?php echo $metodo['point2Ttitle']; ?></h3>
                        <p>
                            <?php echo $metodo['point2Text']; ?>
                        </p>
                    </div>
                </div>
                <div class="d-flex gap-3">
                    <!-- Number, title and text-->
                    <div class="number">
                        <span class="bg-warning text-white py-1 px-3 fs-3 rounded-circle">
                            3
                        </span>
                    </div>
                    <div class="mt-2">
                        <h3 class="fs-4 title"><?php echo $metodo['point3Ttitle']; ?></h3>
                        <p>
                            <?php echo $metodo['point3Text']; ?>
                        </p>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <img src="./images/web/web/vertical-decoration-right.svg" alt="" class="vertical-decoration position-absolute d-none d-lg-block">
</section>

<!-- Motivos -->
<section id="motivos" class="motivos py-5 bg-info">
    <div class="container">
        <!-- Text -->
        <div class="row text-center mb-5">
            <div class="col-md-8 offset-md-2">
                <h2 class="fw-bold text-primary"><?php echo $motivos['title']; ?></h2>
                <p class="lead text-warning fw-semibold">
                    <?php echo $motivos['subtitle']; ?>
                </p>
            </div>
        </div>

        <!-- Row, 3 col each, each one a card with icon, title and text -->
        <div class="row">

            <div class="col-lg-3 col-md-6">
                <!-- Card -->
                <div class="card mb-4 rounded-2 border-2 border-primary p-3">
                    <div class="card-body text-center">
                        <!-- Icon -->
                        <i class="fas fa-book fa-3x text-primary bg-light rounded-circle p-3 my-4"></i>
                        <!-- Title -->
                        <h5 class="card-title text-primary fw-bold"><?php echo $motivos['point1Title']; ?></h5>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <!-- Card -->
                <div class="card mb-4 rounded-2 border-2 border-primary p-3">
                    <div class="card-body text-center">
                        <!-- Icon -->
                        <i class="fas fa-user-group fa-3x text-primary bg-light rounded-circle p-3 my-4"></i>
                        <!-- Title -->
                        <h5 class="card-title text-primary fw-bold"><?php echo $motivos['point2Title']; ?></h5>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <!-- Card -->
                <div class="card mb-4 rounded-2 border-2 border-primary p-3">
                    <div class="card-body text-center">
                        <!-- Icon -->
                        <i class="fas fa-eye fa-3x text-primary bg-light rounded-circle p-3 my-4"></i>
                        <!-- Title -->
                        <h5 class="card-title text-primary fw-bold"><?php echo $motivos['point3Title']; ?></h5>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="card mb-4 rounded-2 border-2 border-primary p-3">
                    <div class="card-body text-center">
                        <i class="fas fa-ruler fa-3x text-primary bg-light rounded-circle p-3 my-4"></i>
                        <h5 class="card-title text-primary fw-bold"><?php echo $motivos['point4Title']; ?></h5>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- beneficios, carousel slide -->
<section id="beneficios" class="beneficios py-4">
    <h2 class="fw-bold text-primary text-center py-4"><?php echo $beneficios['title']; ?></h2>
    <div id="testimonialCarousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <!-- Slide 1 -->
            <div class="carousel-item active">
                <div class="d-flex flex-column justify-content-center align-items-center text-center">
                    <img src="./images/web/beneficios1.jpg" alt="" class="rounded-1" width="250" />
                    <h5 class="pt-4 text-primary fw-bold"><?php echo $beneficios['point1Title']; ?></h5>
                    <p class="w-50 my-4 fst-italic fs-4 mb-4">
                        <?php echo $beneficios['point1Text']; ?>
                    </p>
                </div>
            </div>
            <!-- Slide 2 -->
            <div class="carousel-item">
                <div class="d-flex flex-column justify-content-center align-items-center text-center">
                    <img src="./images/web/beneficios2.jpg" alt="" class="rounded-1" width="250" />
                    <h5 class="pt-4 text-primary fw-bold"><?php echo $beneficios['point2Title']; ?></h5>
                    <p class="w-50 my-4 fst-italic fs-4 mb-4">
                        <?php echo $beneficios['point2Text']; ?>
                    </p>
                </div>
            </div>
            <!-- Slide 3 -->
            <div class="carousel-item">
                <div class="d-flex flex-column justify-content-center align-items-center text-center">
                    <img src="./images/web/beneficios3.jpg" alt="" class="rounded-1" width="250" />
                    <h5 class="pt-4 text-primary fw-bold"><?php echo $beneficios['point3Title']; ?></h5>
                    <p class="w-50 my-4 fst-italic fs-4 mb-4">
                        <?php echo $beneficios['point3Text']; ?>
                    </p>
                </div>
            </div>
            <!-- Slide 4 -->
            <div class="carousel-item">
                <div class="d-flex flex-column justify-content-center align-items-center text-center">
                    <img src="./images/web/beneficios4.jpg" alt="" class="rounded-1" width="250" />
                    <h5 class="pt-4 text-primary fw-bold"><?php echo $beneficios['point4Title']; ?></h5>
                    <p class="w-50 my-4 fst-italic fs-4 mb-4">
                        <?php echo $beneficios['point4Text']; ?>
                    </p>
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#testimonialCarousel" data-bs-slide="prev">
            <i class="fas fa-arrow-circle-left fa-2x text-primary"></i>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#testimonialCarousel" data-bs-slide="next">
            <i class="fas fa-arrow-circle-right fa-2x text-primary"></i>
        </button>
    </div>
</section>

<!-- Precios -->
<section id="precios" class="precios py-5 bg-info">
    <div class="container">

        <!-- Precios Header -->
        <div class="row text-center mb-5">
            <div class="col-md-8 offset-md-2">
                <h2 class="fw-bold text-primary"><?php echo $precios['title']; ?></h2>
                <p class="lead text-warning fw-semibold">
                    <?php echo $precios['subtitle']; ?>
                </p>
            </div>
        </div>

        <div class="row justify-content-center pricing">
            <!-- Pricing Col 1 -->
            <div class="col-lg-3 mb-4">
                <div class="card bg-warning text-center rounded-1">
                    <div class="card-body">
                        <div class="title-page fw-bold text-white"><?php echo $precios['individualPrice']; ?></div>
                        <h4 class="card-title text-white mb-5">
                            <?php echo $precios['individualTitle']; ?>
                        </h4>
                        <p class="text-white"><?php echo $precios['individualSession']; ?></p>
                        <a href="/contacto?asunto=2" class="btn btn-secondary text-uppercase text-white mt-4 mb-4"><?php echo $precios['individualButton']; ?></a>
                    </div>
                </div>
            </div>

            <!-- Pricing Col 2 -->
            <div class="col-lg-3 mb-4">
                <div class="card bg-warning text-center rounded-1">
                    <div class="card-body">
                        <div class="title-page fw-bold text-white"><?php echo $precios['pack5Price']; ?></div>
                        <h4 class="card-title text-white mb-5">
                            <?php echo $precios['pack5Title']; ?>
                        </h4>
                        <p class="text-white"><?php echo $precios['pack5Session']; ?></p>
                        <p class="save"><?php echo $precios['pack5Discount']; ?></p>
                        <a href="/contacto?asunto=2" class="btn btn-secondary text-uppercase text-white mt-4 mb-4"><?php echo $precios['pack5Button']; ?></a>
                    </div>
                </div>
            </div>

            <!-- Pricing Col 3 -->
            <div class="col-lg-3 mb-4">
                <div class="card bg-warning text-center rounded-1">
                    <div class="card-body">
                        <div class="title-page fw-bold text-white"><?php echo $precios['pack10Price']; ?></div>
                        <h4 class="card-title text-white mb-5">
                            <?php echo $precios['pack10Title']; ?>
                        </h4>
                        <p class="text-white"><?php echo $precios['pack10Session']; ?></p>
                        <p class="save"><?php echo $precios['pack10Discount']; ?></p>
                        <a href="/contacto?asunto=2" class="btn btn-secondary text-uppercase text-white mt-4 mb-4"><?php echo $precios['pack10Button']; ?></a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<?php /*
<!-- Blog, 1 row 3 col per row with cards -->
<section id="blog" class="blog bg-light py-5">
    <div class="container">
        <h2 class="text-center fw-bold text-primary pb-4">
            Blog
        </h2>
        <!-- Blog Row 1 -->
        <div class="row mb-4 justify-content-center">
            <!-- Blog entry 1 -->
            <div class="col-lg-4 col-md-4">
                <div class="card">
                    <img src="./images/blog/durga2.jpg" class="card-img" alt="" />
                    <div class="card-body">
                        <h5 class="card-title">La diosa Durga</h5>
                        <p class="card-text">
                            Cuando pensé en Durgga como representación de mi proyecto, lo hice por esta maravillosa diosa y por su capacidad para poder hacer frente y poner límites a todas las adversidades,…
                            <a href="./blog/la-diosa-durga.html" class="blog-link">Leer Más</a>
                        </p>
                    </div>
                </div>
            </div>
            <!-- Blog entry 2 -->
            <div class="col-lg-4 col-md-4">
                <div class="card">
                    <img src="./images/blog/respiracion-ovarica.jpg" class="card-img" alt="" />
                    <div class="card-body">
                        <h5 class="card-title">¿Qué es la respiración ovárica-alquimia femenina?</h5>
                        <p class="card-text">
                            Los ovarios, el útero y los senos son la parte de la anatomía femenina con más potencial energético de todo el organismo, es allí donde se encuentra intrínsecamente la semilla…
                            <a href="./blog/que-es-la-respiración-ovárica-alquimia-femenina.html" class="blog-link">Leer Más</a>
                        </p>
                    </div>
                </div>
            </div>
            <!-- Blog entry 3
          <div class="col-lg-4 col-md-4">
            <div class="card">
              <img src="./images/web/blog/durga2.jpg" class="card-img" alt="" />
              <div class="card-body">
                <h5 class="card-title">¿Qué es la respiración ovárica-alquimia femenina?</h5>
                <p class="card-text">
                  Los ovarios, el útero y los senos son la parte de la anatomía femenina con más potencial energético de todo el organismo, es allí donde se encuentra intrínsecamente la semilla…
                  <a href="article.html" class="blog-link">Read More</a>
                </p>
              </div>
            </div>
          </div>
          -->

        </div>
    </div>
</section>
*/ ?>
<?php /*
<!-- Blog, 1 row 3 col per row with cards -->
<section id="blog" class="blog bg-light py-5">
    <div class="container">
        <h2 class="text-center fw-bold text-primary pb-4">
            Blog
        </h2>
        <!-- Blog Row , 3 cols per row -->
        <div class="row mb-4 justify-content-center">
            <?php foreach ($blogTotal as $blog) : ?>
                <?php if ($blog['data']->published === 1) : ?>
                    <div class="col-lg-4 col-md-4 my-4">
                        <div class="card">
                            <img src="<?php echo "/images/blog/" . $blog['images']->storage_filename; ?>" class="card-img" alt="" />
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $blog['data']->title; ?></h5>
                                <p class="card-text">
                                    <?php echo excerpt($blog['data']->content, 50); ?>
                                    <a href="/blog/<?php echo $blog['data']->id ?>" class="blog-link">Leer Más</a>
                                </p>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>

    </div>
</section>
*/ ?>

<section id="blog" class="blog bg-light py-5">
    <div class="container">
        <h2 class="text-center fw-bold text-primary pb-4">
            Blog
        </h2>
        <!-- Blog Row , 3 cols per row -->
        <div class="row mb-4 justify-content-center">
            <?php foreach ($blogList as $blog) : ?>
                <?php if ($blog->published === 1) : ?>
                    <div class="col-lg-4 col-md-4 my-4">
                        <div class="card">
                            <a href="/blog/<?php echo $blog->blogId ?>">
                                <img src="<?php echo "/images/blog/" . $blog->image; ?>" class="card-img" alt="" />
                            </a>
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $blog->title; ?></h5>
                                <p class="card-text">
                                    <?php echo excerpt($blog->content, 150); ?>
                                    <a href="/blog/<?php echo $blog->blogId ?>" class="blog-link">Leer Más</a>
                                </p>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>

    </div>
</section>




<!-- Newsletter -->
<section id="newsletter" class="newsletter py-5 bg-secondary">
    <div class="container">
        <div class="row mb-4">
            <div class="col-md-8 offset-md-2 d-flex flex-column align-items-center text-center">
                <h2 class="fw-bold text-light"><?php echo $newsletter['title']; ?></h2>
                <p class="text-info">
                    <?php echo $newsletter['subtitle']; ?>
                </p>
            </div>
        </div>

        <div class="row">
            <form method="POST" action="/#newsletter">
                <!-- CSRF TOKEN  -->
                <?php include $this->resolve('partials/_csrf.php'); ?>
                <div class="col-md-8 offset-md-2 d-flex flex-column align-items-center text-center">
                    <div class="input-group mb-3  bg-ligth">
                        <input type="email" class="form-control" placeholder="<?php echo $newsletter['placeholder']; ?>" id="email" name="email" value="<?php echo ($oldFormData['email'] ?? ''); ?>" placeholder="" />
                        <button class="btn btn-primary text-white btn-newsletter" type="submit">
                            <?php echo $newsletter['button']; ?>
                        </button>
                    </div>
                </div>
                <!-- Error Message -->
                <?php if (array_key_exists('email', $errors)) : ?>
                    <div class="col-md-8 offset-md-2 text-light mb-4"><?php echo ($errors['email'][0]); ?></div>
                <?php endif; ?>

            </form>
        </div>

    </div>
</section>

<?php include $this->resolve("partials/_footer.php"); ?>