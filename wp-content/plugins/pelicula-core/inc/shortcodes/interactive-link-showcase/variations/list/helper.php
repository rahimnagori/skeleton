<?php

if ( ! function_exists( 'pelicula_core_add_interactive_link_showcase_variation_list' ) ) {
	function pelicula_core_add_interactive_link_showcase_variation_list( $variations ) {
		$variations['list'] = esc_html__( 'List', 'pelicula-core' );
		
		return $variations;
	}
	
	add_filter( 'pelicula_core_filter_interactive_link_showcase_layouts', 'pelicula_core_add_interactive_link_showcase_variation_list' );
}
