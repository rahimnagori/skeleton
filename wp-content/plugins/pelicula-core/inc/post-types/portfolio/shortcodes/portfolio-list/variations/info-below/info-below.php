<?php

if ( ! function_exists( 'pelicula_core_add_portfolio_list_variation_info_below' ) ) {
	function pelicula_core_add_portfolio_list_variation_info_below( $variations ) {
		
		$variations['info-below'] = esc_html__( 'Info Below', 'pelicula-core' );
		
		return $variations;
	}
	
	add_filter( 'pelicula_core_filter_portfolio_list_layouts', 'pelicula_core_add_portfolio_list_variation_info_below' );
}

if ( ! function_exists( 'pelicula_core_add_portfolio_list_options_info_below' ) ) {
	function pelicula_core_add_portfolio_list_options_info_below( $options ) {
		$info_below_options   = array();
		$info_below_options[] = array(
			'field_type' => 'text',
			'name'       => 'info_below_content_margin_top',
			'title'      => esc_html__( 'Content Top Margin', 'pelicula-core' ),
			'dependency' => array(
				'show' => array(
					'layout' => array(
						'values'        => 'info-below',
						'default_value' => ''
					)
				)
			),
			'group'      => esc_html__( 'Layout', 'pelicula-core' )
		);
		
		return array_merge( $options, $info_below_options );
	}
	
	add_filter( 'pelicula_core_filter_portfolio_list_extra_options', 'pelicula_core_add_portfolio_list_options_info_below' );
}