<?php if ( ! empty( $tagline ) ) { ?>
	<<?php echo esc_attr( $tagline_tag ); ?> class="qodef-m-tagline" <?php qode_framework_inline_style( $tagline_styles ); ?>>
		<?php echo wp_kses_post( $tagline ); ?>
	</<?php echo esc_attr( $tagline_tag ); ?>>
<?php } ?>