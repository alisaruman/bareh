<?php
// Template Name: نتایج دسته‌بندی فیلم‌ها
?>
<?= get_header(); ?>

<div id="Content">
    <div class="container">

        <?php
        $currentCat = single_cat_title('', false);
        $currentCatId = get_cat_ID($currentCat);
        ?>

        <!-- result section -->
        <div class="row d-flex justify-content-between align-items-center pb-2">

            <div class="col-8 col-lg-9">
                <div class="resultName text-gray2 f16 l28">
                    مشاهده فیلم‌های
                    <span class="fw-bold"><?= $currentCat ?></span>
                </div>
            </div>

            <?php
            $currentQuery = new WP_Query(array(
                'post_type' => 'post',
                'showposts' => -1,
                'category__in' => $currentCatId,
            ));
            ?>

            <div class="col-4 col-lg-3 text-start">
                <div class="resultNum f16 l28 text-gray2">
                    <span class="fw-bold ms-1"><?= $currentQuery->post_count; ?></span>فیلم
                </div>
            </div>

        </div>
        <!-- result section  -->

        <!-- posts  -->
        <section class="posts">
            <div class="row">

                <?php
                global $wp_query;
                if (have_posts()) :
                    global $post;
                    while (have_posts()) : the_post(); ?>
                        <?php include('templates/sections/post-item.php'); ?>
                <?php endwhile;
                endif; 
                ?>

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