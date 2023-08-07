<?php

if ( ! function_exists( 'pelicula_core_add_icon_with_text_variation_before_content' ) ) {
	function pelicula_core_add_icon_with_text_variation_before_content( $variations ) {
		
		$variations['before-content'] = esc_html__( 'Before Content', 'pelicula-core' );
		
		return $variations;
	}
	
	add_filter( 'pelicula_core_filter_icon_with_text_layouts', 'pelicula_core_add_icon_with_text_variation_before_content' );
}
