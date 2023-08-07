<?php

if ( ! function_exists( 'pelicula_core_add_movies_list_shortcode' ) ) {
	/**
	 * Function that add shortcode into shortcodes list for registration
	 *
	 * @param $shortcodes array
	 *
	 * @return array
	 */
	function pelicula_core_add_movies_list_shortcode( $shortcodes ) {
		$shortcodes[] = 'PeliculaCoreMoviesListShortcode';
		
		return $shortcodes;
	}
	
	add_filter( 'pelicula_core_filter_register_shortcodes', 'pelicula_core_add_movies_list_shortcode' );
}

if ( class_exists( 'PeliculaCoreShortcode' ) ) {
	class PeliculaCoreMoviesListShortcode extends PeliculaCoreShortcode {

		public function map_shortcode() {
			$this->set_shortcode_path( PELICULA_CORE_SHORTCODES_URL_PATH . '/movies-list' );
			$this->set_base( 'pelicula_core_movies_list' );
			$this->set_name( esc_html__( 'Movies List', 'pelicula-core' ) );
			$this->set_description( esc_html__( 'Shortcode that adds movies list holder', 'pelicula-core' ) );
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
				'field_type' => 'repeater',
				'name'       => 'children',
				'title'      => esc_html__( 'Child elements', 'pelicula-core' ),
				'items'   => array(
					array(
						'field_type' => 'text',
						'name'       => 'item_year',
						'title'      => esc_html__( 'Year', 'pelicula-core' )
					),
					array(
						'field_type' => 'text',
						'name'       => 'item_year_des',
						'title'      => esc_html__( 'Description', 'pelicula-core' )
					),
					array(
						'field_type' => 'text',
						'name'       => 'item_movies',
						'title'      => esc_html__( 'Movie', 'pelicula-core' )
					),
					array(
						'field_type' => 'text',
						'name'       => 'item_movies_des',
						'title'      => esc_html__( 'Description', 'pelicula-core' )
					)
				)
			) );
		}
		
		public function render( $options, $content = null ) {
			parent::render( $options );
			$atts = $this->get_atts();
			
			$atts['holder_classes'] = $this->get_holder_classes( $atts );
			$atts['items']          = $this->parse_repeater_items( $atts['children'] );

			return pelicula_core_get_template_part( 'shortcodes/movies-list', 'templates/movies-list', '', $atts );
		}
		
		private function get_holder_classes( $atts ) {
			$holder_classes = $this->init_holder_classes();
			
			$holder_classes[] = 'qodef-movies-list';
			$holder_classes[] = ! empty( $atts['skin'] ) ? 'qodef-skin--' . $atts['skin'] : '';
			
			return implode( ' ', $holder_classes );
		}
	}
}