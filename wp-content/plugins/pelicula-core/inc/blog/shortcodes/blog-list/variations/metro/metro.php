<?php

if ( ! function_exists( 'pelicula_core_add_blog_list_variation_metro' ) ) {
	function pelicula_core_add_blog_list_variation_metro( $variations ) {
		$variations['metro'] = esc_html__( 'Metro', 'pelicula-core' );
		
		return $variations;
	}
	
	add_filter( 'pelicula_core_filter_blog_list_layouts', 'pelicula_core_add_blog_list_variation_metro' );
}