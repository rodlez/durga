<!DOCTYPE html>
<html lang="en">
<!-- DEVELOPMENT -->
<?php
showNice($_SESSION);
?>
<!-- ***********  -->

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Google Fonts: Source Serif 4 -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Source+Serif+4:ital,opsz,wght@0,8..60,200..900;1,8..60,200..900&display=swap" rel="stylesheet">
    <!-- CSS -->
    <link rel="stylesheet" href="/css/bootstrap.css">
    <link rel="stylesheet" href="/css/styles.css">
    <link rel="stylesheet" href="/css/fontawesome.css">
    <!-- Favicon -->
    <link rel="icon" href="/images/favicon.png" />
    <title><?php echo escapeChar($title); ?></title>
</head>

<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg sticky-top">
        <div class="container">
            <!-- Logo -->
            <a class="navbar-brand" href="/">
                <img src="/images/web/logo.svg" alt="" width="200" />
            </a>
            <!-- Hamburger Menu -->
            <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                <div class="close-icon border-0 px-2 text-white">
                    <i class="fa-solid fa-x fa-1x"></i>
                </div>
                <!--<div class="close-icon border-0 py-1 text-white">✖</div>-->
            </button>
            <!-- Navigation Menu -->
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item px-2">
                        <a class="nav-link" aria-current="page" href="/">Home</a>
                    </li>
                    <li class="nav-item px-2">
                        <a class="nav-link" href="/about">About</a>
                    </li>
                    <li class="nav-item px-2">
                        <a class="nav-link" href="#">Link 1</a>
                    </li>
                    <li class="nav-item px-2">
                        <a class="nav-link" href="#">Link 2</a>
                    </li>
                    <!-- Conditional Rendering if the user is login -->
                    <?php if (isset($_SESSION['user'])) : ?>
                        <li class="nav-item px-2">
                            <a class="nav-link" href="/logout" onclick="return confirm('Are you sure you want to logout?');">Logout</a>
                        </li>
                    <?php endif; ?>

                    <!-- Social Icons outside the ul to properly align them -->
                    <div class="social-icons">
                        <span class="nav-item">
                            <span class="fa-stack">
                                <a href="#" target="_blank">
                                    <i class="fas fa-circle fa-stack-2x"></i>
                                    <i class="fab fa-linkedin fa-stack-1x"></i>
                                </a>
                            </span>
                        </span>
                        <span class="nav-item">
                            <span class="fa-stack">
                                <a href="#" target="_blank">
                                    <i class="fas fa-circle fa-stack-2x"></i>
                                    <i class="fab fa-instagram fa-stack-1x"></i>
                                </a>
                            </span>
                        </span>
                    </div>
            </div>
        </div>
    </nav>