<?php

if ( ! function_exists( 'pelicula_core_add_vertical_sliding_header_options' ) ) {
	function pelicula_core_add_vertical_sliding_header_options( $page, $general_header_tab ) {

		$section = $general_header_tab->add_section_element(
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

		$section->add_field_element(
			array(
				'field_type'    => 'select',
				'name'          => 'qodef_vertical_sliding_menu_icon_source',
				'title'         => esc_html__( 'Icon Source', 'pelicula-core' ),
				'options'       => pelicula_core_get_select_type_options_pool( 'icon_source', false ),
				'default_value' => 'icon_pack'
			)
		);

		$section->add_field_element(
			array(
				'field_type'    => 'select',
				'name'          => 'qodef_vertical_sliding_menu_icon_pack',
				'title'         => esc_html__( 'Icon Pack', 'pelicula-core' ),
				'options'       => qode_framework_icons()->get_icon_packs( array(
					'linea-icons',
					'dripicons',
					'simple-line-icons'
				) ),
				'default_value' => 'elegant-icons',
				'dependency'    => array(
					'show' => array(
						'qodef_vertical_sliding_menu_icon_source' => array(
							'values'        => 'icon_pack',
							'default_value' => 'icon_pack'
						)
					)
				)
			)
		);

		$section_svg_path = $general_header_tab->add_section_element(
			array(
				'title'      => esc_html__( 'SVG Path', 'pelicula-core' ),
				'name'       => 'qodef_vertical_sliding_menu_svg_path_section',
				'dependency' => array(
					'show' => array(
						'qodef_vertical_sliding_menu_icon_source' => array(
							'values'        => 'svg_path',
							'default_value' => 'icon_pack'
						)
					)
				)
			)
		);

		$section_svg_path->add_field_element(
			array(
				'field_type'  => 'textarea',
				'name'        => 'qodef_vertical_sliding_menu_icon_svg_path',
				'title'       => esc_html__( 'Full Screen Menu Open Icon SVG Path', 'pelicula-core' ),
				'description' => esc_html__( 'Enter your full screen menu open icon SVG path here. Please remove version and id attributes from your SVG path because of HTML validation', 'pelicula-core' )
			)
		);

		$section_svg_path->add_field_element(
			array(
				'field_type'  => 'textarea',
				'name'        => 'qodef_vertical_sliding_menu_close_icon_svg_path',
				'title'       => esc_html__( 'Full Screen Menu Close Icon SVG Path', 'pelicula-core' ),
				'description' => esc_html__( 'Enter your full screen menu close icon SVG path here. Please remove version and id attributes from your SVG path because of HTML validation', 'pelicula-core' ),
			)
		);
	}

	add_action( 'pelicula_core_action_after_header_options_map', 'pelicula_core_add_vertical_sliding_header_options', 10, 2 );
}

// if ( ! function_exists( 'pelicula_core_add_vertical_sliding_header_logo_options' ) ) {
// 	function pelicula_core_add_vertical_sliding_header_logo_options( $page, $header_tab ) {

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

// 	add_action( 'pelicula_core_action_after_header_logo_options_map', 'pelicula_core_add_vertical_sliding_header_logo_options', 10, 2 );
// }