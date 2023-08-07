<?php

if ( ! function_exists( 'pelicula_core_add_vertical_sliding_header_meta' ) ) {
	function pelicula_core_add_vertical_sliding_header_meta( $page ) {

		$section = $page->add_section_element(
			array(
				'name'       => 'qodef_vertical_sliding_header_section',
				'title'      => esc_html__( 'Vertical Sliding Header', 'pelicula-core' ),
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

		$section->add_field_element(
			array(
				'field_type'  => 'text',
				'name'        => 'qodef_vertical_sliding_header_padding_top',
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
				'name'        => 'qodef_vertical_sliding_header_padding_bottom',
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
				'name'        => 'qodef_vertical_sliding_header_background_color',
				'title'       => esc_html__( 'Header Background Color', 'pelicula-core' ),
				'description' => esc_html__( 'Enter header background color', 'pelicula-core' )
			)
		);

		$section->add_field_element(
			array(
				'field_type'  => 'color',
				'name'        => 'qodef_vertical_sliding_header_border_color',
				'title'       => esc_html__( 'Header Border Color', 'pelicula-core' ),
				'description' => esc_html__( 'Enter header border color', 'pelicula-core' )
			)
		);
	}

	add_action( 'pelicula_core_action_after_page_header_meta_map', 'pelicula_core_add_vertical_sliding_header_meta' );
}

// if ( ! function_exists( 'pelicula_core_add_vertical_sliding_header_logo_meta_options' ) ) {
// 	function pelicula_core_add_vertical_sliding_header_logo_meta_options( $page, $header_tab ) {

// 		if ( $header_tab ) {
// 			$header_tab->add_field_element(
// 				array(
// 					'field_type'  => 'image',
// 					'name'        => 'qodef_logo_vertical_sliding',
// 					'title'       => esc_html__( 'Logo - Vertical Sliding', 'pelicula-core' ),
// 					'description' => esc_html__( 'Choose vertical sliding area logo image', 'pelicula-core' ),
// 					'multiple'    => 'no'
// 				)
// 			);
// 		}
// 	}

// 	add_action( 'pelicula_core_action_after_page_logo_meta_map', 'pelicula_core_add_vertical_sliding_header_logo_meta_options', 10, 2 );
// }