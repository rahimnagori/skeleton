<?php
if ( ! function_exists( 'pelicula_core_filter_portfolio_list_info_follow' ) ) {
	function pelicula_core_filter_portfolio_list_info_follow( $variations ) {

		$variations['follow'] = esc_html__( 'Follow', 'pelicula-core' );

		return $variations;
	}

	add_filter( 'pelicula_core_filter_portfolio_list_info_follow_animation_options', 'pelicula_core_filter_portfolio_list_info_follow' );
}