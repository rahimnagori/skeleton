<?php

if ( ! function_exists( 'pelicula_core_add_section_title_shortcode' ) ) {
	/**
	 * Function that add shortcode into shortcodes list for registration
	 *
	 * @param $shortcodes array
	 *
	 * @return array
	 */
	function pelicula_core_add_section_title_shortcode( $shortcodes ) {
		$shortcodes[] = 'PeliculaCoreSectionTitleShortcode';
		
		return $shortcodes;
	}
	
	add_filter( 'pelicula_core_filter_register_shortcodes', 'pelicula_core_add_section_title_shortcode' );
}

if ( class_exists( 'PeliculaCoreShortcode' ) ) {
	class PeliculaCoreSectionTitleShortcode extends PeliculaCoreShortcode {
		
		public function map_shortcode() {
			$this->set_shortcode_path( PELICULA_CORE_SHORTCODES_URL_PATH . '/section-title' );
			$this->set_base( 'pelicula_core_section_title' );
			$this->set_name( esc_html__( 'Section Title', 'pelicula-core' ) );
			$this->set_description( esc_html__( 'Shortcode that adds section title element', 'pelicula-core' ) );
			$this->set_category( esc_html__( 'Pelicula Core', 'pelicula-core' ) );
			$this->set_option( array(
				'field_type' => 'text',
				'name'       => 'custom_class',
				'title'      => esc_html__( 'Custom Class', 'pelicula-core' ),
			) );
			$this->set_option( array(
				'field_type' => 'text',
				'name'       => 'title',
				'title'      => esc_html__( 'Title', 'pelicula-core' )
			) );
			$this->set_option( array(
				'field_type'  => 'text',
				'name'        => 'line_break_positions',
				'title'       => esc_html__( 'Positions of Line Break', 'pelicula-core' ),
				'description' => esc_html__( 'Enter the positions of the words after which you would like to create a line break. Separate the positions with commas (e.g. if you would like the first, third, and fourth word to have a line break, you would enter "1,3,4")', 'pelicula-core' ),
				'group'       => esc_html__( 'Title Style', 'pelicula-core' )
			) );
			$this->set_option( array(
				'field_type'    => 'select',
				'name'          => 'disable_title_break_words',
				'title'         => esc_html__( 'Disable Title Line Break', 'pelicula-core' ),
				'description'   => esc_html__( 'Enabling this option will disable title line breaks for screen size 1024 and lower', 'pelicula-core' ),
				'options'       => pelicula_core_get_select_type_options_pool( 'no_yes', false ),
				'default_value' => 'no',
				'group'         => esc_html__( 'Title Style', 'pelicula-core' )
			) );
			$this->set_option( array(
				'field_type'  => 'text',
				'name'        => 'custom_styled_words',
				'title'       => esc_html__( 'Custom Styled Words', 'pelicula-core' ),
				'description' => esc_html__( 'Enter the positions of the words which you would like to apply custom styles on. Separate the positions with commas (e.g. if you would like the first, third, and fourth word to have a custom styles, you would enter "1,3,4")', 'pelicula-core' ),
				'group'       => esc_html__( 'Title Style', 'pelicula-core' )
			) );
			$this->set_option( array(
				'field_type'    => 'select',
				'name'          => 'title_tag',
				'title'         => esc_html__( 'Title Tag', 'pelicula-core' ),
				'options'       => pelicula_core_get_select_type_options_pool( 'title_tag' ),
				'default_value' => 'h2',
				'group'         => esc_html__( 'Title Style', 'pelicula-core' )
			) );
			$this->set_option( array(
				'field_type' => 'color',
				'name'       => 'title_color',
				'title'      => esc_html__( 'Title Color', 'pelicula-core' ),
				'group'      => esc_html__( 'Title Style', 'pelicula-core' )
			) );
			$this->set_option( array(
				'field_type' => 'text',
				'name'       => 'link',
				'title'      => esc_html__( 'Title Custom Link', 'pelicula-core' ),
				'group'      => esc_html__( 'Title Style', 'pelicula-core' )
			) );
			$this->set_option( array(
				'field_type'    => 'select',
				'name'          => 'target',
				'title'         => esc_html__( 'Custom Link Target', 'pelicula-core' ),
				'options'       => pelicula_core_get_select_type_options_pool( 'link_target' ),
				'default_value' => '_self',
				'group'      => esc_html__( 'Title Style', 'pelicula-core' )
			) );
			$this->set_option( array(
				'field_type' => 'text',
				'name'       => 'tagline',
				'title'      => esc_html__( 'Tagline', 'pelicula-core' )
			) );
			$this->set_option( array(
				'field_type'    => 'select',
				'name'          => 'tagline_tag',
				'title'         => esc_html__( 'Tagline Tag', 'pelicula-core' ),
				'options'       => pelicula_core_get_select_type_options_pool( 'title_tag' ),
				'default_value' => 'h6',
				'group'         => esc_html__( 'Tagline Style', 'pelicula-core' )
			) );
			$this->set_option( array(
				'field_type' => 'color',
				'name'       => 'tagline_color',
				'title'      => esc_html__( 'Tagline Color', 'pelicula-core' ),
				'group'      => esc_html__( 'Tagline Style', 'pelicula-core' )
			) );
			$this->set_option( array(
				'field_type' => 'text',
				'name'       => 'tagline_margin_bottom',
				'title'      => esc_html__( 'Tagline Margin Bottom', 'pelicula-core' ),
				'group'      => esc_html__( 'Tagline Style', 'pelicula-core' )
			) );
			$this->set_option( array(
				'field_type' => 'textarea',
				'name'       => 'text',
				'title'      => esc_html__( 'Text', 'pelicula-core' )
			) );
			$this->set_option( array(
				'field_type' => 'color',
				'name'       => 'text_color',
				'title'      => esc_html__( 'Text Color', 'pelicula-core' ),
				'group'      => esc_html__( 'Text Style', 'pelicula-core' )
			) );
			$this->set_option( array(
				'field_type' => 'text',
				'name'       => 'text_margin_top',
				'title'      => esc_html__( 'Text Margin Top', 'pelicula-core' ),
				'group'      => esc_html__( 'Text Style', 'pelicula-core' )
			) );
			$this->set_option( array(
				'field_type' => 'select',
				'name'       => 'content_alignment',
				'title'      => esc_html__( 'Content Alignment', 'pelicula-core' ),
				'options'       => array(
					''       => esc_html__( 'Default', 'pelicula-core' ),
					'left'   => esc_html__( 'Left', 'pelicula-core' ),
					'center' => esc_html__( 'Center', 'pelicula-core' ),
					'right'  => esc_html__( 'Right', 'pelicula-core' )
				),
			) );
		}
		
		public function render( $options, $content = null ) {
			parent::render( $options );
			$atts = $this->get_atts();

			$atts['holder_classes'] = $this->get_holder_classes( $atts );
			$atts['title']          = $this->get_modified_title( $atts );
			$atts['title_styles']   = $this->get_title_styles( $atts );
			$atts['tagline_styles'] = $this->get_tagline_styles( $atts );
			$atts['text_styles']    = $this->get_text_styles( $atts );
			$atts['holder_data']    = $this->get_holder_data( $atts );
			
			return pelicula_core_get_template_part( 'shortcodes/section-title', 'templates/section-title', '', $atts );
		}
		
		private function get_holder_classes( $atts ) {
			$holder_classes = $this->init_holder_classes();
			
			$holder_classes[] = 'qodef-section-title';
			$holder_classes[] = ! empty( $atts['content_alignment'] ) ?  'qodef-alignment--' . $atts['content_alignment'] : 'qodef-alignment--left';
			$holder_classes[]  = $atts['disable_title_break_words'] === 'yes' ? 'qodef-title-break--disabled' : '';
			
			return implode( ' ', $holder_classes );
		}
		
		private function get_modified_title( $atts ) {
			$title = $atts['title'];

			if (
				! empty( $title ) &&
				(
					! empty( $atts['custom_styled_words'] )  ||
					! empty( $atts['line_break_positions'] )
				)
			) {
				$split_title = explode( ' ', $title );

				if ( ! empty( $atts['custom_styled_words'] ) ) {
					$custom_styled_words = explode( ',', str_replace( ' ', '', $atts['custom_styled_words'] ) );

					foreach ( $custom_styled_words as $word ) {
						if ( isset( $split_title[ $word - 1 ] ) && ! empty( $split_title[ $word - 1 ] ) ) {
							$split_title[ $word - 1 ] = '<span class="qodef-custom-styles">' . $split_title[ $word - 1 ] . '</span>';
						}
					}
				}

				if ( ! empty( $atts['line_break_positions'] ) ) {
					$line_break_positions = explode( ',', str_replace( ' ', '', $atts['line_break_positions'] ) );

					foreach ( $line_break_positions as $position ) {
                        $position = intval($position);

						if ( isset( $split_title[ $position - 1 ] ) && ! empty( $split_title[ $position - 1 ] ) ) {
							$split_title[ $position - 1 ] = $split_title[ $position - 1 ] . '<br />';
						}
					}
				}

				$title = implode( ' ', $split_title );
			}

			return $title;
		}
		
		private function get_title_styles( $atts ) {
			$styles = array();
			
			if ( ! empty( $atts['title_color'] ) ) {
				$styles[] = 'color: ' . $atts['title_color'];
			}
			
			return $styles;
		}

		private function get_tagline_styles( $atts ) {
			$styles = array();

			if ( $atts['tagline_margin_bottom'] !== '' ) {
				if ( qode_framework_string_ends_with_space_units( $atts['tagline_margin_bottom'] ) ) {
					$styles[] = 'margin-bottom: ' . $atts['tagline_margin_bottom'];
				} else {
					$styles[] = 'margin-bottom: ' . intval( $atts['tagline_margin_bottom'] ) . 'px';
				}
			}

			if ( ! empty( $atts['tagline_color'] ) ) {
				$styles[] = 'color: ' . $atts['tagline_color'];
			}

			return $styles;
		}
		
		private function get_text_styles( $atts ) {
			$styles = array();
			
			if ( $atts['text_margin_top'] !== '' ) {
				if ( qode_framework_string_ends_with_space_units( $atts['text_margin_top'] ) ) {
					$styles[] = 'margin-top: ' . $atts['text_margin_top'];
				} else {
					$styles[] = 'margin-top: ' . intval( $atts['text_margin_top'] ) . 'px';
				}
			}
			
			if ( ! empty( $atts['text_color'] ) ) {
				$styles[] = 'color: ' . $atts['text_color'];
			}
			
			return $styles;
		}

		private function get_holder_data($atts) {
			$data = array();
			
			$data['line-breaks'] = $atts['line_break_positions'];
			
			return json_encode( $data );
		}
	}
}