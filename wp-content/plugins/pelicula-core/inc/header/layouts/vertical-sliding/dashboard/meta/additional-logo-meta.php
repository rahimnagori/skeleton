<?php

if ( ! function_exists( 'pelicula_core_add_page_additional_logo_meta_box' ) ) {
	/**
	 * Function that add additional options for this module
	 */
	function pelicula_core_add_page_additional_logo_meta_box( $logo_tab ) {

		$header_additional_logo_section = $logo_tab->add_section_element(
			array(
				'name'  => 'qodef_header_additional_logo_section',
				'title' => esc_html__( 'Additional Logo Options', 'pelicula-core' ),
				'dependency' => array(
					'show' => array(
						'qodef_header_layout' => array(
							'values'        => 'vertical-sliding',
							'default_value' => ''
						)
					)
				)
			)
		);

		$header_additional_logo_section->add_field_element(
			array(
				'field_type'  => 'text',
				'name'        => 'qodef_additional_logo_height',
				'title'       => esc_html__( 'Additional Logo Height', 'pelicula-core' ),
				'description' => esc_html__( 'Enter additional logo height', 'pelicula-core' ),
				'args'        => array(
					'suffix' => esc_html__( 'px', 'pelicula-core' )
				)
			)
		);

		$header_additional_logo_section->add_field_element(
			array(
				'field_type'  => 'image',
				'name'        => 'qodef_additional_logo',
				'title'       => esc_html__( 'Additional Logo', 'pelicula-core' ),
				'description' => esc_html__( 'Choose additional logo image', 'pelicula-core' ),
				'multiple'    => 'no'
			)
		);
	}

	add_action( 'pelicula_core_action_after_page_logo_meta_map', 'pelicula_core_add_page_additional_logo_meta_box' );
}