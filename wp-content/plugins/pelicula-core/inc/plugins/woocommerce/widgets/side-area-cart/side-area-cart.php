<?php

if ( ! function_exists( 'pelicula_core_add_woo_side_area_cart_widget' ) ) {
	/**
	 * Function that add widget into widgets list for registration
	 *
	 * @param $widgets array
	 *
	 * @return array
	 */
	function pelicula_core_add_woo_side_area_cart_widget( $widgets ) {
		$widgets[] = 'PeliculaCoreWooSideAreaCartWidget';
		
		return $widgets;
	}
	
	add_filter( 'pelicula_core_filter_register_widgets', 'pelicula_core_add_woo_side_area_cart_widget' );
}

if ( class_exists( 'QodeFrameworkWidget' ) ) {
	class PeliculaCoreWooSideAreaCartWidget extends QodeFrameworkWidget {
		
		public function map_widget() {
			$this->set_base( 'pelicula_core_woo_side_area_cart' );
			$this->set_name( esc_html__( 'Pelicula WooCommerce Side Area Cart', 'pelicula-core' ) );
			$this->set_description( esc_html__( 'Display a shop cart icon with that shows products count that are in the cart', 'pelicula-core' ) );
			$this->set_widget_option(
				array(
					'field_type'  => 'text',
					'name'        => 'widget_padding',
					'title'       => esc_html__( 'Widget Padding', 'pelicula-core' ),
					'description' => esc_html__( 'Insert padding in format: top right bottom left', 'pelicula-core' )
				)
			);
		}
		
		public function load_assets() {
			wp_enqueue_style( 'perfect-scrollbar', PELICULA_CORE_URL_PATH . 'assets/plugins/perfect-scrollbar/perfect-scrollbar.css', array() );
			wp_enqueue_script( 'perfect-scrollbar', PELICULA_CORE_URL_PATH . 'assets/plugins/perfect-scrollbar/perfect-scrollbar.jquery.min.js', array( 'jquery' ), false, true );
		}
		
		public function render( $atts ) {
			$styles = array();
			
			if ( ! empty( $atts['widget_padding'] ) ) {
				$styles[] = 'padding: ' . $atts['widget_padding'];
			}
			?>
			<div class="qodef-woo-side-area-cart qodef-m" <?php qode_framework_inline_style( $styles ) ?>>
				<div class="qodef-woo-side-area-cart-inner qodef-m-inner">
					<?php pelicula_core_template_part( 'plugins/woocommerce/widgets/side-area-cart', 'templates/parts/opener' ); ?>
					<?php pelicula_core_template_part( 'plugins/woocommerce/widgets/side-area-cart', 'templates/content' ); ?>
				</div>
			</div>
			<?php
		}
	}
}

if ( ! function_exists( 'pelicula_core_woo_side_area_cart_add_to_cart_fragment' ) ) {
	function pelicula_core_woo_side_area_cart_add_to_cart_fragment( $fragments ) {
		ob_start();
		?>
		<div class="qodef-woo-side-area-cart-inner qodef-m-inner">
			<?php pelicula_core_template_part( 'plugins/woocommerce/widgets/side-area-cart', 'templates/parts/opener' ); ?>
			<?php pelicula_core_template_part( 'plugins/woocommerce/widgets/side-area-cart', 'templates/content' ); ?>
		</div>
		<?php
		$fragments['.qodef-woo-side-area-cart-inner'] = ob_get_clean();
		
		return $fragments;
	}
	
	add_filter( 'woocommerce_add_to_cart_fragments', 'pelicula_core_woo_side_area_cart_add_to_cart_fragment' );
}