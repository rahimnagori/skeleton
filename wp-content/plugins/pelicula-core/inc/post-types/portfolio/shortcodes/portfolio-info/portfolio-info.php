<?php

if ( ! function_exists( 'pelicula_core_add_portfolio_info_shortcode' ) ) {
	/**
	 * Function that isadding shortcode into shortcodes list for registration
	 *
	 * @param array $shortcodes - Array of registered shortcodes
	 *
	 * @return array
	 */
	function pelicula_core_add_portfolio_info_shortcode( $shortcodes ) {
		$shortcodes[] = 'PeliculaCorePortfolioInfoShortcode';
		
		return $shortcodes;
	}
	
	add_filter( 'pelicula_core_filter_register_shortcodes', 'pelicula_core_add_portfolio_info_shortcode' );
}

if ( class_exists( 'QodeFrameworkShortcode' ) ) {
	class PeliculaCorePortfolioInfoShortcode extends QodeFrameworkShortcode {
		
		public function __construct() {
			parent::__construct();
		}
		
		public function map_shortcode() {
			$this->set_shortcode_path( PELICULA_CORE_CPT_URL_PATH . '/portfolio/shortcodes/portfolio-info' );
			$this->set_base( 'pelicula_core_portfolio_info' );
			$this->set_name( esc_html__( 'Portfolio Info', 'pelicula-core' ) );
			$this->set_description( esc_html__( 'Shortcode that displays portfolio info', 'pelicula-core' ) );
			$this->set_category( esc_html__( 'Pelicula Core', 'pelicula-core' ) );

			$this->set_option( array(
				'field_type' => 'text',
				'name'       => 'custom_class',
				'title'      => esc_html__( 'Custom Class', 'pelicula-core' )
			) );
			$this->set_option( array(
				'field_type' => 'select',
				'name'       => 'skin',
				'title'      => esc_html__( 'Skin', 'pelicula-core' ),
				'options'    => array(
					''      => esc_html__( 'Default', 'pelicula-core' ),
					'light' => esc_html__( 'Light', 'pelicula-core' )
				),
			) );
			$this->set_option( array(
				'field_type'  => 'text',
				'name'        => 'portfolio_id',
				'title'       => esc_html__( 'Portfolio ID', 'pelicula-core' ),
			) );
		}
		
		public static function call_shortcode( $params ) {
			$html = qode_framework_call_shortcode( 'pelicula_core_portfolio_info', $params );
			$html = str_replace( "\n", '', $html );
			
			return $html;
		}

		public function render( $options, $content = null ) {
			parent::render( $options );
			
			$atts = $this->get_atts();

			$atts['portfolio_id'] = intval( $atts['portfolio_id'] );
			if ( $atts['portfolio_id'] <= 0 ) {
				$atts['portfolio_id'] = get_the_ID();
			}

			$atts['holder_classes'] = $this->get_holder_classes( $atts );

			return pelicula_core_get_template_part( 'post-types/portfolio/shortcodes/portfolio-info', 'templates/portfolio-info', '', $atts );
		}
		
		private function get_holder_classes( $atts ) {
			$holder_classes = $this->init_holder_classes();
			
			$holder_classes[] = 'qodef-portfolio-info';
			$holder_classes[] = isset( $atts['skin'] ) && ! empty( $atts['skin'] ) ? 'qodef-skin--' . $atts['skin'] : '';

			return implode( ' ', $holder_classes );
		}
	}
}