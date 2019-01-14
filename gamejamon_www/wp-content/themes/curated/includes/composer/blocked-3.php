<?php
/* --------------------------------------------------------------------------

	A Mahathemes Framework - Copyright (c) 2017

    - Blocked 3

 ---------------------------------------------------------------------------*/
global $post;
?>

<div class="mh-el">

	<?php
	// Start Container
	if (get_sub_field('el_area') == 1) { echo '<div class="container">'; }
	?>

	<?php if ( get_sub_field('block_title') ) { ?>
	<!-- Block Cap -->
	<div class="row">
		<div class="col-sm-12">
			<div class="block-cap">
				<h3><?php echo do_shortcode(get_sub_field('block_title')); ?></h3>
			</div>
		</div>
	</div>
	<?php } ?>

	<div class="row block-streams el-block-3">

		<?php
		// Setup Query
		$loop_fields = array(
			'loop_categories' => get_sub_field('block_category'),
			'loop_tags' => get_sub_field('block_tags'),
			'loop_order' => get_sub_field('block_order'),
			'loop_number_posts' => get_sub_field('block_number_posts'),
			'loop_offset' => get_sub_field('block_offset'),
			'loop_featured' => get_sub_field('featured_post_option')
		);

		$blocked_args = maha_loop($loop_fields);
		$wp_query = new WP_Query( $blocked_args );
		?>

		<?php
		// Setup Loop
		if ( $wp_query->have_posts() ) :

	        while ( $wp_query->have_posts() ) : $wp_query->the_post();
	    		$post->i_summary = get_sub_field('block_summary');
	        
	        	?>
				<div <?php post_class("up-up-child col-sm-12"); ?>>
					<?php get_template_part ( 'includes/content/item', 'list' ); ?>
	        	</div>
	            <?php

	        endwhile;
        else:

            echo '<div class="col-sm-12 message">';
			_e( 'Sorry, no posts were found', 'curated' );
			echo '</div>';
		endif;
		?>

		<?php wp_reset_query(); ?>

	</div>
	
	<?php
	// End of container
	if (get_sub_field('el_area') == 1) { echo '</div>'; }
	?>

</div>