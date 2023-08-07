<?php

include_once PELICULA_CORE_SHORTCODES_PATH . '/interactive-link-showcase/interactive-link-showcase.php';

foreach ( glob( PELICULA_CORE_SHORTCODES_PATH . '/interactive-link-showcase/variations/*/include.php' ) as $variation ) {
	include_once $variation;
}