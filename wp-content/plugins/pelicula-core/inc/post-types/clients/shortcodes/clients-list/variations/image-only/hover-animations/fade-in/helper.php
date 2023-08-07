<?php
if ( ! function_exists( 'pelicula_core_filter_clients_list_image_only_fade_in' ) ) {
	function pelicula_core_filter_clients_list_image_only_fade_in( $variations ) {
		
		$variations['fade-in'] = esc_html__( 'Fade In', 'pelicula-core' );
		
		return $variations;
	}
	
	add_filter( 'pelicula_core_filter_clients_list_image_only_animation_options', 'pelicula_core_filter_clients_list_image_only_fade_in' );
}