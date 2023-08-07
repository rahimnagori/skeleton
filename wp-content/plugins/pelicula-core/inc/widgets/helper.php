<?php

if ( ! function_exists( 'pelicula_core_include_widgets' ) ) {
	/**
	 * Function that includes widgets
	 */
	function pelicula_core_include_widgets() {
		foreach ( glob( PELICULA_CORE_INC_PATH . '/widgets/*/include.php' ) as $widget ) {
			include_once $widget;
		}
	}
	
	add_action( 'qode_framework_action_before_widgets_register', 'pelicula_core_include_widgets' );
}

if ( ! function_exists( 'pelicula_core_register_widgets' ) ) {
	/**
	 * Function that register widgets
	 */
	function pelicula_core_register_widgets() {
		$qode_framework = qode_framework_get_framework_root();
		$widgets        = apply_filters( 'pelicula_core_filter_register_widgets', $widgets = array() );
		
		if ( ! empty( $widgets ) ) {
			foreach ( $widgets as $widget ) {
				$qode_framework->add_widget( new $widget() );
			}
		}
	}
	
	add_action( 'qode_framework_action_before_widgets_register', 'pelicula_core_register_widgets', 11 ); // Priority 11 set because include of files is called on default action 10
}

if ( ! function_exists( 'pelicula_core_modify_widget_title' ) ) {
	/**
	 * Function that modifies widget title
	 *
	 * @return array
	 */
	function pelicula_core_modify_widget_title( $title, $instance, $id_base ) {

		if ( $id_base !== 'rss' ) { // RSS widget is escaping all HTML in title

			$words = explode( ' ', $title );
			$words = is_array( $words ) ? array_filter( $words ) : false;

			if ( $words ) {
				$last_word = end( $words );
				if ( $last_word ) {
					$last_word_key           = key( $words );
					$words[ $last_word_key ] = '<span class="qodef-last-word">' . $last_word . '</span>';
				}
				$title = implode( ' ', $words );
			}
		}

		return $title;
	}

//	add_filter( 'widget_title', 'pelicula_core_modify_widget_title', 10, 3 );
}
