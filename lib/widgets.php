<?php

class VAR_Video_Archive extends WP_Widget {

	function VAR_Video_Archive() {
		$widget_ops = array( 'classname' => 'videoarchive', 'description' => __('Recent Video Widget', 'videoarchive') );
		$control_ops = array( 'width' => 200, 'height' => 250, 'id_base' => 'videoarchive' );
		$this->WP_Widget( 'videoarchive', __('Video Archive', 'videoarchive'), $widget_ops, $control_ops );
	}

	function widget($args, $instance) {
		extract($args);

		echo $before_widget; 

		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? __( 'Latest Videos', 'videoarchive' ) : $instance['title'], $instance, $this->id_base);
		echo $before_title .  $title . $after_title;
		?>
		<div id="video_archive_content_wrapper">
			<ul id="videoarchive_video_cat_fill">
		<?php 
		$post_type = VAR_POST_TYPE;
		$genere_include = empty( $instance['taxgenere_include'] ) ? NULL : array('taxonomy' => 'genere', 'field' => 'id', 'terms' => array($instance['taxgenere_include']), 'operator' => 'IN' );
		$genere_exclude = empty( $instance['taxgenere_exclude'] ) ? NULL : array('taxonomy' => 'genere', 'field' => 'id', 'terms' => array($instance['taxgenere_exclude']), 'operator' => 'NOT IN' );
		$subject_include = empty( $instance['taxsubject_include'] ) ? NULL : array('taxonomy' => 'subject', 'field' => 'id', 'terms' => array($instance['taxsubject_include']), 'operator' => 'IN' );
		$subject_exclude = empty( $instance['taxsubject_exclude'] ) ? NULL : array('taxonomy' => 'subject', 'field' => 'id', 'terms' => array($instance['taxsubject_exclude']), 'operator' => 'NOT IN' );
		$tax_query = array(
			'relation' => 'AND',
			$genere_include,
			$genere_exclude, 
			$subject_include,
			$subject_exclude
		);
$numposts = empty($instance['posts_num']) ? '7' : $instance['posts_num'] ;
		$videos = new WP_Query(array( 'post_type' => $post_type, 'posts_per_page' => $numposts, 'post_status' => 'publish', 'orderby' => 'date', 'order' => 'DESC', 'tax_query' => $tax_query));
		if($videos->have_posts()) :
		while($videos->have_posts()) : $videos->the_post();
		global $post; 
		?>
				<li <?php post_class(); ?>>
					
					<?php if ( $instance['show_video'] == 'yes' ) {
						echo do_shortcode('[va_video id="' . $post->ID . '"]');
					} ?>
					
					<h3><a href="<?php the_permalink($post->ID); ?>" title="<?php the_title($post->ID); ?>"><?php the_title(); ?></a></h3>
					<?php if ( $instance['show_author'] == 'yes' ) {
						printf('<span class="videoauthor">%s%s</span>', __('By: ', 'videoarchive'), get_the_author()); 
					}
					if ( $instance['show_date'] == 'yes' ) {
						printf('<span class="videodate">%s</span>', get_the_date('M j, Y')); 
					}
					if ( $instance['show_excerpt'] == 'yes' ) {
						the_excerpt(); 
					}
					if ( $instance['after_shortcodes'] != '' ) {
						echo do_shortcode($instance['after_shortcodes']); 
					}  ?>
				</li><!--end post_class()-->
		<?php endwhile; endif; ?>
			</ul>
	 	</div>

		<?php echo $after_widget;
		wp_reset_query();
	}//end widget

		function update($new_instance, $old_instance) {
		return $new_instance;
	}

	function form($instance) {
		$instance = wp_parse_args( (array)$instance, array(
			'title' => '',
			'subtitle' => '',
			'posts_num' => 'left',
			'show_video' => '',
			'taxgenere_include' => '',
			'taxgenere_exclude' => '',
			'taxsubject_include' => '',
			'taxsubject_exclude' => '',
		) );
		?>
		<?php $instance['title'] = (!empty($instance['title'])) ? $instance['title'] : __('Latest Videos', 'videoarchive') ; ?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title', 'videoarchive'); ?>:</label>
		<input type="text" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>" size="20" style="float: right;" /><span class="howto"><?php _e('Enter the widget title as you wish it to appear on the site', 'videoarchive'); ?></span></p>

		<?php $instance['subtitle'] = (!empty($instance['subtitle'])) ? $instance['subtitle'] : __('Recent videos from around the site', 'videoarchive') ; ?>
		<p><label for="<?php echo $this->get_field_id('subtitle'); ?>"><?php _e('Subtitle', 'videoarchive'); ?>:</label>
		<input type="text" id="<?php echo $this->get_field_id('subtitle'); ?>" name="<?php echo $this->get_field_name('subtitle'); ?>" value="<?php echo esc_attr( $instance['subtitle'] ); ?>" size="20" style="float: right;" /><span class="howto"><?php _e('Enter the widget subtitle as you wish it to appear on the site', 'videoarchive'); ?></span></p>

		<?php $instance['posts_num'] = (!empty($instance['posts_num'])) ? $instance['posts_num'] : 7; ?>
		<p><label for="<?php echo $this->get_field_id('posts_num'); ?>"><?php _e('Number of Videos to Show', 'videoarchive'); ?>:</label>
		<input type="number" id="<?php echo $this->get_field_id('posts_num'); ?>" name="<?php echo $this->get_field_name('posts_num'); ?>" value="<?php echo esc_attr( $instance['posts_num'] ); ?>" style="float: right;" /><span class="howto"><?php _e('Choose number of posts to show initially, default is 7', 'videoarchive'); ?></span></p>
		
		<?php $instance['show_video'] = (!empty($instance['show_video'])) ? $instance['show_video'] : 'yes'; ?>
		<p><label for="<?php echo $this->get_field_id('show_video'); ?>"><?php _e('Show the videos', 'videoarchive'); ?>:</label>
		<select id="<?php echo $this->get_field_id('show_video'); ?>" name="<?php echo $this->get_field_name('show_video'); ?>" style="float: right;" >
			<option value="yes" <?php selected("yes", $instance['show_video']); ?>><?php _e('yes', 'videoarchive'); ?></option>
			<option value="no" <?php selected("no", $instance['show_video']); ?>><?php _e('no', 'videoarchive'); ?></option>
		
		</select>
		<span class="howto"><?php _e('Select to show or hide the video in the widget', 'videoarchive'); ?></span></p>

		<?php $instance['show_author'] = (!empty($instance['show_author'])) ? $instance['show_author'] : 'no'; ?>
		<p><label for="<?php echo $this->get_field_id('show_author'); ?>"><?php _e('Show the post author', 'videoarchive'); ?>:</label>
		<select id="<?php echo $this->get_field_id('show_author'); ?>" name="<?php echo $this->get_field_name('show_author'); ?>" style="float: right;" >
			<option value="yes" <?php selected("yes", $instance['show_author']); ?>><?php _e('yes', 'videoarchive'); ?></option>
			<option value="no" <?php selected("no", $instance['show_author']); ?>><?php _e('no', 'videoarchive'); ?></option>
		
		</select>
		<span class="howto"><?php _e('Select to show or hide the post author in the widget', 'videoarchive'); ?></span></p>

		<?php $instance['show_date'] = (!empty($instance['show_date'])) ? $instance['show_date'] : 'no'; ?>
		<p><label for="<?php echo $this->get_field_id('show_date'); ?>"><?php _e('Show the post date', 'videoarchive'); ?>:</label>
		<select id="<?php echo $this->get_field_id('show_date'); ?>" name="<?php echo $this->get_field_name('show_date'); ?>" style="float: right;" >
			<option value="yes" <?php selected("yes", $instance['show_date']); ?>><?php _e('yes', 'videoarchive'); ?></option>
			<option value="no" <?php selected("no", $instance['show_date']); ?>><?php _e('no', 'videoarchive'); ?></option>
		
		</select>
		<span class="howto"><?php _e('Select to show or hide the post excerpt in the widget', 'videoarchive'); ?></span></p>


		<?php $instance['show_excerpt'] = (!empty($instance['show_excerpt'])) ? $instance['show_excerpt'] : 'no'; ?>
		<p><label for="<?php echo $this->get_field_id('show_excerpt'); ?>"><?php _e('Show the post excerpt', 'videoarchive'); ?>:</label>
		<select id="<?php echo $this->get_field_id('show_excerpt'); ?>" name="<?php echo $this->get_field_name('show_excerpt'); ?>" style="float: right;" >
			<option value="yes" <?php selected("yes", $instance['show_excerpt']); ?>><?php _e('yes', 'videoarchive'); ?></option>
			<option value="no" <?php selected("no", $instance['show_excerpt']); ?>><?php _e('no', 'videoarchive'); ?></option>
		
		</select>
		<span class="howto"><?php _e('Select to show or hide the post excerpt in the widget', 'videoarchive'); ?></span></p>

		<?php $instance['after_shortcodes'] = (!empty($instance['after_shortcodes'])) ? $instance['after_shortcodes'] : __('', 'videoarchive') ; ?>
		<p><label for="<?php echo $this->get_field_id('after_shortcodes'); ?>"><?php _e('Show shortcodes beneath excerpt', 'videoarchive'); ?>:</label>
		<input type="text" id="<?php echo $this->get_field_id('after_shortcodes'); ?>" name="<?php echo $this->get_field_name('after_shortcodes'); ?>" value="<?php echo esc_attr( $instance['after_shortcodes'] ); ?>" size="20" style="float: right;" /><span class="howto"><?php _e('Enter shortcodes as you wish it to appear below the excerpt', 'videoarchive'); ?></span></p>

		<?php $instance['taxgenere_include'] = (!empty($instance['taxgenere_include'])) ? $instance['taxgenere_include'] : ''; ?>
		<p><label for="<?php echo $this->get_field_id('taxgenere_include'); ?>"><?php _e('Genere\'s to include', 'videoarchive'); ?>:</label>
		<input type="text" id="<?php echo $this->get_field_id('taxgenere_include'); ?>" name="<?php echo $this->get_field_name('taxgenere_include'); ?>" value="<?php echo esc_attr( $instance['taxgenere_include'] ); ?>" size="2" style="float: right;" /><span class="howto"><?php _e('Enter Genere Term ID\'s that you wish to include, default is ALL', 'videoarchive'); ?></span></p>

		<?php $instance['taxgenere_exclude'] = (!empty($instance['taxgenere_exclude'])) ? $instance['taxgenere_exclude'] : ''; ?>
		<p><label for="<?php echo $this->get_field_id('taxgenere_exclude'); ?>"><?php _e('Genere\'s to exclude', 'videoarchive'); ?>:</label>
		<input type="text" id="<?php echo $this->get_field_id('tax_exclude'); ?>" name="<?php echo $this->get_field_name('taxgenere_exclude'); ?>" value="<?php echo esc_attr( $instance['taxgenere_exclude'] ); ?>" size="2" style="float: right;" /><span class="howto"><?php _e('Enter Genere Term ID\'s that you wish to exclude, default is NONE', 'videoarchive'); ?></span></p>

		<?php $instance['taxsubject_include'] = (!empty($instance['taxsubject_include'])) ? $instance['taxsubject_include'] : ''; ?>
		<p><label for="<?php echo $this->get_field_id('taxsubject_include'); ?>"><?php _e('Subject\'s to include', 'videoarchive'); ?>:</label>
		<input type="text" id="<?php echo $this->get_field_id('taxsubject_include'); ?>" name="<?php echo $this->get_field_name('taxsubject_include'); ?>" value="<?php echo esc_attr( $instance['taxsubject_include'] ); ?>" size="2" style="float: right;" /><span class="howto"><?php _e('Enter Subject Term ID\'s that you wish to include, default is ALL', 'videoarchive'); ?></span></p>

		<?php $instance['taxsubject_exclude'] = (!empty($instance['taxsubject_exclude'])) ? $instance['taxsubject_exclude'] : ''; ?>
		<p><label for="<?php echo $this->get_field_id('tax_exclude'); ?>"><?php _e('Subject\'s to exclude', 'videoarchive'); ?>:</label>
		<input type="text" id="<?php echo $this->get_field_id('taxsubject_exclude'); ?>" name="<?php echo $this->get_field_name('taxsubject_exclude'); ?>" value="<?php echo esc_attr( $instance['taxsubject_exclude'] ); ?>" size="2" style="float: right;" /><span class="howto"><?php _e('Enter Subject Term ID\'s that you wish to exclude, default is NONE', 'videoarchive'); ?></span></p>

			
	<?php 
	}
} ?>
