<?php

if ( ! function_exists( 'pelicula_core_register_team_for_meta_options' ) ) {
	function pelicula_core_register_team_for_meta_options( $post_types ) {
		$post_types[] = 'team';
		
		return $post_types;
	}
	
	add_filter( 'qode_framework_filter_meta_box_save', 'pelicula_core_register_team_for_meta_options' );
	add_filter( 'qode_framework_filter_meta_box_remove', 'pelicula_core_register_team_for_meta_options' );
}

if ( ! function_exists( 'pelicula_core_add_team_custom_post_type' ) ) {
	/**
	 * Function that adds team custom post type
	 *
	 * @param $cpts array
	 *
	 * @return array
	 */
	function pelicula_core_add_team_custom_post_type( $cpts ) {
		$cpts[] = 'PeliculaCoreTeamCPT';
		
		return $cpts;
	}
	
	add_filter( 'pelicula_core_filter_register_custom_post_types', 'pelicula_core_add_team_custom_post_type' );
}

if ( class_exists( 'QodeFrameworkCustomPostType' ) ) {
	class PeliculaCoreTeamCPT extends QodeFrameworkCustomPostType {
		
		public function map_post_type() {
			$name = esc_html__( 'Team', 'pelicula-core' );
			$this->set_base( 'team' );
			$this->set_menu_position( 10 );
			$this->set_menu_icon( 'dashicons-screenoptions' );
			$this->set_slug( 'team' );
			$this->set_name( $name );
			$this->set_path( PELICULA_CORE_CPT_PATH . '/team' );
			$this->set_labels( array(
				'name'          => esc_html__( 'Pelicula Team', 'pelicula-core' ),
				'singular_name' => esc_html__( 'Team Member', 'pelicula-core' ),
				'add_item'      => esc_html__( 'New Team Member', 'pelicula-core' ),
				'add_new_item'  => esc_html__( 'Add New Team Member', 'pelicula-core' ),
				'edit_item'     => esc_html__( 'Edit Team Member', 'pelicula-core' )
			) );
			if ( ! pelicula_core_team_has_single() ) {
				$this->set_public( false );
				$this->set_archive( false );
				$this->set_supports( array(
					'title',
					'thumbnail'
				) );
			}
			$this->add_post_taxonomy( array(
				'base'          => 'team-category',
				'slug'          => 'team-category',
				'singular_name' => esc_html__( 'Category', 'pelicula-core' ),
				'plural_name'   => esc_html__( 'Categories', 'pelicula-core' ),
			) );
		}
	}
}