<?php

if ( ! function_exists( 'pelicula_core_add_portfolio_list_variation_info_bottom_left' ) ) {
	function pelicula_core_add_portfolio_list_variation_info_bottom_left( $variations ) {
		
		$variations['info-bottom-left'] = esc_html__( 'Info Bottom Left', 'pelicula-core' );
		
		return $variations;
	}
	
	add_filter( 'pelicula_core_filter_portfolio_list_layouts', 'pelicula_core_add_portfolio_list_variation_info_bottom_left' );
}