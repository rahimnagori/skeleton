<?php

if ( ! function_exists( 'pelicula_core_add_social_share_variation_text' ) ) {
	function pelicula_core_add_social_share_variation_text( $variations ) {
		
		$variations['text'] = esc_html__( 'Text', 'pelicula-core' );
		
		return $variations;
	}
	
	add_filter( 'pelicula_core_filter_social_share_layouts', 'pelicula_core_add_social_share_variation_text' );
}
