<?php

if ( ! function_exists( 'pelicula_core_add_fonts_options' ) ) {
	/**
	 * Function that add options for this module
	 */
	function pelicula_core_add_fonts_options() {
		$qode_framework = qode_framework_get_framework_root();

		$page = $qode_framework->add_options_page(
			array(
				'scope'       => PELICULA_CORE_OPTIONS_NAME,
				'type'        => 'admin',
				'slug'        => 'fonts',
				'title'       => esc_html__( 'Fonts', 'pelicula-core' ),
				'description' => esc_html__( 'Global Fonts Options', 'pelicula-core' ),
				'icon'        => 'fa fa-cog'
			)
		);

		if ( $page ) {
			$page->add_field_element(
				array(
					'field_type'    => 'yesno',
					'name'          => 'qodef_enable_google_fonts',
					'title'         => esc_html__( 'Enable Google Fonts', 'pelicula-core' ),
					'default_value' => 'yes',
					'args'          => array(
						'custom_class' => 'qodef-enable-google-fonts'
					)
				)
			);

			$google_fonts_section = $page->add_section_element(
				array(
					'name'       => 'qodef_google_fonts_section',
					'title'      => esc_html__( 'Google Fonts Options', 'pelicula-core' ),
					'dependency' => array(
						'show' => array(
							'qodef_enable_google_fonts' => array(
								'values'        => 'yes',
								'default_value' => ''
							)
						)
					)
				)
			);

			$page_repeater = $google_fonts_section->add_repeater_element(
				array(
					'name'        => 'qodef_choose_google_fonts',
					'title'       => esc_html__( 'Google Fonts to Include', 'pelicula-core' ),
					'description' => esc_html__( 'Choose Google Fonts which you want to use on your website', 'pelicula-core' ),
					'button_text' => esc_html__( 'Add New Google Font', 'pelicula-core' )
				)
			);

			$page_repeater->add_field_element( array(
				'field_type'  => 'googlefont',
				'name'        => 'qodef_choose_google_font',
				'title'       => esc_html__( 'Google Font', 'pelicula-core' ),
				'description' => esc_html__( 'Choose Google Font', 'pelicula-core' ),
				'args'        => array(
					'include' => 'google-fonts'
				)
			) );

			$google_fonts_section->add_field_element(
				array(
					'field_type'  => 'checkbox',
					'name'        => 'qodef_google_fonts_weight',
					'title'       => esc_html__( 'Google Fonts Weight', 'pelicula-core' ),
					'description' => esc_html__( 'Choose a default Google Fonts weights for your website. Impact on page load time', 'pelicula-core' ),
					'options'     => array(
						'100'  => esc_html__( '100 Thin', 'pelicula-core' ),
						'100i' => esc_html__( '100 Thin Italic', 'pelicula-core' ),
						'200'  => esc_html__( '200 Extra-Light', 'pelicula-core' ),
						'200i' => esc_html__( '200 Extra-Light Italic', 'pelicula-core' ),
						'300'  => esc_html__( '300 Light', 'pelicula-core' ),
						'300i' => esc_html__( '300 Light Italic', 'pelicula-core' ),
						'400'  => esc_html__( '400 Regular', 'pelicula-core' ),
						'400i' => esc_html__( '400 Regular Italic', 'pelicula-core' ),
						'500'  => esc_html__( '500 Medium', 'pelicula-core' ),
						'500i' => esc_html__( '500 Medium Italic', 'pelicula-core' ),
						'600'  => esc_html__( '600 Semi-Bold', 'pelicula-core' ),
						'600i' => esc_html__( '600 Semi-Bold Italic', 'pelicula-core' ),
						'700'  => esc_html__( '700 Bold', 'pelicula-core' ),
						'700i' => esc_html__( '700 Bold Italic', 'pelicula-core' ),
						'800'  => esc_html__( '800 Extra-Bold', 'pelicula-core' ),
						'800i' => esc_html__( '800 Extra-Bold Italic', 'pelicula-core' ),
						'900'  => esc_html__( '900 Ultra-Bold', 'pelicula-core' ),
						'900i' => esc_html__( '900 Ultra-Bold Italic', 'pelicula-core' )
					)
				)
			);

			$google_fonts_section->add_field_element(
				array(
					'field_type'  => 'checkbox',
					'name'        => 'qodef_google_fonts_subset',
					'title'       => esc_html__( 'Google Fonts Style', 'pelicula-core' ),
					'description' => esc_html__( 'Choose a default Google Fonts style for your website. Impact on page load time', 'pelicula-core' ),
					'options'     => array(
						'latin'        => esc_html__( 'Latin', 'pelicula-core' ),
						'latin-ext'    => esc_html__( 'Latin Extended', 'pelicula-core' ),
						'cyrillic'     => esc_html__( 'Cyrillic', 'pelicula-core' ),
						'cyrillic-ext' => esc_html__( 'Cyrillic Extended', 'pelicula-core' ),
						'greek'        => esc_html__( 'Greek', 'pelicula-core' ),
						'greek-ext'    => esc_html__( 'Greek Extended', 'pelicula-core' ),
						'vietnamese'   => esc_html__( 'Vietnamese', 'pelicula-core' )
					)
				)
			);

			$page_repeater = $page->add_repeater_element(
				array(
					'name'        => 'qodef_custom_fonts',
					'title'       => esc_html__( 'Custom Fonts', 'pelicula-core' ),
					'description' => esc_html__( 'Add custom fonts', 'pelicula-core' ),
					'button_text' => esc_html__( 'Add New Custom Font', 'pelicula-core' )
				)
			);

			$page_repeater->add_field_element( array(
				'field_type' => 'file',
				'name'       => 'qodef_custom_font_ttf',
				'title'      => esc_html__( 'Custom Font TTF', 'pelicula-core' ),
				'args'       => array(
					'allowed_type' => 'application/octet-stream'
				)
			) );

			$page_repeater->add_field_element( array(
				'field_type' => 'file',
				'name'       => 'qodef_custom_font_otf',
				'title'      => esc_html__( 'Custom Font OTF', 'pelicula-core' ),
				'args'       => array(
					'allowed_type' => 'application/octet-stream'
				)
			) );

			$page_repeater->add_field_element( array(
				'field_type' => 'file',
				'name'       => 'qodef_custom_font_woff',
				'title'      => esc_html__( 'Custom Font WOFF', 'pelicula-core' ),
				'args'       => array(
					'allowed_type' => 'application/octet-stream'
				)
			) );

			$page_repeater->add_field_element( array(
				'field_type' => 'file',
				'name'       => 'qodef_custom_font_woff2',
				'title'      => esc_html__( 'Custom Font WOFF2', 'pelicula-core' ),
				'args'       => array(
					'allowed_type' => 'application/octet-stream'
				)
			) );

			$page_repeater->add_field_element( array(
				'field_type' => 'text',
				'name'       => 'qodef_custom_font_name',
				'title'      => esc_html__( 'Custom Font Name', 'pelicula-core' ),
			) );

			// Hook to include additional options after module options
			do_action( 'pelicula_core_action_after_page_fonts_options_map', $page );
		}
	}

	add_action( 'pelicula_core_action_default_options_init', 'pelicula_core_add_fonts_options', pelicula_core_get_admin_options_map_position( 'fonts' ) );
}