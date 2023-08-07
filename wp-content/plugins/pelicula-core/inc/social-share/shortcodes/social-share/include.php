<?php

include_once PELICULA_CORE_INC_PATH . '/social-share/shortcodes/social-share/social-share.php';

foreach ( glob( PELICULA_CORE_INC_PATH . '/social-share/shortcodes/social-share/variations/*/include.php' ) as $variation ) {
	include_once $variation;
}