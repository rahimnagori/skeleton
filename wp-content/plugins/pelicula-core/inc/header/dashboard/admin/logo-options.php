<?php

if ( ! function_exists( 'pelicula_core_add_logo_options' ) ) {
	function pelicula_core_add_logo_options() {
		$qode_framework = qode_framework_get_framework_root();

		$page = $qode_framework->add_options_page(
			array(
				'scope'       => PELICULA_CORE_OPTIONS_NAME,
				'type'        => 'admin',
				'slug'        => 'logo',
				'icon'        => 'fa fa-cog',
				'title'       => esc_html__( 'Logo', 'pelicula-core' ),
				'description' => esc_html__( 'Global Logo Options', 'pelicula-core' ),
				'layout'      => 'tabbed'
			)
		);

		if ( $page ) {

			$header_tab = $page->add_tab_element(
				array(
					'name'        => 'tab-header',
					'icon'        => 'fa fa-cog',
					'title'       => esc_html__( 'Header Logo Options', 'pelicula-core' ),
					'description' => esc_html__( 'Set options for initial headers', 'pelicula-core' )
				)
			);

			$header_tab->add_field_element(
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

			$header_tab->add_field_element(
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
			
			$header_tab->add_field_element(
				array(
					'field_type'    => 'select',
					'name'          => 'qodef_logo_source',
					'title'         => esc_html__( 'Logo Source', 'pelicula-core' ),
					'description'   => esc_html__( 'Select logo type', 'pelicula-core' ),
					'default_value' => 'image',
					'options'       => array(
						'image' => esc_html__( 'Image', 'pelicula-core' ),
						'text'  => esc_html__( 'Text', 'pelicula-core' ),
					),
				)
			);

			$header_tab->add_field_element(
				array(
					'field_type'    => 'image',
					'name'          => 'qodef_logo_main',
					'title'         => esc_html__( 'Logo - Main', 'pelicula-core' ),
					'description'   => esc_html__( 'Choose main logo image', 'pelicula-core' ),
					'default_value' => defined( 'PELICULA_ASSETS_ROOT' ) ? PELICULA_ASSETS_ROOT . '/img/logo.png' : '',
					'multiple'      => 'no',
					'dependency'  => array(
						'show'    => array(
							'qodef_logo_source' => array(
								'values'        => 'image',
								'default_value' => 'image'
							)
						)
					)
				)
			);

			$header_tab->add_field_element(
				array(
					'field_type'  => 'image',
					'name'        => 'qodef_logo_dark',
					'title'       => esc_html__( 'Logo - Dark', 'pelicula-core' ),
					'description' => esc_html__( 'Choose dark logo image', 'pelicula-core' ),
					'multiple'    => 'no',
					'dependency'  => array(
						'show'    => array(
							'qodef_logo_source' => array(
								'values'        => 'image',
								'default_value' => 'image'
							)
						)
					)
				)
			);

			$header_tab->add_field_element(
				array(
					'field_type'  => 'image',
					'name'        => 'qodef_logo_light',
					'title'       => esc_html__( 'Logo - Light', 'pelicula-core' ),
					'description' => esc_html__( 'Choose light logo image', 'pelicula-core' ),
					'multiple'    => 'no',
					'dependency'  => array(
						'show'    => array(
							'qodef_logo_source' => array(
								'values'        => 'image',
								'default_value' => 'image'
							)
						)
					)
				)
			);

			$header_tab->add_field_element(
				array(
					'field_type'  => 'text',
					'name'        => 'qodef_logo_text',
					'title'       => esc_html__( 'Logo Text', 'pelicula-core' ),
					'description' => esc_html__( 'Enter logo text', 'pelicula-core' ),
					'dependency'  => array(
						'show'    => array(
							'qodef_logo_source' => array(
								'values'        => 'text',
								'default_value' => 'image'
							)
						)
					)
				)
			);

			$header_tab->add_field_element(
				array(
					'field_type'  => 'text',
					'name'        => 'qodef_logo_text_font_size',
					'title'       => esc_html__( 'Logo Text Font Size', 'pelicula-core' ),
					'description' => esc_html__( 'Enter logo text font size with unit', 'pelicula-core' ),
					'dependency'  => array(
						'show'    => array(
							'qodef_logo_source' => array(
								'values'        => 'text',
								'default_value' => 'image'
							)
						)
					)
				)
			);
			
			$header_tab->add_field_element(
				array(
					'field_type'  => 'color',
					'name'        => 'qodef_logo_text_color',
					'title'       => esc_html__( 'Logo Text Color', 'pelicula-core' ),
					'description' => esc_html__( 'Enter logo text color', 'pelicula-core' ),
					'dependency'  => array(
						'show'    => array(
							'qodef_logo_source' => array(
								'values'        => 'text',
								'default_value' => 'image'
							)
						)
					)
				)
			);

			$header_tab->add_field_element(
				array(
					'field_type'  => 'color',
					'name'        => 'qodef_logo_sticky_text_color',
					'title'       => esc_html__( 'Sticky Logo Text Color', 'pelicula-core' ),
					'description' => esc_html__( 'Enter sticky logo text color', 'pelicula-core' ),
					'dependency'  => array(
						'show'    => array(
							'qodef_logo_source' => array(
								'values'        => 'text',
								'default_value' => 'image'
							)
						)
					)
				)
			);

			$header_tab->add_field_element(
				array(
					'field_type'  => 'select',
					'name'        => 'qodef_logo_line_through',
					'title'       => esc_html__( 'Enable Logo Line Through Decoration', 'pelicula-core' ),
					'description' => esc_html__( 'Use this option to enable/disable logo line through', 'pelicula-core' ),
					'options'     => pelicula_core_get_select_type_options_pool( 'yes_no', false ),
					'dependency'  => array(
						'show'    => array(
							'qodef_logo_source' => array(
								'values'        => 'text',
								'default_value' => 'image'
							)
						)
					)
				)
			);

			// Hook to include additional options after module options
			do_action( 'pelicula_core_action_after_header_logo_options_map', $page, $header_tab );
		}
	}

	add_action( 'pelicula_core_action_default_options_init', 'pelicula_core_add_logo_options', pelicula_core_get_admin_options_map_position( 'logo' ) );
}