<?php

class VerticalHeader extends PeliculaCoreHeader {
	private static $instance;

	public function __construct() {
		$this->set_slug( 'vertical' );
		$this->overriding_whole_header = true;

		parent::__construct();
	}

	public static function get_instance() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	public function enqueue_additional_assets() {
		wp_enqueue_style( 'perfect-scrollbar', PELICULA_CORE_URL_PATH . 'assets/plugins/perfect-scrollbar/perfect-scrollbar.css', array() );
		wp_enqueue_script( 'perfect-scrollbar', PELICULA_CORE_URL_PATH . 'assets/plugins/perfect-scrollbar/perfect-scrollbar.jquery.min.js', array( 'jquery' ), false, true );
	}

	public function set_nav_menu_header_selector( $selector ) {
		return '.qodef-header--vertical .qodef-header-vertical-navigation';
	}

	public function set_nav_menu_narrow_header_selector( $selector ) {
		return '';
	}

	public function set_inline_header_styles( $style ) {
		$styles = array();

		$height           = pelicula_core_get_post_value_through_levels( 'qodef_' . $this->get_formatted_slug() . '_header_height' );
		$background_color = pelicula_core_get_post_value_through_levels( 'qodef_' . $this->get_formatted_slug() . '_header_background_color' );
		$border_color     = pelicula_core_get_post_value_through_levels( 'qodef_' . $this->get_formatted_slug() . '_header_border_color' );

		if ( $height !== '' ) {
			$styles['height'] = intval( $height ) . 'px';
		}

		if ( ! empty( $background_color ) ) {
			$styles['background-color'] = $background_color;
		}

		if ( ! empty( $border_color ) ) {
			$styles['border-right'] = '2px solid ' . $border_color;
		}

		if ( ! empty( $styles ) ) {
			$style .= qode_framework_dynamic_style( '.qodef-header--' . $this->slug . ' #qodef-page-header', $styles );
		}

		$inner_styles = array();

		$header_padding_top = pelicula_core_get_post_value_through_levels( 'qodef_vertical_header_padding_top' );

		if ( ! empty( $header_padding_top ) ) {
			if ( qode_framework_string_ends_with_space_units( $header_padding_top ) ) {
				$inner_styles['padding-top']  = $header_padding_top;
			} else {
				$inner_styles['padding-top']  = intval( $header_padding_top ) . 'px';
			}
		}

		$header_padding_bottom = pelicula_core_get_post_value_through_levels( 'qodef_vertical_header_padding_bottom' );

		if ( ! empty( $header_padding_bottom ) ) {
			if ( qode_framework_string_ends_with_space_units( $header_padding_bottom ) ) {
				$inner_styles['padding-bottom']  = $header_padding_bottom;
			} else {
				$inner_styles['padding-bottom']  = intval( $header_padding_bottom ) . 'px';
			}
		}

		if ( ! empty( $inner_styles ) ) {
			$style .= qode_framework_dynamic_style( '.qodef-header--' . $this->slug . ' #qodef-page-header-inner', $inner_styles );
		}

		return $style;
	}
}