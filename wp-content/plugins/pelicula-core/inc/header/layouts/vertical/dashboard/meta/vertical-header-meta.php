<?php

if ( ! function_exists( 'pelicula_core_add_vertical_header_meta' ) ) {
	function pelicula_core_add_vertical_header_meta( $page ) {

		$section = $page->add_section_element(
			array(
				'name'       => 'qodef_vertical_header_section',
				'title'      => esc_html__( 'Vertical Header', 'pelicula-core' ),
				'dependency' => array(
					'show' => array(
						'qodef_header_layout' => array(
							'values' => 'vertical',
							'default_value' => ''
						)
					)
				)
			)
		);

		$section->add_field_element(
			array(
				'field_type'  => 'text',
				'name'        => 'qodef_vertical_header_padding_top',
				'title'       => esc_html__( 'Header Top Padding', 'pelicula-core' ),
				'description' => esc_html__( 'Set top padding that will be applied to header', 'pelicula-core' ),
				'args'        => array(
					'suffix' => esc_html__( 'px or %', 'pelicula-core' )
				)
			)
		);

		$section->add_field_element(
			array(
				'field_type'  => 'text',
				'name'        => 'qodef_vertical_header_padding_bottom',
				'title'       => esc_html__( 'Header Bottom Padding', 'pelicula-core' ),
				'description' => esc_html__( 'Set bottom padding that will be applied to header', 'pelicula-core' ),
				'args'        => array(
					'suffix' => esc_html__( 'px or %', 'pelicula-core' )
				)
			)
		);

		$section->add_field_element(
			array(
				'field_type'  => 'color',
				'name'        => 'qodef_vertical_header_background_color',
				'title'       => esc_html__( 'Header Background Color', 'pelicula-core' ),
				'description' => esc_html__( 'Enter header background color', 'pelicula-core' )
			)
		);

		$section->add_field_element(
			array(
				'field_type'  => 'color',
				'name'        => 'qodef_vertical_header_border_color',
				'title'       => esc_html__( 'Header Border Color', 'pelicula-core' ),
				'description' => esc_html__( 'Enter header border color', 'pelicula-core' )
			)
		);

	}
	
	add_action( 'pelicula_core_action_after_page_header_meta_map', 'pelicula_core_add_vertical_header_meta' );
}