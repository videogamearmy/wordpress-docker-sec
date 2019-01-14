<?php
/* --------------------------------------------------------------------------

    A Mahathemes Framework - Copyright (c) 2017

    - Recent Posts

 ---------------------------------------------------------------------------*/


if ( ! class_exists( 'maha_recent_posts' ) ) { 
    class maha_recent_posts extends WP_Widget {
        
        /*  Setup
          ================================================== */

        function __construct() {

            // Widget settings
            $widget_ops = array(
                'classname' => 'widget_recents',
                'description' => __('Displays your Recent Posts.', 'curated')
            );

            // Widget control settings
            $control_ops = array(
                'id_base' => 'maha_recent_posts'
            );

            // Create the widget
            parent::__construct('maha_recent_posts', wp_get_theme()->get('Name').__(' - Recent Posts', 'curated'), $widget_ops, $control_ops);
        }

        /*  Display
          ================================================== */

        function widget($args, $instance) {
            extract($args);

            // Our variables from the widget settings
            $title = apply_filters('widget_title', $instance['title']);
            $category = $instance['category'];
            $number = $instance['number'];

            if ( $category != 'all' ) { 
                $cat_qry = $category; 
            } else {
                $cat_qry = NULL;
            }

            $recent_query = new WP_Query( 
                apply_filters( 'widget_posts_args',
                    array( 'posts_per_page' => $number,
                        'category_name' => $cat_qry,
                        'no_found_rows' => true,
                        'post_status' => 'publish',
                        'orderby' => 'date',
                        'order' => 'DESC',
                        'ignore_sticky_posts' => true
                        )
                    )
                );

            // Before widget (defined by theme functions file)
            echo $before_widget;

            // Display the widget title if one was input
            if ($title) {
                echo $before_title . $title . $after_title;
    		}
            ?>

            <?php
            if ( $recent_query->have_posts() ) :
                while ( $recent_query->have_posts() ) : $recent_query->the_post(); 
                    ?>
                    <article class="post-box-small recent-item clearfix">
                        <div class="thumb-wrap zoom-zoom three">
                            <a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>">
                                <?php $thumb_class = 'entry-thumb';
                                if ( has_post_thumbnail() ) : // Set Featured Image
                                    $thumb = maha_featured_url( get_the_ID() , 'mh_widget');
                                    $thumb_class .= ' zoom-it three';
                                else :
                                    $thumb = maha_no_thumbnail('mh_widget');
                                endif; ?>
                                <img width="83" height="63" class="<?php echo $thumb_class; ?>" src="<?php echo $thumb; ?>" alt="<?php the_title(); ?>" title="<?php the_title(); ?>"/>
                            </a>
                        </div>
                        <div class="box-small-wrap">
                            <h3 class="entry-title short-bottom">
                                <a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>">
                                    <?php the_title(); ?>
                                </a>
                            </h3>
                            <meta content="<?php the_title(); ?>" />
                            <div class="meta-info">
                                <time class="entry-date" datetime="<?php the_time( 'c' ); ?>" >
                                    <?php the_time( get_option( 'date_format' ) ); ?>
                                </time>
                            </div>
                        </div>
                    </article>
                    <?php
                endwhile;
            endif;
            ?>
    		
            <?php
            // After widget (defined by theme functions file)
            echo $after_widget;
        }

        
        /*  Update
          ================================================== */

        function update($new_instance, $old_instance) {
            $instance = $old_instance;

            // Strip tags to remove HTML (important for text inputs)
            $instance['title'] = strip_tags($new_instance['title']);
            $instance['category'] = strip_tags($new_instance['category']);
            $instance['number'] = strip_tags($new_instance['number']);

            return $instance;
        }

        
        /*  Settings
          ================================================== */

        function form($instance) {

            // Set up some default widget settings
            $defaults = array(
                'title' => 'Recent Posts',
                'category' => '',
                'number' => '4',
            );
            $cats = get_categories();

            $instance = wp_parse_args((array) $instance, $defaults);
            ?>

            <!-- Widget Input Fields -->
            <p>
                <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title', 'curated') ?></label>
                <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" type="text" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>" />
            </p>
            <p>
                <label for="<?php echo $this->get_field_id( 'category' ); ?>"><?php _e('Category:', 'curated'); ?></label>
                <select class="widefat" id="<?php echo $this->get_field_id( 'category' ); ?>" name="<?php echo $this->get_field_name( 'category' ); ?>">
                <option value="all" <?php if ($this->get_field_id( 'category' ) == 'all') echo 'selected="selected"'; ?>><?php _e('All Categories', 'curated'); ?></option> 
                <?php foreach ($cats as $cat) {
                        if ($instance['category'] == $cat->slug) {$selected = 'selected="selected"'; } else { $selected = NULL;}
                        echo '<option value="'.$cat->slug.'" '.$selected.'>'.$cat->name.' ('.$cat->count.')</option>';
                  } ?>
                </select>
            </p>
            <p>
                <label for="<?php echo $this->get_field_id('number'); ?>"><?php _e('Number of posts', 'curated') ?></label>
                <input class="widefat" id="<?php echo $this->get_field_id('number'); ?>" type="text" name="<?php echo $this->get_field_name('number'); ?>" value="<?php echo $instance['number']; ?>" />
            </p>

            <?php
        }

    }
}


/*  Setup
================================================== */
register_widget('maha_recent_posts');

?>