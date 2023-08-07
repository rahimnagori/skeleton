<?php

if ( ! function_exists( 'pelicula_core_is_back_to_top_enabled' ) ) {
	function pelicula_core_is_back_to_top_enabled() {
		return pelicula_core_get_post_value_through_levels( 'qodef_back_to_top' ) !== 'no';
	}
}

if ( ! function_exists( 'pelicula_core_add_back_to_top_to_body_classes' ) ) {
	function pelicula_core_add_back_to_top_to_body_classes( $classes ) {
		$classes[] = pelicula_core_is_back_to_top_enabled() ? 'qodef-back-to-top--enabled' : '';
		
		return $classes;
	}
	
	add_filter( 'body_class', 'pelicula_core_add_back_to_top_to_body_classes' );
}

if ( ! function_exists( 'pelicula_core_load_back_to_top' ) ) {
	/**
	 * Loads Back To Top HTML
	 */
	function pelicula_core_load_back_to_top() {
		
		if ( pelicula_core_is_back_to_top_enabled() ) {
			$parameters = array();
			
			pelicula_core_template_part( 'back-to-top', 'templates/back-to-top', '', $parameters );
		}
	}
	
	add_action( 'pelicula_action_before_wrapper_close_tag', 'pelicula_core_load_back_to_top' );
}