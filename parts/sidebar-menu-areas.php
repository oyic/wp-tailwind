<?php
$areas = SqeThemeFunctions::get_area_submenu($category);

if(false != $areas):?>
<ul class="submenu areas">
    <?php foreach($areas as $area); ?>
    <li><?php echo $area; ?></li>
</ul>
<?php endif; ?>