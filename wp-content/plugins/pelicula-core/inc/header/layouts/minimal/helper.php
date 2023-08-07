<?php
if ( ! function_exists( 'pelicula_core_add_minimal_header_global_option' ) ) {
	/**
	 * This function set header type value for global header option map
	 */

	function pelicula_core_add_minimal_header_global_option( $header_layout_options ) {
		$header_layout_options['minimal'] = array(
			'image' => PELICULA_CORE_HEADER_LAYOUTS_URL_PATH . '/minimal/assets/img/minimal-header.png',
			'label' => esc_html__( 'Minimal', 'pelicula-core' )
		);

		return $header_layout_options;
	}

	add_filter( 'pelicula_core_filter_header_layout_option', 'pelicula_core_add_minimal_header_global_option' );
}


if ( ! function_exists( 'pelicula_core_register_minimal_header_layout' ) ) {
	function pelicula_core_register_minimal_header_layout( $header_layouts ) {
		$header_layout = array(
			'minimal' => 'MinimalHeader'
		);

		$header_layouts = array_merge( $header_layouts, $header_layout );

		return $header_layouts;
	}

	add_filter( 'pelicula_core_filter_register_header_layouts', 'pelicula_core_register_minimal_header_layout');
}

if ( ! function_exists( 'pelicula_core_set_hide_dep_options_header_minimal' ) ) {
	/**
	 * This function is used to hide all containers/panels for admin options when this header type is selected
	 */
	function pelicula_core_set_hide_dep_options_header_minimal( $hide_dep_options ) {
		$hide_dep_options[] = 'minimal';

		return $hide_dep_options;
	}

	// header widget area meta boxes
	add_filter( 'pelicula_core_filter_header_widget_area_two_hide_meta_boxes', 'pelicula_core_set_hide_dep_options_header_minimal' );
}