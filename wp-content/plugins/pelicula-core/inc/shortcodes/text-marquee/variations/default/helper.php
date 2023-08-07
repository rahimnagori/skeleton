<?php

if ( ! function_exists( 'pelicula_core_add_text_marquee_variation_default' ) ) {
	function pelicula_core_add_text_marquee_variation_default( $variations ) {
		
		$variations['default'] = esc_html__( 'Default', 'pelicula-core' );
		
		return $variations;
	}
	
	add_filter( 'pelicula_core_filter_text_marquee_layouts', 'pelicula_core_add_text_marquee_variation_default' );
}