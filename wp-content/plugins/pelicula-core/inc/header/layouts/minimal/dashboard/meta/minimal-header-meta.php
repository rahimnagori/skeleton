<?php

if ( ! function_exists( 'pelicula_core_add_minimal_header_meta' ) ) {
	function pelicula_core_add_minimal_header_meta( $page ) {
		
		$section = $page->add_section_element(
			array(
				'name'       => 'qodef_minimal_header_section',
				'title'      => esc_html__( 'Minimal Header', 'pelicula-core' ),
				'dependency' => array(
					'show' => array(
						'qodef_header_layout' => array(
							'values' => 'minimal',
							'default_value' => ''
						)
					)
				)
			)
		);
		
		$section->add_field_element(
			array(
				'field_type'  => 'select',
				'name'        => 'qodef_minimal_header_in_grid',
				'title'       => esc_html__( 'Content in Grid', 'pelicula-core' ),
				'description' => esc_html__( 'Set content to be in grid', 'pelicula-core' ),
				'default_value' => '',
				'options'       => pelicula_core_get_select_type_options_pool( 'no_yes' )
			)
		);
		
		$section->add_field_element(
			array(
				'field_type'  => 'text',
				'name'        => 'qodef_minimal_header_height',
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
				'name'        => 'qodef_minimal_header_side_padding',
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
				'name'        => 'qodef_minimal_header_background_color',
				'title'       => esc_html__( 'Header Background Color', 'pelicula-core' ),
				'description' => esc_html__( 'Enter header background color', 'pelicula-core' )
			)
		);

		$section->add_field_element(
			array(
				'field_type'  => 'color',
				'name'        => 'qodef_minimal_header_border_color',
				'title'       => esc_html__( 'Header Border Color', 'pelicula-core' ),
				'description' => esc_html__( 'Enter header border color', 'pelicula-core' )
			)
		);

	}
	
	add_action( 'pelicula_core_action_after_page_header_meta_map', 'pelicula_core_add_minimal_header_meta' );
}