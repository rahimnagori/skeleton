<?php

if ( ! function_exists( 'pelicula_core_add_page_title_meta_box' ) ) {
	/**
	 * Function that add general options for this module
	 */
	function pelicula_core_add_page_title_meta_box( $page ) {

		if ( $page ) {

			$title_tab = $page->add_tab_element(
				array(
					'name'        => 'tab-title',
					'icon'        => 'fa fa-cog',
					'title'       => esc_html__( 'Title Settings', 'pelicula-core' ),
					'description' => esc_html__( 'Title layout settings', 'pelicula-core' )
				)
			);

			$title_tab->add_field_element(
				array(
					'field_type'  => 'select',
					'name'        => 'qodef_enable_page_title',
					'title'       => esc_html__( 'Enable Page Title', 'pelicula-core' ),
					'description' => esc_html__( 'Use this option to enable/disable page title', 'pelicula-core' ),
					'options'     => pelicula_core_get_select_type_options_pool( 'no_yes' )
				)
			);

			$page_title_section = $title_tab->add_section_element(
				array(
					'name'       => 'qodef_page_title_section',
					'title'      => esc_html__( 'Title Area', 'pelicula-core' ),
					'dependency' => array(
						'hide' => array(
							'qodef_enable_page_title' => array(
								'values'        => 'no',
								'default_value' => ''
							)
						)
					)
				)
			);

			$page_title_section->add_field_element(
				array(
					'field_type'  => 'select',
					'name'        => 'qodef_title_layout',
					'title'       => esc_html__( 'Title Layout', 'pelicula-core' ),
					'description' => esc_html__( 'Choose a title layout', 'pelicula-core' ),
					'options'     => apply_filters( 'pelicula_core_filter_title_layout_options', $layouts = array( '' => esc_html__( 'Default', 'pelicula-core' ) ) )
				)
			);

			$page_title_section->add_field_element(
				array(
					'field_type'  => 'select',
					'name'        => 'qodef_set_page_title_area_in_grid',
					'title'       => esc_html__( 'Page Title In Grid', 'pelicula-core' ),
					'description' => esc_html__( 'Enabling this option will set page title area to be in grid', 'pelicula-core' ),
					'options'     => pelicula_core_get_select_type_options_pool( 'no_yes' )
				)
			);

			$page_title_section->add_field_element(
				array(
					'field_type'  => 'text',
					'name'        => 'qodef_page_title_height',
					'title'       => esc_html__( 'Height', 'pelicula-core' ),
					'description' => esc_html__( 'Enter title height', 'pelicula-core' ),
					'args'        => array(
						'suffix' => esc_html__( 'px', 'pelicula-core' )
					)
				)
			);
			
			$page_title_section->add_field_element(
				array(
					'field_type'  => 'text',
					'name'        => 'qodef_page_title_height_on_smaller_screens',
					'title'       => esc_html__( 'Height on Smaller Screens', 'pelicula-core' ),
					'description' => esc_html__( 'Enter title height to be displayed on smaller screens with active mobile header', 'pelicula-core' ),
					'args'        => array(
						'suffix' => esc_html__( 'px', 'pelicula-core' )
					)
				)
			);

			$page_title_section->add_field_element(
				array(
					'field_type'  => 'color',
					'name'        => 'qodef_page_title_background_color',
					'title'       => esc_html__( 'Background Color', 'pelicula-core' ),
					'description' => esc_html__( 'Enter page title area background color', 'pelicula-core' )
				)
			);

			$page_title_section->add_field_element(
				array(
					'field_type'  => 'image',
					'name'        => 'qodef_page_title_background_image',
					'title'       => esc_html__( 'Background Image', 'pelicula-core' ),
					'description' => esc_html__( 'Enter page title area background image', 'pelicula-core' )
				)
			);

			$page_title_section->add_field_element(
				array(
					'field_type' => 'select',
					'name'       => 'qodef_page_title_background_image_behavior',
					'title'      => esc_html__( 'Background Image Behavior', 'pelicula-core' ),
					'options'    => array(
						''           => esc_html__( 'Default', 'pelicula-core' ),
						'responsive' => esc_html__( 'Set Responsive Image', 'pelicula-core' ),
						'parallax'   => esc_html__( 'Set Parallax Image', 'pelicula-core' )
					)
				)
			);

			$page_title_section->add_field_element(
				array(
					'field_type' => 'color',
					'name'       => 'qodef_page_title_color',
					'title'      => esc_html__( 'Title Color', 'pelicula-core' )
				)
			);

			$page_title_section->add_field_element(
				array(
					'field_type'    => 'select',
					'name'          => 'qodef_page_title_tag',
					'title'         => esc_html__( 'Title Tag', 'pelicula-core' ),
					'description'   => esc_html__( 'Enabling this option will set title tag', 'pelicula-core' ),
					'options'       => pelicula_core_get_select_type_options_pool( 'title_tag', true, array(), array('div' => esc_html__( 'Custom', 'pelicula-core' ) ) ),
					'default_value' => '',
					'dependency'    => array(
						'show' => array(
							'qodef_title_layout' => array(
								'values'        => array( 'standard-with-breadcrumbs', 'standard' ),
								'default_value' => ''
							)
						)
					)
				)
			);

			$page_title_section->add_field_element(
				array(
					'field_type'    => 'select',
					'name'          => 'qodef_page_title_text_alignment',
					'title'         => esc_html__( 'Text Alignment', 'pelicula-core' ),
					'options'       => array(
						''       => esc_html__( 'Default', 'pelicula-core' ),
						'left'   => esc_html__( 'Left', 'pelicula-core' ),
						'center' => esc_html__( 'Center', 'pelicula-core' ),
						'right'  => esc_html__( 'Right', 'pelicula-core' )
					),
					'default_value' => ''
				)
			);

			$page_title_section->add_field_element(
				array(
					'field_type'    => 'select',
					'name'          => 'qodef_page_title_vertical_text_alignment',
					'title'         => esc_html__( 'Vertical Text Alignment', 'pelicula-core' ),
					'options'       => array(
						''              => esc_html__( 'Default', 'pelicula-core' ),
						'header-bottom' => esc_html__( 'From Bottom of Header', 'pelicula-core' ),
						'window-top'    => esc_html__( 'From Window Top', 'pelicula-core' )
					),
					'default_value' => ''
				)
			);

			// Hook to include additional options after module options
			do_action( 'pelicula_core_action_after_page_title_meta_box_map', $page_title_section );
		}
	}

	add_action( 'pelicula_core_action_after_general_meta_box_map', 'pelicula_core_add_page_title_meta_box' );
	add_action( 'pelicula_core_action_after_portfolio_meta_box_map', 'pelicula_core_add_page_title_meta_box' );
}