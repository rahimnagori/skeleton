<?php

if ( ! function_exists( 'pelicula_core_add_button_variation_textual' ) ) {
	function pelicula_core_add_button_variation_textual( $variations ) {
		
		$variations['textual'] = esc_html__( 'Textual', 'pelicula-core' );
		
		return $variations;
	}
	
	add_filter( 'pelicula_core_filter_button_layouts', 'pelicula_core_add_button_variation_textual' );
}
