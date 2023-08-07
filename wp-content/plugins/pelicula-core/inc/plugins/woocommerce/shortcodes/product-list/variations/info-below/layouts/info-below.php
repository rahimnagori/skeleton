<div <?php wc_product_class( apply_filters( 'pelicula_filter_product_list_classes', array( $item_classes, 'qodef-e-holder-main qodef-has-post-media' ) ) ); ?>>
    <div class="qodef-woo-product-inner">
		<?php if ( has_post_thumbnail() ) { ?>
            <div class="qodef-woo-product-image">
				<?php pelicula_core_template_part( 'plugins/woocommerce/shortcodes/product-list', 'templates/post-info/on-sale' ); ?>
				<?php pelicula_core_template_part( 'plugins/woocommerce/shortcodes/product-list', 'templates/post-info/image', '', $params ); ?>
                <div class="qodef-woo-product-image-inner">
					<?php
					pelicula_core_template_part( 'plugins/woocommerce/shortcodes/product-list', 'templates/post-info/add-to-cart' );
					
					// Hook to include additional content inside product list item image
					do_action( 'pelicula_core_action_product_list_item_additional_image_content' );
					?>
                </div>
            </div>
		<?php } ?>
        <div class="qodef-woo-product-content qodef-e-content-main">
			<?php pelicula_core_template_part( 'plugins/woocommerce/shortcodes/product-list', 'templates/post-info/category', '', $params ); ?>
			<?php pelicula_core_template_part( 'plugins/woocommerce/shortcodes/product-list', 'templates/post-info/title', '', $params ); ?>
			<?php pelicula_core_template_part( 'plugins/woocommerce/shortcodes/product-list', 'templates/post-info/rating', '', $params ); ?>
			<?php pelicula_core_template_part( 'plugins/woocommerce/shortcodes/product-list', 'templates/post-info/price', '', $params ); ?>
			<?php
			// Hook to include additional content inside product list item content
			do_action( 'pelicula_core_action_product_list_item_additional_content' );
			?>
        </div>
		<?php pelicula_core_template_part( 'plugins/woocommerce/shortcodes/product-list', 'templates/post-info/link' ); ?>
    </div>
</div>