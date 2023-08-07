<?php

if ( ! function_exists( 'pelicula_core_add_fixed_header_option' ) ) {
	/**
	 * This function set header scrolling appearance value for global header option map
	 */
	function pelicula_core_add_fixed_header_option( $options ) {
		$options['fixed'] = esc_html__( 'Fixed', 'pelicula-core' );

		return $options;
	}

	add_filter( 'pelicula_core_filter_header_scroll_appearance_option', 'pelicula_core_add_fixed_header_option' );
}