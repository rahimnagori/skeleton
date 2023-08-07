<?php

if ( ! function_exists( 'pelicula_core_add_portfolio_single_variation_gallery_big' ) ) {
	function pelicula_core_add_portfolio_single_variation_gallery_big( $variations ) {
		$variations['gallery-big'] = esc_html__( 'Gallery - Big', 'pelicula-core' );
		
		return $variations;
	}
	
	add_filter( 'pelicula_core_filter_portfolio_single_layout_options', 'pelicula_core_add_portfolio_single_variation_gallery_big' );
}