<?php

include_once PELICULA_CORE_SHORTCODES_PATH . '/accordion/accordion.php';
include_once PELICULA_CORE_SHORTCODES_PATH . '/accordion/accordion-child.php';

foreach ( glob( PELICULA_CORE_SHORTCODES_PATH . '/accordion/variations/*/include.php' ) as $variation ) {
	include_once $variation;
}