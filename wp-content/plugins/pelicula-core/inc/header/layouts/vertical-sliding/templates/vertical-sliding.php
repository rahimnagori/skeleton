<?php do_action( 'pelicula_action_before_page_header' ); ?>

<header id="qodef-page-header">
	<div id="qodef-page-header-inner">
		<div class="qodef-vertical-sliding-area qodef--static">
			<?php

			// include opener
			pelicula_core_get_opener_icon_html( array(
				'option_name'  => 'vertical_sliding_menu',
				'custom_class' => 'qodef-vertical-sliding-menu-opener'
			), true );

			// include logo
			pelicula_core_get_header_logo_image();

			// include widget area one
			?>
			<div class="qodef-vertical-sliding-widget-holder">
				<?php pelicula_core_get_header_widget_area(); ?>
			</div>
		</div>
		<div class="qodef-vertical-sliding-area qodef--dynamic">
			<?php
			// include logo
			pelicula_core_get_header_additional_logo_image();
			
			// include vertical sliding navigation
			pelicula_core_template_part( 'header', 'layouts/vertical-sliding/templates/navigation' );
			
			// include widget area two
			?>
			<div class="qodef-vertical-sliding-widget-holder">
				<?php pelicula_core_get_header_widget_area( '', 'two' ); ?>
			</div>
		</div>
	</div>
</header>