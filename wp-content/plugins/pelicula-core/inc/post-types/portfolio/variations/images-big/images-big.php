<?php

if ( ! function_exists( 'pelicula_core_add_portfolio_single_variation_images_big' ) ) {
	function pelicula_core_add_portfolio_single_variation_images_big( $variations ) {
		$variations['images-big'] = esc_html__( 'Images - Big', 'pelicula-core' );
		
		return $variations;
	}
	
	add_filter( 'pelicula_core_filter_portfolio_single_layout_options', 'pelicula_core_add_portfolio_single_variation_images_big' );
}

if ( ! function_exists( 'pelicula_core_set_default_portfolio_single_variation_compact' ) ) {
	function pelicula_core_set_default_portfolio_single_variation_compact() {
		return 'images-big';
	}
	
	add_filter( 'pelicula_core_filter_portfolio_single_layout_default_value', 'pelicula_core_set_default_portfolio_single_variation_compact' );
}