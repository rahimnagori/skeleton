<?php if ( ! post_password_required() ) { ?>
	<div class="qodef-e-read-more">
		<?php
		$button_params = array(
			'custom_class'  => 'qodef-layout--custom',
			'link'          => pelicula_core_get_portfolio_link(),
			'target'        => pelicula_core_get_portfolio_link_target(),
			'button_layout' => 'textual',
			'text'          => esc_html__( 'Read More', 'pelicula-core' )
		);

		pelicula_render_button_element( $button_params ); ?>
	</div>
<?php } ?>