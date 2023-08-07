<?php

if ( ! function_exists( 'pelicula_core_add_instagram_list_widget' ) ) {
	/**
	 * Function that add widget into widgets list for registration
	 *
	 * @param $widgets array
	 *
	 * @return array
	 */
	function pelicula_core_add_instagram_list_widget( $widgets ) {
        if ( qode_framework_is_installed( 'instagram' ) ) {
            $widgets[] = 'PeliculaCoreInstagramListWidget';
        }

		return $widgets;
	}
	
	add_filter( 'pelicula_core_filter_register_widgets', 'pelicula_core_add_instagram_list_widget' );
}

if ( class_exists( 'QodeFrameworkWidget' ) ) {
	class PeliculaCoreInstagramListWidget extends QodeFrameworkWidget {
		
		public function map_widget() {
			$this->set_widget_option(
				array(
					'field_type' => 'text',
					'name'       => 'widget_title',
					'title'      => esc_html__( 'Title', 'pelicula-core' )
				)
			);
			$widget_mapped = $this->import_shortcode_options( array(
				'shortcode_base' => 'pelicula_core_instagram_list'
			) );
			if( $widget_mapped ) {
				$this->set_base( 'pelicula_core_instagram_list' );
				$this->set_name( esc_html__( 'Pelicula Instagram List', 'pelicula-core' ) );
				$this->set_description( esc_html__( 'Add a instagram list element into widget areas', 'pelicula-core' ) );
			}
		}
		
		public function render( $atts ) {
			$params = $this->generate_string_params( $atts );
			
			echo do_shortcode( "[pelicula_core_instagram_list $params]" ); // XSS OK
		}
	}
}