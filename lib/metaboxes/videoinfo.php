<div class="my_meta_control">

	<p>Enter the video url.</p>
 
    <label>Youtube or Vimeo URL</label>
 
    <p>
        <input type="text" name="<?php $metabox->the_name('url'); ?>" value="<?php $metabox->the_value('url'); ?>"/>
        <span>Enter the full url including http://</span>
    </p>

 
    <p>Enter the video producer information in the boxes below.</p>
 
    <label>Producer Name</label>
 
    <p>
        <input type="text" name="<?php $metabox->the_name('producer'); ?>" value="<?php $metabox->the_value('producer'); ?>"/>
        <span>Enter in a name</span>
    </p>
 
    <label>Producer Link <span>(Enter in the link including http://)</span></label>
 
    <p>
        <input type="text" name="<?php $metabox->the_name('producer-link'); ?>" value="<?php $metabox->the_value('producer-link'); ?>"/>
        <span>Enter in a url</span>
    </p>
    

    <label>Misc Info <span>(Enter in the video time and publication date)</span></label>
 
    <?php while($metabox->have_fields('timeanddate',1)): ?>
    <p>
        <?php $metabox->the_field('title'); ?>
        <input type="text" name="<?php $metabox->the_name(); ?>" value="<?php $metabox->the_value(); ?>"/>
 
        <input type="text" name="<?php $metabox->the_name('url'); ?>" value="<?php $metabox->the_value('url'); ?>"/>
 

    </p>
    <?php endwhile; ?>

 
 
    <label>Custom Meta Keys <span>(Enter in the title and value)</span></label>
 
    <?php while($metabox->have_fields_and_one('and_one_group')): ?>
    <p>
        <?php $metabox->the_field('title'); ?>
        <input type="text" name="<?php $metabox->the_name(); ?>" value="<?php $metabox->the_value(); ?>"/>
 
        <?php $metabox->the_field('description'); ?>
        <input type="text" name="<?php $metabox->the_name(); ?>" value="<?php $metabox->the_value(); ?>"/>
    </p>
    <?php endwhile; ?>
 
 
</div>
