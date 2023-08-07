<?php

if ( ! function_exists( 'pelicula_core_register_standard_with_breadcrumbs_title_layout' ) ) {
	function pelicula_core_register_standard_with_breadcrumbs_title_layout( $layouts ) {
		$layouts['standard-with-breadcrumbs'] = 'PeliculaCoreStandardWithBreadcrumbsTitle';

		return $layouts;
	}

	add_filter( 'pelicula_core_filter_register_title_layouts', 'pelicula_core_register_standard_with_breadcrumbs_title_layout' );
}

if ( ! function_exists( 'pelicula_core_add_standard_with_breadcrumbs_title_layout_option' ) ) {
	/**
	 * Function that set new value into title layout options map
	 *
	 * @param $layouts array - module layouts
	 *
	 * @return array
	 */
	function pelicula_core_add_standard_with_breadcrumbs_title_layout_option( $layouts ) {
		$layouts['standard-with-breadcrumbs'] = esc_html__( 'Standard with breadcrumbs', 'pelicula-core' );

		return $layouts;
	}

	add_filter( 'pelicula_core_filter_title_layout_options', 'pelicula_core_add_standard_with_breadcrumbs_title_layout_option' );
}

