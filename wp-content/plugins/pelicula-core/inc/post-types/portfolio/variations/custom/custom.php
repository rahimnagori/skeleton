<?php

if ( ! function_exists( 'pelicula_core_add_portfolio_single_variation_custom' ) ) {
	function pelicula_core_add_portfolio_single_variation_custom( $variations ) {
		$variations['custom'] = esc_html__( 'Custom', 'pelicula-core' );
		
		return $variations;
	}
	
	add_filter( 'pelicula_core_filter_portfolio_single_layout_options', 'pelicula_core_add_portfolio_single_variation_custom' );
}