<?php

include_once PELICULA_CORE_SHORTCODES_PATH . '/counter/counter.php';

foreach ( glob( PELICULA_CORE_SHORTCODES_PATH . '/counter/variations/*/include.php' ) as $variation ) {
	include_once $variation;
}