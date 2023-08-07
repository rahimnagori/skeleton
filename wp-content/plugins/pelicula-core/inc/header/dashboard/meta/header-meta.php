<?php

if ( ! function_exists( 'pelicula_core_get_hide_dep_for_header_widget_areas_meta_boxes' ) ) {
	function pelicula_core_get_hide_dep_for_header_widget_areas_meta_boxes() {
		$hide_dep_options = apply_filters( 'pelicula_core_filter_header_widget_areas_hide_meta_boxes', $hide_dep_options = array() );

		return $hide_dep_options;
	}
}

if ( ! function_exists( 'pelicula_core_get_hide_dep_for_header_widget_area_two_meta_boxes' ) ) {
	function pelicula_core_get_hide_dep_for_header_widget_area_two_meta_boxes() {
		$hide_dep_options = apply_filters( 'pelicula_core_filter_header_widget_area_two_hide_meta_boxes', $hide_dep_options = array() );

		return $hide_dep_options;
	}
}

if ( ! function_exists( 'pelicula_core_add_page_header_meta_box' ) ) {
	/**
	 * Function that add general options for this module
	 */
	function pelicula_core_add_page_header_meta_box( $page ) {

		if ( $page ) {

			$hide_dep_widget_area_one 	= pelicula_core_get_hide_dep_for_header_widget_areas_meta_boxes();
			$hide_dep_widget_area_two 	= pelicula_core_get_hide_dep_for_header_widget_area_two_meta_boxes();

			$header_tab = $page->add_tab_element(
				array(
					'name'        => 'tab-header',
					'icon'        => 'fa fa-cog',
					'title'       => esc_html__( 'Header Settings', 'pelicula-core' ),
					'description' => esc_html__( 'Header layout settings', 'pelicula-core' )
				)
			);

			$header_tab->add_field_element(
				array(
					'field_type'  => 'select',
					'name'        => 'qodef_header_layout',
					'title'       => esc_html__( 'Header Layout', 'pelicula-core' ),
					'description' => esc_html__( 'Choose a header layout to set for your website', 'pelicula-core' ),
					'args'        => array( 'images' => true ),
					'options'     => pelicula_core_header_radio_to_select_options( apply_filters( 'pelicula_core_filter_header_layout_option', $header_layout_options = array() ) )
				)
			);

			$header_tab->add_field_element(
				array(
					'field_type'  => 'select',
					'name'        => 'qodef_header_skin',
					'title'       => esc_html__( 'Header Skin', 'pelicula-core' ),
					'description' => esc_html__( 'Choose a predefined header style for header elements', 'pelicula-core' ),
					'options'     => array(
						''      => esc_html__( 'Default', 'pelicula-core' ),
						'none'  => esc_html__( 'None', 'pelicula-core' ),
						'light' => esc_html__( 'Light', 'pelicula-core' ),
						'dark'  => esc_html__( 'Dark', 'pelicula-core' )
					)
				)
			);

			$header_tab->add_field_element(
				array(
					'field_type'    => 'yesno',
					'name'          => 'qodef_show_header_widget_areas',
					'title'         => esc_html__( 'Show Header Widget Areas', 'pelicula-core' ),
					'description'   => esc_html__( 'Choose if you want to show or hide header widget areas', 'pelicula-core' ),
					'default_value' => 'yes'
				)
			);

			$custom_sidebars = pelicula_core_get_custom_sidebars();
			if ( ! empty( $custom_sidebars ) && count( $custom_sidebars ) > 1 ) {

				$section = $header_tab->add_section_element(
					array(
						'name'       => 'qodef_header_custom_widget_area_section',
						'dependency' => array(
							'show' => array(
								'qodef_show_header_widget_areas' => array(
									'values'        => 'yes',
									'default_value' => 'yes'
								)
							)
						)
					)
				);
				
				$section->add_field_element(
					array(
						'field_type'  => 'select',
						'name'        => 'qodef_header_custom_widget_area_one',
						'title'       => esc_html__( 'Choose Custom Header Widget Area One', 'pelicula-core' ),
						'description' => esc_html__( 'Choose custom widget area to display in header widget area one', 'pelicula-core' ),
						'options'     => $custom_sidebars,
						'dependency' => array(
							'hide' => array(
								'qodef_header_layout' => array(
									'values' => $hide_dep_widget_area_one,
									'default_value' => ''
								)
							)
						)
					)
				);
				
				$section->add_field_element(
					array(
						'field_type'  => 'select',
						'name'        => 'qodef_header_custom_widget_area_two',
						'title'       => esc_html__( 'Choose Custom Header Widget Area Two', 'pelicula-core' ),
						'description' => esc_html__( 'Choose custom widget area to display in header widget area two', 'pelicula-core' ),
						'options'     => $custom_sidebars,
						'dependency' => array(
							'hide' => array(
								'qodef_header_layout' => array(
									'values' => $hide_dep_widget_area_two,
									'default_value' => ''
								)
							)
						)
					)
				);
				
				// Hook to include additional options after module options
				do_action( 'pelicula_core_action_after_custom_widget_area_header_meta_map', $section, $custom_sidebars );
			}

			// Hook to include additional options after module options
			do_action( 'pelicula_core_action_after_page_header_meta_map', $header_tab, $custom_sidebars );
		}
	}

	add_action( 'pelicula_core_action_after_general_meta_box_map', 'pelicula_core_add_page_header_meta_box' );
	add_action( 'pelicula_core_action_after_portfolio_meta_box_map', 'pelicula_core_add_page_header_meta_box' );
}