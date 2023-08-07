<?php
include_once PELICULA_CORE_CPT_PATH . '/portfolio/shortcodes/portfolio-list/helper.php';

include_once PELICULA_CORE_CPT_PATH . '/portfolio/shortcodes/portfolio-list/portfolio-list.php';

foreach ( glob( PELICULA_CORE_CPT_PATH . '/portfolio/shortcodes/portfolio-list/variations/*/include.php' ) as $variation ) {
	include_once $variation;
}