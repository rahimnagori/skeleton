<?php

if ( ! function_exists( 'pelicula_core_include_yith_wishlist_plugin_is_installed' ) ) {
	function pelicula_core_include_yith_wishlist_plugin_is_installed( $installed, $plugin ) {
		if ( $plugin === 'yith-wishlist' ) {
			return defined( 'YITH_WCWL' );
		}
		
		return $installed;
	}
	
	add_filter( 'qode_framework_filter_is_plugin_installed', 'pelicula_core_include_yith_wishlist_plugin_is_installed', 10, 2 );
}

if ( ! function_exists( 'pelicula_core_get_yith_wishlist_shortcode' ) ) {
	function pelicula_core_get_yith_wishlist_shortcode() {
		if ( qode_framework_is_installed( 'yith-wishlist' ) ) {
			echo do_shortcode( '[yith_wcwl_add_to_wishlist]' );
		}
	}
}