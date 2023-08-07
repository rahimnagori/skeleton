<div class="qodef-e qodef-info--social-share">
	<?php if ( class_exists( 'PeliculaCoreSocialShareShortcode' ) ) {
		$params = array(
			'title'  => esc_html__( 'Share:', 'pelicula-core' ),
			'layout' => 'list'
		);
		
		echo PeliculaCoreSocialShareShortcode::call_shortcode( $params );
	} ?>
</div>