<?php
/**
 * Recent_Posts Widget Class
 *
 * @since 2.8.0
 */
class Wt_Widget_Recent_Posts extends WP_Widget {

	function Wt_Widget_Recent_Posts() {
		$widget_ops = array('classname' => 'widget_recent_posts', 'description' => esc_html__( "The most recent posts on your site", 'wt_admin') );
		$this->WP_Widget('recent_posts', THEME_SLUG.' - '.esc_html__('Recent Posts', 'wt_admin'), $widget_ops);
		$this->alt_option_name = 'widget_recent_posts';

		add_action( 'save_post', array(&$this, 'flush_widget_cache') );
		add_action( 'deleted_post', array(&$this, 'flush_widget_cache') );
		add_action( 'switch_theme', array(&$this, 'flush_widget_cache') );
	}

	function widget($args, $instance) {
		$cache = wp_cache_get('theme_widget_recent_posts', 'widget');

		if ( !is_array($cache) )
			$cache = array();

		if ( isset($cache[$args['widget_id']]) ) {
			echo balanceTags( $cache[$args['widget_id']] );
			return;
		}

		ob_start();
		extract($args);

		$title = apply_filters('widget_title', empty($instance['title']) ? esc_html__('Recent Posts', 'wt_front') : $instance['title'], $instance, $this->id_base);
		if ( !$number = (int) $instance['number'] )
			$number = 10;
		else if ( $number < 1 )
			$number = 1;
		else if ( $number > 15 )
			$number = 15;
		
		if ( !$desc_length = (int) $instance['desc_length'] )
			$desc_length = 80;
		else if ( $desc_length < 1 )
			$desc_length = 1;
		
		$disable_thumbnail = $instance['disable_thumbnail'] ? '1' : '0';
		$display_extra_type = $instance['display_extra_type'] ? $instance['display_extra_type'] :'time';
		
		$query = array('showposts' => $number, 'nopaging' => 0, 'post_status' => 'publish', 'ignore_sticky_posts' => 1);
		if(!empty($instance['cat'])){
			$query['cat'] = implode(',', $instance['cat']);
		}

		$r = new WP_Query($query);
		if ($r->have_posts()) :
?>
		<section class="wt_widgetPosts widget">
        <h4 class="widgettitle"><span><?php echo esc_attr( $title ); ?></span></h4>
		<?php if($display_extra_type != 'none'):?>
        <ul class="wt_postList">
        <?php else: // end thumbsOnly ?> 
        <div class="postThumbs">
	    <?php endif;?>	
<?php  while ($r->have_posts()) : $r->the_post(); ?>
			<?php if($display_extra_type != 'none'):?><li><?php endif;?>
<?php if(!$disable_thumbnail):?>
				<a class="thumb" href="<?php echo get_permalink() ?>" title="<?php the_title();?>">
<?php if (has_post_thumbnail() ): ?>
					<?php the_post_thumbnail('thumb', array(55,55),array('title'=>get_the_title(),'alt'=>get_the_title())); ?>	
<?php else:?>
					<img src="<?php echo THEME_IMAGES;?>/widget_posts_thumbnail.png" width="55" height="55" title="<?php the_title();?>" alt="<?php the_title();?>"/>
<?php endif;//end has_post_thumbnail ?>
				</a>
<?php endif;//disable_thumbnail ?>
<?php if($display_extra_type != 'none'):?>
				<div class="wt_postInfo">
					<a href="<?php the_permalink() ?>" class="postInfoTitle" rel="bookmark" title="<?php echo esc_attr(get_the_title() ? get_the_title() : get_the_ID()); ?>"><?php if ( get_the_title() ) the_title(); else the_ID(); ?></a>
<?php if($display_extra_type == 'time'):?>
					<span class="date"><?php echo get_the_date(); ?></span>
<?php elseif($display_extra_type == 'description'):?>
					<p><?php echo wp_html_excerpt(get_the_excerpt(),$desc_length);?></p>
<?php elseif($display_extra_type == 'comments'):?>
					<span class="comments"><?php echo comments_popup_link(esc_html__('No response ','wt_front'), esc_html__('1 Comment','wt_front'), esc_html__('% Comments','wt_front'),''); ?></span>
<?php endif;//end display extra type ?>
				</div>
                <div class="wt_clearboth"></div>
<?php endif; //end display post information ?>	
			<?php if($display_extra_type != 'none'):?></li><?php endif;?>
<?php endwhile; ?>
		<?php if($display_extra_type != 'none'):?>
        </ul>
		<?php else: // end postThumbs ?> 
        </div> 
        <div class="wt_clearboth"></div>
		<?php endif;?>
		</section>
<?php
		// Reset the global $the_post as this query will have stomped on it
		wp_reset_query();

		endif;

		$cache[$args['widget_id']] = ob_get_flush();
		wp_cache_set('theme_widget_recent_posts', $cache, 'widget');
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['number'] = (int) $new_instance['number'];
		$instance['desc_length'] = (int) $new_instance['desc_length'];
		$instance['disable_thumbnail'] = !empty($new_instance['disable_thumbnail']) ? 1 : 0;
		$instance['display_extra_type'] = $new_instance['display_extra_type'];
		$instance['cat'] = $new_instance['cat'];

		$this->flush_widget_cache();

		$alloptions = wp_cache_get( 'alloptions', 'options' );
		if ( isset($alloptions['theme_widget_recent_posts']) )
			delete_option('theme_widget_recent_posts');

		return $instance;
	}

	function flush_widget_cache() {
		wp_cache_delete('theme_widget_recent_posts', 'widget');
	}

	function form( $instance ) {
		$title = isset($instance['title']) ? esc_attr($instance['title']) : '';
		$disable_thumbnail = isset( $instance['disable_thumbnail'] ) ? (bool) $instance['disable_thumbnail'] : false;
		$display_extra_type = isset( $instance['display_extra_type'] ) ? $instance['display_extra_type'] : 'time';
		$cat = isset($instance['cat']) ? $instance['cat'] : array();

		if ( !isset($instance['number']) || !$number = (int) $instance['number'] )
			$number = 5;

		if ( !isset($instance['desc_length']) || !$desc_length = (int) $instance['desc_length'] )
			$desc_length = 80;

		$categories = get_categories('orderby=name&hide_empty=0');
?>
		<p><label for="<?php echo esc_attr( $this->get_field_id('title') ); ?>"><?php esc_html_e('Title:', 'wt_admin'); ?></label>
		<input class="widefat" id="<?php echo esc_attr( $this->get_field_id('title') ); ?>" name="<?php echo esc_attr( $this->get_field_name('title') ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" /></p>

		<p><label for="<?php echo esc_attr( $this->get_field_id('number') ); ?>"><?php esc_html_e('Number of posts to show:', 'wt_admin'); ?></label>
		<input id="<?php echo esc_attr( $this->get_field_id('number') ); ?>" name="<?php echo esc_attr( $this->get_field_name('number') ); ?>" type="text" value="<?php echo esc_attr( $number ); ?>" size="3" /></p>

		<p><input type="checkbox" class="checkbox" id="<?php echo esc_attr( $this->get_field_id('disable_thumbnail') ); ?>" name="<?php echo esc_attr( $this->get_field_name('disable_thumbnail') ); ?>"<?php checked( $disable_thumbnail ); ?> />
		<label for="<?php echo esc_attr( $this->get_field_id('disable_thumbnail') ); ?>"><?php esc_html_e( 'Disable Post Thumbnail?', 'wt_admin' ); ?></label></p>
		
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id('display_extra_type') ); ?>"><?php esc_html_e( 'Display Extra infomation type:', 'wt_admin' ); ?></label>
			<select name="<?php echo esc_attr( $this->get_field_name('display_extra_type') ); ?>" id="<?php echo esc_attr( $this->get_field_id('display_extra_type') ); ?>" class="widefat">
				<option value="time"<?php selected($display_extra_type,'time');?>><?php esc_html_e( 'Time', 'wt_admin' ); ?></option>
				<option value="description"<?php selected($display_extra_type,'description');?>><?php esc_html_e( 'Description', 'wt_admin' ); ?></option>
				<option value="comments"<?php selected($display_extra_type,'comments');?>><?php esc_html_e( 'Comments', 'wt_admin' ); ?></option>
				<option value="none"<?php selected($display_extra_type,'none');?>><?php esc_html_e( 'None', 'wt_admin' ); ?></option>
			</select>
		</p>
		
		<p><label for="<?php echo esc_attr( $this->get_field_id('desc_length') ); ?>"><?php esc_html_e('Length of Description to show:', 'wt_admin'); ?></label>
		<input id="<?php echo esc_attr( $this->get_field_id('desc_length') ); ?>" name="<?php echo esc_attr( $this->get_field_name('desc_length') ); ?>" type="text" value="<?php echo esc_attr( $desc_length ); ?>" size="3" /></p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id('cat') ); ?>"><?php esc_html_e( 'Categorys:' , 'wt_admin'); ?></label>
			<select style="height:5.5em" name="<?php echo esc_attr( $this->get_field_name('cat') ); ?>[]" id="<?php echo esc_attr( $this->get_field_id('cat') ); ?>" class="widefat" multiple="multiple">
				<?php foreach($categories as $category):?>
				<option value="<?php echo esc_attr( $category->term_id );?>"<?php echo in_array($category->term_id, $cat)? ' selected="selected"':'';?>><?php echo esc_attr( $category->name );?></option>
				<?php endforeach;?>
			</select>
		</p>
<?php
	}
}