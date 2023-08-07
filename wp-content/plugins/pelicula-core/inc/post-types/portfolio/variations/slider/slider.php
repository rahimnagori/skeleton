<?php

if ( ! function_exists( 'pelicula_core_add_portfolio_single_variation_slider' ) ) {
	function pelicula_core_add_portfolio_single_variation_slider( $variations ) {
		$variations['slider'] = esc_html__( 'Slider', 'pelicula-core' );
		
		return $variations;
	}
	
	add_filter( 'pelicula_core_filter_portfolio_single_layout_options', 'pelicula_core_add_portfolio_single_variation_slider' );
}

if ( ! function_exists( 'pelicula_core_add_portfolio_single_slider' ) ) {
	function pelicula_core_add_portfolio_single_slider() {
		if ( pelicula_core_get_post_value_through_levels( 'qodef_portfolio_single_layout' ) == 'slider' ) {
			pelicula_core_template_part( 'post-types/portfolio', 'variations/slider/layout/parts/slider' );
		}
	}
	
	add_action( 'pelicula_action_before_page_inner', 'pelicula_core_add_portfolio_single_slider' );
}