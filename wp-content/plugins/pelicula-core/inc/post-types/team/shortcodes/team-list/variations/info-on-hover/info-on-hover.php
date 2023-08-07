<?php

if ( ! function_exists( 'pelicula_core_add_team_list_variation_info_on_hover' ) ) {
	function pelicula_core_add_team_list_variation_info_on_hover( $variations ) {
		
		$variations['info-on-hover'] = esc_html__( 'Info on Hover', 'pelicula-core' );
		
		return $variations;
	}
	
	add_filter( 'pelicula_core_filter_team_list_layouts', 'pelicula_core_add_team_list_variation_info_on_hover' );
}