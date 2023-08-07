<?php

include_once PELICULA_CORE_SHORTCODES_PATH . '/item-showcase/item-showcase.php';

foreach ( glob( PELICULA_CORE_SHORTCODES_PATH . '/item-showcase/variations/*/include.php' ) as $variation ) {
	include_once $variation;
}