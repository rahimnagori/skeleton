<?php if ( class_exists( 'PeliculaCoreSocialShareShortcode' ) ) { ?>
	<div class="qodef-woo-product-social-share">
		<?php
		$params = array();
		$params['title'] = esc_html__( 'Share:', 'pelicula-core' );
		
		echo PeliculaCoreSocialShareShortcode::call_shortcode( $params ); ?>
	</div>
<?php } ?>