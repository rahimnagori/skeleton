<?php

if ( ! function_exists( 'pelicula_core_add_portfolio_item_list_meta_boxes' ) ) {
	/**
	 * Function that adds portfolio list settings for portfolio single module
	 */
	function pelicula_core_add_portfolio_item_list_meta_boxes( $page ) {

		if ( $page ) {

			$list_tab = $page->add_tab_element(
				array(
					'name'        => 'tab-list',
					'icon'        => 'fa fa-cog',
					'title'       => esc_html__( 'List Settings', 'pelicula-core' ),
					'description' => esc_html__( 'Portfolio list settings', 'pelicula-core' )
				)
			);

			$list_tab->add_field_element( array(
				'field_type'  => 'image',
				'name'        => 'qodef_portfolio_list_image',
				'title'       => esc_html__( 'Portfolio List Image', 'pelicula-core' ),
				'description' => esc_html__( 'Upload image to be displayed on portfolio list instead of featured image', 'pelicula-core' ),
			) );

			$list_tab->add_field_element( array(
				'field_type'  => 'text',
				'name'        => 'qodef_portfolio_list_video',
				'title'       => esc_html__( 'Portfolio List Video', 'pelicula-core' ),
				'description' => esc_html__( 'Insert video link to be displayed on portfolio list', 'pelicula-core' )
			) );

			$list_tab->add_field_element( array(
				'field_type'  => 'select',
				'name'        => 'qodef_masonry_image_dimension_portfolio-item',
				'title'       => esc_html__( 'Image Dimension', 'pelicula-core' ),
				'description' => esc_html__( 'Choose an image layout for "masonry behavior" portfolio list. If you are using fixed image proportions on the list, choose an option other than default', 'pelicula-core' ),
				'options'     => pelicula_core_get_select_type_options_pool( 'masonry_image_dimension' )
			) );

			$list_tab->add_field_element( array(
				'field_type'  => 'text',
				'name'        => 'qodef_portfolio_item_padding',
				'title'       => esc_html__( 'Portfolio Item Custom Padding', 'pelicula-core' ),
				'description' => esc_html__( 'Choose item padding when it appears in portfolio list (ex. 5% 5% 5% 5%)', 'pelicula-core' )
			) );

			$list_tab->add_field_element( array(
				'field_type'  => 'text',
				'name'        => 'qodef_portfolio_list_external_link',
				'title'       => esc_html__( 'Portfolio External Link', 'pelicula-core' ),
				'description' => esc_html__( 'Insert URL to be linked from portfolio list', 'pelicula-core' )
			) );

			$list_tab->add_field_element( array(
				'field_type'    => 'select',
				'name'          => 'qodef_portfolio_list_external_link_target',
				'title'         => esc_html__( 'Portfolio External Link Target', 'pelicula-core' ),
				'description'   => esc_html__( 'Choose target for portfolio external link', 'pelicula-core' ),
				'options'       => pelicula_core_get_select_type_options_pool( 'link_target' ),
				'default_value' => '_self'
			) );
			
			// Hook to include additional options after module options
			do_action( 'pelicula_core_action_after_portfolio_list_meta_box_map', $list_tab );
		}
	}

	add_action( 'pelicula_core_action_after_portfolio_meta_box_map', 'pelicula_core_add_portfolio_item_list_meta_boxes' );
}