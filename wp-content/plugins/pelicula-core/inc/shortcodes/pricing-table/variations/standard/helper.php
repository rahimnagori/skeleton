<?php

if ( ! function_exists( 'pelicula_core_add_pricing_table_variation_standard' ) ) {
	function pelicula_core_add_pricing_table_variation_standard( $variations ) {
		
		$variations['standard'] = esc_html__( 'Standard', 'pelicula-core' );
		
		return $variations;
	}
	
	add_filter( 'pelicula_core_filter_pricing_table_layouts', 'pelicula_core_add_pricing_table_variation_standard' );
}
