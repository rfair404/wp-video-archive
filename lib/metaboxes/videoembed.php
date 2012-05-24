<div class="my_meta_control">
 
    <p>Enter the video service and ID.</p>
 
    <label>Video Service Provider</label>

	<?php $mb->the_field('vid-service'); ?>
	<select name="<?php $mb->the_name(); ?>">
		<option value="">Select...</option>
		<option value="youtube"<?php $mb->the_select_state('youtube'); ?>>youtube</option>
		<option value="vimeo"<?php $mb->the_select_state('vimeo'); ?>>vimeo</option>
	</select>
 
    <label>Video ID</label>
 
    <p>
        <input type="text" name="<?php $metabox->the_name('vid-id'); ?>" value="<?php $metabox->the_value('vid-id'); ?>"/>
        <span>Enter only the ID</span>
    </p>
 
</div>
