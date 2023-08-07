<?php
if ( ! function_exists( 'pelicula_core_add_divided_header_global_option' ) ) {
	/**
	 * This function set header type value for global header option map
	 */

	function pelicula_core_add_divided_header_global_option( $header_layout_options ) {
		$header_layout_options['divided'] = array(
			'image' => PELICULA_CORE_HEADER_LAYOUTS_URL_PATH . '/divided/assets/img/divided-header.png',
			'label' => esc_html__( 'Divided', 'pelicula-core' )
		);

		return $header_layout_options;
	}

	add_filter( 'pelicula_core_filter_header_layout_option', 'pelicula_core_add_divided_header_global_option' );
}


if ( ! function_exists( 'pelicula_core_register_divided_header_layout' ) ) {
	function pelicula_core_register_divided_header_layout( $header_layouts ) {
		$header_layout = array(
			'divided' => 'DividedHeader'
		);

		$header_layouts = array_merge( $header_layouts, $header_layout );

		return $header_layouts;
	}

	add_filter( 'pelicula_core_filter_register_header_layouts', 'pelicula_core_register_divided_header_layout');
}

if ( ! function_exists( 'pelicula_core_register_divided_menu' ) ) {
	function pelicula_core_register_divided_menu($menus) {

		$menus['divided-menu-left-navigation']  = esc_html__( 'Divided Left Navigation', 'pelicula-core' );
		$menus['divided-menu-right-navigation'] = esc_html__( 'Divided Right Navigation', 'pelicula-core' );

		return $menus;
	}
	add_filter('pelicula_filter_register_navigation_menus','pelicula_core_register_divided_menu');
}