<?php 
    if(is_null($tab_field)) return; // no acf field pass

    if(!get_field($tab_field)) return // not found/ no record acf field

    // defaults
    $id = !is_null($tabs_id)?$tabs_id:'tabs'; 
if(have_rows(have_rows($tab_field))): $x=1;?>

<div class="tabs-content" data-tabs-content="<?php echo $id;?>">
<?php while(have_rows($tab_field)): the_row();?>
    <?php 
        $title = get_sub_field('heading'); 
        $tablinkid = '#'.str_replace(' ','_',strtolower($title));
    ?>
    <div class="tabs-panel <?php echo $x==1?'is-active':'';?>" id="<?php echo $tablinkid;?>">
        <h5><?php echo $title;?></h5>
        <div class="text">
            <?php the_sub_field('text'); ?>
        </div>
    </div>
    <?php $x++;?>
<?php endwhile; ?>
</div>
<?php endif;?>
