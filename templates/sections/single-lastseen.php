<section id="lastSeen" class="py-5">
    <div class="row m-0">

        <!-- Get director terms => get just ids by pluck => create the query => show 5 posts from this director except this post -->
        <div class="col-md-6 pe-md-0">
            <div class="box rounded-2 p-0 box overflow-hidden">
                <div class="head p-3 bg-white">
                    <span class="f16 l20 text-gray2 fw-bold">از همین کارگردان</span>
                </div>
                <div class="lastContent p-3 pe-1">
                    <ul class="list-unstyled p-0 m-0 pe-3 overflow-auto" dir="ltr">

                        <?php
                        $directorString = get_the_terms($post->ID, 'director', 'string');
                        $director_ids = wp_list_pluck($directorString, 'term_id');
                        $thisDirector = new WP_Query(array(
                            'tax_query' => array(array(
                                'taxonomy' => 'director',
                                'field' => 'id',
                                'terms' => $director_ids,
                                'operator' => 'IN',
                            )),
                            'post__not_in' => array($post->ID),
                            'posts_per_page' => 5,
                        ));
                        if ($thisDirector->have_posts()) : while ($thisDirector->have_posts()) : $thisDirector->the_post();
                        ?>
                                <li class="position-relative pb-1 text-end" dir="rtl">
                                    <a href="<?= the_permalink(); ?>" class="d-block">
                                        <span class="name d-inline-flex">
                                            <span class="nameInside fw-bold f16 l30 text-gray2"><?= the_title(); ?></span>
                                        </span>
                                        <span class="director f12 l30 text-gray2">
                                            <?php
                                            if (get_post_meta($post->ID, "movieDirector", true)) :
                                                echo get_post_meta($post->ID, "movieDirector", true);
                                            endif;
                                            ?>
                                        </span>
                                        <i class="fas fa-angle-left position-absolute top-50 start-0 translate-middle-y f21 text-gray2"></i>
                                    </a>
                                </li>
                        <?php endwhile;
                        endif;
                        wp_reset_postdata();
                        ?>

                    </ul>
                </div>
            </div>
        </div>
        <!-- Get director terms => get just ids by pluck => create the query => show 5 posts from this director except this post -->

        <!-- Get related posts based on cat => setup the postdata on $post => show 5 posts from this category except this post -->
        <div class="col-md-6 ps-md-0">
            <div class="box rounded-2 p-0 box overflow-hidden">
                <div class="head p-3 bg-white">
                    <span class="f16 l20 text-gray2 fw-bold">فیلم هایی با موضوع مشابه</span>
                </div>
                <div class="lastContent p-3 pe-1">
                    <ul class="list-unstyled p-0 m-0 pe-3 overflow-auto" dir="ltr">

                        <?php
                        $related = get_posts(array('category__in' => wp_get_post_categories($post->ID), 'numberposts' => 5, 'post__not_in' => array($post->ID)));
                        if ($related) foreach ($related as $post) {
                            setup_postdata($post); ?>
                            <li class="position-relative pb-1 text-end" dir="rtl">
                                <a href="<?= the_permalink(); ?>" class="d-block">
                                    <span class="name d-inline-flex">
                                        <span class="nameInside fw-bold f16 l30 text-gray2"><?= the_title(); ?></span>
                                    </span>
                                    <span class="director f12 l30 text-gray2">
                                        <?php
                                        if (get_post_meta($post->ID, "movieDirector", true)) :
                                            echo get_post_meta($post->ID, "movieDirector", true);
                                        endif;
                                        ?>
                                    </span>
                                    <i class="fas fa-angle-left position-absolute top-50 start-0 translate-middle-y f21 text-gray2"></i>
                                </a>
                            </li>
                        <?php }
                        wp_reset_postdata(); ?>

                    </ul>
                </div>
            </div>
        </div>
        <!-- Get related posts based on cat => setup the postdata on $post => show 5 posts from this category except this post -->

    </div>
</section>