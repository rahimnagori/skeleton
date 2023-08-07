<?php

if ( ! function_exists( 'pelicula_core_add_image_with_text_variation_text_below' ) ) {
	function pelicula_core_add_image_with_text_variation_text_below( $variations ) {
		
		$variations['text-below'] = esc_html__( 'Text Below', 'pelicula-core' );
		
		return $variations;
	}
	
	add_filter( 'pelicula_core_filter_image_with_text_layouts', 'pelicula_core_add_image_with_text_variation_text_below' );
}
