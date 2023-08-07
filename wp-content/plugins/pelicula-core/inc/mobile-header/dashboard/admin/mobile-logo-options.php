<?php

if ( ! function_exists( 'pelicula_core_add_mobile_logo_options' ) ) {
	/**
	 * Function that add mobile header options for this module
	 */
	function pelicula_core_add_mobile_logo_options( $page, $header_tab ) {

		if ( $page ) {
			
			$mobile_header_tab = $page->add_tab_element(
				array(
					'name'        => 'tab-mobile-header',
					'icon'        => 'fa fa-cog',
					'title'       => esc_html__( 'Mobile Header Logo Options', 'pelicula-core' ),
					'description' => esc_html__( 'Set options for mobile headers', 'pelicula-core' )
				)
			);
			
			$mobile_header_tab->add_field_element(
				array(
					'field_type'  => 'text',
					'name'        => 'qodef_mobile_logo_height',
					'title'       => esc_html__( 'Mobile Logo Height', 'pelicula-core' ),
					'description' => esc_html__( 'Enter mobile logo height', 'pelicula-core' ),
					'args'        => array(
						'suffix' => esc_html__( 'px', 'pelicula-core' )
					)
				)
			);
			
			$mobile_header_tab->add_field_element(
				array(
					'field_type'    => 'select',
					'name'          => 'qodef_mobile_logo_source',
					'title'         => esc_html__( 'Mobile Logo Source', 'pelicula-core' ),
					'description'   => esc_html__( 'Select mobile logo type', 'pelicula-core' ),
					'default_value' => 'image',
					'options'       => array(
						'image'     => esc_html__( 'Image', 'pelicula-core' ),
						'text' => esc_html__( 'Text', 'pelicula-core' ),
					),
				)
			);
			
			$mobile_header_tab->add_field_element(
				array(
					'field_type'  => 'image',
					'name'        => 'qodef_mobile_logo_main',
					'title'       => esc_html__( 'Mobile Logo - Main', 'pelicula-core' ),
					'description' => esc_html__( 'Choose main mobile logo image', 'pelicula-core' ),
					'default_value' => defined( 'PELICULA_ASSETS_ROOT' ) ? PELICULA_ASSETS_ROOT . '/img/logo-mobile.png' : '',
					'multiple'    => 'no',
					'dependency'  => array(
						'show'    => array(
							'qodef_mobile_logo_source' => array(
								'values'        => 'image',
								'default_value' => 'image'
							)
						)
					)
				)
			);
			
			$mobile_header_tab->add_field_element(
				array(
					'field_type'  => 'text',
					'name'        => 'qodef_mobile_logo_text',
					'title'       => esc_html__( 'Mobile Logo Text', 'pelicula-core' ),
					'description' => esc_html__( 'Enter mobile logo text', 'pelicula-core' ),
					'dependency'  => array(
						'show'    => array(
							'qodef_mobile_logo_source' => array(
								'values'        => 'text',
								'default_value' => 'image'
							)
						)
					)
				)
			);
			
			$mobile_header_tab->add_field_element(
				array(
					'field_type'  => 'color',
					'name'        => 'qodef_mobile_logo_text_color',
					'title'       => esc_html__( 'Mobile Logo Text Color', 'pelicula-core' ),
					'description' => esc_html__( 'Enter mobile logo text color', 'pelicula-core' ),
					'dependency'  => array(
						'show'    => array(
							'qodef_mobile_logo_source' => array(
								'values'        => 'text',
								'default_value' => 'image'
							)
						)
					)
				)
			);

			$mobile_header_tab->add_field_element(
				array(
					'field_type'  => 'select',
					'name'        => 'qodef_mobile_logo_line_through',
					'title'       => esc_html__( 'Enable Mobile Logo Line Through Decoration', 'pelicula-core' ),
					'description' => esc_html__( 'Use this option to enable/disable mobile logo line through', 'pelicula-core' ),
					'options'     => pelicula_core_get_select_type_options_pool( 'yes_no', false ),
					'dependency'  => array(
						'show'    => array(
							'qodef_mobile_logo_source' => array(
								'values'        => 'text',
								'default_value' => 'image'
							)
						)
					)
				)
			);
			
			do_action( 'pelicula_core_action_after_mobile_logo_options_map', $page );
		}
	}
	
	add_action( 'pelicula_core_action_after_header_logo_options_map', 'pelicula_core_add_mobile_logo_options', 10, 2 );
}