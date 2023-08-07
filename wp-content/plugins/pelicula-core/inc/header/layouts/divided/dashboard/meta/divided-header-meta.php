<?php

if ( ! function_exists( 'pelicula_core_add_divided_header_meta' ) ) {
	function pelicula_core_add_divided_header_meta( $page ) {
		
		$section = $page->add_section_element(
			array(
				'name'       => 'qodef_divided_header_section',
				'title'      => esc_html__( 'Divided Header', 'pelicula-core' ),
				'dependency' => array(
					'show' => array(
						'qodef_header_layout' => array(
							'values' => 'divided',
							'default_value' => ''
						)
					)
				)
			)
		);
		
		$section->add_field_element(
			array(
				'field_type'  => 'text',
				'name'        => 'qodef_divided_header_height',
				'title'       => esc_html__( 'Header Height', 'pelicula-core' ),
				'description' => esc_html__( 'Enter header height', 'pelicula-core' ),
				'args'        => array(
					'suffix' => esc_html__( 'px', 'pelicula-core' )
				)
			)
		);
		
		$section->add_field_element(
			array(
				'field_type'  => 'text',
				'name'        => 'qodef_divided_header_side_padding',
				'title'       => esc_html__( 'Header Side Padding', 'pelicula-core' ),
				'description' => esc_html__( 'Enter side padding for header area', 'pelicula-core' ),
				'args'        => array(
					'suffix' => esc_html__( 'px or %', 'pelicula-core' )
				)
			)
		);
		
		$section->add_field_element(
			array(
				'field_type'  => 'color',
				'name'        => 'qodef_divided_header_background_color',
				'title'       => esc_html__( 'Header Background Color', 'pelicula-core' ),
				'description' => esc_html__( 'Enter header background color', 'pelicula-core' )
			)
		);

		$section->add_field_element(
			array(
				'field_type'  => 'color',
				'name'        => 'qodef_divided_header_border_color',
				'title'       => esc_html__( 'Header Border Color', 'pelicula-core' ),
				'description' => esc_html__( 'Enter header border color', 'pelicula-core' )
			)
		);

	}
	
	add_action( 'pelicula_core_action_after_page_header_meta_map', 'pelicula_core_add_divided_header_meta' );
}