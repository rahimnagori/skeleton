<div <?php qode_framework_class_attribute( $holder_classes ); ?> <?php qode_framework_inline_style( $holder_styles ); ?>>
    <div class="qodef-m-inner">
        <?php if(!empty($carousels)) { ?>
            <div class="qodef-m-sources-holder">
                <?php $i_source = 0; ?>
	            <?php foreach ( $carousels as $carousel ) { ?>
		            <?php foreach ( $carousel as $carousel_content ) { ?>
			            <?php if ( $carousel_content['source'] === 'image' && isset( $carousel_content['link_image'] ) ) { ?>
				            <div class="qodef-e-source"
				                 data-index="<?php echo esc_html( $i_source ); ?>" <?php qode_framework_inline_style( 'background-image: url(' . wp_get_attachment_url( $carousel_content['link_image'] ) . ')' ); ?>></div>
			            <?php } elseif ( $carousel_content['source'] === 'video' && ! empty( $carousel_content['link_video'] ) ) { ?>
				            <div class="qodef-e-source" data-index="<?php echo esc_html( $i_source ); ?>">
					            <?php echo pelicula_core_get_template_part( 'shortcodes/interactive-link-carousel', 'templates/parts/video', '', $carousel_content ); ?>
				            </div>
			            <?php }
			            $i_source ++;
		            } ?>
	            <?php } ?>
            </div>
            <div class="qodef-m-content-holder">
                <div class="qodef-m-content-table">
                    <div class="qodef-m-content-table-cell"> <?php $i_content = 0; $counter = 0; ?>
                        <?php foreach($carousels as $carousel) { ?>
                            <?php $counter++; ?>
                            <div class="qodef-m-content-line">
                                <div class="swiper-container">
                                    <div class="swiper-wrapper">
                                        <?php foreach ($carousel as $carousel_content) { ?>

                                            <div class="qodef-m-item swiper-slide">
                                                <div class="qodef-m-item-content" data-index="<?php echo esc_html($i_content);?>">

                                                    <span class="qodef-m-item-wrap">

                                                            <span class="qodef-m-item-link-holder">

                                                                <?php if($counter%2==1){?>

                                                                    <?php if (
                                                                            isset($carousel_content['link_url']) &&
                                                                            isset($carousel_content['link_text'])
		                                                                ) { ?>

	                                                                    <a class="qodef-m-item-link" target="<?php echo esc_attr($link_target); ?>" href="<?php echo esc_url($carousel_content['link_url']); ?>">
                                                                            <?php echo esc_html($carousel_content['link_text']);?>
	                                                                    </a>

			                                                        <?php } ?>

                                                                <?php } else { ?>

                                                                    <?php if (
                                                                            isset($carousel_content['link_url']) &&
                                                                            isset($carousel_content['link_text'])
		                                                                ) { ?>

	                                                                    <a class="qodef-m-item-link" target="<?php echo esc_attr($link_target); ?>" href="<?php echo esc_url($carousel_content['link_url']); ?>">
                                                                            <?php echo esc_html($carousel_content['link_text']);?>
	                                                                    </a>

			                                                        <?php } ?>

                                                                <?php } ?>

                                                            </span>
                                                    </span>
                                                </div>
                                            </div>

                                        <?php $i_content++; } ?>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>