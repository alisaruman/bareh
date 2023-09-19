<?php
global $post;
?>


<div class="col-12 mb-3">
    <div class="post-item bg-white d-flex w-100 rounded-2 justify-content-between align-items-center">
        <div class="post-content p-3">
            <div class="titleShare d-flex justify-content-between align-items-center pb-2">
                <a href="<?= the_permalink(); ?>"><span class="mainTitle f22 l28 text-gray2 fw-bold"><?= the_title(); ?></span></a>
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
                echo '<div class="director d-block f20 l28 text-gray2 pb-3">';
                $director = wp_get_post_terms($post->ID, 'director',  array("fields" => "names"));
                foreach ($director as $item => $value) {
                    echo '<span class="d-inline-block ms-1">' . $director[$item] . '</span>';
                }
                echo '</div>';
            endif;
            ?>
            <!-- retrieve director(s) name -->

            <p class="excerpt text-gray2 f16 l25 w-75 pb-lg-3">
                <?= get_the_excerpt(); ?>
            </p>
            <div class="tagsTime d-flex justify-content-between align-items-center">

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
            <div class="pic-inside position-relative w-100">
                <img src="<?= get_the_post_thumbnail_url($post->ID, 'full'); ?>" alt="<?= the_title(); ?>" class="mainImg position-absolute start-0 w-100 h-auto" />
                <div id="hov"><img src="<?= get_field("videoPoster"); ?>" /></div>
            </div>
        </div>
    </div>
</div>