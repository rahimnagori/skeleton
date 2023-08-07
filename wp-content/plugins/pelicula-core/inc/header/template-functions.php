<?php

if ( ! function_exists( 'pelicula_core_get_header_logo_image' ) ) {
	/**
	 * This function print header logo image
	 *
	 * @param $parameters array
	 */
	function pelicula_core_get_header_logo_image( $parameters = array() ) {
		$header_skin            = pelicula_core_get_post_value_through_levels( 'qodef_header_skin' );
		$logo_height            = pelicula_core_get_post_value_through_levels( 'qodef_logo_height' );
		$sticky_logo_height     = pelicula_core_get_post_value_through_levels( 'qodef_sticky_logo_height' );
		$customizer_logo        = pelicula_core_get_customizer_logo();
		$logo_source            = pelicula_core_get_post_value_through_levels( 'qodef_logo_source' );
		$logo_text              = pelicula_core_get_post_value_through_levels( 'qodef_logo_text' );
		$logo_text_color        = pelicula_core_get_post_value_through_levels( 'qodef_logo_text_color' );
		$logo_text_font_size    = pelicula_core_get_post_value_through_levels( 'qodef_logo_text_font_size' );
		$logo_line_through      = pelicula_core_get_post_value_through_levels( 'qodef_logo_line_through' );
		$sticky_logo_text_color = pelicula_core_get_post_value_through_levels( 'qodef_logo_sticky_text_color' );

		if ( is_404() ) {
			$header_skin = 'light';
		}

		$additional_class = '';

		if($logo_source === 'text') {
			if($logo_line_through === 'yes') {
				$additional_class = 'qodef-textual-logo qodef--line-through';
			} else {
				$additional_class = 'qodef-textual-logo';
			}
		}

		$parameters = array_merge( $parameters, array(
			'logo_classes'            => ! empty( $logo_height ) ? 'qodef-height--set' : 'qodef-height--not-set',
			'logo_height'             => ! empty( $logo_height ) ? 'height:' . intval( $logo_height ) . 'px' : '',
			'sticky_logo_height'      => ! empty( $sticky_logo_height ) ? 'height:' . intval( $sticky_logo_height ) . 'px' : '',
			'additional_logo_classes' => $additional_class,
			'logo_styles'             => array(
				'logo_height'         => ! empty( $logo_height ) ? 'height:' . intval( $logo_height ) . 'px' : '',
				'logo_text_color'     => ! empty( $logo_text_color ) ? 'color:' . $logo_text_color : '',
				'logo_text_font_size' => ! empty( $logo_text_font_size ) ? 'font-size:' . $logo_text_font_size : '',
			),
			'sticky_logo_styles'      => array(
				'logo_height'         => ! empty( $sticky_logo_height ) ? 'height:' . intval( $sticky_logo_height ) . 'px' : '',
				'logo_text_color'     => ! empty( $logo_text_color ) ? 'color:' . $logo_text_color : '',
				'logo_text_font_size' => ! empty( $logo_text_font_size ) ? 'font-size:' . $logo_text_font_size : '',
			),
			'sticky_text_logo_styles' => array(
				'sticky_logo_text_color' => ! empty( $sticky_logo_text_color ) ? 'color:' . $sticky_logo_text_color : '',
			),
			'logo_source'             => ! empty( $logo_source ) ? $logo_source : '',
			'logo_text'               => ! empty( $logo_text ) ? $logo_text : '',
		) );

		$available_logos = array(
			'main',
			'dark',
			'light',
		);

		$is_enabled = false;

		foreach ( $available_logos as $logo ) {
			$parameters[ 'logo_' . $logo . '_image' ] = '';

			$logo_image_id = pelicula_core_get_post_value_through_levels( 'qodef_logo_' . $logo );
			
			if ( empty( $logo_image_id ) && ! empty( $header_skin ) ) {
				$logo_image_id = pelicula_core_get_post_value_through_levels( 'qodef_logo_main' );
			}
			
			if ( ! empty( $logo_image_id ) ) {
				$logo_image_attr = array(
					'class'    => 'qodef-header-logo-image qodef--' . $logo,
					'itemprop' => 'image',
					'alt'      => sprintf( esc_attr__( 'logo %s', 'pelicula-core' ), $logo )
				);

				$image      = wp_get_attachment_image( $logo_image_id, 'full', false, $logo_image_attr );
				$image_html = ! empty( $image ) ? $image : qode_framework_get_image_html_from_src( $logo_image_id, $logo_image_attr );

				$parameters[ 'logo_' . $logo . '_image' ] = $image_html;

				$is_enabled = true;
			}
		}

		if ( $is_enabled || $logo_text !== '' ) {
			echo apply_filters( 'pelicula_core_filter_get_header_logo_image', pelicula_core_get_template_part( 'header/templates', 'parts/logo', '', $parameters ), $parameters );
		} else if ( ! empty( $customizer_logo ) ) {
			echo qode_framework_wp_kses_html( 'html', $customizer_logo );
		}
	}
}

if ( ! function_exists( 'pelicula_core_get_header_additional_logo_image' ) ) {
	/**
	 * This function print header additional logo image
	 *
	 * @param $parameters array
	 */
	function pelicula_core_get_header_additional_logo_image( $parameters = array() ) {
		$additional_logo_height     = pelicula_core_get_post_value_through_levels( 'qodef_additional_logo_height' );
		$additional_logo            = pelicula_core_get_post_value_through_levels( 'qodef_additional_logo' );
		$additional_logo_image_id   = ! empty( $additional_logo ) ? $additional_logo : '';

		$parameters = array_merge( $parameters, array(
			'logo_classes'            => ! empty( $additional_logo_height ) ? 'qodef-height--set' : 'qodef-height--not-set',
			'logo_height'             => ! empty( $additional_logo_height ) ? 'height:' . intval( $additional_logo_height ) . 'px' : '',
			'additional_logo_classes' => 'qodef--additional',
			'logo_styles'             => array(
				'logo_height' => ! empty( $additional_logo_height ) ? 'height:' . intval( $additional_logo_height ) . 'px' : '',
			)
		) );

		$is_additional_logo_enabled = false;

		if ( ! empty( $additional_logo_image_id ) ) {
			$logo_image_attr = array(
				'class'    => 'qodef-header-logo-image qodef--main',
				'itemprop' => 'image',
				'alt'      => esc_attr__( 'logo %s', 'pelicula-core' )
			);

			$image      = wp_get_attachment_image( $additional_logo_image_id, 'full', false, $logo_image_attr );
			$image_html = ! empty( $image ) ? $image : qode_framework_get_image_html_from_src( $additional_logo_image_id, $logo_image_attr );

			$parameters[ 'logo_additional_image' ] = $image_html;

			$is_additional_logo_enabled = true;
		}

		if ( $is_additional_logo_enabled ) {
			echo pelicula_core_get_template_part( 'header/templates', 'parts/logo', 'additional', $parameters );
		}
	}
}

if ( ! function_exists( 'pelicula_core_get_header_widget_area' ) ) {
	/**
	 * This function return header widgets area
	 *
	 * @param $header_layout string
	 * @param $widget_area string
	 */
	function pelicula_core_get_header_widget_area( $header_layout = '', $widget_area = 'one' ) {
		$page_id = qode_framework_get_page_id();

		$widget_area_map = apply_filters( 'pelicula_core_filter_header_widget_area', array(
			'page_id'             => $page_id,
			'header_layout'       => $header_layout,
			'is_enabled'          => get_post_meta( $page_id, 'qodef_show_header_widget_areas', true ) !== 'no',
			'default_widget_area' => 'qodef-header-widget-area-' . esc_attr( $widget_area ),
			'custom_widget_area'  => get_post_meta( $page_id, 'qodef_header_custom_widget_area_' . esc_attr( $widget_area ), true )
		) );

		extract( $widget_area_map );

		if ( $is_enabled ) {
			if ( is_active_sidebar( $default_widget_area ) && empty( $custom_widget_area ) ) {
				dynamic_sidebar( $default_widget_area );
			} else if ( ! empty( $custom_widget_area ) && is_active_sidebar( $custom_widget_area ) ) {
				dynamic_sidebar( $custom_widget_area );
			}
		}
	}
}