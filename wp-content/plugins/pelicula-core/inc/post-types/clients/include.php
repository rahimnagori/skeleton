<?php

include_once PELICULA_CORE_CPT_PATH . '/clients/helper.php';

foreach ( glob( PELICULA_CORE_CPT_PATH . '/clients/dashboard/meta-box/*.php' ) as $module ) {
	include_once $module;
}