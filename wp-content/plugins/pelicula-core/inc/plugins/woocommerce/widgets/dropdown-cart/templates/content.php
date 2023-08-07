<?php if ( is_object( WC()->cart ) ) {
    pelicula_core_template_part( 'plugins/woocommerce/widgets/dropdown-cart', 'templates/parts/opener' ); ?>
    <div class="qodef-m-dropdown">
        <div class="qodef-m-dropdown-inner">
            <?php if ( ! WC()->cart->is_empty() ) {
                pelicula_core_template_part( 'plugins/woocommerce/widgets/dropdown-cart', 'templates/parts/loop' );

                pelicula_core_template_part( 'plugins/woocommerce/widgets/dropdown-cart', 'templates/parts/order-details' );

                pelicula_core_template_part( 'plugins/woocommerce/widgets/dropdown-cart', 'templates/parts/button' );
            } else {
                // Include posts not found
                pelicula_core_template_part( 'plugins/woocommerce/widgets/dropdown-cart', 'templates/parts/posts-not-found' );
            } ?>
        </div>
    </div>
<?php } ?>