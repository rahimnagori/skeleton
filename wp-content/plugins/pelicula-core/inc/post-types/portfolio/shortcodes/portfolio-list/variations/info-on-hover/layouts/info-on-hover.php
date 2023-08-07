<?php $portfolio_list_video = get_post_meta( get_the_ID(), 'qodef_portfolio_list_video', true ); ?>
<article <?php post_class( $item_classes ); ?>>
	<div class="qodef-e-inner" <?php qode_framework_inline_style( $this_shortcode->get_list_item_style( $params ) ) ?>>
		<div class="qodef-e-image">
			<?php if ( $portfolio_list_video ) {
				pelicula_core_list_sc_template_part( 'post-types/portfolio/shortcodes/portfolio-list', 'post-info/image', 'video', $params );
				echo PeliculaCoreVideoButton::call_shortcode( array(
					'video_link' => esc_url( $portfolio_list_video )
				) );
			} else {
				pelicula_core_list_sc_template_part( 'post-types/portfolio/shortcodes/portfolio-list', 'post-info/image', '', $params );
			} ?>
		</div>
		<div class="qodef-e-content">
			<div class="qodef-e-content-inner">
				<?php if ( ! $portfolio_list_video ) { ?>
					<a itemprop="url" href="<?php echo pelicula_core_get_portfolio_link(); ?>" target="<?php echo pelicula_core_get_portfolio_link_target(); ?>"></a>
				<?php } ?>
				<?php pelicula_core_list_sc_template_part( 'post-types/portfolio/shortcodes/portfolio-list', 'post-info/title', '', $params ); ?>
				<?php pelicula_core_list_sc_template_part( 'post-types/portfolio/shortcodes/portfolio-list', 'post-info/category', '', $params ); ?>
			</div>
		</div>
	</div>
</article>