<?php

if ( ! function_exists( 'pelicula_core_add_vertical_header_global_option' ) ) {
	/**
	 * This function set header type value for global header option map
	 */
	function pelicula_core_add_vertical_header_global_option( $header_layout_options ) {
		$header_layout_options['vertical'] = array(
			'image' => PELICULA_CORE_HEADER_LAYOUTS_URL_PATH . '/vertical/assets/img/vertical-header.png',
			'label' => esc_html__( 'Vertical', 'pelicula-core' )
		);
		
		return $header_layout_options;
	}
	
	add_filter( 'pelicula_core_filter_header_layout_option', 'pelicula_core_add_vertical_header_global_option' );
}

if ( ! function_exists( 'pelicula_core_register_vertical_header_layout' ) ) {
	function pelicula_core_register_vertical_header_layout( $header_layouts ) {
		$header_layout = array(
			'vertical' => 'VerticalHeader'
		);
		
		$header_layouts = array_merge( $header_layouts, $header_layout );
		
		return $header_layouts;
	}
	
	add_filter( 'pelicula_core_filter_register_header_layouts', 'pelicula_core_register_vertical_header_layout' );
}

if ( ! function_exists( 'pelicula_core_vertical_header_nav_menu_grid' ) ) {
	function pelicula_core_vertical_header_nav_menu_grid( $grid_class ) {
		$header = pelicula_core_get_post_value_through_levels( 'qodef_header_layout' );
		
		if ( $header == 'vertical' ) {
			return false;
		}
		
		return $grid_class;
	}
	
	add_filter( 'pelicula_core_filter_drop_down_grid', 'pelicula_core_vertical_header_nav_menu_grid' );
}

if ( ! function_exists( 'pelicula_core_register_vertical_menu' ) ) {
	function pelicula_core_register_vertical_menu( $menus ) {
		$menus['vertical-menu-navigation'] = esc_html__( 'Vertical Navigation', 'pelicula-core' );
		
		return $menus;
	}
	
	add_filter( 'pelicula_filter_register_navigation_menus', 'pelicula_core_register_vertical_menu' );
}

if ( ! function_exists( 'pelicula_core_vertical_header_hide_top_area' ) ) {
	function pelicula_core_vertical_header_hide_top_area( $options ) {
		$options[] = 'vertical';
		
		return $options;
	}
	
	add_filter( 'pelicula_core_filter_top_area_hide_option', 'pelicula_core_vertical_header_hide_top_area' );
}

if ( ! function_exists( 'pelicula_core_vertical_header_hide_scroll_appearance' ) ) {
	function pelicula_core_vertical_header_hide_scroll_appearance( $options ) {
		$options[] = 'vertical';
		
		return $options;
	}
	
	add_filter( 'pelicula_core_filter_header_scroll_appearance_hide_option', 'pelicula_core_vertical_header_hide_scroll_appearance' );
}

if ( ! function_exists( 'pelicula_core_set_hide_dep_options_header_vertical' ) ) {
	/**
	 * This function is used to hide all containers/panels for admin options when this header type is selected
	 */
	function pelicula_core_set_hide_dep_options_header_vertical( $hide_dep_options ) {
		$hide_dep_options[] = 'vertical';

		return $hide_dep_options;
	}

	// header widget area meta boxes
	add_filter( 'pelicula_core_filter_header_widget_area_two_hide_meta_boxes', 'pelicula_core_set_hide_dep_options_header_vertical' );
}