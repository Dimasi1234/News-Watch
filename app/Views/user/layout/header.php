<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>NewsWacth</title>
    <link rel="icon" type="image/x-icon" href="<?= base_url('assets/user/assets/logo.ico') ?>" />
    <!-- Font Awesome icons (free version)-->
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <!-- Google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800" rel="stylesheet" type="text/css" />
    <link href="<?= base_url('assets/user/css/styles.css') ?>" rel="stylesheet" />
    <script src="<?= base_url('assets/user/js/scripts.js') ?>"></script>
</head>
<body>
    <!-- Responsive navbar-->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
        <div class="container">
            <a class="navbar-brand" href="<?= base_url('/') ?>">NewsWatch</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4 active" href="<?= base_url('/') ?>">Home</a></li>
                    <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4" href="#!">About</a></li>
                    <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4" href="#!">Contact</a></li>
                    <?php $isLoggedIn = session()->get('isLoggedIn'); ?>
                    <li class="nav-item">
                        <a class="nav-link px-lg-3 py-3 py-lg-4" href="<?= $isLoggedIn ? base_url('/profile') : base_url('/login') ?>">
                            <?= $isLoggedIn ? 'Profile' : 'Login' ?>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Page header with logo and tagline-->
    <header class="py-5 bg-light border-bottom mb-4">
        <div class="container">
            <div class="text-center my-5">
                <h1 class="fw-bolder">Welcome to NEW'S Watch!</h1>
                <p class="lead mb-0">All type of news from all trusted sources for all type of people</p>
            </div>
        </div>
    </header>


        