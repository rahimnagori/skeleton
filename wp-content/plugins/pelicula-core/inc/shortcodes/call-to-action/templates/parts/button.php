<?php
if( ! empty( $button_params ) ) { ?>
	<div class="qodef-m-button">
		<?php echo PeliculaCoreButtonShortcode::call_shortcode( $button_params ); ?>
	</div>
<?php }