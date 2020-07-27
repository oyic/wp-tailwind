<?php 
    if(is_null($tab_field)) return; // no acf field pass

    if(!get_field($tab_field)) return // not found/ no record acf field

    // defaults
    $align = !is_null($align)?$align:'';
    $id = !is_null($tabs_id)?$tabs_id:'tabs'; 
if(have_rows(have_rows($tab_field))): $x=1;?>
<ul class="<?php echo $align;?> tabs" data-tabs id="<?php echo $id;?>" data-deep-link="true">
<?php while(have_rows($tab_field)): the_row();?>
    <?php 
        $title = get_sub_field('heading'); 
        $tablinkid = '#'.str_replace(' ','_',strtolower($title));
    ?>
    <li class="tabs-title <?php echo $x==1?'is-active':'';?>">
        <a href="<?php echo $tablinkid;?>">
            <?php echo $title;?>
        </a>
    </li>
    <?php $x++;?>
<?php endwhile; reset_rows();?>
</ul>
<?php endif; ?>
