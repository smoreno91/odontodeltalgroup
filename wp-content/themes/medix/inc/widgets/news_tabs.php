<?php
add_action('widgets_init', 'ww_news_tabs_load_widgets');
function ww_news_tabs_load_widgets() {
    register_widget('WW_News_Tabs_Widget');
}
class WW_News_Tabs_Widget extends WP_Widget {
    function __construct() {
        parent::__construct(
                'ww_news_tabs', esc_html__('CMS News Tab Widget', 'medix'), array('description' => esc_html__('Popular post, recent post and comments.', 'medix'),)
        );
    }
    function widget($args, $instance) {
        extract($args);
        $title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );
        $posts = $instance['posts'];
        $comments = $instance['comments'];
        $tags_count = $instance['tags'];
        $show_popular_posts = isset($instance['show_popular_posts']) ? 'true' : 'false';
        $show_recent_posts = isset($instance['show_recent_posts']) ? 'true' : 'false';
        $show_comments = isset($instance['show_comments']) ? 'true' : 'false';
        $show_tags = isset($instance['show_tags']) ? 'true' : 'false';
        $extra_class = !empty($instance['extra_class']) ? $instance['extra_class'] : "";
        // no 'class' attribute - add one with the value of width
        if( strpos($before_widget, 'class') === false ) {
            $before_widget = str_replace('>', 'class="'. $extra_class . '"', $before_widget);
        }
        // there is 'class' attribute - append width value to it
        else {
            $before_widget = str_replace('class="', 'class="'. $extra_class . ' ', $before_widget);
        }
         
        echo ''.$before_widget;
        if ( $title ) {
			echo $before_title . $title . $after_title;
		}
        ?>
        <!-- Nav tabs -->
		<ul class="nav nav-tabs" role="tablist">
            <?php if ($show_recent_posts == 'true'): ?>
			<li class="active">
				<a href="#widget-tab4" role="tab" data-toggle="tab"><?php echo esc_html__('Recent', 'medix'); ?></a>
			</li>
            <?php endif; ?>
            <?php if ($show_popular_posts == 'true'): ?>
			<li>
				<a href="#widget-tab5" role="tab" data-toggle="tab"><?php echo esc_html__('Popular', 'medix'); ?></a>
			</li>
            <?php endif; ?>
            <?php if ($show_comments == 'true'): ?>
			<li>
				<a href="#widget-tab6" role="tab" data-toggle="tab"><?php echo esc_html__('Comments', 'medix'); ?></a>
			</li>
            <?php endif; ?>
		</ul> 
        
        <div class="tab-content top-color-border no-border maintransp_bg_color">
            <?php if ($show_recent_posts == 'true'): ?>
                <div class="tab-pane fade in active" id="widget-tab4">
                    <?php
                    $args_sql = array(
                        'posts_per_page' => $tags_count,
                        'post_type' => 'post',
                        'post_status' => 'publish',
                        'orderby' => 'date',
                        'order' => 'DESC',
                        'paged' => 1
                    );
                    
                    $recent_posts = new WP_Query($args_sql);
                    if ($recent_posts->have_posts()):
                    
                        while ($recent_posts->have_posts()): 
                            $recent_posts->the_post(); 
                            
                            $archive_year  = get_the_time('Y'); 
                            $archive_month = get_the_time('m'); 
                            $archive_day   = get_the_time('d');
                            ?>
                            <div class="vertical-item bottommargin_20">
                                <?php if ( has_post_thumbnail() ):?>
    								<div class="item-media">
    									<a href="<?php the_permalink(); ?>" class="img"> 
                                            <?php the_post_thumbnail('full'); ?>
                                        </a> 
    								</div>
                                <?php endif;?>
								<div class="item-content">
									<h4 class="entry-title"><a class="post-title" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
									<div class="item-meta greylinks">
										<span class="detail-author"><?php echo esc_html__('By','medix'); ?> <?php the_author_posts_link(); ?></span> <?php echo esc_html__('on','medix'); ?>
                                        <a class="entry-date" href="<?php echo get_day_link( $archive_year, $archive_month, $archive_day); ?>"><?php echo get_the_date(); ?></a>
									</div>

								</div>
							</div>
                            <?php endwhile; ?>
                         
                    <?php endif;
                     wp_reset_postdata(); 
                     ?>
                </div>
            <?php endif; ?>
            
            <?php if ($show_popular_posts == 'true'): ?>
                <div class="tab-pane fade" id="widget-tab5">
                    <?php
                    $args_sql = array(
        				'post_type' => 'post',
        				'order'     => 'DESC',
        				'posts_per_page' => $posts,
        				'post_status' => array('publish'),
        				'orderby'   => 'meta_value_num',
        				'meta_key' => 'post_views_count'
        			);
                     
                    $popular_posts = new WP_Query($args_sql);
                     
                    if ($popular_posts->have_posts()):
                         
                        while ($popular_posts->have_posts()): 
                        $popular_posts->the_post(); 
                            
                            $archive_year  = get_the_time('Y'); 
                            $archive_month = get_the_time('m'); 
                            $archive_day   = get_the_time('d');
                            ?>
                                <div class="vertical-item bottommargin_20">
                                    <?php if ( has_post_thumbnail() ):?>
        								<div class="item-media">
        									<a href="<?php the_permalink(); ?>" class="img"> 
                                                <?php the_post_thumbnail('full'); ?>
                                            </a> 
        								</div>
                                    <?php endif;?>
    								<div class="item-content">
    									<h4 class="entry-title"><a class="post-title" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
    									<div class="item-meta greylinks">
    										<span class="detail-author"><?php echo esc_html__('By','medix'); ?> <?php the_author_posts_link(); ?></span> <?php echo esc_html__('on','medix'); ?>
                                            <a class="entry-date" href="<?php echo get_day_link( $archive_year, $archive_month, $archive_day); ?>"><?php echo get_the_date(); ?></a>
                                            <?php $views = medix_get_post_viewed(get_the_ID()); ?>
                							<span class="post-views"><i class="fa fa-eye"></i> <?php echo sprintf( _n( '%s (View)', '%s (Views)', $views, 'medix' ), $views ); ?></span>
    									</div>
    
    								</div>
    							</div>
                            <?php endwhile; ?>
                        
                    <?php endif; 
                     wp_reset_postdata(); 
                    ?>
                </div>
            <?php endif; ?>
            
            <?php if ($show_comments == 'true'): ?>
                <div class="tab-pane fade" id="widget-tab6">
                    <ul class="news-list mx-list-comment">
                        <?php
                        $number = $instance['comments'];
                        $args['post_type'] = 'post';
                		$args['status'] = 'approve';
                		$args['number'] = $number;
                		$comments = get_comments($args);
                         
                        if ( !empty($comments) ){
                        foreach ($comments as $comment) {
                            $strdate = strtotime($comment->comment_date);
                            ?>
                            <li>
                                <div class="avatar pull-left"><?php echo get_avatar( $comment->comment_author_email, '50' ) ?></div>
            					<div class="comment_info media-body">
            						<h4 class="author"><?php echo esc_html($comment->comment_author); ?></h4>
                                    <span class="comment-date">
                                    <?php echo esc_html__('Posted','medix').' '.date("d M, Y",$strdate); ?>
                                    </span>
            						<p class="comment_content"><?php echo wp_trim_words( $comment->comment_content, $num_words = 8, $more = '...' ) ?></p>
            						<p class="on_post"><?php echo esc_html__('on', 'medix') ?> <a href="<?php echo get_permalink($comment->comment_post_ID) . '#comment-' . $comment->comment_ID; ?>"><?php echo get_the_title($comment->comment_post_ID) ?></a></p>
            					</div>
                            </li>
                              
                        <?php }} ?>
                    </ul>
                </div>
            <?php endif;  wp_reset_postdata(); ?>
        </div>
            
        <?php
        echo ''.$after_widget;
    }
    
    function form($instance) {
        $title = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
        $defaults = array('posts' => 3, 'comments' => '3', 'tags' => 3, 'show_popular_posts' => 'on', 'show_recent_posts' => 'on', 'show_comments' => 'on', 'show_tags' => 'on');
        $instance = wp_parse_args((array) $instance, $defaults);
        ?>
        <p><label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"><?php echo esc_html__( 'Title:', 'medix' ); ?></label>
		<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>
        
        <p>
            <label for="<?php echo ''.$this->get_field_id('posts'); ?>"><?php echo esc_html__( 'Number of popular posts:', 'medix' ); ?></label>
            <input class="widefat" style="width: 30px;" id="<?php echo esc_attr($this->get_field_id('posts')); ?>" name="<?php echo esc_attr($this->get_field_name('posts')); ?>" value="<?php echo esc_attr($instance['posts']); ?>" />
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('tags')); ?>"><?php echo esc_html__( 'Number of recent posts:', 'medix' ); ?></label>
            <input class="widefat" style="width: 30px;" id="<?php echo esc_attr($this->get_field_id('tags')); ?>" name="<?php echo esc_attr($this->get_field_name('tags')); ?>" value="<?php echo esc_attr($instance['tags']); ?>" />
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('comments')); ?>"><?php echo esc_html__( 'Number of comments:', 'medix' ); ?></label>
            <input class="widefat" style="width: 30px;" id="<?php echo esc_attr($this->get_field_id('comments')); ?>" name="<?php echo esc_attr($this->get_field_name('comments')); ?>" value="<?php echo esc_attr($instance['comments']); ?>" />
        </p>
        <p>
            <input class="checkbox" type="checkbox" <?php checked($instance['show_popular_posts'], 'on'); ?> id="<?php echo esc_attr($this->get_field_id('show_popular_posts')); ?>" name="<?php echo esc_attr($this->get_field_name('show_popular_posts')); ?>" />
            <label for="<?php echo esc_attr($this->get_field_id('show_popular_posts')); ?>"><?php echo esc_html__( 'Show popular posts', 'medix' ); ?></label>
        </p>
        <p>
            <input class="checkbox" type="checkbox" <?php checked($instance['show_recent_posts'], 'on'); ?> id="<?php echo esc_attr($this->get_field_id('show_recent_posts')); ?>" name="<?php echo esc_attr($this->get_field_name('show_recent_posts')); ?>" />
            <label for="<?php echo esc_attr($this->get_field_id('show_recent_posts')); ?>"><?php echo esc_html__( 'Show recent posts', 'medix' ); ?></label>
        </p>
        <p>
            <input class="checkbox" type="checkbox" <?php checked($instance['show_comments'], 'on'); ?> id="<?php echo esc_attr($this->get_field_id('show_comments')); ?>" name="<?php echo esc_attr($this->get_field_name('show_comments')); ?>" />
            <label for="<?php echo esc_attr($this->get_field_id('show_comments')); ?>"><?php echo esc_html__( 'Show comments', 'medix' ); ?></label>
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('extra_class')); ?>"><?php echo esc_html__( 'Extra Class:', 'medix' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('extra_class')); ?>" name="<?php echo esc_attr($this->get_field_name('extra_class')); ?>" value="<?php if(isset($instance['extra_class'])){echo esc_attr($instance['extra_class']);} ?>" />
        </p>
        <?php
    }
}
?>