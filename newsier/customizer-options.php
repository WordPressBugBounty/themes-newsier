<?php

function newsier_customize_register( $wp_customize ) {

	$wp_customize->remove_control('header_text_center');
	$wp_customize->get_setting('blog_post_layout')->default = 'grid-layout';
	$wp_customize->get_setting('sticky_header_toggle')->default = false;
	$wp_customize->remove_control('newspaperup_menu_search');
	$wp_customize->remove_control('newspaperup_lite_dark_switcher');
	$wp_customize->remove_control('main_trending_post_section_title');
	$wp_customize->remove_control('select_trending_news_category');
	
	$wp_customize->get_control('tren_edit_section_title')->label = esc_html__('Editor Post Section', 'newsier');

}
add_action( 'customize_register', 'newsier_customize_register',999 );