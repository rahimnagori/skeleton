<?php

if ( ! function_exists( 'pelicula_core_add_blog_list_options_enable_meta_info' ) ) {
	function pelicula_core_add_blog_list_options_enable_meta_info( $options ) {
		$blog_list_options   = array();

		$blog_list_options[] = array(
			'field_type' => 'select',
			'name'       => 'enable_excerpt',
			'title'      => esc_html__( 'Enable Excerpt', 'pelicula-core' ),
			'options'       => array(
				''    => esc_html__( 'Default', 'pelicula-core' ),
				'yes' => esc_html__( 'Yes', 'pelicula-core' ),
				'no'  => esc_html__( 'No', 'pelicula-core' )
			),
			'dependency' => array(
				'show' => array(
					'layout' => array(
						'values' => 'standard'
					)
				)
			),
			'group'      => esc_html__( 'Additional Features', 'pelicula-core' )
		);

		$blog_list_options[] = array(
			'field_type' => 'select',
			'name'       => 'enable_button',
			'title'      => esc_html__( 'Enable Button', 'pelicula-core' ),
			'options'       => array(
				''    => esc_html__( 'Default', 'pelicula-core' ),
				'yes' => esc_html__( 'Yes', 'pelicula-core' ),
				'no'  => esc_html__( 'No', 'pelicula-core' )
			),
			'dependency' => array(
				'show' => array(
					'layout' => array(
						'values' => 'metro'
					)
				)
			),
			'group'      => esc_html__( 'Additional Features', 'pelicula-core' )
		);

		$blog_list_options[] = array(
			'field_type'    => 'select',
			'name'          => 'enable_comments',
			'title'         => esc_html__( 'Enable Comments', 'pelicula-core' ),
			'options'       => array(
				''    => esc_html__( 'Default', 'pelicula-core' ),
				'yes' => esc_html__( 'Yes', 'pelicula-core' ),
				'no'  => esc_html__( 'No', 'pelicula-core' )
			),
			'default_value' => 'yes',
			'dependency'    => array(
				'show' => array(
					'layout' => array(
						'values' => array( 'metro', 'standard' )
					)
				)
			),
			'group'         => esc_html__( 'Additional Features', 'pelicula-core' )
		);

		$blog_list_options[] = array(
			'field_type'    => 'select',
			'name'          => 'enable_social_share',
			'title'         => esc_html__( 'Enable Social Share', 'pelicula-core' ),
			'options'       => array(
				''    => esc_html__( 'Default', 'pelicula-core' ),
				'yes' => esc_html__( 'Yes', 'pelicula-core' ),
				'no'  => esc_html__( 'No', 'pelicula-core' )
			),
			'default_value' => 'yes',
			'dependency'    => array(
				'show' => array(
					'layout' => array(
						'values' => array( 'metro', 'standard' )
					)
				)
			),
			'group'         => esc_html__( 'Additional Features', 'pelicula-core' )
		);

		return array_merge( $options, $blog_list_options );
	}

	add_filter( 'pelicula_core_filter_blog_list_extra_options', 'pelicula_core_add_blog_list_options_enable_meta_info', 10, 1 );
}