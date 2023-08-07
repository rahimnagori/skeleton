<?php

include_once PELICULA_CORE_SHORTCODES_PATH . '/info-section/info-section.php';

foreach ( glob( PELICULA_CORE_SHORTCODES_PATH . '/info-section/variations/*/include.php' ) as $variation ) {
	include_once $variation;
}