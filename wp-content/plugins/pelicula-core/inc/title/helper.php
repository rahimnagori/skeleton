<?php

if ( ! function_exists( 'pelicula_core_is_page_title_enabled' ) ) {
	/**
	 * Function that check is module enabled
	 *
	 * @param $is_enabled bool
	 *
	 * @return bool
	 */
	function pelicula_core_is_page_title_enabled( $is_enabled ) {

		$option = pelicula_core_get_option_value('admin', 'qodef_enable_page_title') !== 'no';
		$option = apply_filters('pelicula_core_filter_is_page_title_enabled', $option);
		$meta_option = pelicula_core_get_option_value('meta-box', 'qodef_enable_page_title', '', qode_framework_get_page_id());
		$option = $meta_option == '' ? $option : ($meta_option == 'yes' ? true : false);

		if ( ! $option ) {
			$is_enabled = false;
		}
		
		return $is_enabled;
	}
	
	add_filter( 'pelicula_filter_enable_page_title', 'pelicula_core_is_page_title_enabled', 10 );
}

if ( ! function_exists( 'pelicula_core_get_page_title_image_params' ) ) {
	/**
	 * Function that return parameters for page title image
	 *
	 * @return array
	 */
	function pelicula_core_get_page_title_image_params() {
		$background_image = pelicula_core_get_post_value_through_levels( 'qodef_page_title_background_image' );
		$image_behavior   = pelicula_core_get_post_value_through_levels( 'qodef_page_title_background_image_behavior' );

		$params = array(
			'image'          => ! empty( $background_image ) ? $background_image : '',
			'image_behavior' => ! empty( $image_behavior ) ? $image_behavior : ''
		);
		
		return $params;
	}
}

if ( ! function_exists( 'pelicula_core_get_page_title_image' ) ) {
	/**
	 * Function that render page title image html
	 */
	function pelicula_core_get_page_title_image() {
		$image_params = pelicula_core_get_page_title_image_params();
		
		if ( ! empty( $image_params['image'] ) && $image_params['image_behavior'] === 'responsive' ) {
			echo '<div class="qodef-m-image">' . wp_get_attachment_image( $image_params['image'], 'full' ) . '</div>';
		}

		if ( ! empty( $image_params['image'] ) && $image_params['image_behavior'] === 'parallax' ) {
			echo '<div class="qodef-parallax-img-holder"><div class="qodef-parallax-img-wrapper">' . wp_get_attachment_image( $image_params['image'], 'full', false,  array( "class" => "qodef-parallax-img")) . '</div></div>';
		}
	}
}

if ( ! function_exists( 'pelicula_core_get_page_title_content_classes' ) ) {
	/**
	 * Function that return classes for page title content area
	 *
	 * @return string
	 */
	function pelicula_core_get_page_title_content_classes() {
		$classes = array();
		$image_params = pelicula_core_get_page_title_image_params();
		
		$enable_title_grid  = pelicula_core_get_post_value_through_levels( 'qodef_set_page_title_area_in_grid' ) !== 'no';
		$is_grid_enabled    = apply_filters( 'pelicula_core_filter_page_title_in_grid', $enable_title_grid );
		$enable_title_grid_meta = pelicula_core_get_option_value('meta-box', 'qodef_set_page_title_area_in_grid', '', qode_framework_get_page_id());
		$is_grid_enabled = $enable_title_grid_meta == '' ? $is_grid_enabled : ($enable_title_grid_meta == 'yes' ? true : false);

		$classes[]          = $is_grid_enabled ? 'qodef-content-grid' : 'qodef-content-full-width';
		$classes[]          = $image_params['image_behavior'] == 'parallax' ? 'qodef-parallax-content-holder' : '';

		return implode( ' ', $classes );
	}
}