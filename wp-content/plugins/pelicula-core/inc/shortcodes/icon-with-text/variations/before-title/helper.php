<?php

if ( ! function_exists( 'pelicula_core_add_icon_with_text_variation_before_title' ) ) {
	function pelicula_core_add_icon_with_text_variation_before_title( $variations ) {
		
		$variations['before-title'] = esc_html__( 'Before Title', 'pelicula-core' );
		
		return $variations;
	}
	
	add_filter( 'pelicula_core_filter_icon_with_text_layouts', 'pelicula_core_add_icon_with_text_variation_before_title' );
}
