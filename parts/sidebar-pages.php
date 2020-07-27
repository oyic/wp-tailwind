<?php global $post; ?>
<div class="page-parent-menu">
    <ul class="lists menu">
    <?php if(is_page() && $post->post_parent==0):?>
            <?php wp_list_pages( 
                [
                    'child_of'=>$post->ID
                ]
            );?>
    <?php endif; ?>
    </ul>
</div>