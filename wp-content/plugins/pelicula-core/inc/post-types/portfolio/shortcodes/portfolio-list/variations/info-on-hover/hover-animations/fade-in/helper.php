<?php

if ( ! function_exists( 'pelicula_core_filter_portfolio_list_info_on_hover_fade_in' ) ) {
	function pelicula_core_filter_portfolio_list_info_on_hover_fade_in( $variations ) {
		$variations['fade-in'] = esc_html__( 'Fade In', 'pelicula-core' );
		
		return $variations;
	}
	
	add_filter( 'pelicula_core_filter_portfolio_list_info_on_hover_animation_options', 'pelicula_core_filter_portfolio_list_info_on_hover_fade_in' );
}