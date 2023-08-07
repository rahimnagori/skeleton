<article <?php post_class( apply_filters( 'pelicula_filter_blog_post_classes', array( $item_classes, 'qodef-e-holder-main' ) ) ); ?>>
	<div class="qodef-e-inner">
		<?php
		// Include post media
		pelicula_core_theme_template_part( 'blog', 'templates/parts/post-info/media' );
		?>
		<div class="qodef-e-content qodef-e-content-main" <?php qode_framework_inline_style( $content_styles ); ?>>
			<div class="qodef-e-text">
				<?php // Include post title
				pelicula_core_template_part( 'blog/shortcodes/blog-list', 'templates/post-info/title', '', $params ); ?>

				<div class="qodef-e-info qodef-info--top">
					<?php
					// Include post date info
					pelicula_core_theme_template_part( 'blog', 'templates/parts/post-info/date' );
					// Include post category info
					pelicula_core_theme_template_part( 'blog', 'templates/parts/post-info/category' );
					// Include post author info
					pelicula_core_theme_template_part( 'blog', 'templates/parts/post-info/author' );
					?>
				</div>

				<?php
				// Include post excerpt
				if ( $enable_excerpt === 'yes' ) {
					pelicula_core_theme_template_part( 'blog', 'templates/parts/post-info/excerpt', '', $params );
				}

				// Hook to include additional content after blog single content
				do_action( 'pelicula_action_after_blog_single_content' );
				?>
			</div>
			<div class="qodef-e-info qodef-info--bottom">
				<div class="qodef-e-info-full">
					<?php
					// Include post read more
					pelicula_core_theme_template_part( 'blog', 'templates/parts/post-info/read-more' );
					// Include post comments
					if ( $enable_comments === 'yes' ) {
						pelicula_core_theme_template_part( 'blog', 'templates/parts/post-info/comments' );
					}
					// Hook to include social share
					if ( $enable_social_share === 'yes' ) {
						$social_share_layout_params = array();
						if ( isset( $params['columns'] ) && $params['columns'] == 1 ) {
							$social_share_layout_params = array( 'dropdown_behavior' => 'right' );
						}
						do_action( 'pelicula_action_after_blog_list_bottom_content', $social_share_layout_params );
					}
					?>
				</div>
			</div>
		</div>
	</div>
</article>