<?php
// Template Name: نتایج جستجو
get_header();
?>

<div id="Content">
    <div class="container">

        <!-- result section -->
        <div class="row d-flex justify-content-between align-items-center pb-2">
            <div class="col-8 col-lg-9">
                <div class="resultName text-gray2 f16 l28">
                    فیلم‌های مرتبط با <span class="fw-bold"><?= $_GET['s']; ?></span>
                </div>
            </div>
            <div class="col-4 col-lg-3 text-start">
                <div class="resultNum f16 l28 text-gray2">
                    <span class="fw-bold ms-1">
                        <?php
                        global $wp_query;
                        // if ($filter2->have_posts()) {
                        //     echo $wp_query->found_posts + $filter2->post_count;
                        // } else {
                        echo  $wp_query->found_posts;
                        // }
                        ?>
                    </span>فیلم
                </div>
            </div>
        </div>
        <!-- result section  -->

        <!-- posts  -->
        <section class="posts">
            <div class="row">

                <?php
                $location = [];
                $year = [];
                $time = [];
                if (isset($_GET['locationItems'])) {
                    $location = $_GET['locationItems'];
                }
                if (isset($_GET['yearsItems'])) {
                    $year = $_GET['yearsItems'];
                }
                if (isset($_GET['timeItems'])) {
                    $time = $_GET['timeItems'];
                }
                my_search($_GET['s'], 2, $location, $year, $time);
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

        <!-- lastSeen boxes  -->
        <?php include('templates/sections/lastseen.php'); ?>
        <!-- lastSeen boxes  -->

    </div>
</div>

<?= get_footer(); ?>