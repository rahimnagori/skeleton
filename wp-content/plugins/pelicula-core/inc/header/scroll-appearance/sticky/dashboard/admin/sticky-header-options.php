<?php

if ( ! function_exists( 'pelicula_core_add_sticky_header_options' ) ) {
	function pelicula_core_add_sticky_header_options( $page, $section ) {
		
		$section->add_field_element(
			array(
				'field_type'  => 'text',
				'name'        => 'qodef_sticky_header_scroll_amount',
				'title'       => esc_html__( 'Sticky Scroll Amount', 'pelicula-core' ),
				'description' => esc_html__( 'Enter scroll amount for sticky header to appear', 'pelicula-core' ),
				'args'        => array(
					'suffix' => esc_html__( 'px', 'pelicula-core' )
				),
				'dependency'  => array(
					'show' => array(
						'qodef_header_scroll_appearance' => array(
							'values'        => 'sticky',
							'default_value' => ''
						)
					)
				)
			)
		);
		
		$section->add_field_element(
			array(
				'field_type'  => 'text',
				'name'        => 'qodef_sticky_header_side_padding',
				'title'       => esc_html__( 'Sticky Header Side Padding', 'pelicula-core' ),
				'description' => esc_html__( 'Enter side padding for sticky header area', 'pelicula-core' ),
				'args'        => array(
					'suffix' => esc_html__( 'px or %', 'pelicula-core' )
				),
				'dependency'  => array(
					'show' => array(
						'qodef_header_scroll_appearance' => array(
							'values'        => 'sticky',
							'default_value' => ''
						)
					)
				)
			)
		);
		
		$section->add_field_element(
			array(
				'field_type'  => 'color',
				'name'        => 'qodef_sticky_header_background_color',
				'title'       => esc_html__( 'Sticky Header Background Color', 'pelicula-core' ),
				'description' => esc_html__( 'Enter sticky header background color', 'pelicula-core' ),
				'dependency'  => array(
					'show' => array(
						'qodef_header_scroll_appearance' => array(
							'values'        => 'sticky',
							'default_value' => ''
						)
					)
				)
			)
		);
	}
	
	add_action( 'pelicula_core_action_after_header_scroll_appearance_options_map', 'pelicula_core_add_sticky_header_options', 10, 2 );
}