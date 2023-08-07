<?php

if ( ! function_exists( 'pelicula_core_register_testimonials_for_meta_options' ) ) {
	function pelicula_core_register_testimonials_for_meta_options( $post_types ) {
		$post_types[] = 'testimonials';
		return $post_types;
	}
	
	add_filter( 'qode_framework_filter_meta_box_save', 'pelicula_core_register_testimonials_for_meta_options' );
	add_filter( 'qode_framework_filter_meta_box_remove', 'pelicula_core_register_testimonials_for_meta_options' );
}

if ( ! function_exists( 'pelicula_core_add_testimonials_custom_post_type' ) ) {
	/**
	 * Function that adds testimonials custom post type
	 *
	 * @param $cpts array
	 *
	 * @return array
	 */
	function pelicula_core_add_testimonials_custom_post_type( $cpts ) {
		$cpts[] = 'PeliculaCoreTestimonialsCPT';
		
		return $cpts;
	}
	
	add_filter( 'pelicula_core_filter_register_custom_post_types', 'pelicula_core_add_testimonials_custom_post_type' );
}

if ( class_exists( 'QodeFrameworkCustomPostType' ) ) {
	class PeliculaCoreTestimonialsCPT extends QodeFrameworkCustomPostType {
		
		public function map_post_type() {
			$name = esc_html__( 'Testimonials', 'pelicula-core' );
			$this->set_base( 'testimonials' );
			$this->set_menu_position( 10 );
			$this->set_menu_icon( 'dashicons-screenoptions' );
			$this->set_slug( 'testimonials' );
			$this->set_name( $name );
			$this->set_path( PELICULA_CORE_CPT_PATH . '/testimonials' );
			$this->set_labels( array(
				'name'          => esc_html__( 'Pelicula Testimonials', 'pelicula-core' ),
				'singular_name' => esc_html__( 'Testimonial', 'pelicula-core' ),
				'add_item'      => esc_html__( 'New Testimonial', 'pelicula-core' ),
				'add_new_item'  => esc_html__( 'Add New Testimonial', 'pelicula-core' ),
				'edit_item'     => esc_html__( 'Edit Testimonial', 'pelicula-core' )
			) );
			$this->set_public( false );
			$this->set_archive( false );
			$this->set_supports( array(
				'title',
				'thumbnail'
			) );
			$this->add_post_taxonomy( array(
				'base'          => 'testimonials-category',
				'slug'          => 'testimonials-category',
				'singular_name' => esc_html__( 'Category', 'pelicula-core' ),
				'plural_name'   => esc_html__( 'Categories', 'pelicula-core' ),
			) );
		}
		
	}
}