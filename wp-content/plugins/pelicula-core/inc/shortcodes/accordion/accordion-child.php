<?php

if ( ! function_exists( 'pelicula_core_add_accordion_child_shortcode' ) ) {
	/**
	 * Function that add shortcode into shortcodes list for registration
	 *
	 * @param $shortcodes array
	 *
	 * @return array
	 */
	function pelicula_core_add_accordion_child_shortcode( $shortcodes ) {
		$shortcodes[] = 'PeliculaCoreAccordionChildShortcode';
		
		return $shortcodes;
	}
	
	add_filter( 'pelicula_core_filter_register_shortcodes', 'pelicula_core_add_accordion_child_shortcode' );
}

if ( class_exists( 'PeliculaCoreShortcode' ) ) {
	class PeliculaCoreAccordionChildShortcode extends PeliculaCoreShortcode {
		
		public function map_shortcode() {
			$this->set_shortcode_path( PELICULA_CORE_SHORTCODES_URL_PATH . '/accordion' );
			$this->set_base( 'pelicula_core_accordion_child' );
			$this->set_name( esc_html__( 'Accordion Child', 'pelicula-core' ) );
			$this->set_description( esc_html__( 'Shortcode that adds accordion child to accordion holder', 'pelicula-core' ) );
			$this->set_category( esc_html__( 'Pelicula Core', 'pelicula-core' ) );
			$this->set_is_child_shortcode( true );
			$this->set_parent_elements( array(
				'pelicula_core_accordion'
			) );
			$this->set_is_parent_shortcode( true );
			$this->set_option( array(
				'field_type' => 'text',
				'name'       => 'title',
				'title'      => esc_html__( 'Title', 'pelicula-core' ),
			) );
			$this->set_option( array(
				'field_type'    => 'select',
				'name'          => 'title_tag',
				'title'         => esc_html__( 'Title Tag', 'pelicula-core' ),
				'options'       => pelicula_core_get_select_type_options_pool( 'title_tag' ),
				'default_value' => 'h5'
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
			$atts['content'] = $content;

			return pelicula_core_get_template_part( 'shortcodes/accordion', 'variations/'.$atts['layout'].'/templates/child', '', $atts );
		}
	}
}