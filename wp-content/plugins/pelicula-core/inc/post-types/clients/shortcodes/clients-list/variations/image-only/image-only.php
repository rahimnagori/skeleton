<?php

if ( ! function_exists( 'pelicula_core_add_clients_list_variation_image_only' ) ) {
	function pelicula_core_add_clients_list_variation_image_only( $variations ) {
		
		$variations['image-only'] = esc_html__( 'Image Only', 'pelicula-core' );
		
		return $variations;
	}
	
	add_filter( 'pelicula_core_filter_clients_list_layouts', 'pelicula_core_add_clients_list_variation_image_only' );
}