<?php

if ( ! function_exists( 'pelicula_core_add_portfolio_options' ) ) {
	/**
	 * Function that add general options for this module
	 */
	function pelicula_core_add_portfolio_options() {
		$qode_framework = qode_framework_get_framework_root();

		$page = $qode_framework->add_options_page(
			array(
				'scope'       => PELICULA_CORE_OPTIONS_NAME,
				'type'        => 'admin',
				'slug'        => 'portfolio-item',
				'layout'      => 'tabbed',
				'icon'        => 'fa fa-cog',
				'title'       => esc_html__( 'Portfolio', 'pelicula-core' ),
				'description' => esc_html__( 'Global settings related to portfolio', 'pelicula-core' )
			)
		);

		if ( $page ) {
			$archive_tab = $page->add_tab_element(
				array(
					'name'        => 'tab-archive',
					'icon'        => 'fa fa-cog',
					'title'       => esc_html__( 'Portfolio List', 'pelicula-core' ),
					'description' => esc_html__( 'Settings related to portfolio archive pages', 'pelicula-core' )
				)
			);

			// Hook to include additional options after archive module options
			do_action( 'pelicula_core_action_after_portfolio_options_archive', $archive_tab );

			$single_tab = $page->add_tab_element(
				array(
					'name'        => 'tab-single',
					'icon'        => 'fa fa-cog',
					'title'       => esc_html__( 'Portfolio Single', 'pelicula-core' ),
					'description' => esc_html__( 'Settings related to portfolio single pages', 'pelicula-core' )
				)
			);
			$single_tab->add_field_element(
				array(
					'field_type'    => 'select',
					'name'          => 'qodef_portfolio_single_layout',
					'title'         => esc_html__( 'Single Layout', 'pelicula-core' ),
					'description'   => esc_html__( 'Choose default layout for portfolio single', 'pelicula-core' ),
					'default_value' => apply_filters( 'pelicula_core_filter_portfolio_single_layout_default_value', '' ),
					'options'       => apply_filters( 'pelicula_core_filter_portfolio_single_layout_options', array() )
				)
			);

			$single_tab->add_field_element(
				array(
					'field_type'    => 'yesno',
					'name'          => 'qodef_portfolio_single_sticky_sidebar',
					'title'         => esc_html__( 'Enable Sticky Side Text', 'pelicula-core' ),
					'description'   => esc_html__( 'Enabling this option will make side text sticky on Single Project pages. This option works only for Images - Small, Gallery - Small and Masonry - Small portfolio types', 'pelicula-core' ),
					'default_value' => 'yes'
				)
			);

			// Hook to include additional options after single module options
			do_action( 'pelicula_core_action_after_portfolio_options_single', $single_tab );

			// Hook to include additional options after module options
			do_action( 'pelicula_core_action_after_portfolio_options_map', $page );
		}
	}

	add_action( 'pelicula_core_action_default_options_init', 'pelicula_core_add_portfolio_options', pelicula_core_get_admin_options_map_position( 'portfolio' ) );
}