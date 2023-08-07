<?php do_action('pelicula_action_before_page_header'); ?>

<header id="qodef-page-header">
    <div id="qodef-page-header-inner">
	
	    <?php
	    // Include logo
	    pelicula_core_get_header_logo_image();
	
	    // Include divided left navigation
		pelicula_core_template_part( 'header', 'layouts/vertical/templates/navigation' );
	 
		// Include widget area one
		if ( is_active_sidebar( 'qodef-header-widget-area-one' ) ) { ?>
			<div class="qodef-vertical-widget-holder">
				<?php pelicula_core_get_header_widget_area(); ?>
			</div>
		<?php } ?>
    </div>
</header>

