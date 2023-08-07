<?php

if ( ! function_exists( 'pelicula_core_add_social_share_variation_dropdown' ) ) {
	function pelicula_core_add_social_share_variation_dropdown( $variations ) {
		
		$variations['dropdown'] = esc_html__( 'Dropdown', 'pelicula-core' );
		
		return $variations;
	}
	
	add_filter( 'pelicula_core_filter_social_share_layouts', 'pelicula_core_add_social_share_variation_dropdown' );
}
