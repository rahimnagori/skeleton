<?php

if ( ! function_exists( 'pelicula_core_add_countdown_shortcode' ) ) {
	/**
	 * Function that add shortcode into shortcodes list for registration
	 *
	 * @param $shortcodes array
	 *
	 * @return array
	 */
	function pelicula_core_add_countdown_shortcode( $shortcodes ) {
		$shortcodes[] = 'PeliculaCoreCountdownShortcode';
		
		return $shortcodes;
	}
	
	add_filter( 'pelicula_core_filter_register_shortcodes', 'pelicula_core_add_countdown_shortcode' );
}

if ( class_exists( 'PeliculaCoreShortcode' ) ) {
	class PeliculaCoreCountdownShortcode extends PeliculaCoreShortcode {
		
		public function __construct() {
			$this->set_layouts( apply_filters( 'pelicula_core_filter_countdown_layouts', array() ) );
			
			parent::__construct();
		}
		
		public function map_shortcode() {
			$this->set_shortcode_path( PELICULA_CORE_SHORTCODES_URL_PATH . '/countdown' );
			$this->set_base( 'pelicula_core_countdown' );
			$this->set_name( esc_html__( 'Countdown', 'pelicula-core' ) );
			$this->set_description( esc_html__( 'Shortcode that displays countdown with provided parameters', 'pelicula-core' ) );
			$this->set_category( esc_html__( 'Pelicula Core', 'pelicula-core' ) );
			$this->set_scripts(
				array(
					'countdown' => array(
						'registered'	=> false,
						'url'			=> PELICULA_CORE_INC_URL_PATH . '/shortcodes/countdown/assets/js/plugins/jquery.countdown.min.js',
						'dependency'	=> array( 'jquery' )
					)
				)
			);


			$options_map = pelicula_core_get_variations_options_map( $this->get_layouts() );
			
			$this->set_option( array(
				'field_type'    => 'select',
				'name'          => 'layout',
				'title'         => esc_html__( 'Layout', 'pelicula-core' ),
				'options'       => $this->get_layouts(),
				'default_value' => $options_map['default_value'],
				'visibility'    => array( 'map_for_page_builder' => $options_map['visibility'] )
			) );
			$this->set_option( array(
				'field_type' => 'text',
				'name'       => 'custom_class',
				'title'      => esc_html__( 'Custom Class', 'pelicula-core' ),
			) );
			$this->set_option( array(
				'field_type'  => 'date',
				'name'        => 'date',
				'title'       => esc_html__( 'Date', 'pelicula-core' ),
				'description' => esc_html__( 'Format: YYYY/mm/dd', 'pelicula-core' )
			) );
			$this->set_option( array(
				'field_type' => 'text',
				'name'       => 'date_hour',
				'title'      => esc_html__( 'Hour', 'pelicula-core' )
			) );
			$this->set_option( array(
				'field_type' => 'text',
				'name'       => 'date_minute',
				'title'      => esc_html__( 'Minute', 'pelicula-core' )
			) );
			$this->set_option( array(
				'field_type' => 'text',
				'name'       => 'week_label',
				'title'      => esc_html__( 'Week Label', 'pelicula-core' )
			) );
			$this->set_option( array(
				'field_type' => 'text',
				'name'       => 'week_label_plural',
				'title'      => esc_html__( 'Week Label Plural', 'pelicula-core' )
			) );
			$this->set_option( array(
				'field_type' => 'text',
				'name'       => 'day_label',
				'title'      => esc_html__( 'Day Label', 'pelicula-core' )
			) );
			$this->set_option( array(
				'field_type' => 'text',
				'name'       => 'day_label_plural',
				'title'      => esc_html__( 'Day Label Plural', 'pelicula-core' )
			) );
			$this->set_option( array(
				'field_type' => 'text',
				'name'       => 'hour_label',
				'title'      => esc_html__( 'Hour Label', 'pelicula-core' )
			) );
			$this->set_option( array(
				'field_type' => 'text',
				'name'       => 'hour_label_plural',
				'title'      => esc_html__( 'Hour Label Plural', 'pelicula-core' )
			) );
			$this->set_option( array(
				'field_type' => 'text',
				'name'       => 'minute_label',
				'title'      => esc_html__( 'Minute Label', 'pelicula-core' )
			) );
			$this->set_option( array(
				'field_type' => 'text',
				'name'       => 'minute_label_plural',
				'title'      => esc_html__( 'Minute Label Plural', 'pelicula-core' )
			) );
			$this->set_option( array(
				'field_type' => 'text',
				'name'       => 'second_label',
				'title'      => esc_html__( 'Second Label', 'pelicula-core' )
			) );
			$this->set_option( array(
				'field_type' => 'text',
				'name'       => 'second_label_plural',
				'title'      => esc_html__( 'Second Label Plural', 'pelicula-core' )
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
		}
		
		public function load_assets() {
			wp_enqueue_script( 'countdown');
		}
		
		public function render( $options, $content = null ) {
			parent::render( $options );
			$atts = $this->get_atts();
			
			$atts['data_attrs']     = $this->get_data_attrs( $atts );
			$atts['holder_classes'] = $this->get_holder_classes( $atts );
			
			return pelicula_core_get_template_part( 'shortcodes/countdown', 'variations/' . $atts['layout'] . '/templates/countdown', '', $atts );
		}
		
		private function get_holder_classes( $atts ) {
			$holder_classes = $this->init_holder_classes();
			
			$holder_classes[] = 'qodef-countdown';
			$holder_classes[] = 'qodef-show--5';
			
			$holder_classes[] = ! empty( $atts['skin'] ) ? 'qodef-countdown--' . $atts['skin'] : '';
			$holder_classes[] = ! empty( $atts['layout'] ) ? 'qodef-layout--' . $atts['layout'] : '';
			
			return implode( ' ', $holder_classes );
		}
		
		private function get_data_attrs( $atts ) {
			$data = array();
			
			if ( ! empty( $atts['date'] ) ) {
				$date = $atts['date'];
				$date_formatted = date( 'Y/m/d', strtotime( $date) );
				$hour = ! empty ( $atts['date_hour'] ) ? $atts['date_hour'] : '00';
				$minute = ! empty ( $atts['date_minute'] ) ? $atts['date_minute'] : '00';
				$date = $date_formatted . ' ' . $hour . ':' . $minute . ':00';
				$data['data-date'] = $date;
			}
			
			$date_formats = array(
				'week' => array(
					'default' => esc_html__( 'Week', 'pelicula-core' ),
					'plural'  => esc_html__( 'Weeks', 'pelicula-core' )
				),
				'day' => array(
					'default' => esc_html__( 'Day', 'pelicula-core' ),
					'plural'  => esc_html__( 'Days', 'pelicula-core' )
				),
				'hour' => array(
					'default' => esc_html__( 'Hour', 'pelicula-core' ),
					'plural'  => esc_html__( 'Hours', 'pelicula-core' )
				),
				'minute' => array(
					'default' => esc_html__( 'Minute', 'pelicula-core' ),
					'plural'  => esc_html__( 'Minutes', 'pelicula-core' )
				),
				'second' => array(
					'default' => esc_html__( 'Second', 'pelicula-core' ),
					'plural'  => esc_html__( 'Seconds', 'pelicula-core' )
				),
			);
			
			foreach ( $date_formats as $key => $value ) {
				if ( ! empty( $atts[ $key . '_label' ] ) ) {
					$data[ 'data-' . $key . '-label' ] = $atts[ $key . '_label' ];
				} else {
					$data[ 'data-' . $key . '-label' ] = $value['default'];
				}
				
				if ( ! empty( $atts[ $key . '_label_plural' ] ) ) {
					$data[ 'data-' . $key . '-label-plural' ] = $atts[ $key . '_label_plural' ];
				} else {
					$data[ 'data-' . $key . '-label-plural' ] = $value['plural'];
				}
			}
			
			return $data;
		}
	}
}