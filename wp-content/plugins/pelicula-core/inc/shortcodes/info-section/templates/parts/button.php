<?php
if( ! empty( $button_params ) && ! empty ( $button_params['text'] ) ) { ?>
	<div class="qodef-m-button">
		<?php echo PeliculaCoreButtonShortcode::call_shortcode( $button_params ); ?>
	</div>
<?php }