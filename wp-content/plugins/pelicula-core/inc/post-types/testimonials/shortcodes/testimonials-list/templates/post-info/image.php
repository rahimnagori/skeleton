<?php if ( has_post_thumbnail() ) { ?>
	<div class="qodef-e-media-image">
		<?php echo qode_framework_generate_thumbnail( intval( get_post_thumbnail_id( get_the_ID() ) ), 53, 53 ); ?>
	</div>
<?php } ?>