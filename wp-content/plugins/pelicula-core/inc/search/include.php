<?php

include_once PELICULA_CORE_INC_PATH . '/search/search.php';
include_once PELICULA_CORE_INC_PATH . '/search/helper.php';
include_once PELICULA_CORE_INC_PATH . '/search/dashboard/admin/search-options.php';

foreach ( glob( PELICULA_CORE_INC_PATH . '/search/layouts/*/include.php' ) as $layout ) {
	include_once $layout;
}
