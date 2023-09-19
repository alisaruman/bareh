<?php
// Template Name: نتایج دسته‌بندی فیلم‌ها
?>
<?= get_header(); ?>

<div id="Content">
    <div class="container">

        <!-- result section -->
        <div class="row d-flex justify-content-between align-items-center pb-2">
            <div class="col-8 col-lg-9">

                <?php if (isset($_POST['submit'])) : if (!empty($_POST['cats'])) : 
                        $selected = [];
                ?>
                        <div class="resultName text-gray2 f16 l28">
                            نتیجه جستجوی فیلم های

                            <?php foreach ($_POST['cats'] as $cat) : 
                                array_push($selected, get_cat_ID($cat));
                            ?>
                                <span class="selectedCat f12 py-1 pe-2 text-gray2 my-1 rounded cursor-pointer d-inline-flex align-items-center mx-2">
                                    <span><?= $cat; ?></span>
                                    <i class="fa-light fa-xmark ms-2 me-3 f16"></i>
                                </span>
                            <?php endforeach; ?>

                        </div>
                <?php endif;
                endif; ?>

                <?php
                $resultNumPost = new WP_Query(array(
                    'post_type' => 'post',
                    'showposts' => -1,
                    'category__in' => $selected,
                ));
                ?>

            </div>
            <div class="col-4 col-lg-3 text-start">
                <div class="resultNum f16 l28 text-gray2">
                    <span class="fw-bold ms-1"><?= $resultNumPost->post_count; ?></span>فیلم
                </div>
            </div>
        </div>
        <!-- result section  -->

        <!-- posts  -->
        <section class="posts">
            <div class="row">

                <?php
                $defaultQuery = new WP_Query(array(
                    'post_type' => 'post',
                    'category__in' => $selected,
                ));
                if ($defaultQuery->have_posts()) :

                    global $post;
                    while ($defaultQuery->have_posts()) : $defaultQuery->the_post(); ?>
                        <?php include('sections/post-item.php'); ?>
                <?php endwhile;
                endif; ?>

            </div>
        </section>
        <!-- posts  -->

        <!-- see more -->
        <section class="seemore">
            <div class="row pt-2 pb-5">
                <button class="text-gray2 d-inline-block w-auto m-auto f16 l20 fw-bold cursor-pointer border-0 bg-transparent" id="loadMore">بیشتر ببینید
                </button>
            </div>
        </section>
        <!-- see more -->

    </div>
</div>

<?= get_footer(); ?>