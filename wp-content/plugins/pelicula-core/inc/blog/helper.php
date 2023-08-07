<?php

if ( ! function_exists( 'pelicula_core_include_blog_shortcodes' ) ) {
	/**
	 * Function that includes shortcodes
	 */
	function pelicula_core_include_blog_shortcodes() {
		foreach ( glob( PELICULA_CORE_INC_PATH . '/blog/shortcodes/*/include.php' ) as $shortcode ) {
			include_once $shortcode;
		}
	}
	
	add_action( 'qode_framework_action_before_shortcodes_register', 'pelicula_core_include_blog_shortcodes' );
}

if ( ! function_exists( 'pelicula_core_include_blog_shortcodes_widget' ) ) {
	/**
	 * Function that includes widgets
	 */
	function pelicula_core_include_blog_shortcodes_widget() {
		foreach ( glob( PELICULA_CORE_INC_PATH . '/blog/shortcodes/*/widget/include.php' ) as $widget ) {
			include_once $widget;
		}
	}
	
	add_action( 'qode_framework_action_before_widgets_register', 'pelicula_core_include_blog_shortcodes_widget' );
}

if ( ! function_exists( 'pelicula_core_set_blog_single_page_title' ) ) {
	/**
	 * Function that enable/disable page title area for blog single page
	 *
	 * @param $enable_page_title bool
	 *
	 * @return bool
	 */
	function pelicula_core_set_blog_single_page_title( $enable_page_title ) {
		
		if ( is_singular( 'post' ) ) {
			$option = pelicula_core_get_post_value_through_levels( 'qodef_blog_single_enable_page_title' ) !== 'no';
			
			if ( isset ( $option ) ) {
				$enable_page_title = $option;
			}
			
			$meta_option = get_post_meta( get_the_ID(), 'qodef_enable_page_title', true );
			
			if ( ! empty( $meta_option ) ) {
				$enable_page_title = $meta_option;
			}
		}
		
		return $enable_page_title;
	}
	
	add_filter( 'pelicula_filter_enable_page_title', 'pelicula_core_set_blog_single_page_title' );
}

if ( ! function_exists( 'pelicula_core_set_blog_single_sidebar_layout' ) ) {
	/**
	 * Function that return sidebar layout
	 *
	 * @param $layout string
	 *
	 * @return string
	 */
	function pelicula_core_set_blog_single_sidebar_layout( $layout ) {
		
		if ( is_singular( 'post' ) ) {
			$option = pelicula_core_get_post_value_through_levels( 'qodef_blog_single_sidebar_layout' );
			
			if ( ! empty( $option ) ) {
				$layout = $option;
			}
			
			$meta_option = get_post_meta( get_the_ID(), 'qodef_page_sidebar_layout', true );
			
			if ( ! empty( $meta_option ) ) {
				$layout = $meta_option;
			}
		}
		
		return $layout;
	}
	
	add_filter( 'pelicula_filter_sidebar_layout', 'pelicula_core_set_blog_single_sidebar_layout' );
}

if ( ! function_exists( 'pelicula_core_set_blog_single_custom_sidebar_name' ) ) {
	/**
	 * Function that return sidebar name
	 *
	 * @param $sidebar_name string
	 *
	 * @return string
	 */
	function pelicula_core_set_blog_single_custom_sidebar_name( $sidebar_name ) {
		
		if ( is_singular( 'post' ) ) {
			$option = pelicula_core_get_post_value_through_levels( 'qodef_blog_single_custom_sidebar' );
			
			if ( ! empty( $option ) ) {
				$sidebar_name = $option;
			}
			
			$meta_option = get_post_meta( get_the_ID(), 'qodef_page_custom_sidebar', true );
			
			if ( ! empty( $meta_option ) ) {
				$sidebar_name = $meta_option;
			}
		}
		
		return $sidebar_name;
	}
	
	add_filter( 'pelicula_filter_sidebar_name', 'pelicula_core_set_blog_single_custom_sidebar_name' );
}

if ( ! function_exists( 'pelicula_core_set_blog_single_sidebar_grid_gutter_classes' ) ) {
	/**
	 * Function that returns grid gutter classes
	 *
	 * @param $classes string
	 *
	 * @return string
	 */
	function pelicula_core_set_blog_single_sidebar_grid_gutter_classes( $classes ) {
		
		if ( is_singular( 'post' ) ) {
			$option = pelicula_core_get_post_value_through_levels( 'qodef_blog_single_sidebar_grid_gutter' );
			
			if ( ! empty( $option ) ) {
				$classes = 'qodef-gutter--' . esc_attr( $option );
			}
			
			$meta_option = get_post_meta( get_the_ID(), 'qodef_page_sidebar_grid_gutter', true );
			
			if ( ! empty( $meta_option ) ) {
				$classes = 'qodef-gutter--' . esc_attr( $meta_option );
			}
		}
		
		return $classes;
	}
	
	add_filter( 'pelicula_filter_grid_gutter_classes', 'pelicula_core_set_blog_single_sidebar_grid_gutter_classes' );
}

if ( ! function_exists( 'pelicula_core_enable_posts_order' ) ) {
	/**
	 * Function that enable page attributes options for blog single page
	 */
	function pelicula_core_enable_posts_order() {
		add_post_type_support( 'post', 'page-attributes' );
	}
	
	add_action( 'admin_init', 'pelicula_core_enable_posts_order' );
}

if ( ! function_exists( 'pelicula_core_set_blog_list_excerpt_length' ) ) {
	/**
	 * Function that set number of characters for excerpt on blog list page
	 *
	 * @param $excerpt_length int
	 *
	 * @return int
	 */
	function pelicula_core_set_blog_list_excerpt_length( $excerpt_length ) {
		$option = pelicula_core_get_post_value_through_levels( 'qodef_blog_list_excerpt_number_of_characters' );
		
		if ( $option !== '' ) {
			$excerpt_length = $option;
		}
		
		return $excerpt_length;
	}
	
	add_filter( 'pelicula_filter_blog_list_excerpt_length', 'pelicula_core_set_blog_list_excerpt_length' );
}

if ( ! function_exists( 'pelicula_core_get_allowed_pages_for_blog_sidebar_layout' ) ) {
	/**
	 * Function that return pages where blog sidebar is allowed
	 *
	 * @return bool
	 */
	function pelicula_core_get_allowed_pages_for_blog_sidebar_layout() {
		return ( is_archive() || ( is_home() && is_front_page() ) ) && get_post_type() === 'post';
	}
}

if ( ! function_exists( 'pelicula_core_set_blog_archive_sidebar_layout' ) ) {
	/**
	 * Function that return sidebar layout
	 *
	 * @param $layout string
	 *
	 * @return string
	 */
	function pelicula_core_set_blog_archive_sidebar_layout( $layout ) {
		
		if ( pelicula_core_get_allowed_pages_for_blog_sidebar_layout() ) {
			$option = pelicula_core_get_post_value_through_levels( 'qodef_blog_archive_sidebar_layout' );
			
			if ( ! empty( $option ) ) {
				$layout = $option;
			}
		}
		
		return $layout;
	}
	
	add_filter( 'pelicula_filter_sidebar_layout', 'pelicula_core_set_blog_archive_sidebar_layout' );
}

if ( ! function_exists( 'pelicula_core_set_blog_archive_custom_sidebar_name' ) ) {
	/**
	 * Function that return sidebar name
	 *
	 * @param $sidebar_name string
	 *
	 * @return string
	 */
	function pelicula_core_set_blog_archive_custom_sidebar_name( $sidebar_name ) {
		
		if ( pelicula_core_get_allowed_pages_for_blog_sidebar_layout() ) {
			$option = pelicula_core_get_post_value_through_levels( 'qodef_blog_archive_custom_sidebar' );
			
			if ( ! empty( $option ) ) {
				$sidebar_name = $option;
			}
		}
		
		return $sidebar_name;
	}
	
	add_filter( 'pelicula_filter_sidebar_name', 'pelicula_core_set_blog_archive_custom_sidebar_name' );
}

if ( ! function_exists( 'pelicula_core_set_blog_archive_sidebar_grid_gutter_classes' ) ) {
	/**
	 * Function that returns grid gutter classes
	 *
	 * @param $classes string
	 *
	 * @return string
	 */
	function pelicula_core_set_blog_archive_sidebar_grid_gutter_classes( $classes ) {
		
		if ( pelicula_core_get_allowed_pages_for_blog_sidebar_layout() ) {
			$option = pelicula_core_get_post_value_through_levels( 'qodef_blog_single_archive_grid_gutter' );
			
			if ( ! empty( $option ) ) {
				$classes = 'qodef-gutter--' . esc_attr( $option );
			}
		}
		
		return $classes;
	}
	
	add_filter( 'pelicula_filter_grid_gutter_classes', 'pelicula_core_set_blog_archive_sidebar_grid_gutter_classes' );
}

if ( ! function_exists( 'pelicula_core_blog_single_set_post_title_instead_of_page_title_text' ) ) {
	/**
	 * Function that set current post title text for single posts
	 *
	 * @param $title string
	 *
	 * @return string
	 */
	function pelicula_core_blog_single_set_post_title_instead_of_page_title_text( $title ) {
		$option = pelicula_core_get_option_value( 'admin', 'qodef_blog_single_set_post_title_in_title_area' );
		
		if ( is_singular( 'post' ) && $option === 'yes' ) {
			$title = get_the_title( qode_framework_get_page_id() );
		}
		
		return $title;
	}
	
	add_filter( 'pelicula_filter_page_title_text', 'pelicula_core_blog_single_set_post_title_instead_of_page_title_text' );
}

if ( ! function_exists( 'pelicula_core_get_blog_single_post_taxonomies' ) ) {
	/**
	 * Function that return single post taxonomies list
	 *
	 * @param $post_id int
	 *
	 * @return array
	 */
	function pelicula_core_get_blog_single_post_taxonomies( $post_id ) {
		$options = array();
		
		if ( ! empty( $post_id ) ) {
			$options['post_tag'] = get_the_tags( $post_id );
			$options['category'] = get_the_category( $post_id );
		}
		
		return $options;
	}
}

if ( ! function_exists( 'pelicula_add_blog_list_bottom_content' ) ) {
	/**
	 * Function which adds blog list bottom content
	 */
	function pelicula_add_blog_list_bottom_content( $params ) {

		if ( ! is_array( $params )) $params = array();

		$params = array_merge( array (
			'title'             => esc_html__( 'share', 'pelicula-core' ),
			'layout'            => 'dropdown',
			'dropdown_behavior' => 'bottom',
			'icon_font'         => 'elegant-icons'
		), $params );

		echo '<div class="qodef-e-info-item qodef-e-info-social-share">';

			echo PeliculaCoreSocialShareShortcode::call_shortcode( $params );

		echo '</div>';
	}

	add_action( 'pelicula_action_after_blog_list_bottom_content', 'pelicula_add_blog_list_bottom_content' );
}

if ( ! function_exists( 'pelicula_add_blog_single_bottom_right_content' ) ) {
	/**
	 * Function which adds blog single bottom right content
	 */
	function pelicula_add_blog_single_bottom_right_content( $params ) {

		if ( ! is_array( $params )) $params = array();

		$params = array_merge( array (
			'title'             => esc_html__( 'Share:', 'pelicula-core' ),
			'layout'            => 'list',
			'icon_font'         => 'elegant-icons'
		), $params );

		echo '<div class="qodef-e-info-item qodef-e-info-social-share">';

			echo PeliculaCoreSocialShareShortcode::call_shortcode( $params );

		echo '</div>';
	}

	add_action( 'pelicula_action_blog_single_bottom_right_content', 'pelicula_add_blog_single_bottom_right_content' );
}

if ( ! function_exists( 'get_the_modified_title' ) ) {
	/**
	 * Function that extends the native WP get_the_title function
	 */
	function get_the_modified_title( $post = 0 ) {
		$post = get_post( $post );

		$title = isset( $post->post_title ) ? $post->post_title : '';
		$id    = isset( $post->ID ) ? $post->ID : 0;

		$title_length              = strlen( $title );
		$title_custom_styled_chars = get_post_meta( $id, 'qodef_blog_list_title_custom_styled_chars', true );

		if ( ! empty( $title ) ) {
			$custom_styled_chars = explode( ',', str_replace( ' ', '', $title_custom_styled_chars ) );
			$custom_styled_chars = is_array( $custom_styled_chars ) ? array_filter( $custom_styled_chars ) : false;

			if ( $custom_styled_chars && count( $custom_styled_chars ) >= 2 ) {
				$start = intval( $custom_styled_chars[0] );
				$end   = intval( $custom_styled_chars[1] );

				if (
					$start >= 0 &&
					$start <= $title_length &&
					$end >= 0 &&
					$end <= $title_length &&
					$start <= $end
				) {
					$first_part  = substr( $title, 0, $start - 1 );
					$middle_part = '<span class="qodef-custom-styles">' . substr( $title, $start - 1, $end - $start + 1 ) . '</span>';
					$last_part   = substr( $title, $end );

					$title = $first_part . $middle_part . $last_part;
				}
			}
		}

		if ( ! is_admin() ) {
			if ( ! empty( $post->post_password ) ) {

				/* translators: %s: Protected post title. */
				$prepend = __( 'Protected: %s' );

				/**
				 * Filters the text prepended to the post title for protected posts.
				 *
				 * The filter is only applied on the front end.
				 *
				 * @since 2.8.0
				 *
				 * @param string $prepend Text displayed before the post title.
				 *                         Default 'Protected: %s'.
				 * @param WP_Post $post Current post object.
				 */
				$protected_title_format = apply_filters( 'protected_title_format', $prepend, $post );
				$title                  = sprintf( $protected_title_format, $title );
			} elseif ( isset( $post->post_status ) && 'private' == $post->post_status ) {

				/* translators: %s: Private post title. */
				$prepend = __( 'Private: %s' );

				/**
				 * Filters the text prepended to the post title of private posts.
				 *
				 * The filter is only applied on the front end.
				 *
				 * @since 2.8.0
				 *
				 * @param string $prepend Text displayed before the post title.
				 *                         Default 'Private: %s'.
				 * @param WP_Post $post Current post object.
				 */
				$private_title_format = apply_filters( 'private_title_format', $prepend, $post );
				$title                = sprintf( $private_title_format, $title );
			}
		}

		/**
		 * Filters the post title.
		 *
		 * @since 0.71
		 *
		 * @param string $title The post title.
		 * @param int $id The post ID.
		 */
		return apply_filters( 'the_title', $title, $id );
	}
}