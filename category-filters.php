<?php
// Template Name: دسته‌بندی فیلم‌ها
?>
<?= get_header(); ?>

<div id="Content">
    <div class="container">

        <!-- category handler  -->
        <div class="row m-0 p-sm-3 p-lg-4 bg-white rounded-2 align-items-center" id="catHandler">
            <div class="col-lg-10 text-gray2 f16 l20">
                <span class="fw-bold ps-3">دسته‌بندی موضوعی فیلم</span>
                <span>موضوعات دلخواه خود را انتخاب کنید.</span>
            </div>
            <div class="col-lg-2">
                <form action="<?= get_site_url(); ?>/cat-results" method="POST">
                    <input type="submit" name="submit" id="catSend" class="disablebtn text-white rounded-2 border-0 d-block py-2 w-100" value="اعمال فیلتر" disabled />
                    <select name='cats[]' id='cats' class='d-none' multiple></select>
                </form>
            </div>
        </div>
        <!-- category handler  -->

        <!-- categories list  -->
        <div class="row m-0 align-items-center justify-content-start pt-3 mt-2" id="categories">

            <?php
            $categories = get_categories(array(
                'orderby' => 'name',
                'hide_empty' => false,
                'exclude' => array(1),
            ));
            foreach ($categories as $category) {
            ?>
                <div class="col-md-4 col-lg-3 mb-4">
                    <div class="box rounded-2 py-3 text-center cursor-pointer">
                        <span class="f16 l20 text-gray2 text-center" data-slug="<?= $category->slug; ?>"><?= $category->name; ?></span></span>
                    </div>
                </div>
            <?php } ?>

        </div>
        <!-- categories list  -->

    </div>
</div>


<?= get_footer(); ?>