<?php require_once get_template_directory() . '/templates/home-header.php'; ?>

    <!-- searchbox -->
    <section id="searchbox" class="mt-5 pt-4">
        <div class="header-inside position-relative">

            <div id="filterSec"
                class="position-absolute top-50 opacity-0 overflow-hidden start-0 w-100 bg-white shadow-lg">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="filterSelect position-relative">
                                <div
                                    class="filterTitle d-flex justify-content-between align-items-center p-2 cursor-pointer">
                                    <span class="title fw-bold text-gray2 f16">محل فیلمبرداری</span>
                                    <i class="fas fa-chevron-down text-gray2 f16"></i>
                                </div>
                                <div
                                    class="selectItems position-absolute border border-gray4 rounded-bottom border-top-0 bg-white top-100 left-0 w-100 h-auto">
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
                                </div>
                            </div>
                            <div id="locationArea" class="selectedArea d-flex align-items-start flex-column my-2"></div>
                        </div>
                        <div class="col-lg-4">
                            <div class="filterSelect position-relative">
                                <div
                                    class="filterTitle d-flex justify-content-between align-items-center p-2 cursor-pointer">
                                    <span class="title fw-bold text-gray2 f16">سال ساخت</span>
                                    <i class="fas fa-chevron-down text-gray2 f16"></i>
                                </div>
                                <div
                                    class="selectItems position-absolute border border-gray4 rounded-bottom border-top-0 bg-white top-100 left-0 w-100 h-auto">
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
                                <div
                                    class="filterTitle d-flex justify-content-between align-items-center p-2 cursor-pointer">
                                    <span class="title fw-bold text-gray2 f16">مدت زمان</span>
                                    <i class="fas fa-chevron-down text-gray2 f16"></i>
                                </div>
                                <div
                                    class="selectItems position-absolute border border-gray4 rounded-bottom border-top-0 bg-white top-100 left-0 w-100 h-auto">
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
                        <button id="filterHandler"
                            class="strokebtn2 w-auto d-inline-block mx-1 py-2 rounded-2 border-gray2">اعمال
                            فیلتر</button>
                        <button id="filterRemover"
                            class="fillbtn w-auto bg-white mx-1 d-inline-block py-2 rounded-2">حذف همه
                            فیلترها</button>
                    </div>
                </div>
            </div>

            <div class="container bg-white rounded-2 position-relative overflow-hidden">
                <form method="GET" action="<?= get_site_url(); ?>">
                    <div class="row">
                        <div class="col-md-9 d-flex align-items-center" id="rightCorner">
                            <i class="fa-regular fa-magnifying-glass"></i>
                            <input type="text" class="f14 l20"
                                placeholder="جستجو با نام فیلم، کارگردان یا نام تهیه‌کننده "  name="s" id="s"/>
                        </div>
                        <div class="col-md-3 d-flex align-items-center p-0 justify-content-end">
                            <span id="filters"
                                class="text-gray2 bg-white border-0 fw-bold border-right py-1 px-3 border-end border-2 border-gray3 cursor-pointer">
                                فیلترها
                            </span>
                            <input type="submit" value="جستجو کنید"
                                class="p-0 top-0 start-0 h-100 px-4 border-0 rounded-left fw-bold strokebtn" />
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="container p-0">
            <p class="pt-3 text-gray2 f16 l30">
                «باره» فرهنگ موضوعی سینمای مستند ایران است و برای جست‌وجوی موضوعی در انبوهی از آثار سینمای مستند
                طراحی
                شده.
                <br>همچنین در فرهنگ باره می‌توان براساس اسم کارگردان،‌تهیه‌کننده و تمامی عوامل، در فهرست فیلم‌ها
                جست‌وجو کرد.<br>
                یکی از مهم‌ترین دسته‌بندی‌های دیگر باره؛ سال ساخت و مدت‌زمان فیلم است.
                <a href="<?= get_site_url(); ?>/about-bareh" class="text-gray2 fw-bold">بیشتر بخوانید</a>
            </p>
        </div>
    </section>
    <!-- searchbox -->

    <!-- lastSeen boxes  -->
    <?php include('templates/sections/lastseen.php'); ?>
    <!-- lastSeen boxes  -->

<?= get_footer(); ?>