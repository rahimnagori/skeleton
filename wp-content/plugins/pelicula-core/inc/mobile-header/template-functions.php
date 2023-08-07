<?php

if ( ! function_exists( 'pelicula_core_get_mobile_header_logo_image' ) ) {
	function pelicula_core_get_mobile_header_logo_image() {
		$logo_source                = pelicula_core_get_post_value_through_levels( 'qodef_logo_source' );
		$logo_height_mobile         = pelicula_core_get_post_value_through_levels( 'qodef_mobile_logo_height' );
		$logo_height                = ! empty( $logo_height_mobile ) ? $logo_height_mobile : pelicula_core_get_post_value_through_levels( 'qodef_logo_height' );
		$mobile_logo_main_image_id  = pelicula_core_get_post_value_through_levels( 'qodef_mobile_logo_main' );
		$logo_main_image_id         = ! empty( $mobile_logo_main_image_id ) ? $mobile_logo_main_image_id : pelicula_core_get_post_value_through_levels( 'qodef_logo_main' );
		$customizer_logo            = pelicula_core_get_customizer_logo();
		$logo_text                  = pelicula_core_get_post_value_through_levels( 'qodef_mobile_logo_text' );
		$logo_text_color 			= pelicula_core_get_post_value_through_levels( 'qodef_mobile_logo_text_color' );
		$logo_line_through          = pelicula_core_get_post_value_through_levels( 'qodef_mobile_logo_line_through' );

		$additional_class = '';

		if($logo_source === 'text') {
			if($logo_line_through === 'yes') {
				$additional_class = 'qodef-textual-logo qodef--line-through';
			} else {
				$additional_class = 'qodef-textual-logo';
			}
		}
		
		$parameters = array(
			'logo_source'      => ! empty( $logo_source ) ? $logo_source : '',
			'additional_logo_classes' => $additional_class,
			'logo_styles' => array(
				'logo_height'      => ! empty( $logo_height ) ? 'height:' . intval( $logo_height ) . 'px' : '',
				'logo_text_color'      => ! empty( $logo_text_color ) ? 'color:' . $logo_text_color : '',
			),
			'logo_main_image' => '',
			'logo_text'        => ! empty( $logo_text ) ? $logo_text : '',
		);
		
		if ( ! empty( $logo_main_image_id ) ) {
			$logo_main_image_attr = array(
				'class'    => 'qodef-header-logo-image qodef--main',
				'itemprop' => 'image',
				'alt'      => esc_attr__( 'logo main', 'pelicula-core' )
			);
			
			$image      = wp_get_attachment_image( $logo_main_image_id, 'full', false, $logo_main_image_attr );
			$image_html = ! empty( $image ) ? $image : qode_framework_get_image_html_from_src( $logo_main_image_id, $logo_main_image_attr );
			
			$parameters['logo_main_image'] = $image_html;
		}
		
		if ( ! empty( $logo_main_image_id ) ) {
			pelicula_core_template_part( 'mobile-header/templates', 'parts/mobile-logo', '', $parameters );
		} else if ( ! empty( $customizer_logo ) ) {
			echo qode_framework_wp_kses_html( 'html', $customizer_logo );
		}
	}
}