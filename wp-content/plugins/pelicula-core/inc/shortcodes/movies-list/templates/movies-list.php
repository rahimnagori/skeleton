<div <?php qode_framework_class_attribute( $holder_classes ); ?>>
	<div class="qodef-m-items">
		<?php foreach ( $items as $item ) { ?>
			<div class="qodef-m-item qodef-e">
				<div class="qodef-e-year">
					<span class="qodef-e-item-year"><?php echo esc_html( $item['item_year'] ); ?></span>
					<span class="qodef-e-item-description"><?php echo esc_html( $item['item_year_des'] ); ?></span>
				</div>
				<div class="qodef-e-movies">
					<span class="qodef-e-item-movies"><?php echo esc_html( $item['item_movies'] ); ?></span>
					<span class="qodef-e-item-description"><?php echo esc_html( $item['item_movies_des'] ); ?></span>
				</div>
			</div>
		<?php } ?>
	</div>
</div>