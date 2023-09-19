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

                $taxes = array("relation" => "AND");
                if (isset($_GET['locationItems'])) :
                    $childs =  [];
                    foreach ($_GET['locationItems'] as $locationItem) :
                        $locationItemName = get_term_by('name', $locationItem, 'location');
                        if ($locationItemName) {
                            $childs[] = $locationItemName->term_id;
                        }
                    endforeach;
                    $taxes[] = array("taxonomy" => "location", "terms" => $childs);
                endif;
                if (isset($_GET['yearsItems'])) :
                    $childs = [];
                    foreach ($_GET['yearsItems'] as $yearsItem) :
                        $yearsItemName = get_term_by('name', $yearsItem, 'filmyear');
                        if ($yearsItemName) {
                            $childs[] = $yearsItemName->term_id;
                        }
                    endforeach;
                    $taxes[] = array("taxonomy" => "filmyear", "terms" => $childs);
                endif;
                if (isset($_GET['timeItems'])) :
                    $childs = [];
                    foreach ($_GET['timeItems'] as $timeItem) :
                        $timeItemName = get_term_by('name', $timeItem, 'filmtime');
                        if ($timeItemName) {
                            $childs[] =  $timeItemName->term_id;
                        }
                    endforeach;
                    $taxes[] = array("taxonomy" => "filmtime", "terms" => $childs);
                endif;

                $filterPrev = array(
                    'post_type' => 'post',
                );

                if (!empty($_GET['s'])) {
                    $filterPrev['s'] = $_GET['s'];
                }
                if (!empty($taxes)) {
                    $filterPrev['tax_query'] = $taxes;
                }

                $filter = new WP_Query($filterPrev);
                $filterExclude = [];
                $defExclude = [];

                if ($filter->have_posts()) {
                    global $post;
                    while ($filter->have_posts()) : $filter->the_post();
                        array_push($filterExclude, $post->ID);
                        include('templates/sections/post-item.php');
                    endwhile;
                    wp_reset_postdata();
                    print_r($filterExclude);

                    if (!empty($_GET['s'])) {
                        $filter2 = new WP_Query(array(
                            'post_type' => 'post',
                            'meta_query' => array(
                                'relation' => 'OR',
                                array(
                                    'key' => 'movieDirector',
                                    'value' => $_GET['s'],
                                    'compare' => 'LIKE'
                                ),
                                array(
                                    'key' => 'movieCreator',
                                    'value' => $_GET['s'],
                                    'compare' => 'LIKE'
                                )
                            ),
                            'post__not_in' => $filterExclude,
                        ));
                    }

                    if ($filter2->have_posts()) {
                        global $post;
                        while ($filter2->have_posts()) : $filter2->the_post();
                            include('templates/sections/post-item.php');
                        endwhile;
                    }
                    wp_reset_postdata();

                } 
                else {
                    if (have_posts()) {
                        global $post;
                        while (have_posts()) : the_post();
                            array_push($defExclude, $post->ID);
                            include('templates/sections/post-item.php');
                        endwhile;
                    }

                    if (!empty($_GET['s'])) {
                        $filter2 = new WP_Query(array(
                            'post_type' => 'post',
                            'meta_query' => array(
                                'relation' => 'OR',
                                array(
                                    'key' => 'movieDirector',
                                    'value' => $_GET['s'],
                                    'compare' => 'LIKE'
                                ),
                                array(
                                    'key' => 'movieCreator',
                                    'value' => $_GET['s'],
                                    'compare' => 'LIKE'
                                )
                            ),
                            'post__not_in' => $defExclude,
                        ));
                    }

                    if ($filter2->have_posts()) {
                        global $post;
                        while ($filter2->have_posts()) : $filter2->the_post();
                            include('templates/sections/post-item.php');
                        endwhile;
                    }
                    wp_reset_postdata();
                }

                if(!empty($filterExclude)) {
                    ?>
                        <script>let filterExclude = "<?php echo implode(',',$filterExclude); ?>";</script>
                    <?php
                }
                if(!empty($defExclude)) {
                    ?>
                        <script>let defExclude = "<?php echo implode(',',$defExclude); ?>";</script>
                    <?php
                }

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
        <section id="lastSeen" class="py-5">
            <div class="row">

                <div class="col-md-6 pe-md-0">
                    <div class="box rounded-2 p-0 box overflow-hidden">
                        <div class="head p-3">
                            <span class="f16 l20 text-gray2 fw-bold">آخرین جستجوهای مخاطبان</span>
                        </div>
                        <div class="lastContent p-3 pe-1">
                            <ul class="list-unstyled p-0 m-0 pe-3 overflow-auto" dir="ltr">
                                <li class="position-relative pb-1 text-end" dir="rtl">
                                    <a href="#" class="d-block">
                                        <span class="name d-inline-flex">
                                            <span class="nameInside fw-bold f16 l30 text-gray2">پروژه ازدواج</span>
                                        </span>
                                        <span class="director f12 l30 text-gray2">حسام اسلامی</span>
                                        <i class="fas fa-angle-left position-absolute top-50 start-0 translate-middle-y f21 text-gray2"></i>
                                    </a>
                                </li>
                                <li class="position-relative pb-1 text-end" dir="rtl">
                                    <a href="#" class="d-block">
                                        <span class="name d-inline-flex">
                                            <span class="nameInside fw-bold f16 l30 text-gray2">خیزاب</span>
                                        </span>
                                        <span class="director f12 l30 text-gray2">علی حیدری</span>
                                        <i class="fas fa-angle-left position-absolute top-50 start-0 translate-middle-y f21 text-gray2"></i>
                                    </a>
                                </li>
                                <li class="position-relative pb-1 text-end" dir="rtl">
                                    <a href="#" class="d-block">
                                        <span class="name d-inline-flex">
                                            <span class="nameInside fw-bold f16 l30 text-gray2">داخلی-تهران</span>
                                        </span>
                                        <span class="director f12 l30 text-gray2">پوریا غفوری</span>
                                        <i class="fas fa-angle-left position-absolute top-50 start-0 translate-middle-y f21 text-gray2"></i>
                                    </a>
                                </li>
                                <li class="position-relative pb-1 text-end" dir="rtl">
                                    <a href="#" class="d-block">
                                        <span class="name d-inline-flex">
                                            <span class="nameInside fw-bold f16 l30 text-gray2">پروژه ازدواج</span>
                                        </span>
                                        <span class="director f12 l30 text-gray2">حسام اسلامی</span>
                                        <i class="fas fa-angle-left position-absolute top-50 start-0 translate-middle-y f21 text-gray2"></i>
                                    </a>
                                </li>
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
                                <li class="position-relative pb-1 text-end" dir="rtl">
                                    <a href="#" class="d-block">
                                        <span class="name d-inline-flex">
                                            <span class="nameInside fw-bold f16 l30 text-gray2">پروژه ازدواج</span>
                                        </span>
                                        <span class="director f12 l30 text-gray2">حسام اسلامی</span>
                                        <i class="fas fa-angle-left position-absolute top-50 start-0 translate-middle-y f21 text-gray2"></i>
                                    </a>
                                </li>
                                <li class="position-relative pb-1 text-end" dir="rtl">
                                    <a href="#" class="d-block">
                                        <span class="name d-inline-flex">
                                            <span class="nameInside fw-bold f16 l30 text-gray2">خیزاب</span>
                                        </span>
                                        <span class="director f12 l30 text-gray2">علی حیدری</span>
                                        <i class="fas fa-angle-left position-absolute top-50 start-0 translate-middle-y f21 text-gray2"></i>
                                    </a>
                                </li>
                                <li class="position-relative pb-1 text-end" dir="rtl">
                                    <a href="#" class="d-block">
                                        <span class="name d-inline-flex">
                                            <span class="nameInside fw-bold f16 l30 text-gray2">داخلی-تهران</span>
                                        </span>
                                        <span class="director f12 l30 text-gray2">پوریا غفوری</span>
                                        <i class="fas fa-angle-left position-absolute top-50 start-0 translate-middle-y f21 text-gray2"></i>
                                    </a>
                                </li>
                                <li class="position-relative pb-1 text-end" dir="rtl">
                                    <a href="#" class="d-block">
                                        <span class="name d-inline-flex">
                                            <span class="nameInside fw-bold f16 l30 text-gray2">پروژه ازدواج</span>
                                        </span>
                                        <span class="director f12 l30 text-gray2">حسام اسلامی</span>
                                        <i class="fas fa-angle-left position-absolute top-50 start-0 translate-middle-y f21 text-gray2"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

            </div>
        </section>
        <!-- lastSeen boxes  -->

    </div>
</div>

<?= get_footer(); ?>