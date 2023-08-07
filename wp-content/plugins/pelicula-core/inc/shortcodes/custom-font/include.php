<?php

include_once PELICULA_CORE_SHORTCODES_PATH . '/custom-font/custom-font.php';

foreach ( glob( PELICULA_CORE_SHORTCODES_PATH . '/custom-font/variations/*/include.php' ) as $variation ) {
	include_once $variation;
}