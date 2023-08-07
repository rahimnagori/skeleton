<?php

include_once PELICULA_CORE_SHORTCODES_PATH . '/image-marquee/image-marquee.php';

foreach ( glob( PELICULA_CORE_INC_PATH . '/shortcodes/image-marquee/variations/*/include.php' ) as $variation ) {
	include_once $variation;
}