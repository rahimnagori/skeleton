<div class="qodef-e-media">
	<?php switch ( get_post_format() ) {
		case 'gallery':
			pelicula_core_theme_template_part( 'blog', 'templates/parts/post-format/gallery','', $params );
			break;
		case 'video':
			pelicula_core_theme_template_part( 'blog', 'templates/parts/post-format/video','', $params );
			break;
		case 'audio':
			pelicula_core_theme_template_part( 'blog', 'templates/parts/post-format/audio','', $params );
			break;
		default:
			pelicula_core_template_part( 'blog/shortcodes/blog-list', 'templates/post-info/image','', $params );
			break;
	} ?>
</div>