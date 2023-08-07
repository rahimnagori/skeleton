<?php if ( is_object( WC()->cart ) ) { ?>
    <div class="qodef-m-content">
        <?php if ( ! WC()->cart->is_empty() ) {
            pelicula_core_template_part( 'plugins/woocommerce/widgets/side-area-cart', 'templates/parts/loop' );

            pelicula_core_template_part( 'plugins/woocommerce/widgets/side-area-cart', 'templates/parts/order-details' );

            pelicula_core_template_part( 'plugins/woocommerce/widgets/side-area-cart', 'templates/parts/button' );
        } else {
            // Include posts not found
            pelicula_core_template_part( 'plugins/woocommerce/widgets/side-area-cart', 'templates/parts/posts-not-found' );
        }

        pelicula_core_template_part( 'plugins/woocommerce/widgets/side-area-cart', 'templates/parts/close' );
        ?>
    </div>
<?php } ?>