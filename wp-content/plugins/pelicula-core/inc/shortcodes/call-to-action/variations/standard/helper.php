<?php

if ( ! function_exists( 'pelicula_core_add_call_to_action_variation_standard' ) ) {
	function pelicula_core_add_call_to_action_variation_standard( $variations ) {
		
		$variations['standard'] = esc_html__( 'Standard', 'pelicula-core' );
		
		return $variations;
	}
	
	add_filter( 'pelicula_core_filter_call_to_action_layouts', 'pelicula_core_add_call_to_action_variation_standard' );
}
