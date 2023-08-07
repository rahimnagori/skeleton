<div <?php qode_framework_class_attribute( $holder_classes ); ?>>
	<?php pelicula_core_template_part( 'shortcodes/movie-screen', 'templates/parts/image', '', $params ) ?>
	<div class="qodef-m-content">
		<?php pelicula_core_template_part( 'shortcodes/movie-screen', 'templates/parts/subtitle', '', $params ) ?>
		<?php pelicula_core_template_part( 'shortcodes/movie-screen', 'templates/parts/title', '', $params ) ?>
		<?php pelicula_core_template_part( 'shortcodes/movie-screen', 'templates/parts/additional-image', '', $params ) ?>
		<?php pelicula_core_template_part( 'shortcodes/movie-screen', 'templates/parts/button', '', $params ) ?>
	</div>
</div>