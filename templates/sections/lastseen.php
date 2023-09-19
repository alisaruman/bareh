<?php

global $post;
$month = date("m");
$year = date("Y");

$popularArgs = array(
    'post_type' => 'post',
    'posts_per_page' => '10',
    'meta_key' => 'post_views_count',
    'orderby' => 'meta_value_num',
    'order' => 'DESC',
    'monthnum' => $month,
    'year' => $year
);
$popular = new WP_Query($popularArgs);

$recentArgs = array(
    'post_type' => 'post',
    'posts_per_page' => '10',
    'orderby' => 'date',
);

$recent = new WP_Query($recentArgs);

?>

<section id="lastSeen" class="py-5">
    <div class="container">
        <div class="row">

            <div class="col-md-6 pe-md-0">
                <div class="box rounded-2 p-0 box overflow-hidden">
                    <div class="head p-3">
                        <span class="f16 l20 text-gray2 fw-bold">برترین فیلم‌های ماه</span>
                    </div>
                    <div class="lastContent p-3 pe-1">
                        <ul class="list-unstyled p-0 m-0 pe-3 overflow-auto" dir="ltr">

                            <?php
                            if ($popular->have_posts()) :
                                while ($popular->have_posts()) :
                                    $popular->the_post();
                            ?>
                                    <li class="position-relative pb-1 text-end" dir="rtl">
                                        <a href="<?= the_permalink(); ?>" class="d-block">
                                            <span class="name d-inline-flex">
                                                <span class="nameInside fw-bold f16 l30 text-gray2"><?= the_title(); ?></span>
                                            </span>
                                            <span class="director f12 l30 text-gray2">
                                                <?php if (!empty(get_field('movieDirector'))) {
                                                    echo get_field('movieDirector');
                                                }
                                                ?>
                                            </span>
                                            <i class="fas fa-angle-left position-absolute top-50 start-0 translate-middle-y f21 text-gray2"></i>
                                        </a>
                                    </li>
                            <?php
                                endwhile;
                            endif;
                            wp_reset_postdata();
                            ?>

                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-md-6 ps-md-0">
                <div class="box rounded-2 p-0 box overflow-hidden">
                    <div class="head p-3">
                        <span class="f16 l20 text-gray2 fw-bold">آخرین فیلم‌های ثبت شده</span>
                    </div>
                    <div class="lastContent p-3 pe-1">
                        <ul class="list-unstyled p-0 m-0 pe-3 overflow-auto" dir="ltr">

                            <?php
                            if ($recent->have_posts()) :
                                while ($recent->have_posts()) :
                                    $recent->the_post();
                            ?>
                                    <li class="position-relative pb-1 text-end" dir="rtl">
                                        <a href="<?= the_permalink(); ?>" class="d-block">
                                            <span class="name d-inline-flex">
                                                <span class="nameInside fw-bold f16 l30 text-gray2"><?= the_title(); ?></span>
                                            </span>
                                            <span class="director f12 l30 text-gray2">
                                                <?php if (!empty(get_field('movieDirector'))) {
                                                    echo get_field('movieDirector');
                                                }
                                                ?>
                                            </span>
                                            <i class="fas fa-angle-left position-absolute top-50 start-0 translate-middle-y f21 text-gray2"></i>
                                        </a>
                                    </li>
                            <?php
                                endwhile;
                            endif;
                            wp_reset_postdata();
                            ?>

                        </ul>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>