<?php

if ( ! function_exists( 'pelicula_core_add_interactive_link_showcase_variation_slider' ) ) {
	function pelicula_core_add_interactive_link_showcase_variation_slider( $variations ) {
		$variations['slider'] = esc_html__( 'Slider', 'pelicula-core' );
		
		return $variations;
	}
	
	add_filter( 'pelicula_core_filter_interactive_link_showcase_layouts', 'pelicula_core_add_interactive_link_showcase_variation_slider' );
}
