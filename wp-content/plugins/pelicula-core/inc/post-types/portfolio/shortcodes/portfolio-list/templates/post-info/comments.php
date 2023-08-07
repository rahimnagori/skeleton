<?php if ( comments_open() ) { ?>
	<div class="qodef-e-info-comments">
		<a itemprop="url" class="qodef-e-info-comments-link" href="<?php comments_link(); ?>">
			<?php comments_number( '0 ' . esc_html__( 'Comments', 'pelicula-core' ), '1 ' . esc_html__( 'Comment', 'pelicula-core' ), '% ' . esc_html__( 'Comments', 'pelicula-core' ) ); ?>
		</a>
	</div>
<?php } ?>