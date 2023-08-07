<?php

if ( ! function_exists( 'pelicula_core_add_interactive_link_carousel_shortcode' ) ) {
	/**
	 * Function that add shortcode into shortcodes list for registration
	 *
	 * @param array $shortcodes
	 *
	 * @return array
	 */
	function pelicula_core_add_interactive_link_carousel_shortcode( $shortcodes ) {
		$shortcodes[] = 'PeliculaCoreInteractiveLinkCarouselShortcode';
		
		return $shortcodes;
	}
	
	add_filter( 'pelicula_core_filter_register_shortcodes', 'pelicula_core_add_interactive_link_carousel_shortcode' );
}

if ( class_exists( 'PeliculaCoreShortcode' ) ) {
	class PeliculaCoreInteractiveLinkCarouselShortcode extends PeliculaCoreShortcode {
		
		public function __construct() {
			$this->set_extra_options( apply_filters( 'pelicula_core_filter_interactive_link_carousel_extra_options', array() ) );
			
			parent::__construct();
		}
		
		public function map_shortcode() {
			$this->set_shortcode_path( PELICULA_CORE_SHORTCODES_URL_PATH . '/interactive-link-carousel' );
			$this->set_base( 'pelicula_core_interactive_link_carousel' );
			$this->set_name( esc_html__( 'Interactive Link Carousel', 'pelicula-core' ) );
			$this->set_description( esc_html__( 'Shortcode that adds interactive link carousel holder', 'pelicula-core' ) );
			$this->set_category( esc_html__( 'Pelicula Core', 'pelicula-core' ) );
			$this->set_option( array(
				'field_type' => 'text',
				'name'       => 'custom_class',
				'title'      => esc_html__( 'Custom Class', 'pelicula-core' ),
			) );

			$this->set_option( array(
				'field_type' => 'select',
				'name'       => 'skin',
				'title'      => esc_html__( 'Link Skin', 'pelicula-core' ),
				'options'    => array(
					''      => esc_html__( 'Default', 'pelicula-core' ),
					'light' => esc_html__( 'Light', 'pelicula-core' )
				)
			) );
			$this->set_option( array(
				'field_type' => 'color',
				'name'       => 'background_color',
				'title'      => esc_html__( 'Background Color', 'pelicula-core' )
			) );
			$this->set_option( array(
				'field_type'    => 'select',
				'name'          => 'link_target',
				'title'         => esc_html__( 'Link Target', 'pelicula-core' ),
				'options'       => pelicula_core_get_select_type_options_pool( 'link_target' ),
				'default_value' => '_self'
			) );
			$this->set_option( array(
				'field_type' => 'repeater',
				'name'       => 'carousel1',
				'title'      => esc_html__( 'Carousel 1', 'pelicula-core' ),
				'items'   => array(
					array(
						'field_type'    => 'text',
						'name'          => 'link_url',
						'title'         => esc_html__( 'Url', 'pelicula-core' ),
						'default_value' => ''
					),
					array(
						'field_type' => 'text',
						'name'       => 'link_text',
						'title'      => esc_html__( 'Text', 'pelicula-core' )
					),
					array(
						'field_type'    => 'select',
						'name'          => 'source',
						'title'         => esc_html__( 'Source', 'pelicula-core' ),
						'options'       => array(
							'image' => esc_html__( 'Image', 'pelicula-core' ),
							'video' => esc_html__( 'Self Hosted Video', 'pelicula-core' )
						),
						'default_value' => 'image'
					),
					array(
						'field_type' => 'image',
						'name'       => 'link_image',
						'title'      => esc_html__( 'Image', 'pelicula-core' ),
						'dependency' => array(
							'show' => array(
								'source' => array(
									'values'        => 'image',
									'default_value' => 'image'
								)
							)
						)
					),
					array(
						'field_type' => 'text',
						'name'       => 'link_video',
						'title'      => esc_html__( 'Video Link', 'pelicula-core' ),
						'dependency' => array(
							'show' => array(
								'source' => array(
									'values'        => 'video',
									'default_value' => 'image'
								)
							)
						)
					)
				)
			) );
			$this->set_option( array(
				'field_type' => 'repeater',
				'name'       => 'carousel2',
				'title'      => esc_html__( 'Carousel 2', 'pelicula-core' ),
				'items'   => array(
					array(
						'field_type'    => 'text',
						'name'          => 'link_url',
						'title'         => esc_html__( 'Url', 'pelicula-core' ),
						'default_value' => ''
					),
					array(
						'field_type' => 'text',
						'name'       => 'link_text',
						'title'      => esc_html__( 'Text', 'pelicula-core' )
					),
					array(
						'field_type'    => 'select',
						'name'          => 'source',
						'title'         => esc_html__( 'Source', 'pelicula-core' ),
						'options'       => array(
							'image' => esc_html__( 'Image', 'pelicula-core' ),
							'video' => esc_html__( 'Self Hosted Video', 'pelicula-core' )
						),
						'default_value' => 'image'
					),
					array(
						'field_type' => 'image',
						'name'       => 'link_image',
						'title'      => esc_html__( 'Image', 'pelicula-core' ),
						'dependency' => array(
							'show' => array(
								'source' => array(
									'values'        => 'image',
									'default_value' => 'image'
								)
							)
						)
					),
					array(
						'field_type' => 'text',
						'name'       => 'link_video',
						'title'      => esc_html__( 'Video Link', 'pelicula-core' ),
						'dependency' => array(
							'show' => array(
								'source' => array(
									'values'        => 'video',
									'default_value' => 'image'
								)
							)
						)
					)
				)
			) );
			$this->map_extra_options();
		}
		
		public function render( $options, $content = null ) {
			parent::render( $options );
			$atts = $this->get_atts();

			$atts['holder_classes'] = $this->get_holder_classes( $atts );
			$atts['holder_styles']  = $this->get_holder_styles( $atts );
			$atts['carousels']      = $this->get_multi_repeater_options( $atts );
			$atts['this_shortcode'] = $this;
			
			return pelicula_core_get_template_part( 'shortcodes/interactive-link-carousel', 'templates/interactive-link-carousel', '', $atts );
		}

		private function get_multi_repeater_options( $atts ) {
			$carousels = array();

			foreach ( array( 1, 2 ) as $index ) {

				if ( ! empty( $carousel = $this->parse_repeater_items( $atts[ 'carousel' . $index ] ) ) ) {
					$carousels[] = $carousel;
				}
			}

			return $carousels;
		}

		private function get_holder_classes( $atts ) {
			$holder_classes = $this->init_holder_classes();
			
			$holder_classes[] = 'qodef-interactive-link-carousel';
			$holder_classes[] = ! empty( $atts['skin'] ) ? 'qodef-skin--' . $atts['skin'] : '';
			
			return implode( ' ', $holder_classes );
		}
		
		private function get_holder_styles( $atts ) {
			$styles = array();
			
			if ( ! empty( $atts['background_color'] ) ) {
				$styles[] = 'background-color: ' . $atts['background_color'];
			}
			
			return $styles;
		}
	}
}