<?php

if ( ! function_exists( 'pelicula_core_add_vertical_sliding_header_global_option' ) ) {
	/**
	 * This function set header type value for global header option map
	 */
	function pelicula_core_add_vertical_sliding_header_global_option( $header_layout_options ) {
		$header_layout_options['vertical-sliding'] = array(
			'image' => PELICULA_CORE_HEADER_LAYOUTS_URL_PATH . '/vertical-sliding/assets/img/vertical-sliding-header.png',
			'label' => esc_html__( 'Vertical Sliding', 'pelicula-core' )
		);

		return $header_layout_options;
	}

	add_filter( 'pelicula_core_filter_header_layout_option', 'pelicula_core_add_vertical_sliding_header_global_option' );
}

if ( ! function_exists( 'pelicula_core_register_vertical_sliding_header_layout' ) ) {
	function pelicula_core_register_vertical_sliding_header_layout( $header_layouts ) {
		$header_layout = array(
			'vertical-sliding' => 'VerticalSlidingHeader'
		);

		$header_layouts = array_merge( $header_layouts, $header_layout );

		return $header_layouts;
	}

	add_filter( 'pelicula_core_filter_register_header_layouts', 'pelicula_core_register_vertical_sliding_header_layout' );
}

if ( ! function_exists( 'pelicula_core_vertical_sliding_header_nav_menu_grid' ) ) {
	function pelicula_core_vertical_sliding_header_nav_menu_grid( $grid_class ) {
		$header = pelicula_core_get_post_value_through_levels( 'qodef_header_layout' );

		if ( $header == 'vertical-sliding' ) {
			return false;
		}

		return $grid_class;
	}

	add_filter( 'pelicula_core_filter_drop_down_grid', 'pelicula_core_vertical_sliding_header_nav_menu_grid' );
}

// same as in vertical menu
if ( ! function_exists( 'pelicula_core_register_vertical_menu' ) ) {
	function pelicula_core_register_vertical_menu( $menus ) {

		$menus['vertical-menu-navigation'] = esc_html__( 'Vertical Navigation', 'pelicula-core' );

		return $menus;
	}

	add_filter( 'pelicula_filter_register_navigation_menus', 'pelicula_core_register_vertical_menu' );
}

if ( ! function_exists( 'pelicula_core_vertical_sliding_header_hide_top_area' ) ) {
	function pelicula_core_vertical_sliding_header_hide_top_area( $options ) {
		$options[] = 'vertical-sliding';

		return $options;
	}

	add_filter( 'pelicula_core_filter_top_area_hide_option', 'pelicula_core_vertical_sliding_header_hide_top_area' );
}

if ( ! function_exists( 'pelicula_core_vertical_sliding_header_hide_scroll_appearance' ) ) {
	function pelicula_core_vertical_sliding_header_hide_scroll_appearance( $options ) {
		$options[] = 'vertical-sliding';

		return $options;
	}

	add_filter( 'pelicula_core_filter_header_scroll_appearance_hide_option', 'pelicula_core_vertical_sliding_header_hide_scroll_appearance' );
}

if ( ! function_exists( 'pelicula_core_set_vertical_sliding_header_logo_image' ) ) {
	/**
	 * This function set header logo image for vertical sliding header
	 */
	function pelicula_core_set_vertical_sliding_header_logo_image( $template, $parameters ) {
		$is_enabled = false;

		$logo_image_id = pelicula_core_get_post_value_through_levels( 'qodef_logo_vertical_sliding' );

		if ( ! empty( $logo_image_id ) && isset( $parameters['vertical_sliding_logo'] ) && ! empty( $parameters['vertical_sliding_logo'] ) ) {
			$logo_image_attr = array(
				'class'    => 'qodef-header-logo-image qodef--vertical-sliding',
				'itemprop' => 'image',
				'alt'      => esc_attr__( 'logo vertical sliding', 'pelicula-core' )
			);

			$image      = wp_get_attachment_image( $logo_image_id, 'full', false, $logo_image_attr );
			$image_html = ! empty( $image ) ? $image : qode_framework_get_image_html_from_src( $logo_image_id, $logo_image_attr );

			$parameters['logo_vertical_sliding_image'] = $image_html;

			$is_enabled = true;
		}

		if ( $is_enabled ) {
			return pelicula_core_get_template_part( 'header/layouts/vertical-sliding/templates', 'logo-vertical-sliding', '', $parameters );
		} else {
			return $template;
		}
	}

	add_filter( 'pelicula_core_filter_get_header_logo_image', 'pelicula_core_set_vertical_sliding_header_logo_image', 10, 2 );
}