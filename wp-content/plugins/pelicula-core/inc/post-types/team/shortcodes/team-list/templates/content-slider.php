<div <?php qode_framework_class_attribute( $holder_classes ); ?> <?php qode_framework_inline_attr( $slider_attr, 'data-options' ); ?>>
	<div class="swiper-wrapper">
		<?php
		// Include items
		pelicula_core_template_part( 'post-types/team/shortcodes/team-list', 'templates/loop', '', $params );
		?>
	</div>
	<?php if ( $slider_navigation !== 'no' ) { ?>
		<div class="qodef-navigation">
			<div class="swiper-button-next">
				<span class="swiper-button-text"><?php esc_html_e( 'Next', 'pelicula-core' ); ?></span>
			</div>
			<div class="swiper-button-prev">
				<span class="swiper-button-text"><?php esc_html_e( 'Prev', 'pelicula-core' ); ?></span>
			</div>
		</div>
	<?php } ?>
	<?php if( $slider_pagination !== 'no' ) { ?>
		<div class="swiper-pagination"></div>
	<?php } ?>
</div>