<?php

if ( ! function_exists( 'pelicula_core_add_portfolio_list_options' ) ) {
	function pelicula_core_add_portfolio_list_options( $options ) {
		$info_below_options   = array();
		$info_below_options[] = array(
			'field_type' => 'select',
			'name'       => 'slider_layout',
			'title'      => esc_html__( 'Slider Layout', 'pelicula-core' ),
			'options'    => array(
				''            => esc_html__( 'Default', 'pelicula-core' ),
				'predefined'  => esc_html__( '3 Column Center Highlight', 'pelicula-core' ),
				'predefined2' => esc_html__( '3 Column Center Overlap', 'pelicula-core' ),
				'predefined3' => esc_html__( '5 Column Carousel', 'pelicula-core' )
			),
			'dependency' => array(
				'show' => array(
					'behavior' => array(
						'values'        => 'slider',
						'default_value' => 'columns'
					)
				)
			),
			'group'      => esc_html__( 'Special', 'pelicula-core' ),
		);

		$info_below_options[] = array(
			'field_type' => 'select',
			'name'       => 'enable_fs_predefined_slider',
			'title'      => esc_html__( 'Enable Full Screen Slider', 'pelicula-core' ),
			'options'       => pelicula_core_get_select_type_options_pool( 'no_yes', false ),
			'dependency' => array(
				'show' => array(
					'slider_layout' => array(
						'values'        => 'predefined',
						'default_value' => ''
					)
				)
			),
			'group'      => esc_html__( 'Special', 'pelicula-core' ),
		);
		
		return array_merge( $options, $info_below_options );
	}
	
	add_filter( 'pelicula_core_filter_portfolio_list_extra_options', 'pelicula_core_add_portfolio_list_options' );
}

if ( ! function_exists( 'pelicula_core_get_portfolio_link' ) ) {
	function pelicula_core_get_portfolio_link() {

		$portfolio_link = get_the_permalink();

		$portfolio_external_link = get_post_meta( get_the_ID(), 'qodef_portfolio_list_external_link', true );
		if ( ! empty( $portfolio_external_link ) ) {
			$portfolio_link = esc_url( $portfolio_external_link );
		}

		return $portfolio_link;
	}
}

if ( ! function_exists( 'pelicula_core_get_portfolio_link_target' ) ) {
	function pelicula_core_get_portfolio_link_target() {

		$portfolio_link_target = '_self';

		$portfolio_external_link_target = get_post_meta( get_the_ID(), 'qodef_portfolio_list_external_link_target', true );
		if ( ! empty( $portfolio_external_link_target ) ) {
			$portfolio_link_target = esc_attr( $portfolio_external_link_target );
		}

		return $portfolio_link_target;
	}
}