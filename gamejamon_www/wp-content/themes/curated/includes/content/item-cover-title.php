<?php global $post, $curated; $maha_options = get_option('curated');// echo $post->ID; // print_r($post); ?>

<div class="row">
	<!-- Page -->
	<div class="col-sm-12">
		<div class="cover-wrap">

			<div class="detail container">

				<div class="row">

					<div class="col-sm-12">

						<meta itemprop="headline" content="<?php echo get_the_title($post->ID); ?>">
						<meta itemprop="datecreated" content="<?php echo get_the_time( 'c', $post->ID ); ?>">
						<meta itemprop="datePublished" content="<?php the_time( 'c' ); ?>">
						<meta itemprop="dateModified" content="<?php the_modified_date( 'c' ); ?>">
						<meta itemscope itemprop="mainEntityOfPage" itemType="https://schema.org/WebPage" itemid="<?php the_permalink( $post->ID ); ?>"/>
						<span class="hidden" itemprop="image" itemscope itemtype="https://schema.org/ImageObject">
							<meta itemprop="url" content="<?php echo maha_featured_url( $post->ID , ''); ?>">
							<meta itemprop="width" content="<?php echo maha_featured_size( $post->ID , 'w' ); ?>">
							<meta itemprop="height" content="<?php echo maha_featured_size( $post->ID , 'h' ); ?>">
						</span>
						<span class="hidden" itemprop="publisher" itemscope itemtype="https://schema.org/Organization">
							<span class="hidden" itemprop="logo" itemscope itemtype="https://schema.org/ImageObject">
								<meta itemprop="url" content="<?php echo maha_logo_img(); ?>">
							</span>
							<meta itemprop="name" content="<?php bloginfo('name'); ?>">
						</span>

						<?php $user = get_user_by( 'email', get_the_author_meta( 'email' ) );
						if ( isset( $user->u_google_plus ) && !empty( $user->u_google_plus ) ) { ?>
							<a href="<?php echo $user->u_google_plus."?rel=author"; ?>" style="display:none;"></a>
						<?php } ?>

						<div class="meta-count">
							<span class="i-category"><?php maha_post_category( $post->ID ); ?></span>
						</div>

						<h1 itemprop="name"><?php echo get_the_title($post->ID); ?></h1>
						<?php
						if ( get_field('subtitle', $post->ID) != '' ){
							echo '<div class="entry-subtitle single-subtitle">'.get_field('subtitle', $post->ID).'</div>';
						}
						?>

						<div class="meta-info">
							<span class="entry-author">
								<a href="<?php echo get_author_posts_url( $post->post_author ); ?>"><span><?php echo get_the_author_meta('display_name', $post->post_author); ?></span></a>,
							</span>
							<time class="entry-date" datetime="<?php echo get_the_time( 'c', $post->ID ); ?>" >
								<?php echo get_the_time( get_option( 'date_format' ), $post->ID ); ?>
							</time>
							
							<div class="count-data right">
								<?php if ( isset( $curated['single_meta_count']['view'] ) && $curated['single_meta_count']['view'] == true ) : ?>
									<span class="meta-info-viewer"><?php echo maha_get_viwr( $post->ID ); ?><i class="tm-view"></i></span>
								<?php endif; ?>

								<?php if ( isset( $curated['single_meta_count']['comment'] ) && $curated['single_meta_count']['comment'] == true ) : ?>
									<span class="meta-info-comments"><a href="<?php the_permalink(); ?>"><?php comments_number('0', '1', '%'); ?></a><i class="tm-comment"></i></span>
								<?php endif; ?>
							</div>
						</div>

					</div>

				</div>

			</div>
				
		</div>
	</div>
</div>