<?php
$styles = array();
if ( ! empty( $info_below_content_margin_top ) ) {
	$margin_bottom = qode_framework_string_ends_with_space_units( $info_below_content_margin_top ) ? $info_below_content_margin_top : intval( $info_below_content_margin_top ) . 'px';
	$styles[] = 'margin-top:' . $margin_bottom;
}
$portfolio_list_video = get_post_meta( get_the_ID(), 'qodef_portfolio_list_video', true );
?>
<article <?php post_class( apply_filters( 'pelicula_filter_portfolio_post_classes', array( $item_classes, 'qodef-e-holder-main' ) ) ); ?>>
	<div class="qodef-e-inner" <?php qode_framework_inline_style( $this_shortcode->get_list_item_style( $params ) ) ?>>
		<div class="qodef-e-image-outer">
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
		</div>
		<div class="qodef-e-content qodef-e-content-main" <?php qode_framework_inline_style( $styles ); ?>>
			<?php pelicula_core_list_sc_template_part( 'post-types/portfolio/shortcodes/portfolio-list', 'post-info/title', '', $params ); ?>
			<?php pelicula_core_list_sc_template_part( 'post-types/portfolio/shortcodes/portfolio-list', 'post-info/category', '', $params ); ?>
		</div>
	</div>
</article>