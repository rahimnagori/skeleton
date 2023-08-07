<?php

if ( ! function_exists( 'pelicula_core_add_social_share_widget' ) ) {
	/**
	 * Function that add widget into widgets list for registration
	 *
	 * @param $widgets array
	 *
	 * @return array
	 */
	function pelicula_core_add_social_share_widget( $widgets ) {
		$widgets[] = 'PeliculaCoreSocialShareWidget';
		
		return $widgets;
	}
	
	add_filter( 'pelicula_core_filter_register_widgets', 'pelicula_core_add_social_share_widget' );
}

if ( class_exists( 'QodeFrameworkWidget' ) ) {
	class PeliculaCoreSocialShareWidget extends QodeFrameworkWidget {
		
		public function map_widget() {
			$widget_mapped = $this->import_shortcode_options( array(
				'shortcode_base' => 'pelicula_core_social_share'
			) );
			if( $widget_mapped ) {
				$this->set_base( 'pelicula_core_social_share' );
				$this->set_name( esc_html__( 'Pelicula Social Share', 'pelicula-core' ) );
				$this->set_description( esc_html__( 'Add a social share element into widget areas', 'pelicula-core' ) );
			}
		}
		
		public function render( $atts ) {
			$params = $this->generate_string_params( $atts );
			
			echo do_shortcode( "[pelicula_core_social_share $params]" ); // XSS OK
		}
	}
}