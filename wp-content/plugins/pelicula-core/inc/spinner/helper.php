<?php

if ( ! function_exists( 'pelicula_core_is_page_spinner_enabled' ) ) {
	function pelicula_core_is_page_spinner_enabled() {
		return pelicula_core_get_post_value_through_levels( 'qodef_enable_page_spinner' ) === 'yes';
	}
}

if ( ! function_exists( 'pelicula_core_load_page_spinner' ) ) {
	/**
	 * Loads Spinners HTML
	 */
	function pelicula_core_load_page_spinner() {
		
		if ( pelicula_core_is_page_spinner_enabled() ) {
			$parameters = array();
			
			pelicula_core_template_part( 'spinner', 'templates/spinner', '', $parameters );
		}
	}
	
	add_action( 'pelicula_action_after_body_tag_open', 'pelicula_core_load_page_spinner' );
}

if ( ! function_exists( 'pelicula_core_get_spinners_type' ) ) {
	function pelicula_core_get_spinners_type() {
		$html = '';
		$type = pelicula_core_get_post_value_through_levels( 'qodef_page_spinner_type' );
		
		if ( ! empty( $type ) ) {
			$html = pelicula_core_get_template_part( 'spinner', 'layouts/' . $type . '/templates/' . $type );
		}
		
		echo wp_kses_post( $html );
	}
}

if ( ! function_exists( 'pelicula_core_set_page_spinner_classes' ) ) {
	/**
	 * Function that return classes for page spinner area
	 *
	 * @param array $classes
	 *
	 * @return array
	 */
	function pelicula_core_set_page_spinner_classes( $classes ) {
		$type = pelicula_core_get_post_value_through_levels( 'qodef_page_spinner_type' );
		
		if ( ! empty( $type ) ) {
			$classes[] = 'qodef-layout--' . esc_attr( $type );
		}
		
		return $classes;
	}
	
	add_filter( 'pelicula_core_filter_page_spinner_classes', 'pelicula_core_set_page_spinner_classes' );
}

if ( ! function_exists( 'pelicula_core_set_page_spinner_styles' ) ) {
	/**
	 * Function that generates module inline styles
	 *
	 * @param string $style
	 *
	 * @return string
	 */
	function pelicula_core_set_page_spinner_styles( $style ) {
		$spinner_styles = array();
		
		$spinner_background_color = pelicula_core_get_post_value_through_levels( 'qodef_page_spinner_background_color' );
		$spinner_color            = pelicula_core_get_post_value_through_levels( 'qodef_page_spinner_color' );
		
		if ( ! empty( $spinner_background_color ) ) {
			$spinner_styles['background-color'] = $spinner_background_color;
		}
		
		if ( ! empty( $spinner_color ) ) {
			$spinner_styles['color'] = $spinner_color;
		}
		
		if ( ! empty( $spinner_styles ) ) {
			$style .= qode_framework_dynamic_style( '#qodef-page-spinner .qodef-m-inner', $spinner_styles );
		}
		
		return $style;
	}
	
	add_filter( 'pelicula_filter_add_inline_style', 'pelicula_core_set_page_spinner_styles' );
}