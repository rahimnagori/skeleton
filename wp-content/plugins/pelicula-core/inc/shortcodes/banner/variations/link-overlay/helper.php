<?php

if ( ! function_exists( 'pelicula_core_add_banner_variation_link_overlay' ) ) {
	function pelicula_core_add_banner_variation_link_overlay( $variations ) {
		
		$variations['link-overlay'] = esc_html__( 'Link Overlay', 'pelicula-core' );
		
		return $variations;
	}
	
	add_filter( 'pelicula_core_filter_banner_layouts', 'pelicula_core_add_banner_variation_link_overlay' );
}
