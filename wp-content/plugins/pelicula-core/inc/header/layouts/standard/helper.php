<?php

if ( ! function_exists( 'pelicula_core_add_standard_header_global_option' ) ) {
	/**
	 * This function set header type value for global header option map
	 */
	function pelicula_core_add_standard_header_global_option( $header_layout_options ) {
		$header_layout_options['standard'] = array(
			'image' => PELICULA_CORE_HEADER_LAYOUTS_URL_PATH . '/standard/assets/img/standard-header.png',
			'label' => esc_html__( 'Standard', 'pelicula-core' )
		);

		return $header_layout_options;
	}

	add_filter( 'pelicula_core_filter_header_layout_option', 'pelicula_core_add_standard_header_global_option' );
}

if ( ! function_exists( 'pelicula_core_set_standard_header_as_default_global_option' ) ) {
	/**
	 * This function set header type as default option value for global header option map
	 */
	function pelicula_core_set_standard_header_as_default_global_option( $default_value ) {
		return 'standard';
	}
	
	add_filter( 'pelicula_core_filter_header_layout_default_option_value', 'pelicula_core_set_standard_header_as_default_global_option' );
}

if ( ! function_exists( 'pelicula_core_register_standard_header_layout' ) ) {
	function pelicula_core_register_standard_header_layout( $header_layouts ) {
		$header_layout = array(
			'standard' => 'StandardHeader'
		);

		$header_layouts = array_merge( $header_layouts, $header_layout );

		return $header_layouts;
	}

	add_filter( 'pelicula_core_filter_register_header_layouts', 'pelicula_core_register_standard_header_layout');
}

if ( ! function_exists( 'pelicula_core_set_hide_dep_options_header_standard' ) ) {
	/**
	 * This function is used to hide all containers/panels for admin options when this header type is selected
	 */
	function pelicula_core_set_hide_dep_options_header_standard( $hide_dep_options ) {
		$hide_dep_options[] = 'standard';

		return $hide_dep_options;
	}

	// header widget area meta boxes
	add_filter( 'pelicula_core_filter_header_widget_area_two_hide_meta_boxes', 'pelicula_core_set_hide_dep_options_header_standard' );
}