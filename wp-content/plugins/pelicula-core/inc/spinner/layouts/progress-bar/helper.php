<?php

if ( ! function_exists( 'pelicula_core_add_progress_bar_spinner_layout_option' ) ) {
	/**
	 * Function that set new value into page spinner layout options map
	 *
	 * @param array $layouts  - module layouts
	 *
	 * @return array
	 */
	function pelicula_core_add_progress_bar_spinner_layout_option( $layouts ) {
		$layouts['progress-bar'] = esc_html__( 'Progress Bar', 'pelicula-core' );
		
		return $layouts;
	}
	
	add_filter( 'pelicula_core_filter_page_spinner_layout_options', 'pelicula_core_add_progress_bar_spinner_layout_option' );
}

if ( ! function_exists( 'pelicula_core_add_progress_bar_spinner_layout_classes' ) ) {
	/**
	 * Function that return classes for page spinner area
	 *
	 * @param array $classes
	 *
	 * @return array
	 */
	function pelicula_core_add_progress_bar_spinner_layout_classes( $classes ) {
		$type = pelicula_core_get_post_value_through_levels( 'qodef_page_spinner_type' );
		
		if ( $type === 'progress-bar' ) {
			$classes[] = 'qodef--custom-spinner';
		}
		
		return $classes;
	}
	
	add_filter( 'pelicula_core_filter_page_spinner_classes', 'pelicula_core_add_progress_bar_spinner_layout_classes' );
}