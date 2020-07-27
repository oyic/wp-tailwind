<?php if (current_user_can('administrator')) : ?>
    <span class="wp-template">
    
        <?php
        global $template;
        // echo basename($template);
        ?>
        <span>Template</span><?php echo basename($template); ?>
    </span>
<?php endif; ?>