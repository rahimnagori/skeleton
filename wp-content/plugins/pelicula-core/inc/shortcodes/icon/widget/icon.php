<?php

if ( ! function_exists( 'pelicula_core_add_icon_widget' ) ) {
	/**
	 * Function that add widget into widgets list for registration
	 *
	 * @param $widgets array
	 *
	 * @return array
	 */
	function pelicula_core_add_icon_widget( $widgets ) {
		$widgets[] = 'PeliculaCoreIconWidget';
		
		return $widgets;
	}
	
	add_filter( 'pelicula_core_filter_register_widgets', 'pelicula_core_add_icon_widget' );
}

if ( class_exists( 'QodeFrameworkWidget' ) ) {
	class PeliculaCoreIconWidget extends QodeFrameworkWidget {
		
		public function map_widget() {
			$widget_mapped = $this->import_shortcode_options( array(
				'shortcode_base' => 'pelicula_core_icon'
			) );
			if( $widget_mapped ) {
				$this->set_base( 'pelicula_core_icon' );
				$this->set_name( esc_html__( 'Pelicula Icon', 'pelicula-core' ) );
				$this->set_description( esc_html__( 'Add a icon element into widget areas', 'pelicula-core' ) );
			}
		}
		
		public function render( $atts ) {
			
			$params = $this->generate_string_params( $atts );
			
			echo do_shortcode( "[pelicula_core_icon $params]" ); // XSS OK
		}
	}
}
