<?php

if ( ! function_exists( 'pelicula_core_add_product_categories_list_variation_info_on_image' ) ) {
	function pelicula_core_add_product_categories_list_variation_info_on_image( $variations ) {
		$variations['info-on-image'] = esc_html__( 'Info On Image', 'pelicula-core' );

		return $variations;
	}

	add_filter( 'pelicula_core_filter_product_categories_list_layouts', 'pelicula_core_add_product_categories_list_variation_info_on_image' );
}