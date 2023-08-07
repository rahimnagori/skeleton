<div <?php qode_framework_class_attribute( $holder_classes ); ?> data-distance="<?php echo esc_attr( $distance ); ?>">
	<div class="qodef-m-ht-nav">
		<div class="qodef-m-ht-nav-wrapper">
			<div class="qodef-m-ht-nav-inner">
				<ol>
					<?php foreach ( $dates as $date ) { ?>
						<li>
							<a href="#" data-date="<?php echo esc_attr( $date['formatted'] ); ?>"><?php echo esc_html( $date['date_label'] ); ?><span class="qodef-m-ht-nav-line-through"></span></a>
						</li>
					<?php } ?>
				</ol>
				<span class="qodef-m-ht-nav-filling-line" aria-hidden="true"></span>
			</div>
		</div>
		<ul class="qodef-m-ht-nav-navigation">
			<li><a href="#" class="ion-md-arrow-dropleft qodef-prev qodef-inactive"></a></li>
			<li><a href="#" class="ion-md-arrow-dropright qodef-next"></a></li>
		</ul>
	</div>
	<?php if (is_array($items) && count($items)) { ?>
		<div class="qodef-m-ht-content">
			<ol class="qodef-m-items">
				<?php foreach($items as $key => $item) { ?>
					<li class="qodef-m-item qodef-e" data-date="<?php echo esc_attr( $item['date'] ) ?>">
						<div class="qodef-e-hti-content-inner <?php echo esc_attr( $this_object->getItemClasses( $item ) ); ?>">

							<?php if ( ! empty( $item['content_image'] ) ) { ?>
								<div class="qodef-e-hti-content-image">
			                        <?php echo wp_get_attachment_image( $item['content_image'], 'full', false, array( 'class' => 'qodef-m-image' ) ); ?>
								</div>
							<?php } ?>

							<div class="qodef-e-hti-content-value">
				                <?php if ( ! empty( $item['content_title'] ) ) : ?>
			                        <<?php echo esc_attr( $item['content_title_tag'] ); ?> class="qodef-e-title">
				                        <?php echo esc_html( $item['content_title'] ); ?>
			                        </<?php echo esc_attr( $item['content_title_tag'] ); ?>>
			                    <?php endif; ?>

			                    <?php if ( ! empty( $item['content_text'] ) ) : ?>
			                        <p class="qodef-e-text"><?php echo wp_kses( nl2br( $item['content_text'] ), array( 'br' => array() ) ) ?></p>
			                    <?php endif; ?>

			                    <?php
			                    $button_params = array(
			                        'link'             => $item['content_button_link'],
			                        'text'             => $item['content_button_text'],
			                        'target'           => $item['content_button_target'],
			                        'size'             => 'normal',
			                        'button_layout'    => 'textual',
			                        'custom_class'     => 'qodef-e-button',
			                    );
			                    echo PeliculaCoreButtonShortcode::call_shortcode( $button_params ); ?>
							</div>

						</div>
					</li>
				<?php } ?>
			</ol>
		</div>
	<?php } ?>
</div>