<?= get_header(); ?>

<!-- single post swiper css -->
<link href="<?= bloginfo("template_directory"); ?>/assets/css/swiper-bundle.min.css" rel="stylesheet" />
<!-- single post swiper css  -->

<div id="Content">
    <div class="container">
        <section class="posts">
            <div class="row">

                <?php if (have_posts()) : ?> <?php while (have_posts()) : the_post();
                    global $post;
                    gt_set_post_view();
                ?>

                        <div class="col-12 mb-3">
                            <div class="post-item bg-white d-flex w-100 rounded-2 justify-content-between align-items-center">
                                <div class="post-content p-3">
                                    <div class="titleShare d-flex justify-content-between align-items-center pb-2">
                                        <span class="mainTitle f22 l28 text-gray2 fw-bold"><?= the_title(); ?></span>
                                        <div class="shareIcon cursor-pointer position-relative">
                                            <ul class="position-absolute bg-white p-2 m-0 top-50 list-unstyled">
                                                <li class="mb-3"><span id="linkCopier" class="d-flex justify-content-center cursor-pointer" data-val="<?= wp_get_shortlink(); ?>"><i class="fa-light fa-link f16 text-gray2"></i></span></li>
                                                <li class="mb-3"><a href="https://telegram.me/share/url?url=<?= the_permalink(); ?>&text=<?= the_title(); ?>" class="d-flex justify-content-center" target="_blank"><i class="fa-light fa-paper-plane f16 text-gray2"></i></a></li>
                                                <li><a href="https://web.whatsapp.com/send?text=<?= the_permalink(); ?>" class="d-flex justify-content-center" target="_blank"><i class="fa-brands fa-whatsapp f16 text-gray2"></i></a></li>
                                            </ul>
                                        </div>
                                    </div>

                                    <!-- retrieve director(s) name -->
                                    <?php
                                                    if (wp_get_post_terms($post->ID, 'director',  array("fields" => "names"))) :
                                                        echo '<div class="director d-block f16 fw-bold l28 text-gray2 pb-5">کارگردان: ';
                                                        $director = wp_get_post_terms($post->ID, 'director',  array("fields" => "names"));
                                                        foreach ($director as $item => $value) {
                                                            echo '<span class="d-inline-block ms-1">' . $director[$item] . '</span>';
                                                        }
                                                    endif;
                                    ?>
                                    <!-- retrieve director(s) name -->

                                </div>
                                <div class="tagsTime d-flex justify-content-between align-items-center pt-5">

                                    <!-- retrieve film categories -->
                                    <div class="tags d-flex">
                                        <?php
                                                    $post_categories = wp_get_post_categories($post->ID, array('fields' => 'all'));
                                                    foreach ($post_categories as $cat => $value) {
                                                        echo '<a href="' . esc_url(get_category_link($post_categories[$cat]->term_id)) . '">' . $post_categories[$cat]->name . '</a>';
                                                    }
                                        ?>
                                    </div>
                                    <!-- retrieve film categories -->

                                    <!-- retrieve duration of film -->
                                    <?php
                                                    if (get_post_meta($post->ID, "filmDuration", true)) :
                                                        $filmtime = get_post_meta($post->ID, "filmDuration", true);
                                    ?>
                                        <div class="time d-flex align-items-center">
                                            <i class="fa-light fa-clock-three text-gray2 f16 ms-3"></i>
                                            <span class="f16 l20 text-gray2"><?= $filmtime; ?></span>
                                        </div>
                                    <?php endif; ?>
                                    <!-- retrieve duration of film -->

                                </div>
                            </div>
                            <div class="pic position-relative">
                                <div class="pic-inside position-relative w-100 overflow-hidden">
                                    <img src="<?= get_the_post_thumbnail_url($post->ID, 'full'); ?>" alt="<?= the_title(); ?>" class="mainImg position-absolute start-0 w-100 h-auto" />
                                </div>
                            </div>
                        </div>
            </div>

    </div>
    </section>
    <!-- posts  -->

    <!-- Content  -->
    <div class="row post-content f14 l28 text-gray2 bg-white m-0 rounded-2 pt-3 px-1">
        <?= the_content(); ?>
    </div>
    <!-- Content  -->

    <!-- Data table  -->
    <div class="row m-0 my-3" id="data-tables">
        <div class="col-lg-6 pe-0 ps-1">
            <div class="bg-white rounded-2 py-5 px-3">
                <table class="table text-end f14 l28 w-auto m-auto">
                    <tbody>

                        <?php if (get_post_meta($post->ID, "movieYear", true)) : ?>
                            <tr>
                                <td>سال ساخت</td>
                                <td><?= get_post_meta($post->ID, "movieYear", true); ?></td>
                            </tr>
                        <?php endif; ?>

                        <?php if (get_post_meta($post->ID, "movieFormat", true)) : ?>
                            <tr>
                                <td> فرمت</td>
                                <td><?= get_post_meta($post->ID, "movieFormat", true); ?></td>
                            </tr>
                        <?php endif; ?>

                        <?php if (get_post_meta($post->ID, "movieDuration", true)) : ?>
                            <tr>
                                <td> مدت‌زمان</td>
                                <td class="pb-4"><?= get_post_meta($post->ID, "movieDuration", true); ?></td>
                            </tr>
                        <?php endif; ?>

                        <?php if (get_post_meta($post->ID, "movieDirector", true)) : ?>
                            <tr>
                                <td>کارگردان</td>
                                <td class="fw-bold"><?= get_post_meta($post->ID, "movieDirector", true); ?></td>
                            </tr>
                        <?php endif; ?>

                        <?php if (get_post_meta($post->ID, "movieCreator", true)) : ?>
                            <tr>
                                <td>تهیه کننده</td>
                                <td><?= get_post_meta($post->ID, "movieCreator", true); ?></td>
                            </tr>
                        <?php endif; ?>

                        <?php if (get_post_meta($post->ID, "movieOrder", true)) : ?>
                            <tr>
                                <td>به سفارش</td>
                                <td><?= get_post_meta($post->ID, "movieOrder", true); ?></td>
                            </tr>
                        <?php endif; ?>

                        <?php if (get_post_meta($post->ID, "movieMade", true)) : ?>
                            <tr>
                                <td>تهیه شده در</td>
                                <td><?= get_post_meta($post->ID, "movieMade", true); ?></td>
                            </tr>
                        <?php endif; ?>

                        <?php if (get_post_meta($post->ID, "movieResearcher", true)) : ?>
                            <tr>
                                <td>پژوهش‌گر</td>
                                <td><?= get_post_meta($post->ID, "movieResearcher", true); ?></td>
                            </tr>
                        <?php endif; ?>

                        <?php if (get_post_meta($post->ID, "movieWriter", true)) : ?>
                            <tr>
                                <td>نویسنده</td>
                                <td><?= get_post_meta($post->ID, "movieWriter", true); ?></td>
                            </tr>
                        <?php endif; ?>

                        <?php if (get_post_meta($post->ID, "movieDialogue", true)) : ?>
                            <tr>
                                <td>نویسنده گفتار</td>
                                <td><?= get_post_meta($post->ID, "movieDialogue", true); ?></td>
                            </tr>
                        <?php endif; ?>

                        <?php if (get_post_meta($post->ID, "movieCamera", true)) : ?>
                            <tr>
                                <td>فیلمبردار</td>
                                <td><?= get_post_meta($post->ID, "movieCamera", true); ?></td>
                            </tr>
                        <?php endif; ?>

                        <?php if (get_post_meta($post->ID, "movieEditor", true)) : ?>
                            <tr>
                                <td>تدوین‌گر</td>
                                <td><?= get_post_meta($post->ID, "movieEditor", true); ?></td>
                            </tr>
                        <?php endif; ?>

                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-lg-6 ps-0">
            <div class="bg-white rounded-2 py-5 px-3">
                <table class="table text-end f14 l28 w-auto m-auto">
                    <tbody>

                        <?php if (get_post_meta($post->ID, "movieSoundCreator", true)) : ?>
                            <tr>
                                <td>صدا‌بردار</td>
                                <td><?= get_post_meta($post->ID, "movieSoundCreator", true); ?></td>
                            </tr>
                        <?php endif; ?>

                        <?php if (get_post_meta($post->ID, "movieSoundPutter", true)) : ?>
                            <tr>
                                <td>صداگذار</td>
                                <td><?= get_post_meta($post->ID, "movieSoundPutter", true); ?></td>
                            </tr>
                        <?php endif; ?>

                        <?php if (get_post_meta($post->ID, "movieSoundMerger", true)) : ?>
                            <tr>
                                <td>طراحی و ترکیب‌صدا</td>
                                <td><?= get_post_meta($post->ID, "movieSoundMerger", true); ?></td>
                            </tr>
                        <?php endif; ?>

                        <?php if (get_post_meta($post->ID, "movieMusicCreator", true)) : ?>
                            <tr>
                                <td>آهنگساز</td>
                                <td><?= get_post_meta($post->ID, "movieMusicCreator", true); ?></td>
                            </tr>
                        <?php endif; ?>

                        <?php if (get_post_meta($post->ID, "movieCaster", true)) : ?>
                            <tr>
                                <td>گوینده</td>
                                <td><?= get_post_meta($post->ID, "movieCaster", true); ?></td>
                            </tr>
                        <?php endif; ?>

                        <?php if (get_post_meta($post->ID, "movieLightEditor", true)) : ?>
                            <tr>
                                <td>اصلاح رنگ و نور</td>
                                <td><?= get_post_meta($post->ID, "movieLightEditor", true); ?></td>
                            </tr>
                        <?php endif; ?>

                        <?php if (get_post_meta($post->ID, "movieGraphic", true)) : ?>
                            <tr>
                                <td>گرافیک</td>
                                <td><?= get_post_meta($post->ID, "movieGraphic", true); ?></td>
                            </tr>
                        <?php endif; ?>

                        <?php if (get_post_meta($post->ID, "movieMotion", true)) : ?>
                            <tr>
                                <td>موشن</td>
                                <td class="pb-4"><?= get_post_meta($post->ID, "movieMotion", true); ?></td>
                            </tr>
                        <?php endif; ?>

                        <?php if (get_post_meta($post->ID, "movieSubject", true)) : ?>
                            <tr>
                                <td>موضوع</td>
                                <td><?= get_post_meta($post->ID, "movieSubject", true); ?></td>
                            </tr>
                        <?php endif; ?>

                        <?php if (get_post_meta($post->ID, "movieLocation", true)) : ?>
                            <tr>
                                <td>محل فیلمبرداری</td>
                                <td><?= get_post_meta($post->ID, "movieLocation", true); ?></td>
                            </tr>
                        <?php endif; ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- Data table  -->

    <!-- post slider  -->
    <?php if (have_rows('slider')) : ?>
        <div class="row m-0" id="postSwiper" dir="ltr">
            <div class="col-12 bg-white rounded-2 p-lg-5">
                <div style="--swiper-navigation-color: #fff; --swiper-pagination-color: #fff" class="swiper mySwiper2">
                    <div class="swiper-wrapper">

                        <?php while (have_rows('slider')) : the_row(); ?>
                            <div class="swiper-slide">
                                <?php if (get_sub_field('sliderType') == 'عکس') : ?>
                                    <img src="<?= get_sub_field('sliderValue'); ?>" />
                                <?php else : ?>
                                    <video width="100%" height="100%" controls>
                                        <source src="<?= get_sub_field('sliderValue'); ?>" type="video/mp4">
                                        مرورگر شما از ویدیو پشتیبانی نمی‌کند.
                                    </video>
                                <?php endif; ?>
                            </div>
                        <?php endwhile; ?>

                    </div>
                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>
                </div>

                <div thumbsSlider="" class="swiper mySwiper pb-0">
                    <div class="swiper-wrapper">

                        <?php while (have_rows('slider')) : the_row(); ?>
                            <div class="swiper-slide cursor-pointer">
                                <img src="<?= get_sub_field('sliderPic'); ?>" />
                            </div>
                        <?php endwhile; ?>

                    </div>
                </div>

            </div>
        </div>

        <script src="<?= bloginfo("template_directory"); ?>/assets/js/swiper-bundle.min.js"></script>
        <script>
            var swiper = new Swiper("#postSwiper .mySwiper", {
                spaceBetween: 10,
                slidesPerView: 8,
                freeMode: true,
                watchSlidesProgress: true,
            });
            var swiper2 = new Swiper("#postSwiper .mySwiper2", {
                spaceBetween: 10,
                navigation: {
                    nextEl: ".swiper-button-next",
                    prevEl: ".swiper-button-prev",
                },
                thumbs: {
                    swiper: swiper,
                },
            });
        </script>

    <?php endif; ?>
    <!-- post slider  -->

    <div class="col-12">
        <div class="d-flex align-items-end my-4 f16 l28 text-gray2">
            <span class="pb-1">اطلاعات این فیلم مشکلی دارد؟ </span>
            <span class="cursor-pointer fw-bold pb-1 me-3" id="reportBug">
                گزارش مشکل
            </span>
        </div>

        <div id="reportForm" class="w-50">
            <?= do_shortcode('[contact-form-7 id="75" title="فرم گزارش مشکل"]'); ?>
        </div>

    </div>

    <!-- lastSeen boxes  -->
    <?php require_once get_template_directory() . '/templates/sections/single-lastseen.php'; ?>
    <!-- lastSeen boxes  -->
<?php endwhile;
                                            endif; ?>

</div>
</div>

<?= get_footer(); ?>