<?php

include_once PELICULA_CORE_SHORTCODES_PATH . '/call-to-action/call-to-action.php';

foreach ( glob( PELICULA_CORE_SHORTCODES_PATH . '/call-to-action/variations/*/include.php' ) as $variation ) {
	include_once $variation;
}