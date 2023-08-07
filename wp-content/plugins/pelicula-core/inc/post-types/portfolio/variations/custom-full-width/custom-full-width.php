<?php

if ( ! function_exists( 'pelicula_core_add_portfolio_single_variation_custom_full_width' ) ) {
	function pelicula_core_add_portfolio_single_variation_custom_full_width( $variations ) {
		$variations['custom-full-width'] = esc_html__( 'Custom - Full Width', 'pelicula-core' );
		
		return $variations;
	}
	
	add_filter( 'pelicula_core_filter_portfolio_single_layout_options', 'pelicula_core_add_portfolio_single_variation_custom_full_width' );
}

if ( ! function_exists( 'pelicula_core_set_portfolio_single_variation_custom_full_width_holder_width' ) ) {
	function pelicula_core_set_portfolio_single_variation_custom_full_width_holder_width( $classes ) {

		if ( pelicula_core_get_post_value_through_levels( 'qodef_portfolio_single_layout' ) == 'custom-full-width' ) {
			$classes = 'qodef-content-full-width';
		}

		return $classes;
	}

	add_filter( 'pelicula_filter_page_inner_classes', 'pelicula_core_set_portfolio_single_variation_custom_full_width_holder_width' );
}