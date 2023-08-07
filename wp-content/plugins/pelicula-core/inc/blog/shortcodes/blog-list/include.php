<?php

include_once PELICULA_CORE_INC_PATH . '/blog/shortcodes/blog-list/helper.php';
include_once PELICULA_CORE_INC_PATH . '/blog/shortcodes/blog-list/blog-list.php';

foreach ( glob( PELICULA_CORE_INC_PATH . '/blog/shortcodes/blog-list/variations/*/include.php' ) as $variation ) {
	include_once $variation;
}