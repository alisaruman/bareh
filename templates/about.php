<?php
// Template Name: شناسنامه باره
get_header();
?>

<!-- About Bareh -->
<div id="Content">
    <div class="container">

        <ul class="nav nav-pills m-0 p-0" id="pills-tab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active rounded-0 py-3 px-5 f16 l20 text-gray2" id="pills-about-tab" data-bs-toggle="pill" data-bs-target="#pills-about" type="button" role="tab" aria-controls="pills-home" aria-selected="true">در این باره</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link rounded-0 py-3 px-5 l20 text-gray2" id="pills-how-tab" data-bs-toggle="pill" data-bs-target="#pills-how" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">ساز و کار باره</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link rounded-0 py-3 px-5 l20 text-gray2" id="pills-resource-tab" data-bs-toggle="pill" data-bs-target="#pills-resource" type="button" role="tab" aria-controls="pills-contact" aria-selected="false">منابع</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link rounded-0 py-3 px-5 l20 text-gray2" id="pills-partners-tab" data-bs-toggle="pill" data-bs-target="#pills-partners" type="button" role="tab" aria-controls="pills-contact" aria-selected="false">همکاران</button>
            </li>
        </ul>
        <div class="tab-content tab-content f16 l28 p-5" id="pills-tabContent">
            <div class="tab-pane fade show text-gray2 active" id="pills-about" role="tabpanel" aria-labelledby="pills-about-tab">
                <?php
                if (get_field('barehAbout')) {
                    echo get_field('barehAbout');
                }
                ?>
            </div>
            <div class="tab-pane fade text-gray2" id="pills-how" role="tabpanel" aria-labelledby="pills-how-tab">
                <?php
                if (get_field('barehHow')) {
                    echo get_field('barehHow');
                }
                ?>
            </div>
            <div class="tab-pane fade text-gray2" id="pills-resource" role="tabpanel" aria-labelledby="pills-resource-tab">
                <?php
                if (get_field('barehResource')) {
                    echo get_field('barehResource');
                }
                ?>
            </div>
            <div class="tab-pane fade text-gray2" id="pills-partners" role="tabpanel" aria-labelledby="pills-partners-tab">
                <?php
                if (get_field('barehPartners')) {
                    echo get_field('barehPartners');
                }
                ?>
            </div>
        </div>

    </div>
</div>
<!-- About Bareh -->

<?= get_footer(); ?>