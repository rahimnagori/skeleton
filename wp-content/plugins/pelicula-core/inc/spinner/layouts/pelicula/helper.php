<?php

if ( ! function_exists( 'pelicula_core_add_pelicula_spinner_layout_option' ) ) {
	/**
	 * Function that set new value into page spinner layout options map
	 *
	 * @param array $layouts  - module layouts
	 *
	 * @return array
	 */
	function pelicula_core_add_pelicula_spinner_layout_option( $layouts ) {
		$layouts['pelicula'] = esc_html__( 'Pelicula', 'pelicula-core' );
		
		return $layouts;
	}
	
	add_filter( 'pelicula_core_filter_page_spinner_layout_options', 'pelicula_core_add_pelicula_spinner_layout_option' );
}

if ( ! function_exists( 'pelicula_core_set_pelicula_spinner_layout_as_default_option' ) ) {
	/**
	 * Function that set default value for page spinner layout options map
	 *
	 * @param string $default_value
	 *
	 * @return string
	 */
	function pelicula_core_set_pelicula_spinner_layout_as_default_option( $default_value ) {
		return 'pelicula';
	}
	
	add_filter( 'pelicula_core_filter_page_spinner_default_layout_option', 'pelicula_core_set_pelicula_spinner_layout_as_default_option' );
}