<?php if(function_exists('bcn_display')):?>
<div class="breadcrumbs" typeof="BreadcrumbList" vocab="http://schema.org/">
    <?php bcn_display();?>
</div>
<?php else:?>
    <?php if (function_exists('yoast_breadcrumb')) {yoast_breadcrumb('<p id="breadcrumbs">', '</p>');}?>
<?php endif; ?>