<?php

if ( ! function_exists( 'pelicula_core_add_portfolio_list_variation_info_follow' ) ) {
	function pelicula_core_add_portfolio_list_variation_info_follow( $variations ) {
		
		$variations['info-follow'] = esc_html__( 'Info Follow', 'pelicula-core' );
		
		return $variations;
	}
	
	add_filter( 'pelicula_core_filter_portfolio_list_layouts', 'pelicula_core_add_portfolio_list_variation_info_follow' );
}