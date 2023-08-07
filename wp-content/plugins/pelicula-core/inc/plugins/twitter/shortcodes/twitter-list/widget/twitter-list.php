<?php

if ( ! function_exists( 'pelicula_core_add_twitter_list_widget' ) ) {
	/**
	 * Function that add widget into widgets list for registration
	 *
	 * @param $widgets array
	 *
	 * @return array
	 */
	function pelicula_core_add_twitter_list_widget( $widgets ) {
        if ( qode_framework_is_installed( 'twitter' ) ) {
            $widgets[] = 'PeliculaCoreTwitterListWidget';
        }

		return $widgets;
	}
	
	add_filter( 'pelicula_core_filter_register_widgets', 'pelicula_core_add_twitter_list_widget' );
}

if ( class_exists( 'QodeFrameworkWidget' ) ) {
	class PeliculaCoreTwitterListWidget extends QodeFrameworkWidget {
		
		public function map_widget() {
			$this->set_widget_option(
				array(
					'name'       => 'widget_title',
					'field_type' => 'text',
					'title'      => esc_html__( 'Title', 'pelicula-core' )
				)
			);
			$widget_mapped = $this->import_shortcode_options( array(
				'shortcode_base' => 'pelicula_core_twitter_list'
			) );
			if( $widget_mapped ) {
				$this->set_base( 'pelicula_core_twitter_list' );
				$this->set_name( esc_html__( 'Pelicula Twitter List', 'pelicula-core' ) );
				$this->set_description( esc_html__( 'Add a twitter list element into widget areas', 'pelicula-core' ) );
			}
		}
		
		public function render( $atts ) {
			$params = $this->generate_string_params( $atts );
			
			echo do_shortcode( "[pelicula_core_twitter_list $params]" ); // XSS OK
		}
	}
}