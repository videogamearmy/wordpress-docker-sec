<?php
/* --------------------------------------------------------------------------

	A Mahathemes Framework - Copyright (c) 2017

    - Default Page

 ---------------------------------------------------------------------------*/
global $post;
$maha_options = get_option('curated');
$page_column = "12"; if ($maha_options['buddypress_sidebar_on'] == true) { $page_column = "8"; }
?>
<?php get_header(); ?>
<?php if ($maha_options['running_text_on'] == true) { get_template_part('includes/content/running', 'text'); } ?>
<div class="mh-el page-sidebar page-default">
        
	<!-- start container -->
	<div class="container">

		<div class="row">
			<!-- Page -->
			<div class="col-sm-<?php echo $page_column; ?>">

				<div class="main-content" role="main" itemprop="mainContentOfPage">
					
					<!-- Breadcrumbs -->
					<?php
					$maha_breadcrumbs = 1;
					if ( function_exists('yoast_breadcrumb') ) {
						$yoast_crumb = yoast_breadcrumb('<div class="maha-crumbs">','</div>', false);
						if ( isset( $yoast_crumb ) && !empty( $yoast_crumb ) ) {
							echo $yoast_crumb;
							$maha_breadcrumbs = 0;
						}
					}
					
					if (function_exists('maha_crumbs') && $maha_breadcrumbs === 1) { maha_crumbs(); } ?>
					
					<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
						<article id="post-2729" class="main-content single-post-box">
							<header class="buddy-header">
							
								<?php if((bp_is_current_component( 'members' ) || bp_is_current_component( 'groups' )) && bp_is_directory()) {?>
								<h1 class="entry-title"><?php the_title(); ?></h1>
								
								<?php }?>
								
							</header>							
							<div class="text-content <?php if((bp_is_current_component( 'members' ) || bp_is_current_component( 'groups' )) && bp_is_directory()) echo 'buddy-members-groups'?>">
								<?php the_content(); ?>
							</div>

						</article>

					<?php endwhile; endif; ?>

				</div>

				<?php
				if (get_field('use_homepage', $post->ID) == 'enable'){ get_template_part ( 'includes/composer/homepage'); }
				?>

			</div>

			<?php
			// If This Page Use Sidebar
			if ($maha_options['buddypress_sidebar_on'] == true) {
			 echo '<div class="col-sm-4"><div class="sidebar">'; dynamic_sidebar($maha_options['buddypress_sidebar_select']); 
			 echo '</div></div>'; }
			?>
			
		</div>
	</div>

</div>


<?php get_footer(); ?>