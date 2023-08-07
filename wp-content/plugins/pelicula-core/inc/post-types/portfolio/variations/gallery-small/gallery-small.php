<?php

if ( ! function_exists( 'pelicula_core_add_portfolio_single_variation_gallery_small' ) ) {
	function pelicula_core_add_portfolio_single_variation_gallery_small( $variations ) {
		$variations['gallery-small'] = esc_html__( 'Gallery - Small', 'pelicula-core' );
		
		return $variations;
	}
	
	add_filter( 'pelicula_core_filter_portfolio_single_layout_options', 'pelicula_core_add_portfolio_single_variation_gallery_small' );
}