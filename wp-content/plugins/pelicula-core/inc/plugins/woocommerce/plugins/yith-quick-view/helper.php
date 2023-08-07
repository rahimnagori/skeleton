<?php

if ( ! function_exists( 'pelicula_core_include_yith_quick_view_plugin_is_installed' ) ) {
	function pelicula_core_include_yith_quick_view_plugin_is_installed( $installed, $plugin ) {
		if ( $plugin === 'yith-quick-view' ) {
			return defined( 'YITH_WCQV' );
		}
		
		return $installed;
	}
	
	add_filter( 'qode_framework_filter_is_plugin_installed', 'pelicula_core_include_yith_quick_view_plugin_is_installed', 10, 2 );
}