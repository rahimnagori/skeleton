<?php

if ( ! function_exists( 'pelicula_core_add_tabs_child_shortcode' ) ) {
	/**
	 * Function that add shortcode into shortcodes list for registration
	 *
	 * @param $shortcodes array
	 *
	 * @return array
	 */
	function pelicula_core_add_tabs_child_shortcode( $shortcodes ) {
		$shortcodes[] = 'PeliculaCoreTabsChildShortcode';
		
		return $shortcodes;
	}
	
	add_filter( 'pelicula_core_filter_register_shortcodes', 'pelicula_core_add_tabs_child_shortcode' );
}

if ( class_exists( 'PeliculaCoreShortcode' ) ) {
	class PeliculaCoreTabsChildShortcode extends PeliculaCoreShortcode {
		
		public function map_shortcode() {
			$this->set_shortcode_path( PELICULA_CORE_SHORTCODES_URL_PATH . '/tabs' );
			$this->set_base( 'pelicula_core_tabs_child' );
			$this->set_name( esc_html__( 'Tabs Child', 'pelicula-core' ) );
			$this->set_description( esc_html__( 'Shortcode that adds tab child to tabs holder', 'pelicula-core' ) );
			$this->set_category( esc_html__( 'Pelicula Core', 'pelicula-core' ) );
			$this->set_is_child_shortcode( true );
			$this->set_parent_elements( array(
				'pelicula_core_tabs'
			) );
			$this->set_is_parent_shortcode( true );
			$this->set_option( array(
				'field_type' => 'text',
				'name'       => 'tab_title',
				'title'      => esc_html__( 'Title', 'pelicula-core' ),
			) );
			$this->set_option( array(
				'field_type'    => 'text',
				'name'          => 'layout',
				'title'         => esc_html__( 'Layout', 'pelicula-core' ),
				'default_value' => '',
				'visibility'    => array('map_for_page_builder' => false)
			) );
		}
		
		public function render( $options, $content = null ) {
			parent::render( $options );
			$atts = $this->get_atts();
			
			$rand_number       = rand( 0, 1000 );
			$atts['tab_title'] = $atts['tab_title'] . '-' . $rand_number;
			$atts['content']   = $content;

			return pelicula_core_get_template_part( 'shortcodes/tabs', 'variations/'.$atts['layout'].'/templates/child', '', $atts );
		}
	}
}