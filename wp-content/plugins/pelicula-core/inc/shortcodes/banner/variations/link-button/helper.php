<?php

if ( ! function_exists( 'pelicula_core_add_banner_variation_link_button' ) ) {
	function pelicula_core_add_banner_variation_link_button( $variations ) {
		
		$variations['link-button'] = esc_html__( 'Link Button', 'pelicula-core' );
		
		return $variations;
	}
	
	add_filter( 'pelicula_core_filter_banner_layouts', 'pelicula_core_add_banner_variation_link_button' );
}
