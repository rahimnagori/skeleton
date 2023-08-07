<?php

if ( ! function_exists( 'pelicula_core_include_image_sizes' ) ) {
	/**
	 * Function that includes icons
	 */
	function pelicula_core_include_image_sizes() {
		foreach ( glob( PELICULA_CORE_INC_PATH . '/media/*/include.php' ) as $image_size ) {
			include_once $image_size;
		}
	}
	
	add_action( 'qode_framework_action_before_images_register', 'pelicula_core_include_image_sizes' );
}