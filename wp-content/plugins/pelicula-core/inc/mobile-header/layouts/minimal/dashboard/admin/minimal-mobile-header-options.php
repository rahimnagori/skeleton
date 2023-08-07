<?php

if ( ! function_exists( 'pelicula_core_add_minimal_mobile_header_options' ) ) {
	function pelicula_core_add_minimal_mobile_header_options( $page ) {
		
		$section = $page->add_section_element(
			array(
				'name'       => 'qodef_minimal_mobile_header_section',
				'title'      => esc_html__( 'Minimal Mobile Header', 'pelicula-core' ),
				'dependency' => array(
					'show' => array(
						'qodef_mobile_header_layout' => array(
							'values' => 'minimal',
							'default_value' => ''
						)
					)
				)
			)
		);
		
		$section->add_field_element(
			array(
				'field_type'  => 'text',
				'name'        => 'qodef_minimal_mobile_header_height',
				'title'       => esc_html__( 'Minimal Height', 'pelicula-core' ),
				'description' => esc_html__( 'Enter header height', 'pelicula-core' ),
				'args'        => array(
					'suffix' => esc_html__( 'px', 'pelicula-core' )
				)
			)
		);
		
		$section->add_field_element(
			array(
				'field_type'  => 'color',
				'name'        => 'qodef_minimal_mobile_header_background_color',
				'title'       => esc_html__( 'Header Background Color', 'pelicula-core' ),
				'description' => esc_html__( 'Enter header background color', 'pelicula-core' ),
				'args'        => array(
					'suffix' => esc_html__( 'px', 'pelicula-core' )
				)
			)
		);
	}
	
	add_action( 'pelicula_core_action_after_mobile_header_options_map', 'pelicula_core_add_minimal_mobile_header_options' );
}