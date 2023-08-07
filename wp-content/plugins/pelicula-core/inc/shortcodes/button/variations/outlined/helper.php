<?php

if ( ! function_exists( 'pelicula_core_add_button_variation_outlined' ) ) {
	function pelicula_core_add_button_variation_outlined( $variations ) {
		
		$variations['outlined'] = esc_html__( 'Outlined', 'pelicula-core' );
		
		return $variations;
	}
	
	add_filter( 'pelicula_core_filter_button_layouts', 'pelicula_core_add_button_variation_outlined' );
}
