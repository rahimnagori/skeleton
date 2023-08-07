<?php

if ( ! function_exists( 'pelicula_core_add_button_variation_filled' ) ) {
	function pelicula_core_add_button_variation_filled( $variations ) {
		
		$variations['filled'] = esc_html__( 'Filled', 'pelicula-core' );
		
		return $variations;
	}
	
	add_filter( 'pelicula_core_filter_button_layouts', 'pelicula_core_add_button_variation_filled' );
}
