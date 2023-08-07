<div <?php qode_framework_class_attribute( $holder_classes ); ?> <?php qode_framework_inline_style( $holder_styles ); ?>>
	
	<div class="qodef-m-bg-image" <?php qode_framework_inline_style( $this_shortcode->get_image_styles( $bg_image ) ); ?>>
		<?php echo wp_get_attachment_image( $bg_image, 'full' ); ?>
	</div>
	
	<div class="qodef-m-items">
		<?php foreach ( $items as $item ) { ?>
				<a itemprop="url" class="qodef-m-item qodef-e" href="javascript:void(0)" target="<?php echo esc_attr( $link_target ); ?>">
					<span class="qodef-e-title"><?php echo esc_html( $item['item_title'] ); ?></span>
				</a>
		<?php } ?>
	</div>
	<div class="qodef-m-images">
		<div class="qodef-m-images-mark"></div>
		<?php foreach ( $items as $item ) { ?>
			<div class="qodef-m-image" <?php qode_framework_inline_style( $this_shortcode->get_image_styles( $item['item_image'] ) ); ?>>
				<?php if (!empty($item['item_link'])) {
					echo PeliculaCoreVideoButton::call_shortcode( array(
						'video_link' => esc_url( $item['item_link'] )
					) );
				} ?>
			</div>
		<?php } ?>
	</div>
	<div class="qodef-mobile-holder">
		<?php foreach ( $items as $item ) { ?>
			<div class="qodef-m-mobile-item">
				<div class="qodef-mobile-image-holder">
					<?php echo wp_get_attachment_image( $item['item_image'], 'full' ); ?>
					<?php if (!empty($item['item_link'])) {
						echo PeliculaCoreVideoButton::call_shortcode( array(
							'video_link' => esc_url( $item['item_link'] )
						) );
					} ?>
				</div>
				<div class="qodef-e-title"><?php echo esc_html( $item['item_title'] ); ?></div>
			</div>
		<?php } ?>
	</div>
</div>