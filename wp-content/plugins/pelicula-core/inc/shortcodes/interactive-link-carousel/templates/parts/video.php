<?php

if ( isset( $link_video ) && ! empty( $link_video ) ) {

	// Video player settings
	$settings = array(
		'loop'     => true,
		'autoplay' => true
	);

	$oembed = wp_oembed_get( $link_video );
	if ( ! empty( $oembed ) ) {
		echo wp_oembed_get( $link_video, $settings );
	} else {
		echo wp_video_shortcode( array_merge( array( 'src' => esc_url( $link_video ) ), $settings ) );
	}
}