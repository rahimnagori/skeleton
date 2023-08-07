<?php
$is_enabled = pelicula_core_get_post_value_through_levels( 'qodef_portfolio_enable_navigation' );

if ( $is_enabled === 'yes' ) {
	$nav_in_grid           = pelicula_core_get_post_value_through_levels( 'qodef_portfolio_single_navigation_in_grid' ) === 'yes';
	$through_same_category = pelicula_core_get_post_value_through_levels( 'qodef_portfolio_navigation_through_same_category' ) === 'yes';
	?>
	<div id="qodef-single-portfolio-navigation" class="qodef-m">
		<div class="qodef-m-inner <?php if ( $nav_in_grid ) echo esc_attr('qodef-content-grid'); ?>">
			<?php
			$post_navigation = array(
				'prev'      => array(
					'label' => '<span class="qodef-m-nav-label">' . esc_html__( 'Previous', 'pelicula-core' ) . '</span>'
				),
				'back-link' => array(),
				'next'      => array(
					'label' => '<span class="qodef-m-nav-label">' . esc_html__( 'Next', 'pelicula-core' ) . '</span>'
				)
			);
			
			if ( $through_same_category ) {
				if ( get_adjacent_post( true, '', true, 'portfolio-category' ) !== '' ) {
					$post_navigation['prev']['post'] = get_adjacent_post( true, '', true, 'portfolio-category' );
				}
				if ( get_adjacent_post( true, '', false, 'portfolio-category' ) !== '' ) {
					$post_navigation['next']['post'] = get_adjacent_post( true, '', false, 'portfolio-category' );
				}
			} else {
				if ( get_adjacent_post( false, '', true ) !== '' ) {
					$post_navigation['prev']['post'] = get_adjacent_post( false, '', true );
				}
				if ( get_adjacent_post( false, '', false ) !== '' ) {
					$post_navigation['next']['post'] = get_adjacent_post( false, '', false );
				}
			}
			
			$back_to_link = get_post_meta( get_the_ID(), 'qodef_portfolio_single_back_to_link', true );
			if ( $back_to_link !== '' ) {
				$post_navigation['back-link'] = array(
					'post'    => true,
					'post_id' => $back_to_link,
					'icon'    => qode_framework_icons()->render_icon( 'icon_grid-2x2', 'elegant-icons', array( 'icon_attributes' => array( 'class' => 'qodef-m-nav-icon' ) ) )
				);
			}
			
			foreach ( $post_navigation as $key => $value ) {
				if ( isset( $post_navigation[ $key ]['post'] ) ) {
					$current_post = $value['post'];
					$post_id      = isset( $value['post_id'] ) && ! empty( $value['post_id'] ) ? $value['post_id'] : $current_post->ID;
					$thumb_id     = (int) get_post_thumbnail_id( $post_id );
					if ( $key === 'back-link' ) { ?>
						<a itemprop="url" class="qodef-m-nav qodef--<?php echo esc_attr( $key ); ?>" href="<?php echo esc_url( get_permalink( $post_id ) ); ?>">
							<?php if ( ! empty( $value['icon'] ) ) {
								echo wp_kses( $value['icon'], array( 'span' => array( 'class' => true ) ) );
							} ?>
						</a>
					<?php } else { ?>
						<a itemprop="url" class="qodef-m-nav qodef--<?php echo esc_attr( $key ); ?>"
						   href="<?php echo esc_url( get_permalink( $post_id ) ); ?>">
							<?php if ( has_post_thumbnail( $post_id ) ) { ?>
								<div class="qodef-post-image">
									<?php echo qode_framework_generate_thumbnail( $thumb_id, '144', '80' ); ?>
								</div>
							<?php } ?>

							<div class="qodef-title-label">
								<h4 itemprop="url" class="qodef-e-title-link"
								      title="<?php the_title_attribute( array( 'post' => $post_id ) ); ?>">
									<?php echo get_the_title( $post_id ); ?>
								</h4>
								<?php echo wp_kses( $value['label'], array( 'span' => array( 'class' => true ) ) ); ?>
							</div>
						</a>
				<?php }
				}
			}
			?>
		</div>
	</div>
<?php } ?>