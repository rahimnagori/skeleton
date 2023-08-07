<?php

if ( ! function_exists( 'pelicula_core_add_rotating_cubes_spinner_layout_option' ) ) {
	/**
	 * Function that set new value into page spinner layout options map
	 *
	 * @param array $layouts  - module layouts
	 *
	 * @return array
	 */
	function pelicula_core_add_rotating_cubes_spinner_layout_option( $layouts ) {
		$layouts['rotating-cubes'] = esc_html__( 'Rotating Cubes', 'pelicula-core' );
		
		return $layouts;
	}
	
	add_filter( 'pelicula_core_filter_page_spinner_layout_options', 'pelicula_core_add_rotating_cubes_spinner_layout_option' );
}