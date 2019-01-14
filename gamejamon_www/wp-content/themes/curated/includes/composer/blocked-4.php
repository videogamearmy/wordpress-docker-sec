<?php
/* --------------------------------------------------------------------------

	A Mahathemes Framework - Copyright (c) 2017

    - Blocked 4

 ---------------------------------------------------------------------------*/
global $post;
?>

<div class="mh-el">

	<?php
	// Start Container
	$col_sm = 6; $item_range = 2;
	if (get_sub_field('el_area') == 1) { echo '<div class="container">'; $col_sm = 4; $item_range = 3; }
	if (get_sub_field('el_area') == 2 && get_field('page_sidebar', $post->ID) == 'page_sidebar_off') { $col_sm = 4; $item_range = 3; }
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

	<div class="row block-streams el-block-4">

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

			$post_start = 1;
			$item_small = 0;
	        while ( $wp_query->have_posts() ) : $wp_query->the_post();
	        	$post->i_summary = get_sub_field('block_summary');
	        
	        	if ( $post_start == 1 ) {

	        		// Latest Post
		        	?>
					<div <?php post_class("up-up-child col-sm-".$col_sm); ?>>
						<?php get_template_part ( 'includes/content/item', 'medium' ); ?>
		        	</div>
		            <?php
		            
	        	} else {

	        		// if ( $post_start == 2 ) { echo '<div class="col-sm-'.$col_sm.'">'; }
	        		echo '<div class="up-up-child col-sm-'.$col_sm.'">';

					// Posts Small Loop
					get_template_part ( 'includes/content/item', 'small' );

					// $item_small++; 

	        		echo '</div>';
	        		// if ( $post_start >= 3 && $item_small == 4 && $number_of_posts != $post_start ) { echo '</div>'; $post_start = 1; $item_small = 0; }
	        		// if ( $post_start >= 3 && $number_of_posts == $post_start ) { echo '</div>'; }
	        	}

	           	$post_start++;
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