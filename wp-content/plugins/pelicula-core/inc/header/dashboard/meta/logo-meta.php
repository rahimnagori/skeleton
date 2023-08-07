<?php

if ( ! function_exists( 'pelicula_core_add_page_logo_meta_box' ) ) {
	/**
	 * Function that add general options for this module
	 */
	function pelicula_core_add_page_logo_meta_box( $page ) {

		if ( $page ) {

			$logo_tab = $page->add_tab_element(
				array(
					'name'        => 'tab-logo',
					'icon'        => 'fa fa-cog',
					'title'       => esc_html__( 'Logo Settings', 'pelicula-core' ),
					'description' => esc_html__( 'Logo settings', 'pelicula-core' )
				)
			);

			$header_logo_section = $logo_tab->add_section_element(
				array(
					'name'  => 'qodef_header_logo_section',
					'title' => esc_html__( 'Header Logo Options', 'pelicula-core' ),
				)
			);

			$header_logo_section->add_field_element(
				array(
					'field_type'  => 'text',
					'name'        => 'qodef_logo_height',
					'title'       => esc_html__( 'Logo Height', 'pelicula-core' ),
					'description' => esc_html__( 'Enter logo height', 'pelicula-core' ),
					'args'        => array(
						'suffix' => esc_html__( 'px', 'pelicula-core' )
					)
				)
			);

			$header_logo_section->add_field_element(
				array(
					'field_type'  => 'text',
					'name'        => 'qodef_sticky_logo_height',
					'title'       => esc_html__( 'Sticky Logo Height', 'pelicula-core' ),
					'description' => esc_html__( 'Enter sticky logo height', 'pelicula-core' ),
					'args'        => array(
						'suffix' => esc_html__( 'px', 'pelicula-core' )
					)
				)
			);
			
			$header_logo_section->add_field_element(
				array(
					'field_type'    => 'select',
					'name'          => 'qodef_logo_source',
					'title'         => esc_html__( 'Logo Source', 'pelicula-core' ),
					'description'   => esc_html__( 'Select logo type', 'pelicula-core' ),
					'default_value' => '',
					'options'       => array(
						''       => esc_html__( 'Default', 'pelicula-core' ),
						'image'   => esc_html__( 'Image', 'pelicula-core' ),
						'text' => esc_html__( 'Text', 'pelicula-core' ),
					)
				)
			);

			$header_logo_section->add_field_element(
				array(
					'field_type'  => 'image',
					'name'        => 'qodef_logo_main',
					'title'       => esc_html__( 'Logo - Main', 'pelicula-core' ),
					'description' => esc_html__( 'Choose main logo image', 'pelicula-core' ),
					'multiple'    => 'no',
					'dependency' => array(
						'show' => array(
							'qodef_logo_source' => array(
								'values'        => 'image',
								'default_value' => ''
							)
						)
					)
				)
			);

			$header_logo_section->add_field_element(
				array(
					'field_type'  => 'image',
					'name'        => 'qodef_logo_dark',
					'title'       => esc_html__( 'Logo - Dark', 'pelicula-core' ),
					'description' => esc_html__( 'Choose dark logo image', 'pelicula-core' ),
					'multiple'    => 'no',
					'dependency' => array(
						'show' => array(
							'qodef_logo_source' => array(
								'values'        => 'image',
								'default_value' => ''
							)
						)
					)
				)
			);

			$header_logo_section->add_field_element(
				array(
					'field_type'  => 'image',
					'name'        => 'qodef_logo_light',
					'title'       => esc_html__( 'Logo - Light', 'pelicula-core' ),
					'description' => esc_html__( 'Choose light logo image', 'pelicula-core' ),
					'multiple'    => 'no',
					'dependency' => array(
						'show' => array(
							'qodef_logo_source' => array(
								'values'        => 'image',
								'default_value' => ''
							)
						)
					)
				)
			);
			
			$header_logo_section->add_field_element(
				array(
					'field_type'  => 'text',
					'name'        => 'qodef_logo_text',
					'title'       => esc_html__( 'Logo Text', 'pelicula-core' ),
					'description' => esc_html__( 'Enter logo text', 'pelicula-core' ),
					'dependency' => array(
						'show' => array(
							'qodef_logo_source' => array(
								'values'        => 'text',
								'default_value' => ''
							)
						)
					)
				)
			);

			$header_logo_section->add_field_element(
				array(
					'field_type'  => 'text',
					'name'        => 'qodef_logo_text_font_size',
					'title'       => esc_html__( 'Logo Text Font Size', 'pelicula-core' ),
					'description' => esc_html__( 'Enter logo text font size with unit', 'pelicula-core' ),
					'dependency' => array(
						'show' => array(
							'qodef_logo_source' => array(
								'values'        => 'text',
								'default_value' => ''
							)
						)
					)
				)
			);
			
			$header_logo_section->add_field_element(
				array(
					'field_type'  => 'color',
					'name'        => 'qodef_logo_text_color',
					'title'       => esc_html__( 'Logo Text Color', 'pelicula-core' ),
					'description' => esc_html__( 'Enter logo text color', 'pelicula-core' ),
					'dependency' => array(
						'show' => array(
							'qodef_logo_source' => array(
								'values'        => 'text',
								'default_value' => ''
							)
						)
					)
				)
			);

			$header_logo_section->add_field_element(
				array(
					'field_type'  => 'color',
					'name'        => 'qodef_logo_sticky_text_color',
					'title'       => esc_html__( 'Sticky Logo Text Color', 'pelicula-core' ),
					'description' => esc_html__( 'Enter sticky logo text color', 'pelicula-core' ),
					'dependency' => array(
						'show' => array(
							'qodef_logo_source' => array(
								'values'        => 'text',
								'default_value' => ''
							)
						)
					)
				)
			);

			// Hook to include additional options after module options
			do_action( 'pelicula_core_action_after_page_logo_meta_map', $logo_tab );
		}
	}

	add_action( 'pelicula_core_action_after_general_meta_box_map', 'pelicula_core_add_page_logo_meta_box' );
}