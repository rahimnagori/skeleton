<?php

if ( ! function_exists( 'pelicula_core_is_boxed_enabled' ) ) {
	function pelicula_core_is_boxed_enabled() {
		return pelicula_core_get_post_value_through_levels( 'qodef_boxed' ) === 'yes';
	}
}

if ( ! function_exists( 'pelicula_core_is_passepartout_enabled' ) ) {
	function pelicula_core_is_passepartout_enabled() {
		return pelicula_core_get_post_value_through_levels( 'qodef_passepartout' ) === 'yes';
	}
}

if ( ! function_exists( 'pelicula_core_add_general_options_body_classes' ) ) {
	function pelicula_core_add_general_options_body_classes( $classes ) {
		$content_width         = pelicula_core_get_post_value_through_levels( 'qodef_content_width' );
		$content_behind_header = pelicula_core_get_post_value_through_levels( 'qodef_content_behind_header' );
		
		$classes[] = pelicula_core_is_boxed_enabled() ? 'qodef--boxed' : '';
		$classes[] = 'qodef-content-grid-' . $content_width;
		$classes[] = $content_behind_header == 'yes' ? 'qodef-content-behind-header' : '';
		$classes[] = pelicula_core_is_passepartout_enabled() ? 'qodef--passepartout' : '';
		
		return $classes;
	}
	
	add_filter( 'body_class', 'pelicula_core_add_general_options_body_classes' );
}

if ( ! function_exists( 'pelicula_core_add_boxed_wrapper_classes' ) ) {
	function pelicula_core_add_boxed_wrapper_classes( $classes ) {
		
		if ( pelicula_core_is_boxed_enabled() ) {
			$classes .= ' qodef-content-grid';
		}
		
		return $classes;
	}
	
	add_filter( 'pelicula_filter_page_wrapper_classes', 'pelicula_core_add_boxed_wrapper_classes' );
}

if ( ! function_exists( 'pelicula_core_set_general_styles' ) ) {
	/**
	 * Function that generates module inline styles
	 *
	 * @param $style string
	 *
	 * @return string
	 */
	function pelicula_core_set_general_styles( $style ) {
		$styles = array();
		
		$background_color      = pelicula_core_get_post_value_through_levels( 'qodef_page_background_color' );
		$background_image      = pelicula_core_get_post_value_through_levels( 'qodef_page_background_image' );
		$background_repeat     = pelicula_core_get_post_value_through_levels( 'qodef_page_background_repeat' );
		$background_size       = pelicula_core_get_post_value_through_levels( 'qodef_page_background_size' );
		$background_attachment = pelicula_core_get_post_value_through_levels( 'qodef_page_background_attachment' );
		
		if ( ! empty( $background_color ) ) {
			$styles['background-color'] = $background_color;
		}
		
		if ( ! empty( $background_image ) ) {
			$styles['background-image'] = 'url(' . esc_url( wp_get_attachment_image_url( $background_image, 'full' ) ) . ')';
		}
		
		if ( ! empty( $background_repeat ) ) {
			$styles['background-repeat'] = $background_repeat;
		}
		
		if ( ! empty( $background_size ) ) {
			$styles['background-size'] = $background_size;
		}
		
		if ( ! empty( $background_attachment ) ) {
			$styles['background-attachment'] = $background_attachment;
		}
		
		if ( ! empty( $styles ) ) {
			$selector = pelicula_core_is_passepartout_enabled() ? '.qodef--passepartout #qodef-page-wrapper' : 'body';
			$style    .= qode_framework_dynamic_style( $selector, $styles );
		}
		
		if ( pelicula_core_is_boxed_enabled() ) {
			$boxed_styles = array();
			
			$boxed_background_color = pelicula_core_get_post_value_through_levels( 'qodef_boxed_background_color' );
			
			if ( ! empty( $boxed_background_color ) ) {
				$boxed_styles['background-color'] = $boxed_background_color;
			}
			
			if ( ! empty( $boxed_styles ) ) {
				$style .= qode_framework_dynamic_style( '.qodef--boxed #qodef-page-wrapper', $boxed_styles );
			}
		}
		
		if ( pelicula_core_is_passepartout_enabled() ) {
			$passepartout_styles = array();
			$passepartout_color  = pelicula_core_get_post_value_through_levels( 'qodef_passepartout_color' );
			$passepartout_image  = pelicula_core_get_post_value_through_levels( 'qodef_passepartout_image' );
			$passepartout_size   = pelicula_core_get_post_value_through_levels( 'qodef_passepartout_size' );
			
			if ( ! empty( $passepartout_color ) ) {
				$passepartout_styles['background-color'] = $passepartout_color;
			}
			
			if ( ! empty( $passepartout_image ) ) {
				$passepartout_styles['background-image'] = 'url(' . esc_url( wp_get_attachment_image_url( $passepartout_image, 'full' ) ) . ')';
			}
			
			if ( ! empty( $passepartout_size ) ) {
				
				if ( qode_framework_string_ends_with_space_units( $passepartout_size ) ) {
					$passepartout_styles['padding'] = $passepartout_size;
				} else {
					$passepartout_styles['padding'] = intval( $passepartout_size ) . 'px';
				}
			}
			
			if ( ! empty( $passepartout_styles ) ) {
				$style .= qode_framework_dynamic_style( '.qodef--passepartout', $passepartout_styles );
			}
			
			$passepartout_responsive_styles = array();
			$passepartout_size_responsive   = pelicula_core_get_post_value_through_levels( 'qodef_passepartout_size_responsive' );
			
			if ( ! empty( $passepartout_size_responsive ) ) {
				if ( qode_framework_string_ends_with_space_units( $passepartout_size_responsive ) ) {
					$passepartout_responsive_styles['padding'] = $passepartout_size_responsive;
				} else {
					$passepartout_responsive_styles['padding'] = intval( $passepartout_size_responsive ) . 'px';
				}
			}
			
			if ( ! empty( $passepartout_responsive_styles ) ) {
				$style .= qode_framework_dynamic_style_responsive( '.qodef--passepartout', $passepartout_responsive_styles, '', '1024' );
			}
		}
		
		$page_content_style = array();
		
		$page_content_padding = pelicula_core_get_post_value_through_levels( 'qodef_page_content_padding' );
		if ( ! empty ( $page_content_padding ) ) {
			$page_content_style['padding'] = $page_content_padding;
		}
		
		if ( ! empty( $page_content_style ) ) {
			$style .= qode_framework_dynamic_style( '#qodef-page-inner', $page_content_style );
		}
		
		$page_content_style_mobile = array();
		
		$page_content_padding_mobile = pelicula_core_get_post_value_through_levels( 'qodef_page_content_padding_mobile' );
		if ( ! empty ( $page_content_padding_mobile ) ) {
			$page_content_style_mobile['padding'] = $page_content_padding_mobile;
		}
		
		if ( ! empty( $page_content_style_mobile ) ) {
			$style .= qode_framework_dynamic_style_responsive( '#qodef-page-inner', $page_content_style_mobile, '', '1024' );
		}
		
		return $style;
	}
	
	add_filter( 'pelicula_filter_add_inline_style', 'pelicula_core_set_general_styles' );
}

if ( ! function_exists( 'pelicula_core_add_grid_lines' ) ) {
	/**
	 * Adds vertical lines in website content background
	 *
	 * @return html
	 */
	function pelicula_core_add_grid_lines() {
		$enable_content_lines              = pelicula_core_get_post_value_through_levels( 'qodef_content_lines' );
		$enable_content_center_line        = pelicula_core_get_post_value_through_levels( 'qodef_content_center_line' );
		$enable_content_lines_in_grid      = pelicula_core_get_post_value_through_levels( 'qodef_content_lines_in_grid' );
		$enable_content_lines_in_grid_type = pelicula_core_get_post_value_through_levels( 'qodef_content_lines_in_grid_type' );
		$content_lines_skin                = pelicula_core_get_post_value_through_levels( 'qodef_content_lines_skin' );

		$html = '';
		if ( $enable_content_lines === 'yes' ) {

			$holder_classes = array( 'qodef-content-lines-holder' );

			if ( $enable_content_lines_in_grid === 'yes' ) {
				$holder_classes[] = 'qodef-content-grid';

				if ( ! empty( $enable_content_lines_in_grid_type ) ) {
					$holder_classes[] = 'qodef-content-grid-type--' . esc_attr( $enable_content_lines_in_grid_type );
				}
			}

			if ( ! empty( $content_lines_skin ) ) {
				$holder_classes[] = 'qodef-skin--' . esc_attr( $content_lines_skin );
			}

			$html .= '<div ' . qode_framework_get_class_attribute( $holder_classes ) . '>';

				$html .= '<div class="qodef-content-line qodef--left"></div>';

				if ( $enable_content_center_line === 'yes' ) {
					$html .= '<div class="qodef-content-line qodef--center"></div>';
				}

				$html .= '<div class="qodef-content-line qodef--right"></div>';

			$html .= '</div>';
		}

		echo $html;
	}

	add_filter( 'pelicula_action_page_header_template', 'pelicula_core_add_grid_lines' );
}

if ( ! function_exists( 'pelicula_core_set_general_main_color_styles' ) ) {
	/**
	 * Function that generates module inline styles
	 *
	 * @param $style string
	 *
	 * @return string
	 */
	function pelicula_core_set_general_main_color_styles( $style ) {
		$main_color = pelicula_core_get_post_value_through_levels( 'qodef_main_color' );
		
		if ( ! empty( $main_color ) ) {
			
			// Include main color selectors
			include_once PELICULA_CORE_INC_PATH . '/general/main-color/main-color.php';
			
			$allowed_selectors = array(
				'color',
				'color_important',
				'background_color',
				'background_color_important',
				'border_color',
				'border_color_important',
				'fill_color',
				'fill_color_important',
				'stroke_color',
				'stroke_color_important',
			);
			
			foreach ( $allowed_selectors as $allowed_selector ) {
				$selector = $allowed_selector . '_selector';
				
				if ( isset( $$selector ) && ! empty( $$selector ) ) {
					
					if ( strpos( $selector, '_important' ) !== false ) {
						$attribute = str_replace( '_important', '', $allowed_selector );
						$color     = $main_color . '!important';
					} else {
						$attribute = $allowed_selector;
						$color     = $main_color;
					}
					
					$style .= qode_framework_dynamic_style( $$selector, array( str_replace( '_', '-', $attribute ) => $color ) );
				}
			}
		}
		
		return $style;
	}
	
	add_filter( 'pelicula_filter_add_inline_style', 'pelicula_core_set_general_main_color_styles' );
}

if ( ! function_exists( 'pelicula_core_print_custom_js' ) ) {
	/**
	 * Prints out custom js from theme options
	 */
	function pelicula_core_print_custom_js() {
		$custom_js = pelicula_core_get_post_value_through_levels( 'qodef_custom_js' );
		
		if ( ! empty( $custom_js ) ) {
			wp_add_inline_script( 'pelicula-main-js', $custom_js );
		}
	}
	
	add_action( 'wp_enqueue_scripts', 'pelicula_core_print_custom_js', 15 ); // Permission 15 is set in order to call a function after the main theme script initialization
}