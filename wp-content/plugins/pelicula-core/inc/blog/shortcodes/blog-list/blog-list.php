<?php

if ( ! function_exists( 'pelicula_core_add_blog_list_shortcode' ) ) {
	/**
	 * Function that isadding shortcode into shortcodes list for registration
	 *
	 * @param array $shortcodes - Array of registered shortcodes
	 *
	 * @return array
	 */
	function pelicula_core_add_blog_list_shortcode( $shortcodes ) {
		$shortcodes[] = 'PeliculaCoreBlogListShortcode';
		
		return $shortcodes;
	}
	
	add_filter( 'pelicula_core_filter_register_shortcodes', 'pelicula_core_add_blog_list_shortcode' );
}

if ( class_exists( 'PeliculaCoreListShortcode' ) ) {
	class PeliculaCoreBlogListShortcode extends PeliculaCoreListShortcode {
		
		public function __construct() {
			$this->set_post_type( 'post' );
			$this->set_post_type_taxonomy( 'category' );
			$this->set_post_type_additional_taxonomies( array( 'post_tag' ) );
			$this->set_layouts( apply_filters( 'pelicula_core_filter_blog_list_layouts', array() ) );
			$this->set_extra_options( apply_filters( 'pelicula_core_filter_blog_list_extra_options', array() ) );
			$this->set_hover_animation_options( apply_filters( 'pelicula_core_filter_blog_list_hover_animation_options', array() ) );
			
			parent::__construct();
		}
		
		public function map_shortcode() {
			$this->set_shortcode_path( PELICULA_CORE_INC_URL_PATH . '/blog/shortcodes/blog-list' );
			$this->set_base( 'pelicula_core_blog_list' );
			$this->set_name( esc_html__( 'Blog List', 'pelicula-core' ) );
			$this->set_description( esc_html__( 'Shortcode that displays list of blog posts', 'pelicula-core' ) );
			$this->set_category( esc_html__( 'Pelicula Core', 'pelicula-core' ) );
			$this->set_scripts(
				apply_filters('pelicula_core_filter_blog_list_register_scripts', array())
			);
			$this->set_necessary_styles(
				apply_filters('pelicula_core_filter_blog_list_register_styles', array())
			);
			$this->set_option( array(
				'field_type' => 'text',
				'name'       => 'custom_class',
				'title'      => esc_html__( 'Custom Class', 'pelicula-core' )
			) );
			$this->set_option( array(
				'field_type'    => 'select',
				'name'          => 'skin',
				'title'         => esc_html__( 'Skin', 'pelicula-core' ),
				'options'       => array(
					''      => esc_html__( 'Default', 'pelicula-core' ),
					'light' => esc_html__( 'Light', 'pelicula-core' ),
					'dark'  => esc_html__( 'Dark', 'pelicula-core' )
				),
				'default_value' => '',
			) );
			$this->map_list_options( array(
				'exclude_behavior' => array( 'justified-gallery' )
			) );
			$this->map_query_options();
			$this->map_layout_options( array(
				'layouts'          => $this->get_layouts(),
				'hover_animations' => $this->get_hover_animation_options()
			) );
			$this->set_option( array(
				'field_type' => 'text',
				'name'       => 'excerpt_length',
				'title'      => esc_html__( 'Excerpt Length', 'pelicula-core' ),
				'group'      => esc_html__( 'Layout', 'pelicula-core' )
			) );
			$this->set_option( array(
				'field_type'    => 'select',
				'name'          => 'title_custom_style',
				'title'         => esc_html__( 'Title Custom Style', 'pelicula-core' ),
				'options'       => pelicula_core_get_select_type_options_pool( 'no_yes', false ),
				'default_value' => 'no',
				'dependency' => array(
					'show' => array(
						'title_tag' => array(
							'values'        => 'p',
							'default_value' => 'h1'
						)
					)
				),
				'group'         => esc_html__( 'Layout', 'pelicula-core' )
			) );
			$this->set_option( array(
				'field_type' => 'text',
				'name'       => 'content_padding_bottom',
				'title'      => esc_html__( 'Content Bottom Padding (px or %)', 'pelicula-core' ),
				'dependency' => array(
					'show' => array(
						'layout' => array(
							'values'        => 'standard',
							'default_value' => 'metro'
						)
					)
				),
				'group'      => esc_html__( 'Layout', 'pelicula-core' )
			) );
			$this->map_additional_options();
			$this->map_extra_options();
		}
		
		public static function call_shortcode( $params ) {
			$html = qode_framework_call_shortcode( 'pelicula_core_blog_list', $params );
			$html = str_replace( "\n", '', $html );
			
			return $html;
		}
		
		public function load_assets() {
			parent::load_assets();
			
			$is_allowed = apply_filters( 'pelicula_core_filter_load_blog_list_assets', false, $this->get_atts() );
			
			if ( $is_allowed ) {
				wp_enqueue_style( 'wp-mediaelement' );
				wp_enqueue_script( 'wp-mediaelement' );
				wp_enqueue_script( 'mediaelement-vimeo' );
			}
		}
		
		public function render( $options, $content = null ) {
			parent::render( $options );
			
			$atts = $this->get_atts();

			$atts['post_type']       = $this->get_post_type();
			$atts['taxonomy_filter'] = $this->get_post_type_taxonomy();
			
			// Additional query args
			$atts['additional_query_args'] = $this->get_additional_query_args( $atts );
			
			$atts['holder_classes'] = $this->get_holder_classes( $atts );
			$atts['content_styles'] = $this->get_content_styles( $atts );
			$atts['query_result']   = new \WP_Query( pelicula_core_get_query_params( $atts ) );
			$atts['slider_attr']    = $this->get_slider_data( $atts );
			$atts['data_attr']      = pelicula_core_get_pagination_data( PELICULA_CORE_REL_PATH, 'blog/shortcodes', 'blog-list', 'post', $atts );
			
			$atts['this_shortcode'] = $this;
			
			return pelicula_core_get_template_part( 'blog/shortcodes/blog-list', 'templates/content', $atts['behavior'], $atts );
		}
		
		private function get_holder_classes( $atts ) {
			$holder_classes = $this->init_holder_classes();
			
			$holder_classes[] = 'qodef-blog';
			if ( ! empty( $atts['layout'] ) && $atts['layout'] == 'standard' ) {
				$holder_classes[] = 'qodef--list';
			}
			$holder_classes[] = ! empty( $atts['skin'] ) ? 'qodef-skin--' . $atts['skin'] : '';
			$holder_classes[] = ! empty( $atts['layout'] ) ? 'qodef-item-layout--' . $atts['layout'] : '';
			$holder_classes[] = $atts['title_custom_style'] === 'yes' ? 'qodef-title-style--custom' : '';

			$list_classes   = $this->get_list_classes( $atts );
			$holder_classes = array_merge( $holder_classes, $list_classes );
			
			return implode( ' ', $holder_classes );
		}

		private function get_content_styles( $atts ) {
			$styles = array();

			if ( $atts['content_padding_bottom'] !== '' ) {
				if ( qode_framework_string_ends_with_space_units( $atts['content_padding_bottom'] ) ) {
					$styles[] = 'padding-bottom: ' . $atts['content_padding_bottom'];
				} else {
					$styles[] = 'padding-bottom: ' . intval( $atts['content_padding_bottom'] ) . 'px';
				}
			}

			return $styles;
		}

		public function get_item_classes( $atts ) {
			$item_classes = $this->init_item_classes();
			
			$list_item_classes = $this->get_list_item_classes( $atts );
			
			$item_classes = array_merge( $item_classes, $list_item_classes );
			
			return implode( ' ', $item_classes );
		}

		public function get_title_styles( $atts ) {
			$styles = array();
			
			if ( ! empty( $atts['text_transform'] ) ) {
				$styles[] = 'text-transform: ' . $atts['text_transform'];
			}
			
			return $styles;
		}
	}
}