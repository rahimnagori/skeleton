<?php
    $qodef_spinner_text = pelicula_core_get_post_value_through_levels( 'qodef_spinner_text', qode_framework_get_page_id() );
?>

<div class="qodef-m-pelicula">
    <span><?php esc_html_e( $qodef_spinner_text, 'stal-core' ); ?></span>
</div>