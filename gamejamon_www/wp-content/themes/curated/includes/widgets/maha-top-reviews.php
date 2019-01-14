<?php
/* --------------------------------------------------------------------------

    A Mahathemes Framework - Copyright (c) 2017

    - Top Reviews

 ---------------------------------------------------------------------------*/

if ( ! class_exists( 'maha_top_reviews' ) ) { 
    class maha_top_reviews extends WP_Widget {
    
    	function __construct() {

            // Widget settings
    		$widget_ops = array('classname' => 'widget_review', 'description' =>  __("Show top reviews with different filters", 'curated') );
    		            
            // Widget control settings
            $this->alt_option_name = 'widget_top_reviews';
            
            // Create the widget
            parent::__construct('top-reviews', wp_get_theme()->get('Name').__(' - Top Reviews', 'curated'), $widget_ops);
    	}
    
    	function widget($args, $instance) {
    
    		extract($args);
    
    		$title = apply_filters('widget_title', empty($instance['title']) ? __('Top Reviews', 'curated') : $instance['title'], $instance, $this->id_base);
    		$category = apply_filters('widget_category', empty($instance['category']) ? '' : $instance['category'], $instance, $this->id_base);
            $filter = apply_filters('widget_filter', empty($instance['filter']) ? '' : $instance['filter'], $instance, $this->id_base);

    		if ( $filter == NULL ) {
                $filter = 'alltime';
            }
    		
    		if ( empty( $instance['number'] ) || ! $number = absint( $instance['number'] ) )  {$number = 5; }
            
            if ( $category != 'all' ) { 
                $cat_qry = $category; 
            } else {
                $cat_qry = NULL;
            }

            $type_filter = 'enable_review';

    		if ( $filter == 'week' ) {

        		$week = date('W');
        		$year = date('Y');
        		$top_query = new WP_Query( 
                    apply_filters( 'widget_posts_args', 
                        array( 
                            'posts_per_page' => $number,
                            'category_name' => $cat_qry,
                            'year' => $year,
                            'w' => $week ,
                            'no_found_rows' => true,
                            'post_status' => 'publish',
                            'meta_query' => array(
                            'relation' => 'AND',
                                array(
                                    'key' => $type_filter,
                                    'value' => '1'
                                )
                            ),
                            'meta_key' => 'score_module',
                            'orderby' => 'meta_value_num',
                            'order' => 'DESC',
                            'ignore_sticky_posts' => true ) 
                        ) 
                    );

        	} elseif ( $filter == 'alltime' ) {
    
    		  $top_query = new WP_Query( 
                apply_filters( 'widget_posts_args', 
                    array(
                        'posts_per_page' => $number,
                        'category_name' => $cat_qry,
                        'no_found_rows' => true,
                        'post_status' => 'publish',
                        'meta_query' => array(
                            'relation' => 'AND',
                            array(
                                'key' => $type_filter,
                                'value' => '1'
                            )
                        ),
                        'meta_key' => 'score_module',
                        'orderby' => 'meta_value_num',
                        'order' => 'DESC',
                        'ignore_sticky_posts' => true
                        )
                    )
                );

    		} elseif ( $filter == 'month' ) {
    			
    		  $month = date('m', strtotime('-30 days'));
    		  $year = date('Y', strtotime('-30 days'));
    		  $top_query = new WP_Query(
                apply_filters( 'widget_posts_args',
                    array(
                        'posts_per_page' => $number,
                        'category_name' => $cat_qry,
                        'year' => $year,
                        'monthnum' => $month ,
                        'no_found_rows' => true,
                        'post_status' => 'publish',
                        'meta_query' => array(
                            'relation' => 'AND',
                            array(
                                'key' => $type_filter,
                                'value' => '1'
                            )
                        ),
                        'meta_key' => 'score_module',
                        'orderby' => 'meta_value_num',
                        'order' => 'DESC',
                        'ignore_sticky_posts' => true
                        )
                    )
                );

    		} elseif ( isset( $filter ) && !empty( $filter ) ) {
    
                $top_query = new WP_Query( 
                    apply_filters( 'widget_posts_args',
                        array( 'posts_per_page' => $number,
                            'category_name' => $cat_qry,
                            'year' => $filter,
                            'no_found_rows' => true,
                            'post_status' => 'publish',
                            'meta_query' => array(
                            'relation' => 'AND',
                                array(
                                    'key' => $type_filter,
                                    'value' => '1'
                                )
                            ),
                            'meta_key' => 'score_module',
                            'orderby' => 'meta_value_num',
                            'order' => 'DESC',
                            'ignore_sticky_posts' => true
                            )
                        )
                    );
    		} 	

            echo $before_widget;

            // Display the widget title if one was input
            if ($title) {
                echo $before_title . $title . $after_title;
            }
            // print_r($top_query);
            $r_posts = array();
            if ( $top_query->have_posts() ) :
                while ( $top_query->have_posts() ) : $top_query->the_post(); 
                    $r_posts[get_the_ID()] = maha_meta_review(get_the_ID());
                endwhile;
            endif;
            wp_reset_postdata();

            arsort($r_posts);

            if ( count($r_posts > 0) ) {
                foreach ($r_posts as $key => $v_review) {
                    ?>
                    <article class="popupar-item-wrap">
                        <div class="popupar-item zoom-zoom">
                            <span class="i-review"><?php echo maha_meta_review($key);?></span>
                            <a rel="bookmark" href="<?php echo get_permalink($key); ?>" title="<?php echo get_the_title($key); ?>">
                                <?php $thumb_class = 'entry-thumb';
                                if ( has_post_thumbnail( $key ) ) : // Set Featured Image
                                    $thumb = maha_featured_url( $key , 'mh_medium');
                                    $thumb_class .= ' zoom-it';
                                else :
                                    $thumb = maha_no_thumbnail('mh_medium');
                                endif; ?>
                                <img width="360" height="206" class="<?php echo $thumb_class; ?>" src="<?php echo $thumb; ?>" alt="<?php echo get_the_title($key); ?>" title="<?php echo get_the_title($key); ?>"/>
                            </a>
                        </div>
                        <meta content="<?php echo get_the_title($key); ?>" />
                        <div class="detail">
                            <a rel="bookmark" href="<?php echo get_permalink($key); ?>" title="<?php echo get_the_title($key); ?>">
                                <h4><?php echo get_the_title($key); ?></h4>
                            </a>
                        </div>
                    </article>
                    <?php
                }
            }

            echo $after_widget;
    	}
    
    	function update( $new_instance, $old_instance ) {
    		$instance = $old_instance;
    		$instance['title'] = strip_tags($new_instance['title']);
    		$instance['category'] = strip_tags($new_instance['category']);
    		$instance['number'] = (int) $new_instance['number'];
            $instance['filter'] =  strip_tags($new_instance['filter']);
    
    		return $instance;
    	}
    
    	function form( $instance ) {
    		$title     = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : 'Top Review';
    		$category  = isset( $instance['category'] ) ? esc_attr( $instance['category'] ) : '';
    		$number    = isset( $instance['number'] ) ? absint( $instance['number'] ) : 4;
            $filter    = isset( $instance['filter'] ) ? esc_attr( $instance['filter'] ) : '';
    		$cats = get_categories();
            
            ?>
    		<p>
                <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'curated' ); ?></label>
                <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" />
            </p>
    
    		<p>
                <label for="<?php echo $this->get_field_id( 'category' ); ?>"><?php _e('Category:', 'curated'); ?></label>
                <select class="widefat" id="<?php echo $this->get_field_id( 'category' ); ?>" name="<?php echo $this->get_field_name( 'category' ); ?>">
                <option value="all" <?php if ($category == 'all') echo 'selected="selected"'; ?>><?php _e('All Categories', 'curated'); ?></option> 
                <?php foreach ($cats as $cat) {
                        if ($category == $cat->slug) {$selected = 'selected="selected"'; } else { $selected = NULL;}
                        echo '<option value="'.$cat->slug.'" '.$selected.'>'.$cat->name.' ('.$cat->count.')</option>';
                        
                  } ?>
                </select>
            </p>
    		
    		<p>
                <label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php _e( 'Number of reviews to show:', 'curated' ); ?></label>
                <input class="widefat" id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" type="text" value="<?php echo $number; ?>" size="3" />
            </p>
    		
    		<p>
                <label for="<?php echo $this->get_field_id( 'filter' ); ?>"><?php _e('Filter:', 'curated'); ?></label>
                <select class="widefat" id="<?php echo $this->get_field_id( 'filter' ); ?>" name="<?php echo $this->get_field_name( 'filter' ); ?>">
                    <?php $selected = false; ?>
                    <option value="alltime" <?php if ( $filter == 'alltime' ) { echo 'selected="selected"'; $selected = true; } ?>><?php _e('All-time', 'curated'); ?></option> 
                    <option value="month" <?php if ( $filter == 'month' ) { echo 'selected="selected"'; $selected = true; } ?>><?php _e('Last Month', 'curated'); ?></option> 
                    <option value="week" <?php if ( $filter == 'week' ) { echo 'selected="selected"'; $selected = true; } ?>><?php _e('This Week', 'curated'); ?></option>
                    <?php
                    $year = date("Y");
                    $opt = '';
                    for ($i=0; $i < 4; $i++) { 
                        
                        $opt .= "<option value='". $year ."' ";
                        if ( $filter == $year ) {
                            $opt .= 'selected="selected"';
                            $selected = true;
                        }

                        $opt .= ">". __('Only','curated').' '.$year ."</option>";
                        $year--;
                    }
                    echo $opt;

                    if ( $selected == false ) {
                        echo $opt = '<option value="'. $filter .'" selected="selected">'. __('Only ','curated').' '.$filter .'</option>';
                    }
                    ?>
                </select>
            </p>
        <?php
    	}
    }
}


register_widget( 'maha_top_reviews' );
?>