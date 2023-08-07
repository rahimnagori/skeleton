<?php

if ( ! function_exists( 'pelicula_core_add_page_spinner_meta_box' ) ) {
	/**
	 * Function that add general options for this module
	 */
	function pelicula_core_add_page_spinner_meta_box( $page ) {
		
		if ( $page ) {
			$page->add_field_element(
				array(
					'field_type'  => 'select',
					'name'        => 'qodef_enable_page_spinner',
					'title'       => esc_html__( 'Enable Page Spinner', 'pelicula-core' ),
					'description' => esc_html__( 'Enable Page Spinner Effect', 'pelicula-core' ),
					'options'     => pelicula_core_get_select_type_options_pool( 'yes_no' )
				)
			);
		}
	}
	
	add_action( 'pelicula_core_action_after_general_page_meta_box_map', 'pelicula_core_add_page_spinner_meta_box', 9 );
}