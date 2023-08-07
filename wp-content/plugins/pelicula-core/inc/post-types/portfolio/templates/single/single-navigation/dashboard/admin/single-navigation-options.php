<?php

if ( ! function_exists( 'pelicula_core_add_portfolio_single_navigation_options' ) ) {
	function pelicula_core_add_portfolio_single_navigation_options( $page ) {

		if ( $page ) {

			$page->add_field_element(
				array(
					'field_type'    => 'yesno',
					'name'          => 'qodef_portfolio_enable_navigation',
					'title'         => esc_html__( 'Navigation', 'pelicula-core' ),
					'description'   => esc_html__( 'Enabling this option will turn on portfolio navigation functionality', 'pelicula-core' ),
					'default_value' => 'yes'
				)
			);

			$page->add_field_element(
				array(
					'field_type'    => 'yesno',
					'name'          => 'qodef_portfolio_navigation_through_same_category',
					'title'         => esc_html__( 'Navigation Through Same Category', 'pelicula-core' ),
					'description'   => esc_html__( 'Enabling this option will make portfolio navigation sort through current category', 'pelicula-core' ),
					'default_value' => 'no',
					'dependency'    => array(
						'show' => array(
							'qodef_portfolio_enable_navigation' => array(
								'values'        => 'yes',
								'default_value' => 'yes'
							)
						)
					)
				)
			);
		}
	}

	add_action( 'pelicula_core_action_after_portfolio_options_single', 'pelicula_core_add_portfolio_single_navigation_options' );
}