<?php

if ( ! function_exists( 'pelicula_core_add_author_info_widget' ) ) {
	/**
	 * Function that add widget into widgets list for registration
	 *
	 * @param $widgets array
	 *
	 * @return array
	 */
	function pelicula_core_add_author_info_widget( $widgets ) {
		$widgets[] = 'PeliculaCoreAuthorInfoWidget';
		
		return $widgets;
	}
	
	add_filter( 'pelicula_core_filter_register_widgets', 'pelicula_core_add_author_info_widget' );
}

if ( class_exists( 'QodeFrameworkWidget' ) ) {
	class PeliculaCoreAuthorInfoWidget extends QodeFrameworkWidget {
		
		public function map_widget() {
			$this->set_base( 'pelicula_core_author_info' );
			$this->set_name( esc_html__( 'Pelicula Author Info', 'pelicula-core' ) );
			$this->set_description( esc_html__( 'Add author info element into widget areas', 'pelicula-core' ) );
			$this->set_widget_option(
				array(
					'field_type' => 'text',
					'name'       => 'author_username',
					'title'      => esc_html__( 'Author Username', 'pelicula-core' )
				)
			);
		}
		
		public function render( $atts ) {
			$author_id = 1;
			if ( ! empty( $atts['author_username'] ) ) {
				$author = get_user_by( 'login', $atts['author_username'] );
				
				if ( ! empty( $author ) ) {
					$author_id = $author->ID;
				}
			}

			$author_link    = get_author_posts_url( $author_id );
			$author_bio     = get_the_author_meta( 'description', $author_id );
			$author_socials = pelicula_core_get_author_social_networks( $author_id );
			?>
			<div class="widget qodef-author-info">
				<a itemprop="url" class="qodef-author-info-image" href="<?php echo esc_url( $author_link ); ?>">
					<?php echo get_avatar( $author_id, 398 ); ?>
				</a>
				<?php if ( ! empty( $author_bio ) ) { ?>
					<h4 class="qodef-author-info-name vcard author">
						<a itemprop="url" href="<?php echo esc_url( $author_link ); ?>">
							<span class="fn"><?php echo esc_html( get_the_author_meta( 'display_name', $author_id ) ); ?></span>
						</a>
					</h4>
					<p itemprop="description" class="qodef-author-info-description"><?php echo esc_html( $author_bio ); ?></p>
					<?php if ( ! empty( $author_socials ) ) { ?>
						<div class="qodef-author-info-social-icons">
							<?php foreach ( $author_socials as $social ) { ?>
								<a itemprop="url" class="<?php echo esc_attr( $social['class'] ) ?>" href="<?php echo esc_url( $social['url'] ) ?>" target="_blank">
									<?php echo qode_framework_icons()->render_icon( $social['icon'], 'elegant-icons' ); ?>
								</a>
							<?php } ?>
						</div>
					<?php } ?>
				<?php } ?>
			</div>
			<?php
		}
	}
}
