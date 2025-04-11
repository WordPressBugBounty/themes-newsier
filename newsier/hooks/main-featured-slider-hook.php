<?php
if (!function_exists('newsier_front_page_banner_section')) :
  /**
   *
   * @since newspaperup
   *
   */
  function newsier_front_page_banner_section() {
    if (is_front_page() || is_home()) {

      do_action('newsier_action_main_banner');
      do_action('newsier_action_banner_editor');

    }
  }
endif;
add_action('newsier_action_front_page_main_section_1', 'newsier_front_page_banner_section', 40);

if (!function_exists('newsier_main_banner')) :

    function newsier_main_banner() {
        $newspaperup_slider_category = newspaperup_get_option('select_slider_news_category');
        $newspaperup_number_of_post = 5;
        $newspaperup_all_posts_main = newspaperup_get_posts($newspaperup_number_of_post, $newspaperup_slider_category);
        ?>
        <!--row-->
        <div class="col-lg-8">
        <div class="mb-0">
            <div class="homemain bs swiper-container">
            <div class="swiper-wrapper">
                <?php
                if ($newspaperup_all_posts_main->have_posts()) :
                while ($newspaperup_all_posts_main->have_posts()) : $newspaperup_all_posts_main->the_post(); 
                    newspaperup_slider_default_section();   
                endwhile;
                endif;
                wp_reset_postdata(); ?>
            </div>
            <!-- Add Arrows -->
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
            <!-- <div class="swiper-pagination"></div> -->
            </div>
            <!--/swipper-->
        </div>
        </div>
        <!--/col-12-->
        <?php
    }
endif;
add_action('newsier_action_main_banner', 'newsier_main_banner', 40);

if (!function_exists('newsier_banner_editor')) :

    function newsier_banner_editor() {
        $slider_meta_enable = get_theme_mod('slider_meta_enable','true');
        // Editor
        $select_editor_news_category = newspaperup_get_option('select_editor_news_category');
        $editor_off = 0;
        $featured_editor_posts = newspaperup_get_posts( 2, $select_editor_news_category);  
        ?>
        <div class="col-lg-4">
            <div class="multi-post-widget mb-0 mt-3 mt-lg-0">
                <div class="inner_columns three">
                    <?php
                    if ($featured_editor_posts->have_posts()) :
                    while ($featured_editor_posts->have_posts()) : $featured_editor_posts->the_post();
                    if($editor_off >= 2){
                        break;
                    }
                    global $post;
                    $newspaperup_url = newspaperup_get_freatured_image_url($post->ID, 'newspaperup-slider-full');
                    ?>
                        <div class="bs-blog-post three bsm back-img bshre mb-0" <?php if (!empty($newspaperup_url)): ?>
                            style="background-image: url('<?php echo esc_url($newspaperup_url); ?>');"
                            <?php endif; ?>>
                            <a class="link-div" href="<?php the_permalink(); ?>"> </a>
                            <?php if($slider_meta_enable == true) { ?><?php newspaperup_post_categories(); ?> <?php } ?>
                            <div class="inner">
                                <h4 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                                <?php if($slider_meta_enable == true) { newspaperup_post_meta(); } ?>
                            </div>
                        </div>
                    <?php endwhile;
                        endif;
                        wp_reset_postdata(); 
                ?>
                </div>
            </div>
        </div>
    <?php
    }
endif;
add_action('newsier_action_banner_editor', 'newsier_banner_editor', 40);