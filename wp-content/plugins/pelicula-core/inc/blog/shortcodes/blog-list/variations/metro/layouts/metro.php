<article <?php post_class( $item_classes ); ?>>
	<div class="qodef-e-inner">
		<a itemprop="url" class="qodef-e-post-link" href="<?php the_permalink(); ?>"></a>
		<?php pelicula_core_template_part( 'blog/shortcodes/blog-list', 'templates/post-info/image', 'background', $params ); ?>
		<div class="qodef-e-content">
			<div class="qodef-e-info qodef-info--top">
				<?php
				// Include post date info
				pelicula_template_part( 'blog', 'templates/parts/post-info/date' );
				// Include post author info
				pelicula_template_part( 'blog', 'templates/parts/post-info/author' );
				// Include post category info
				pelicula_template_part( 'blog', 'templates/parts/post-info/category' );
				?>
			</div>
			<?php pelicula_core_template_part( 'blog/shortcodes/blog-list', 'templates/post-info/title', 'metro', $params ); ?>
			<?php if ( $enable_button === 'yes' || $enable_comments === 'yes' || $enable_social_share === 'yes' ) { ?>
				<div class="qodef-e-info qodef-info--bottom">
					<div class="qodef-e-info-full">
						<?php if ( $enable_button === 'yes' ) {
							pelicula_core_template_part( 'blog/shortcodes/blog-list', 'templates/post-info/read-more' );
						} if ( $enable_comments === 'yes' ) {
							pelicula_core_theme_template_part( 'blog', 'templates/parts/post-info/comments' );
						} if ( $enable_social_share === 'yes' ) {
							// Hook to include social share
							$social_share_layout_params = array();
							if ( isset( $params['columns'] ) && $params['columns'] == 1 ) {
								$social_share_layout_params = array( 'dropdown_behavior' => 'right' );
							}
							do_action( 'pelicula_action_after_blog_list_bottom_content', $social_share_layout_params );
						} ?>
					</div>
				</div>
			<?php  }?>
		</div>
	</div>
</article>