<div class="qodef-header-sticky">
    <div class="qodef-header-sticky-inner">
	    <div class="qodef-divided-header-left-wrapper">
		    <?php
		    // Include widget area two
		    if ( is_active_sidebar( 'qodef-header-widget-area-two' ) ) { ?>
			    <div class="qodef-widget-holder">
				    <?php pelicula_core_get_header_widget_area( '', 'two' ); ?>
			    </div>
		    <?php }
		
		    // Include divided left navigation
		    pelicula_core_template_part( 'header/layouts/divided', 'templates/parts/left-navigation' ); ?>
	    </div>
	
	    <?php
	    // Include logo
	    pelicula_core_get_header_logo_image( array( 'sticky_logo' => true ) );
	    ?>
	
	    <div class="qodef-divided-header-right-wrapper">
		    <?php
		    // Include divided right navigation
		    pelicula_core_template_part( 'header/layouts/divided', 'templates/parts/right-navigation' );
		
		    // Include widget area one
		    if ( is_active_sidebar( 'qodef-header-widget-area-one' ) ) { ?>
			    <div class="qodef-widget-holder">
				    <?php pelicula_core_get_header_widget_area(); ?>
			    </div>
		    <?php } ?>
	    </div>
	
	    <?php do_action('pelicula_core_action_after_sticky_header'); ?>
    </div>
</div>