<?php

if ( ! function_exists( 'pelicula_core_add_portfolio_single_navigation_meta_box' ) ) {
	/**
	 * Function that add general meta box options for this module
	 */
	function pelicula_core_add_portfolio_single_navigation_meta_box( $page, $general_tab ) {
		
		if ( $page ) {

			$general_tab->add_field_element(
				array(
					'field_type'  => 'select',
					'name'        => 'qodef_portfolio_single_navigation_type',
					'title'       => esc_html__( 'Navigation Type', 'pelicula-core' ),
					'options'     => array(
						''       => esc_html__( 'Default', 'pelicula-core' ),
						'simple' => esc_html__( 'Simple', 'pelicula-core' )
					),
				)
			);

			$general_tab->add_field_element(
				array(
					'field_type'  => 'select',
					'name'        => 'qodef_portfolio_single_navigation_in_grid',
					'title'       => esc_html__( 'Navigation in Grid', 'pelicula-core' ),
					'options'     => array(
						''       => esc_html__( 'Default', 'pelicula-core' ),
						'yes'    => esc_html__( 'Yes', 'pelicula-core' )
					),
				)
			);

			$general_tab->add_field_element(
				array(
					'field_type'  => 'select',
					'name'        => 'qodef_portfolio_single_navigation_skin',
					'title'       => esc_html__( 'Navigation Skin', 'pelicula-core' ),
					'options'     => array(
						''      => esc_html__( 'Default', 'pelicula-core' ),
						'light' => esc_html__( 'Light', 'pelicula-core' )
					),
				)
			);

			$general_tab->add_field_element(
				array(
					'field_type'  => 'select',
					'name'        => 'qodef_portfolio_single_back_to_link',
					'title'       => esc_html__( 'Back To Link', 'pelicula-core' ),
					'description' => esc_html__( 'Choose "Back To" page to link from portfolio single', 'pelicula-core' ),
					'options'     => qode_framework_get_pages( true ),
				)
			);
		}
	}
	
	add_action( 'pelicula_core_action_after_portfolio_meta_box_map', 'pelicula_core_add_portfolio_single_navigation_meta_box', 10, 2 );
}