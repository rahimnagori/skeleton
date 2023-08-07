<?php

if ( ! function_exists( 'pelicula_core_add_accordion_variation_simple' ) ) {
	function pelicula_core_add_accordion_variation_simple( $variations ) {
		
		$variations['simple'] = esc_html__( 'Simple', 'pelicula-core' );
		
		return $variations;
	}
	
	add_filter( 'pelicula_core_filter_accordion_layouts', 'pelicula_core_add_accordion_variation_simple' );
}
