<?php

include_once PELICULA_CORE_SHORTCODES_PATH . '/button/button.php';

foreach ( glob( PELICULA_CORE_SHORTCODES_PATH . '/button/variations/*/include.php' ) as $variation ) {
	include_once $variation;
}