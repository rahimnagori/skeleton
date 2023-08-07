<?php

include_once PELICULA_CORE_SHORTCODES_PATH . '/banner/banner.php';

foreach ( glob( PELICULA_CORE_INC_PATH . '/shortcodes/banner/variations/*/include.php' ) as $variation ) {
	include_once $variation;
}