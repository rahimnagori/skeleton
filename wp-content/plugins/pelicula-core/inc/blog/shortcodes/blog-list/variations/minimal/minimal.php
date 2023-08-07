<?php

if ( ! function_exists( 'pelicula_core_add_blog_list_variation_minimal' ) ) {
	function pelicula_core_add_blog_list_variation_minimal( $variations ) {
		$variations['minimal'] = esc_html__( 'Minimal', 'pelicula-core' );
		
		return $variations;
	}
	
	add_filter( 'pelicula_core_filter_blog_list_layouts', 'pelicula_core_add_blog_list_variation_minimal' );
}