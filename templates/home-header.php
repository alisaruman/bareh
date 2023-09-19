<!DOCTYPE html>
<html lang="fa">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= get_bloginfo("name") ?> | <?= get_bloginfo("description"); ?></title>
    <!-- library imports -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
    <link href="<?php bloginfo("template_directory"); ?>/assets/css/all.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="<?php bloginfo("template_directory"); ?>/style.css">
    <!-- library imports -->
</head>

<body class="home">

    <!-- header  -->
    <header>
        <div class="container">
            <?php
            $defaults = array(
                'theme_location'  => 'primary_menu',
                'container'       => 'nav',
                'container_class' => 'nav justify-content-center align-items-center f16 l25 pt-5',
                'menu_class'      => 'footer-top list-unstyled',
                'add_a_class'     => 'box-link text-dark',
                'echo'            => false,
                'fallback_cb'     => false,
                'items_wrap'      => '%3$s',
                'depth'           => 0
            );
            echo strip_tags(wp_nav_menu($defaults), '<nav><li><a>');
            ?>
        </div>
    </header>
    <!-- header  -->

    <!-- logo -->
    <section class="logo">
        <div class="container d-flex flex-column justify-content-center align-items-center">
            <img src="<?php bloginfo("template_directory"); ?>/images/global/logo.svg" width="80px" />
            <div class="fw-bold f13 l30 text-gray2 pt-1">فرهنگ موضوعی سینمای مستند ایران</div>
        </div>
    </section>
    <!-- logo -->