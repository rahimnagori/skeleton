<?php

if ( ! function_exists( 'pelicula_core_add_general_page_meta_box' ) ) {
	/**
	 * Function that add general options for this module
	 */
	function pelicula_core_add_general_page_meta_box( $page ) {

		$general_tab = $page->add_tab_element(
			array(
				'name'        => 'tab-page',
				'icon'        => 'fa fa-cog',
				'title'       => esc_html__( 'Page Settings', 'pelicula-core' ),
				'description' => esc_html__( 'General page layout settings', 'pelicula-core' )
			)
		);

		$general_tab->add_field_element(
			array(
				'field_type'  => 'color',
				'name'        => 'qodef_page_background_color',
				'title'       => esc_html__( 'Page Background Color', 'pelicula-core' ),
				'description' => esc_html__( 'Set background color', 'pelicula-core' )
			)
		);

		$general_tab->add_field_element(
			array(
				'field_type'  => 'image',
				'name'        => 'qodef_page_background_image',
				'title'       => esc_html__( 'Page Background Image', 'pelicula-core' ),
				'description' => esc_html__( 'Set background image', 'pelicula-core' )
			)
		);

		$general_tab->add_field_element(
			array(
				'field_type'  => 'select',
				'name'        => 'qodef_page_background_repeat',
				'title'       => esc_html__( 'Page Background Image Repeat', 'pelicula-core' ),
				'description' => esc_html__( 'Set background image repeat', 'pelicula-core' ),
				'options'     => array(
					''          => esc_html__( 'Default', 'pelicula-core' ),
					'no-repeat' => esc_html__( 'No Repeat', 'pelicula-core' ),
					'repeat'    => esc_html__( 'Repeat', 'pelicula-core' ),
					'repeat-x'  => esc_html__( 'Repeat-x', 'pelicula-core' ),
					'repeat-y'  => esc_html__( 'Repeat-y', 'pelicula-core' )
				)
			)
		);

		$general_tab->add_field_element(
			array(
				'field_type'  => 'select',
				'name'        => 'qodef_page_background_size',
				'title'       => esc_html__( 'Page Background Image Size', 'pelicula-core' ),
				'description' => esc_html__( 'Set background image size', 'pelicula-core' ),
				'options'     => array(
					''        => esc_html__( 'Default', 'pelicula-core' ),
					'contain' => esc_html__( 'Contain', 'pelicula-core' ),
					'cover'   => esc_html__( 'Cover', 'pelicula-core' )
				)
			)
		);

		$general_tab->add_field_element(
			array(
				'field_type'  => 'select',
				'name'        => 'qodef_page_background_attachment',
				'title'       => esc_html__( 'Page Background Image Attachment', 'pelicula-core' ),
				'description' => esc_html__( 'Set background image attachment', 'pelicula-core' ),
				'options'     => array(
					''       => esc_html__( 'Default', 'pelicula-core' ),
					'fixed'  => esc_html__( 'Fixed', 'pelicula-core' ),
					'scroll' => esc_html__( 'Scroll', 'pelicula-core' )
				)
			)
		);

		$general_tab->add_field_element(
			array(
				'field_type'  => 'text',
				'name'        => 'qodef_page_content_padding',
				'title'       => esc_html__( 'Page Content Padding', 'pelicula-core' ),
				'description' => esc_html__( 'Set padding that will be applied for page content in format: top right bottom left (e.g. 10px 5px 10px 5px)', 'pelicula-core' )
			)
		);

		$general_tab->add_field_element(
			array(
				'field_type'  => 'text',
				'name'        => 'qodef_page_content_padding_mobile',
				'title'       => esc_html__( 'Page Content Padding Mobile', 'pelicula-core' ),
				'description' => esc_html__( 'Set padding that will be applied for page content on mobile screens (1024px and below) in format: top right bottom left (e.g. 10px 5px 10px 5px)', 'pelicula-core' )
			)
		);

		$general_tab->add_field_element(
			array(
				'field_type'    => 'select',
				'name'          => 'qodef_boxed',
				'title'         => esc_html__( 'Boxed Layout', 'pelicula-core' ),
				'description'   => esc_html__( 'Set boxed layout', 'pelicula-core' ),
				'default_value' => '',
				'options'       => pelicula_core_get_select_type_options_pool( 'yes_no' )
			)
		);

		$boxed_section = $general_tab->add_section_element(
			array(
				'name'       => 'qodef_boxed_section',
				'title'      => esc_html__( 'Boxed Layout Section', 'pelicula-core' ),
				'dependency' => array(
					'hide' => array(
						'qodef_boxed' => array(
							'values'        => 'no',
							'default_value' => ''
						)
					)
				)
			)
		);

		$boxed_section->add_field_element(
			array(
				'field_type'  => 'color',
				'name'        => 'qodef_boxed_background_color',
				'title'       => esc_html__( 'Boxed Background Color', 'pelicula-core' ),
				'description' => esc_html__( 'Set boxed background color', 'pelicula-core' )
			)
		);

		$general_tab->add_field_element(
			array(
				'field_type'    => 'select',
				'name'          => 'qodef_passepartout',
				'title'         => esc_html__( 'Passepartout', 'pelicula-core' ),
				'description'   => esc_html__( 'Enabling this option will display a passepartout around website content', 'pelicula-core' ),
				'default_value' => '',
				'options'       => pelicula_core_get_select_type_options_pool( 'yes_no' )
			)
		);

		$passepartout_section = $general_tab->add_section_element(
			array(
				'name'       => 'qodef_passepartout_section',
				'dependency' => array(
					'hide' => array(
						'qodef_passepartout' => array(
							'values'        => 'no',
							'default_value' => ''
						)
					)
				)
			)
		);

		$passepartout_section->add_field_element(
			array(
				'field_type'  => 'color',
				'name'        => 'qodef_passepartout_color',
				'title'       => esc_html__( 'Passepartout Color', 'pelicula-core' ),
				'description' => esc_html__( 'Choose background color for passepartout', 'pelicula-core' )
			)
		);

		$passepartout_section->add_field_element(
			array(
				'field_type'  => 'image',
				'name'        => 'qodef_passepartout_image',
				'title'       => esc_html__( 'Passepartout Background Image', 'pelicula-core' ),
				'description' => esc_html__( 'Set background image for passepartout', 'pelicula-core' )
			)
		);

		$passepartout_section->add_field_element(
			array(
				'field_type'  => 'text',
				'name'        => 'qodef_passepartout_size',
				'title'       => esc_html__( 'Passepartout Size', 'pelicula-core' ),
				'description' => esc_html__( 'Enter size amount for passepartout', 'pelicula-core' ),
				'args'        => array(
					'suffix' => esc_html__( 'px or %', 'pelicula-core' )
				)
			)
		);

		$passepartout_section->add_field_element(
			array(
				'field_type'  => 'text',
				'name'        => 'qodef_passepartout_size_responsive',
				'title'       => esc_html__( 'Passepartout Responsive Size', 'pelicula-core' ),
				'description' => esc_html__( 'Enter size amount for passepartout for smaller screens (1024px and below)', 'pelicula-core' ),
				'args'        => array(
					'suffix' => esc_html__( 'px or %', 'pelicula-core' )
				)
			)
		);

		$general_tab->add_field_element(
			array(
				'field_type'  => 'select',
				'name'        => 'qodef_content_width',
				'title'       => esc_html__( 'Initial Width of Content', 'pelicula-core' ),
				'description' => esc_html__( 'Choose the initial width of content which is in grid (applies to pages set to "Default Template" and rows set to "In Grid")', 'pelicula-core' ),
				'options'     => pelicula_core_get_select_type_options_pool( 'content_width' )
			)
		);

		$general_tab->add_field_element(
			array(
				'field_type'  => 'select',
				'name'        => 'qodef_content_lines',
				'title'       => esc_html__( 'Display lines in content background', 'pelicula-core' ),
				'description' => esc_html__( 'Enabling this option will display vertical lines in website content background', 'pelicula-core' ),
				'options'     => pelicula_core_get_select_type_options_pool( 'yes_no' )
			)
		);

		$general_tab->add_field_element(
			array(
				'field_type'  => 'select',
				'name'        => 'qodef_content_center_line',
				'title'       => esc_html__( 'Display additional center line', 'pelicula-core' ),
				'description' => esc_html__( 'Enabling this option will display additional vertical line in the center of website content background', 'pelicula-core' ),
				'options'     => pelicula_core_get_select_type_options_pool( 'yes_no' ),
				'dependency'  => array(
					'show' => array(
						'qodef_content_lines' => array(
							'values'        => 'yes',
							'default_value' => 'no'
						)
					)
				)
			)
		);

		$general_tab->add_field_element(
			array(
				'field_type'  => 'select',
				'name'        => 'qodef_content_lines_in_grid',
				'title'       => esc_html__( 'Display lines in grid layout', 'pelicula-core' ),
				'description' => esc_html__( 'Enabling this option will place content background lines in grid', 'pelicula-core' ),
				'options'     => pelicula_core_get_select_type_options_pool( 'yes_no' ),
				'dependency'  => array(
					'show' => array(
						'qodef_content_lines' => array(
							'values'        => 'yes',
							'default_value' => 'no'
						)
					)
				)
			)
		);

		$general_tab->add_field_element(
			array(
				'field_type'  => 'select',
				'name'        => 'qodef_content_lines_in_grid_type',
				'title'       => esc_html__( 'Display lines type', 'pelicula-core' ),
				'description' => esc_html__( 'Selecting this option will change content background lines type in grid layout', 'pelicula-core' ),
				'options'     => array(
					''     => esc_html__( 'Default', 'pelicula-core' ),
					'wide' => esc_html__( 'Wide', 'pelicula-core' )
				),
				'dependency'  => array(
					'show' => array(
						'qodef_content_lines_in_grid' => array(
							'values'        => 'yes',
							'default_value' => 'no'
						)
					)
				)
			)
		);

		$general_tab->add_field_element(
			array(
				'field_type'  => 'select',
				'name'        => 'qodef_content_lines_skin',
				'title'       => esc_html__( 'Lines Skin', 'pelicula-core' ),
				'description' => esc_html__( 'Choose a predefined style for line elements', 'pelicula-core' ),
				'options'     => array(
					''      => esc_html__( 'Default', 'pelicula-core' ),
					'dark'  => esc_html__( 'Dark', 'pelicula-core' ),
					'light' => esc_html__( 'Light', 'pelicula-core' )
				),
				'dependency' => array(
					'show' => array(
						'qodef_content_lines' => array(
							'values'        => 'yes',
							'default_value' => 'no'
						)
					)
				)
			)
		);

		$general_tab->add_field_element( array(
			'field_type'    => 'yesno',
			'default_value' => 'no',
			'name'          => 'qodef_content_behind_header',
			'title'         => esc_html__( 'Always put content behind header', 'pelicula-core' ),
			'description'   => esc_html__( 'Enabling this option will put page content behind page header', 'pelicula-core' ),
		) );

		// Hook to include additional options after module options
		do_action( 'pelicula_core_action_after_general_page_meta_box_map', $general_tab );
	}

	add_action( 'pelicula_core_action_after_general_meta_box_map', 'pelicula_core_add_general_page_meta_box', 9 );
	add_action( 'pelicula_core_action_after_portfolio_meta_box_map', 'pelicula_core_add_general_page_meta_box' );
}