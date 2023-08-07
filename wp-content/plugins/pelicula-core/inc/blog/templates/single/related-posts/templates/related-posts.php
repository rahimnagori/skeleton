<?php
$post_id       = get_the_ID();
$is_enabled    = pelicula_core_get_post_value_through_levels( 'qodef_blog_single_enable_related_posts' );
$related_posts = pelicula_core_get_custom_post_type_related_posts( $post_id, pelicula_core_get_blog_single_post_taxonomies( $post_id ) );

if ( $is_enabled === 'yes' && ! empty( $related_posts ) ) { ?>
	<div id="qodef-related-posts">
		<h3 class="qodef-related-posts-title"><?php echo esc_html__( 'Related Posts', 'pelicula-core' ); ?></h3>
		<?php
		$params = apply_filters( 'pelicula_core_filter_blog_single_related_posts_params', array(
			'custom_class'      => 'qodef--no-bottom-space',
			'columns'           => '2',
			'posts_per_page'    => 2,
			'layout'            => 'standard',
			'additional_params' => 'tax',
			'tax'               => $related_posts['taxonomy'],
			'tax__in'           => implode( ',', $related_posts['items'] ),
			'title_tag'         => 'h4',
			'enable_excerpt'    => 'no',
			'orderby'           => 'rand',
		) );

		if ( class_exists( 'PeliculaCoreBlogListShortcode' ) ) {
			echo PeliculaCoreBlogListShortcode::call_shortcode( $params );
		}
		?>
	</div>
<?php } ?>
