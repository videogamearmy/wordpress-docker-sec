<?php global $curated; ?>
<article class="item-full-width post-box-full">
	
	<?php if ( isset( $curated['module_meta']['category'] ) && $curated['module_meta']['category'] != false ) : ?>
	<div class="meta-count">
		<span class="i-category"><?php maha_post_category( get_the_ID() ); ?></span>
	</div>
	<?php endif; ?>

	<h3 class="entry-title">
		<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>">
			<?php the_title(); ?>
		</a>
	</h3>
	<meta content="<?php the_title(); ?>" />

	<div class="meta-info">
		<?php if ( isset( $curated['module_meta']['author'] ) && $curated['module_meta']['author'] != false ) : ?>
			<span class="entry-author"><a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><?php the_author(); ?></a></span>
		<?php endif; ?>

		<?php if ( isset( $curated['module_meta']['author'] ) && $curated['module_meta']['author'] != false && isset( $curated['module_meta']['date'] ) && $curated['module_meta']['date'] != false ) : ?>
			<span class="coma">,</span>
		<?php endif; ?>

		<?php if ( isset( $curated['module_meta']['date'] ) && $curated['module_meta']['date'] != false ) : ?>
			<time class="entry-date" datetime="<?php the_time( 'c' ); ?>" >
				<?php the_time( get_option( 'date_format' ) ); ?>
			</time>
		<?php endif; ?>

		<div class="count-data right">
			<?php if ( isset( $curated['module_meta']['view'] ) && $curated['module_meta']['view'] != false ) : ?>
				<span class="meta-info-viewer"><?php echo maha_get_viwr( $post->ID ); ?><i class="tm-view"></i></span>
			<?php endif; ?>

			<?php if ( isset( $curated['module_meta']['comment'] ) && $curated['module_meta']['comment'] != false ) : ?>
				<span class="meta-info-comments"><a href="<?php the_permalink(); ?>"><?php comments_number('0', '1', '%'); ?></a><i class="tm-comment"></i></span>
			<?php endif; ?>
		</div>
	</div>
	
	<div class="thumb-wrap short-bottom zoom-zoom">
		<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>">
		<?php if ( maha_meta_review( get_the_ID() ) != '' ) : ?>
			<span class="i-review"><?php echo maha_meta_review( get_the_ID() ); ?></span>
		<?php endif; ?>

		<?php $thumb_class = 'entry-thumb';
		if ( has_post_thumbnail() ) : // Set Featured Image
			$thumb = maha_featured_url( get_the_ID() , 'mh_slide_large');
			$thumb_class .= ' zoom-it three';
		else :
			$thumb = maha_no_thumbnail('mh_slide_large');
		endif; ?>
		<img class="<?php echo $thumb_class; ?>" src="<?php echo $thumb; ?>"  alt="<?php the_title(); ?>" title="<?php the_title(); ?>"/>
		</a>
	</div>

	<div class="i-summary">
		<?php the_excerpt(); ?>
	</div>
</article>