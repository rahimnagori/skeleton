<?php

if ( ! function_exists( 'pelicula_core_movie_screen_shortcode' ) ) {
	/**
	 * Function that add shortcode into shortcodes list for registration
	 *
	 * @param $shortcodes array
	 *
	 * @return array
	 */
	function pelicula_core_movie_screen_shortcode( $shortcodes ) {
		$shortcodes[] = 'PeliculaCoreMoviesScreenShortcode';
		
		return $shortcodes;
	}
	
	add_filter( 'pelicula_core_filter_register_shortcodes', 'pelicula_core_movie_screen_shortcode' );
}

if ( class_exists( 'PeliculaCoreShortcode' ) ) {
	class PeliculaCoreMoviesScreenShortcode extends PeliculaCoreShortcode {
		
		public function map_shortcode() {
			$this->set_shortcode_path( PELICULA_CORE_SHORTCODES_URL_PATH . '/movie-screen' );
			$this->set_base( 'pelicula_core_movie_screen' );
			$this->set_name( esc_html__( 'Movie screen', 'pelicula-core' ) );
			$this->set_description( esc_html__( 'Shortcode that adds movie screen element', 'pelicula-core' ) );
			$this->set_category( esc_html__( 'Pelicula Core', 'pelicula-core' ) );
			$this->set_option( array(
				'field_type' => 'text',
				'name'       => 'custom_class',
				'title'      => esc_html__( 'Custom Class', 'pelicula-core' ),
			) );
			$this->set_option( array(
				'field_type' => 'image',
				'name'       => 'image',
				'title'      => esc_html__( 'Image', 'pelicula-core' ),
			) );
			$this->set_option( array(
				'field_type' => 'image',
				'name'       => 'additional_image',
				'title'      => esc_html__( 'Additional Image', 'pelicula-core' ),
				'group'      => esc_html__( 'Content', 'pelicula-core' )
			) );
			$this->set_option( array(
				'field_type' => 'text',
				'name'       => 'additional_image_size',
				'title'      => esc_html__( 'Additional Image Size', 'pelicula-core' ),
				'description'=> esc_html__( 'For predefined image sizes input thumbnail, medium, large or full. If you wish to set a custom image size, type in the desired image dimensions in pixels (e.g. 400x400).', 'pelicula-core' ),
				'group'      => esc_html__( 'Content', 'pelicula-core' )
				) );
			$this->set_option( array(
				'field_type' => 'text',
				'name'       => 'title',
				'title'      => esc_html__( 'Title', 'pelicula-core' ),
				'group'      => esc_html__( 'Content', 'pelicula-core' )
			) );
			$this->set_option( array(
				'field_type'    => 'select',
				'name'          => 'title_tag',
				'title'         => esc_html__( 'Title Tag', 'pelicula-core' ),
				'options'       => pelicula_core_get_select_type_options_pool( 'title_tag' ),
				'default_value' => 'h3',
				'group'         => esc_html__( 'Content', 'pelicula-core' )
			) );
			$this->set_option( array(
				'field_type' => 'color',
				'name'       => 'title_color',
				'title'      => esc_html__( 'Title Color', 'pelicula-core' ),
				'group'      => esc_html__( 'Content', 'pelicula-core' )
			) );
			$this->set_option( array(
				'field_type' => 'text',
				'name'       => 'title_margin_top',
				'title'      => esc_html__( 'Title Margin Top', 'pelicula-core' ),
				'group'      => esc_html__( 'Content', 'pelicula-core' )
			) );
			$this->set_option( array(
				'field_type' => 'text',
				'name'       => 'subtitle',
				'title'      => esc_html__( 'Subtitle', 'pelicula-core' ),
				'group'      => esc_html__( 'Content', 'pelicula-core' )
			) );
			$this->set_option( array(
				'field_type'    => 'select',
				'name'          => 'subtitle_tag',
				'title'         => esc_html__( 'Subtitle Tag', 'pelicula-core' ),
				'options'       => pelicula_core_get_select_type_options_pool( 'title_tag' ),
				'default_value' => 'h5',
				'group'         => esc_html__( 'Content', 'pelicula-core' )
			) );
			$this->set_option( array(
				'field_type' => 'color',
				'name'       => 'subtitle_color',
				'title'      => esc_html__( 'Subtitle Color', 'pelicula-core' ),
				'group'      => esc_html__( 'Content', 'pelicula-core' )
			) );
			$this->set_option( array(
				'field_type' => 'text',
				'name'       => 'subtitle_margin_top',
				'title'      => esc_html__( 'Subtitle Margin Top', 'pelicula-core' ),
				'group'      => esc_html__( 'Content', 'pelicula-core' )
			) );
			$this->import_shortcode_options( array(
				'shortcode_base'    => 'pelicula_core_button',
				'exclude'           => array( 'custom_class' ),
				'additional_params' => array(
					'group' => esc_html__( 'Button', 'pelicula-core' ),
				)
			) );
			
			$this->map_extra_options();
		}
		
		public function render( $options, $content = null ) {
			parent::render( $options );
			$atts = $this->get_atts();

			$atts['holder_classes']          = $this->get_holder_classes( $atts );
			$atts['title_styles']            = $this->get_title_styles( $atts );
			$atts['subtitle_styles']         = $this->get_subtitle_styles( $atts );
			$atts['button_params']           = $this->generate_button_params( $atts );
			$atts['main_image_params']       = $this->generate_main_image_params( $atts );
			$atts['additional_image_params'] = $this->generate_additional_image_params( $atts );

			return pelicula_core_get_template_part( 'shortcodes/movie-screen', 'templates/movie-screen', '', $atts );
		}
		
		private function get_holder_classes( $atts ) {
			$holder_classes = $this->init_holder_classes();
			
			$holder_classes[] = 'qodef-movie-screen';
			
			return implode( ' ', $holder_classes );
		}
		
		private function get_title_styles( $atts ) {
			$styles = array();
			
			if ( $atts['title_margin_top'] !== '' ) {
				if ( qode_framework_string_ends_with_space_units( $atts['title_margin_top'] ) ) {
					$styles[] = 'margin-top: ' . $atts['title_margin_top'];
				} else {
					$styles[] = 'margin-top: ' . intval( $atts['title_margin_top'] ) . 'px';
				}
			}
			
			if ( ! empty( $atts['title_color'] ) ) {
				$styles[] = 'color: ' . $atts['title_color'];
			}
			
			return $styles;
		}
		
		private function get_subtitle_styles( $atts ) {
			$styles = array();
			
			if ( $atts['subtitle_margin_top'] !== '' ) {
				if ( qode_framework_string_ends_with_space_units( $atts['subtitle_margin_top'] ) ) {
					$styles[] = 'margin-top: ' . $atts['subtitle_margin_top'];
				} else {
					$styles[] = 'margin-top: ' . intval( $atts['subtitle_margin_top'] ) . 'px';
				}
			}
			
			if ( ! empty( $atts['subtitle_color'] ) ) {
				$styles[] = 'color: ' . $atts['subtitle_color'];
			}
			
			return $styles;
		}
		
		private function generate_button_params( $atts ) {
			$params = $this->populate_imported_shortcode_atts( array(
				'shortcode_base' => 'pelicula_core_button',
				'exclude'        => array( 'custom_class' ),
				'atts'           => $atts,
			) );
			
			return $params;
		}

		private function generate_image_params( $image_id ) {

			$image_id       = intval( $image_id );
			$image_original = wp_get_attachment_image_src( $image_id, 'full' );

			$image = array();
			if ( $image_original ) {
				$image['image_id']     = $image_id;
				$image['url']          = $image_original[0];
				$image['alt']          = get_post_meta( $image_id, '_wp_attachment_image_alt', true );
				$image['bg_image_css'] = array(
					'background-image: url(' . $image['url'] . '); ',
					'background-repeat: no-repeat; ',
					'background-position: top left; ',
					'background-size: cover; '
				);
			}

			return $image;
		}

		private function generate_image_size_params( $size ) {

			$size = trim( $size );
			preg_match_all( '/\d+/', $size, $matches ); /* check if numeral width and height are entered */

			if ( in_array( $size, array( 'thumbnail', 'thumb', 'medium', 'large', 'full' ) ) ) {
				return $size;
			} elseif ( ! empty( $matches[0] ) ) {
				return array(
					$matches[0][0],
					$matches[0][1]
				);
			} else {
				return 'full';
			}
		}

		private function generate_main_image_params( $atts ) {
			$main_image = array();

			if ( ! empty( $atts['image'] ) ) {
				$main_image = $this->generate_image_params( $atts['image'] );
			}

			return $main_image;
		}

		private function generate_additional_image_params( $atts ) {
			$additional_image = array();
			
			if ( ! empty( $atts['additional_image'] ) ) {
				$additional_image               = $this->generate_image_params( $atts['additional_image'] );
				$additional_image['image_size'] = $this->generate_image_size_params( $atts['additional_image_size'] );
			}
			
			return $additional_image;
		}
	}
}