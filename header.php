<!DOCTYPE html>
<html lang="fa">
<?php wp_head(); ?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= get_bloginfo("name") ?> | <?= get_bloginfo("description"); ?></title>
    <!-- library imports -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
    <link href="<?= bloginfo("template_directory"); ?>/assets/css/all.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="<?= bloginfo("template_directory"); ?>/style.css">
    <!-- library imports -->
</head>

<body>

    <!-- non home header  -->
    <header id="noHomeHeader" class="py-2 position-fixed top-0 w-100">
        <div class="header-inside position-relative">
            <div id="filterSec" class="position-absolute top-50 opacity-0 overflow-hidden start-0 w-100 bg-white shadow-lg">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="filterSelect position-relative">
                                <div class="filterTitle d-flex justify-content-between align-items-center p-2 cursor-pointer">
                                    <span class="title fw-bold text-gray2 f16">محل فیلمبرداری</span>
                                    <i class="fas fa-chevron-down text-gray2 f16"></i>
                                </div>
                                <div class="selectItems position-absolute border border-gray4 rounded-bottom border-top-0 bg-white top-100 left-0 w-100 h-auto">
                                    <div class="item clickable pb-2 cursor-pointer">تهران</div>
                                    <div class="item clickable pb-2 cursor-pointer">شیراز</div>
                                    <div class="item clickable pb-2 cursor-pointer">مشهد</div>
                                    <div class="item clickable pb-2 cursor-pointer">خوزستان</div>
                                    <div class="item clickable pb-2 cursor-pointer">تبریز</div>
                                    <div class="item clickable pb-2 cursor-pointer">اردبیل</div>
                                    <div class="item clickable pb-2 cursor-pointer">بوشهر</div>
                                    <div class="item clickable pb-2 cursor-pointer">کیش</div>
                                    <div class="item clickable pb-2 cursor-pointer">قشم</div>
                                    <div class="item clickable pb-2 cursor-pointer">قم</div>
                                    <div class="item clickable pb-2 cursor-pointer">مشهد</div>
                                    <div class="item clickable pb-2 cursor-pointer">اصفهان</div>
                                    <div class="item clickable pb-2 cursor-pointer">قزوین</div>
                                </div>
                            </div>
                            <div id="locationArea" class="selectedArea d-flex align-items-start flex-column my-2"></div>
                        </div>
                        <div class="col-lg-4">
                            <div class="filterSelect position-relative">
                                <div class="filterTitle d-flex justify-content-between align-items-center p-2 cursor-pointer">
                                    <span class="title fw-bold text-gray2 f16">سال ساخت</span>
                                    <i class="fas fa-chevron-down text-gray2 f16"></i>
                                </div>
                                <div class="selectItems position-absolute border border-gray4 rounded-bottom border-top-0 bg-white top-100 left-0 w-100 h-auto">
                                    <div class="item clickable pb-2 cursor-pointer">1390</div>
                                    <div class="item clickable pb-2 cursor-pointer">1391</div>
                                    <div class="item clickable pb-2 cursor-pointer">1392</div>
                                    <div class="item clickable pb-2 cursor-pointer">1393</div>
                                    <div class="item clickable pb-2 cursor-pointer">1394</div>
                                    <div class="item clickable pb-2 cursor-pointer">1395</div>
                                    <div class="item clickable pb-2 cursor-pointer">1396</div>
                                    <div class="item clickable pb-2 cursor-pointer">1397</div>
                                    <div class="item clickable pb-2 cursor-pointer">1398</div>
                                    <div class="item clickable pb-2 cursor-pointer">1399</div>
                                    <div class="item clickable pb-2 cursor-pointer">1400</div>
                                    <div class="item clickable pb-2 cursor-pointer">1401</div>
                                </div>
                            </div>
                            <div id="yearsArea" class="selectedArea d-flex align-items-start flex-column my-2"></div>
                        </div>
                        <div class="col-lg-4">
                            <div class="filterSelect position-relative">
                                <div class="filterTitle d-flex justify-content-between align-items-center p-2 cursor-pointer">
                                    <span class="title fw-bold text-gray2 f16">مدت زمان</span>
                                    <i class="fas fa-chevron-down text-gray2 f16"></i>
                                </div>
                                <div class="selectItems position-absolute border border-gray4 rounded-bottom border-top-0 bg-white top-100 left-0 w-100 h-auto">
                                    <div class="item clickable pb-2 cursor-pointer">کوتاه</div>
                                    <div class="item clickable pb-2 cursor-pointer">متوسط</div>
                                    <div class="item clickable pb-2 cursor-pointer">بلند</div>
                                    <div class="item clickable pb-2 cursor-pointer">خیلی طولانی</div>
                                </div>
                            </div>
                            <div id="timeArea" class="selectedArea d-flex align-items-start flex-column my-2"></div>
                        </div>
                    </div>
                    <div class="row d-flex align-items-center justify-content-center" id="filterButtons">
                        <button id="filterHandler" class="strokebtn2 w-auto d-inline-block mx-1 py-2 rounded-2 border-gray2">اعمال
                            فیلتر</button>
                        <button id="filterRemover" class="fillbtn w-auto bg-white mx-1 d-inline-block py-2 rounded-2">حذف همه فیلترها</button>
                    </div>
                </div>
            </div>
            <div class="container-xxl">
                <div class="row">
                    <div class="col-lg-1 py-1">
                        <a href="<?= get_site_url(); ?>" class="d-inline-block" title="باره">
                            <img src="<?= bloginfo("template_directory"); ?>/images/global/logo.svg" alt="<?= bloginfo("name"); ?>" class="img-fluid" width="50" />
                        </a>
                    </div>
                    <div class="col-lg-7 d-flex align-items-center" id="searchbox">
                        <div class="searchContainer bg-white rounded-2 position-relative overflow-hidden w-100">
                            <div class="row">
                                <form method="GET" class="d-flex" action="<?= get_site_url(); ?>">
                                    <div class="col-md-9 d-flex align-items-center" id="rightCorner">
                                        <i class="fa-regular fa-magnifying-glass"></i>
                                        <input type="text" class="f14 l20" placeholder="جستجو با نام فیلم، کارگردان یا نام تهیه‌کننده " name="s" id="s"/>
                                    </div>
                                    <div class="col-md-3 d-flex align-items-center p-0 justify-content-end">
                                        <span id="filters" class="text-gray2 bg-white border-0 fw-bold border-right py-1 px-3 border-end border-2 border-gray3 cursor-pointer">
                                            فیلترها
                                        </span>
                                        <input type="submit" value="جستجو کنید" class="p-0 top-0 start-0 h-100 px-4 border-0 rounded-left fw-bold strokebtn" />
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 d-flex">
                        <?php
                        $defaults = array(
                            'theme_location'  => 'primary_menu',
                            'container'       => 'nav',
                            'container_class' => 'nav justify-content-end align-items-center f16 l25 w-100',
                            'menu_class'      => 'list-unstyled',
                            'echo'            => false,
                            'fallback_cb'     => false,
                            'items_wrap'      => '%3$s',
                            'depth'           => 0
                        );
                        echo strip_tags(wp_nav_menu($defaults), '<nav><li><a>');
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- non home header  -->