<?php

if ( ! function_exists( 'pelicula_core_add_horizontal_timeline_shortcode' ) ) {
	/**
	 * Function that add shortcode into shortcodes list for registration
	 *
	 * @param $shortcodes array
	 *
	 * @return array
	 */
	function pelicula_core_add_horizontal_timeline_shortcode( $shortcodes ) {
		$shortcodes[] = 'PeliculaCoreHorizontalTimelineShortcode';
		
		return $shortcodes;
	}
	
	add_filter( 'pelicula_core_filter_register_shortcodes', 'pelicula_core_add_horizontal_timeline_shortcode' );
}

if ( class_exists( 'PeliculaCoreShortcode' ) ) {
	class PeliculaCoreHorizontalTimelineShortcode extends PeliculaCoreShortcode {
		
		public function map_shortcode() {
			$this->set_shortcode_path( PELICULA_CORE_SHORTCODES_URL_PATH . '/horizontal-timeline' );
			$this->set_base( 'pelicula_core_horizontal_timeline' );
			$this->set_name( esc_html__( 'Horizontal Timeline', 'pelicula-core' ) );
			$this->set_description( esc_html__( 'Shortcode that adds horizontal timeline element', 'pelicula-core' ) );
			$this->set_category( esc_html__( 'Pelicula Core', 'pelicula-core' ) );
			$this->set_option( array(
				'field_type' => 'text',
				'name'       => 'custom_class',
				'title'      => esc_html__( 'Custom Class', 'pelicula-core' ),
			) );
			$this->set_option( array(
				'field_type'    => 'select',
				'name'          => 'timeline_format',
				'title'         => esc_html__( 'Timeline Format', 'pelicula-core' ),
				'options'       => array(
					''         => esc_html__( 'Default', 'pelicula-core' ),
					'Y'        => esc_html__( 'Only Years', 'pelicula-core' ),
					'M Y'      => esc_html__( 'Years and Months', 'pelicula-core' ),
					'M d, \'y' => esc_html__( 'Years, Months and Days', 'pelicula-core' ),
					'M d'      => esc_html__( 'Months and Days', 'pelicula-core' )
				),
				'default_value' => 'Y',
			) );
			$this->set_option( array(
				'field_type'    => 'text',
				'name'          => 'distance',
				'title'         => esc_html__( 'Minimal Distance Between Dates', 'pelicula-core' ),
				'description'   => esc_html__( 'Default value is 60', 'pelicula-core' ),
				'default_value' => '60'
			) );
			$this->set_option( array(
				'field_type' => 'repeater',
				'name'       => 'children',
				'title'      => esc_html__( 'Horizontal Timeline Items', 'pelicula-core' ),
				'items'   => array(
					array(
						'field_type'  => 'text',
						'name'        => 'date',
						'title'       => esc_html__( 'Timeline Date', 'pelicula-core' ),
						'description' => esc_html__( 'Enter date in format dd/mm/yyyy.', 'pelicula-core' )
					),
					array(
						'field_type' => 'image',
						'name'       => 'content_image',
						'title'      => esc_html__( 'Content Image', 'pelicula-core' ),
					),
					array(
						'field_type' => 'text',
						'name'       => 'content_title',
						'title'      => esc_html__( 'Title', 'pelicula-core' ),
					),
					array(
						'field_type'    => 'select',
						'name'          => 'content_title_tag',
						'title'         => esc_html__( 'Title Tag', 'pelicula-core' ),
						'options'       => pelicula_core_get_select_type_options_pool( 'title_tag', false ),
						'default_value' => 'h3'
					),
					array(
						'field_type' => 'textarea',
						'name'       => 'content_text',
						'title'      => esc_html__( 'Text', 'pelicula-core' ),
					),
					array(
						'field_type' => 'text',
						'name'       => 'content_button_link',
						'title'      => esc_html__( 'Button Link', 'pelicula-core' ),
					),
					array(
						'field_type' => 'text',
						'name'       => 'content_button_text',
						'title'      => esc_html__( 'Button Text', 'pelicula-core' ),
					),
					array(
						'field_type' => 'select',
						'name'       => 'content_button_target',
						'title'      => esc_html__( 'Button Target', 'pelicula-core' ),
						'options'    => pelicula_core_get_select_type_options_pool( 'link_target', false )
					)
				)
			) );
			$this->set_option( array(
				'field_type' => 'select',
				'name'       => 'skin',
				'title'      => esc_html__( 'Skin', 'pelicula-core' ),
				'options'    => array(
					''      => esc_html__( 'Default', 'pelicula-core' ),
					'light' => esc_html__( 'Light', 'pelicula-core' )
				)
			) );
			$this->set_option( array(
				'field_type' => 'select',
				'name'       => 'autoplay',
				'title'      => esc_html__( 'Enable Autoplay', 'pelicula-core' ),
				'options'    => pelicula_core_get_select_type_options_pool( 'yes_no', false ),
			) );
		}
		
		public function render( $options, $content = null ) {
			parent::render( $options );
			$atts = $this->get_atts();

			$atts['holder_classes'] = $this->get_holder_classes( $atts );
			$atts['items']          = $this->parse_repeater_items( $atts['children'] );
			$atts['dates']          = $this->getDates( $atts['items'], $atts['timeline_format'] );
			$atts['this_object']    = $this;

			return pelicula_core_get_template_part( 'shortcodes/horizontal-timeline', 'templates/horizontal-timeline', '', $atts );
		}
		
		private function get_holder_classes( $atts ) {
			$holder_classes = $this->init_holder_classes();
			
			$holder_classes[] = 'qodef-horizontal-timeline';
			$holder_classes[] = ! empty( $atts['skin'] ) ? 'qodef-skin--'.esc_attr( $atts['skin'] ) : '';
			$holder_classes[] = $atts['autoplay'] === 'yes' ? 'qodef-autoplay--enabled' : '';
			
			return implode( ' ', $holder_classes );
		}

		private function getDates( $items, $timeline_format ) {
			$dates_array = array();

			foreach ( $items as $item ) {

				if ( array_key_exists( 'date', $item ) ) {

					$date      = new \DateTime( str_replace( '/', '-', $item['date'] ) );
					$date_info = getdate( $date->getTimestamp() );

					switch ( $date_info['month'] ) {
						case 'January':
							$month = esc_attr__( 'Jan', 'pelicula-core' );
							break;
						case 'February':
							$month = esc_attr__( 'Feb', 'pelicula-core' );
							break;
						case 'March':
							$month = esc_attr__( 'Mar', 'pelicula-core' );
							break;
						case 'April':
							$month = esc_attr__( 'Apr', 'pelicula-core' );
							break;
						case 'May':
							$month = esc_attr__( 'May', 'pelicula-core' );
							break;
						case 'June':
							$month = esc_attr__( 'Jun', 'pelicula-core' );
							break;
						case 'July':
							$month = esc_attr__( 'Jul', 'pelicula-core' );
							break;
						case 'August':
							$month = esc_attr__( 'Aug', 'pelicula-core' );
							break;
						case 'September':
							$month = esc_attr__( 'Sep', 'pelicula-core' );
							break;
						case 'October':
							$month = esc_attr__( 'Oct', 'pelicula-core' );
							break;
						case 'November':
							$month = esc_attr__( 'Nov', 'pelicula-core' );
							break;
						case 'December':
							$month = esc_attr__( 'Dec', 'pelicula-core' );
							break;
						default:
							$month = $date_info['month'];
							break;
					}

					switch ( $timeline_format ) {
						case 'Y':
							$date_label = $date_info['year'];
							break;
						case 'M Y':
							$date_label = $month . ' ' . $date_info['year'];
							break;
						case 'M d, \'y':
							$date_label = $month . ' ' . $date_info['mday'] . ', ' . $date_info['year'];
							break;
						case 'M d':
							$date_label = $month . ' ' . $date_info['mday'];
							break;
						default:
							$date_label = $date_info['year'];
							break;
					}

					$current_date = array(
						'formatted'  => $item['date'],
						'date_label' => $date_label
					);

					$dates_array[] = $current_date;
				}
			}

			return $dates_array;
		}

		public function getItemClasses( $item ) {
			$itemClasses = array();

			$itemClasses[] = ! empty( $item['content_image'] ) ? 'qodef-timeline-has-image' : 'qodef-timeline-no-image';

			return implode( ' ', $itemClasses );
		}
	}
}