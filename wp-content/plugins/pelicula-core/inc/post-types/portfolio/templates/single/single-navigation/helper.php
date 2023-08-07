<?php

if ( ! function_exists( 'pelicula_core_include_portfolio_single_post_navigation_template' ) ) {
	/**
	 * Function which includes additional module on single portfolio page
	 */
	function pelicula_core_include_portfolio_single_post_navigation_template() {
		pelicula_core_template_part( 'post-types/portfolio', 'templates/single/single-navigation/templates/single-navigation' );
	}
	
	add_action( 'pelicula_core_action_after_portfolio_single_item', 'pelicula_core_include_portfolio_single_post_navigation_template' );
}