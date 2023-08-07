<?php
$is_enabled = pelicula_core_get_post_value_through_levels( 'qodef_blog_single_enable_single_post_navigation' );

if ( $is_enabled === 'yes' ) {
	$through_same_category = pelicula_core_get_post_value_through_levels( 'qodef_blog_single_post_navigation_through_same_category' ) === 'yes';
	?>
	<div id="qodef-single-post-navigation" class="qodef-m">
		<div class="qodef-m-inner">
			<?php
			$post_navigation = array(
				'prev' => array(
					'label' => '<span class="qodef-m-nav-label">' . esc_html__( 'previous post', 'pelicula-core' ) . '</span>'
				),
				'next' => array(
					'label' => '<span class="qodef-m-nav-label">' . esc_html__( 'next post', 'pelicula-core' ) . '</span>'
				)
			);
			
			if ( $through_same_category ) {
				if ( get_previous_post( true ) !== '' ) {
					$post_navigation['prev']['post'] = get_previous_post( true );
				}
				if ( get_next_post( true ) !== '' ) {
					$post_navigation['next']['post'] = get_next_post( true );
				}
			} else {
				if ( get_previous_post() !== '' ) {
					$post_navigation['prev']['post'] = get_previous_post();
				}
				if ( get_next_post() !== '' ) {
					$post_navigation['next']['post'] = get_next_post();
				}
			}
			
			foreach ( $post_navigation as $key => $value ) {
				if ( isset( $post_navigation[ $key ]['post'] ) ) {
					$current_post = $value['post'];
					$post_id      = $current_post->ID;
					$thumb_id     = (int) get_post_thumbnail_id( $post_id );
					?>
					<a itemprop="url" class="qodef-m-nav qodef--<?php echo esc_attr( $key ); ?>" href="<?php echo get_permalink( $post_id ); ?>">
						<?php if ( has_post_thumbnail( $post_id ) ) { ?>
							<div class="qodef-post-image">
								<?php echo qode_framework_generate_thumbnail( $thumb_id, '112', '67' ); ?>
							</div>
						<?php } ?>

						<div class="qodef-title-label">
							<span itemprop="url" class="qodef-e-title-link" title="<?php the_title_attribute( array( 'post' => $post_id ) ); ?>">
								<?php echo get_the_title( $post_id ); ?>
							</span>
							<?php echo wp_kses( $value['label'], array( 'span' => array( 'class' => true ) ) ); ?>
						</div>
					</a>
				<?php }
			}
			?>
		</div>
	</div>
<?php } ?>