<?php
// register nav 
function bareh_register_nav_menu()
{
    register_nav_menus(array(
        'primary_menu' => __('منو اصلی', 'text_domain'),
    ));
}
add_action('after_setup_theme', 'bareh_register_nav_menu', 0);
// register nav 

// config nav and li anchors
function tps_primary_menu_anchor_class($item_output, $item, $depth, $args)
{
    $item_output = preg_replace('/<a /', '<a class="nav-link text-gray1 p-0" ', $item_output, 1);
    return $item_output;
}
add_filter('walker_nav_menu_start_el', 'tps_primary_menu_anchor_class', 10, 4);

function tps_primary_menu_li_class($objects, $args)
{
    foreach ($objects as $key => $item) {
        $objects[$key]->classes[] = 'nav-item';
        if ($key === array_key_last($objects)) {
            $objects[$key]->classes[] = 'last';
        }
    }
    return $objects;
}
add_filter('wp_nav_menu_objects', 'tps_primary_menu_li_class', 10, 2);
// config nav and li anchors

// register thumbnail 
add_theme_support('post-thumbnails');
// register thumbnail 

// Set queries to default query of category page
add_action('wp_footer', 'loadMoreFunction');
function loadMoreFunction()
{
    if (!is_search()) {
        global $wp_query;
        $tax      = "category";
        if ($wp_query->get("taxonomy")) {
            $tax =  $wp_query->get("taxonomy");
        }
        $cat = $wp_query->get_queried_object_id();
        if (isset($_POST['cats'])) {
            $cat = [];
            foreach ($_POST['cats'] as $item) {
                $catID = get_cat_ID($item);
                array_push($cat, $catID);
            }
            $cat = implode(',', $cat);
        }
?>
        <script type="text/javascript">
            $(document).ready(function($) {
                let ajaxurl = '<?php echo  admin_url('admin-ajax.php'); ?>';
                $("#loadMore").click(function() {
                    window.page = window.page ?? 1;
                    window.page++
                    let data = {
                        'action': 'loadmore',
                        page: window.page,
                        tax: '<?= $tax; ?>',
                        cat: '<?= $cat; ?>'
                    };

                    $.ajaxSetup({
                        beforeSend: function() {
                            $("#loadMore").text('. . .');
                        },
                        complete: function() {
                            $("#loadMore").text('بیشتر ببینید');
                        },
                        success: function() {}
                    });

                    $.post(ajaxurl, data, function(res) {
                            if (res.length != 0) {
                                $("section.posts .row").append(res);
                                hovController();
                            } else {
                                $("#loadMore").remove();
                                alert('فیلمی برای نمایش  وجود ندارد.');
                            }
                        })
                        .fail(() => {
                            alert('ارتباط با سرور برقرار نیست.');
                        });
                });
            });
        </script>
    <?php
    }
}

function loadmore($query)
{
    $page = intval($_POST['page']);
    $cat = $_POST['cat'];
    $tax = $_POST['tax'];
    $query = new WP_Query([
        'paged' => $page,
        "post_type" => "post",
        "tax_query" => array(
            array("taxonomy" => $tax, "terms" => $cat)
        )
    ]);
    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            include('templates/sections/post-item.php');
        }
    }
    wp_die();
}

add_action('wp_ajax_loadmore', 'loadmore');
add_action('wp_ajax_nopriv_loadmore', 'loadmore');

// Set queries to default query of category page



// loadMore Ajax for Searches 
add_action("wp_footer", function () {
    if (is_search()) {

    ?>
        <script type="text/javascript">
            $(document).ready(function($) {

                let ajaxurl = '<?php echo  admin_url('admin-ajax.php'); ?>';
                $("#loadMore").click(function() {
                    
                    <?php global $filterExclude, $defExclude; ?>
                    window.page = window.page ?? 1;
                    window.page++
                    let data = {
                        'action': 'loadmore_search',
                        page: window.page,
                        'location': "<?= (isset($_GET['locationItems']) ?  implode(",", $_GET['locationItems'])  : "0"); ?>",
                        'year': "<?= (isset($_GET['yearsItems']) ?  implode(",", $_GET['yearsItems'])  : "0"); ?>",
                        'time': "<?= (isset($_GET['timeItems']) ?  implode(",", $_GET['timeItems'])  : "0"); ?>",
                        'word': "<?= (isset($_GET['s']) ?  $_GET['s']  : "0"); ?>",
                        'filterEx': "<?= (!empty($filterExclude) ? implode(',',$filterExclude) : "0"); ?>",
                        'defEx': "<?= (!empty($defExclude) ? implode(',',$defExclude) : "0"); ?>",
                    };

                    $.ajaxSetup({
                        beforeSend: function() {
                            $("#loadMore").text('. . .');
                        },
                        complete: function() {
                            $("#loadMore").text('بیشتر ببینید');
                        },
                        success: function() {}
                    });

                    $.post(ajaxurl, data, function(res) {
                            if (res.length != 0) {
                                $("section.posts .row").append(res);
                                hovController();
                            } else {
                                $("#loadMore").remove();
                                alert('فیلمی برای نمایش  وجود ندارد.');
                            }
                        })
                        .fail(() => {
                            alert('ارتباط با سرور برقرار نیست.');
                        });
                });
            });
        </script>

<?php
    }
});

function loadmore_search()
{
if(isset($_POST['filterEx'])) {
    $filterEx = explode(',',$_POST['filterEx']);
}
if(isset($_POST['defEx'])) {
    $defEx = explode(',',$_POST['defEx']);
}
    $taxes = array("relation" => "AND");
    if (!empty($_POST['location'])) :
        $childs =  [];
        foreach (explode(",", $_POST['location']) as $locationItem) :
            $locationItemName = get_term_by('name', $locationItem, 'location');
            if ($locationItemName) {
                $childs[] = $locationItemName->term_id;
            }
        endforeach;
        $taxes[] = array("taxonomy" => "location", "terms" => $childs);
    endif;
    if (!empty($_POST['year'])) :
        $childs = [];
        foreach (explode(",", $_POST['year']) as $yearsItem) :
            $yearsItemName = get_term_by('name', $yearsItem, 'filmyear');
            if ($yearsItemName) {
                $childs[] = $yearsItemName->term_id;
            }
        endforeach;
        $taxes[] = array("taxonomy" => "filmyear", "terms" => $childs);
    endif;
    if (!empty($_POST['time'])) :
        $childs = [];
        foreach (explode(",", $_POST['time']) as $timeItem) :
            $timeItemName = get_term_by('name', $timeItem, 'filmtime');
            if ($timeItemName) {
                $childs[] =  $timeItemName->term_id;
            }
        endforeach;
        $taxes[] = array("taxonomy" => "filmtime", "terms" => $childs);
    endif;

    $filterPrev = array(
        'post_type' => 'post',
        "paged" => $_POST['page'],
    );

    if (!empty($_POST['word'])) {
        $filterPrev['s'] = $_POST['word'];
    }
    if (!empty($taxes)) {
        $filterPrev['tax_query'] = $taxes;
    }

    $filter = new WP_Query($filterPrev);

    if ($filter->have_posts()) {
        global $post;
        while ($filter->have_posts()) : $filter->the_post();
            array_push($filterEx, $post->ID);
            include('templates/sections/post-item.php');
        endwhile;
        wp_reset_postdata();
    }

    if (!empty($_POST['word'])) {
        $filter2 = new WP_Query(array(
            'post_type' => 'post',
            "paged" => $_POST['page'],
            'meta_query' => array(
                'relation' => 'OR',
                array(
                    'key' => 'movieDirector',
                    'value' => $_POST['word'],
                    'compare' => 'LIKE'
                ),
                array(
                    'key' => 'movieCreator',
                    'value' => $_POST['word'],
                    'compare' => 'LIKE'
                ),
                'post__not_in' => $filterEx
            )
        ));

        print_r($filterEx);

        if ($filter2->have_posts()) {
            while ($filter2->have_posts()) : $filter2->the_post();
                include('templates/sections/post-item.php');
            endwhile;
            wp_reset_postdata();
        }
    }

    if (empty($filter)) {
        if (have_posts()) {
            global $post;
            while (have_posts()) : the_post();
                array_push($defEx, $post->ID);
                include('templates/sections/post-item.php');
            endwhile;
        }

        $filter2 = new WP_Query(array(
            'post_type' => 'post',
            "paged" => $_POST['page'],
            'meta_query' => array(
                'relation' => 'OR',
                array(
                    'key' => 'movieDirector',
                    'value' => $_POST['word'],
                    'compare' => 'LIKE'
                ),
                array(
                    'key' => 'movieCreator',
                    'value' => $_POST['word'],
                    'compare' => 'LIKE'
                ),
                'post__not_in' => $defEx
            )
        ));

        if ($filter2->have_posts()) {
            while ($filter2->have_posts()) : $filter2->the_post();
                include('templates/sections/post-item.php');
            endwhile;
        }
        wp_reset_postdata();
    }

    die();
}

add_action("wp_ajax_loadmore_search", "loadmore_search");
add_action("wp_ajax_nopriv_loadmore_search", "loadmore_search");
// loadMore Ajax for Searches 

function my_search($key,$page=1,$location=[],$year=[],$time=[]){
    $taxes = array("relation" => "AND");
    if (!empty($location)) :
        $childs =  [];
        foreach ($location as $locationItem) :
            $locationItemName = get_term_by('name', $locationItem, 'location');
            if ($locationItemName) {
                $childs[] = $locationItemName->term_id;
            }
        endforeach;
        $taxes[] = array("taxonomy" => "location", "terms" => $childs);
    endif;
    if (!empty($year)) :
        $childs = [];
        foreach ($year as $yearsItem) :
            $yearsItemName = get_term_by('name', $yearsItem, 'filmyear');
            if ($yearsItemName) {
                $childs[] = $yearsItemName->term_id;
            }
        endforeach;
        $taxes[] = array("taxonomy" => "filmyear", "terms" => $childs);
    endif;
    if (!empty($time)) :
        $childs = [];
        foreach ($time as $timeItem) :
            $timeItemName = get_term_by('name', $timeItem, 'filmtime');
            if ($timeItemName) {
                $childs[] =  $timeItemName->term_id;
            }
        endforeach;
        $taxes[] = array("taxonomy" => "filmtime", "terms" => $childs);
    endif;

    $filterPrev = array(
        'post_type' => 'post',
        "showposts"=>"-1"
    );

    if (!empty($key)) {
        $filterPrev['s'] = $key;
    }
    if (!empty($taxes)) {
        $filterPrev['tax_query'] = $taxes;
    }

    $filter = new WP_Query($filterPrev);
    $posts = $filter->posts;
    $nots = [];
    foreach($posts as $p){
        $nots[] = $p->ID;
    }
    if (!empty($key)) {

        $filter2 = new WP_Query(array(
            'post_type' => 'post',
            'showposts'=>"-1",
            'meta_query' => array(
                array(
                    'key' => 'movieDirector',
                    'value' => $key,
                    'compare' => 'LIKE'
                ),
                
            ),
            'post__not_in' => $nots,
        ));
        foreach($filter2->posts as $p2){
            $nots[] = $p2->ID;
        }
        $posts = array_merge($posts,$filter2->posts);
        $filter3 = new WP_Query(array(
            'post_type' => 'post',
            'showposts'=>"-1",
            'meta_query' => array(
                array(
                    'key' => 'movieCreator',
                    'value' => $key,
                    'compare' => 'LIKE'
                )
            ),
            'post__not_in' => $nots,
        ));
        $posts = array_merge($posts,$filter3->posts);
    }
    $limit = get_option("posts_per_page");
    $from = ($page * $limit ) - $limit;
    $end = $page * $limit; 
    if($from < count($posts)){
        for($i=$from;$i<($end > count($posts) ? count($posts) : $end);$i++){
            $post = $posts[$i];
            setup_postdata( $post );
            include('templates/sections/post-item.php');

        }
    } else {
        //EMPTY RESULT
    }
        
}


// Exclude page result in search
function exclude_pages_from_search($query)
{
    if ($query->is_search() && $query->is_main_query() && !is_admin()) {
        $query->set('post_type', 'post');
    }
}
add_filter('pre_get_posts', 'exclude_pages_from_search');
// Exclude page result in search


// Get and Set Post Views
function gt_get_post_view() {
    $count = get_post_meta( get_the_ID(), 'post_views_count', true );
    return "$count";
}
function gt_set_post_view() {
    $key = 'post_views_count';
    $post_id = get_the_ID();
    $count = (int) get_post_meta( $post_id, $key, true );
    $count++;
    update_post_meta( $post_id, $key, $count );
}
function gt_posts_column_views( $columns ) {
    $columns['post_views'] = 'بازدید';
    return $columns;
}
function gt_posts_custom_column_views( $column ) {
    if ( $column === 'post_views') {
        echo gt_get_post_view();
    }
}
add_filter( 'manage_posts_columns', 'gt_posts_column_views' );
add_action( 'manage_posts_custom_column', 'gt_posts_custom_column_views' );
// Get and Set Post Views
