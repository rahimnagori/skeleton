<?php

include_once PELICULA_CORE_SHORTCODES_PATH . '/pricing-table/pricing-table.php';

foreach ( glob( PELICULA_CORE_SHORTCODES_PATH . '/pricing-table/variations/*/include.php' ) as $variation ) {
	include_once $variation;
}