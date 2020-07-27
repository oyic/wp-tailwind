<?php
$b = !is_null($b)?$b:false;
$cat = !is_null($cat)?$cat:false;
$area = !is_null($area)?$area:false;
$order = !is_null($order)?$order:'DESC';
?>

<form action="" class="form-post-filter" method="POST">
    <div class="grid-x grid-margin-x small-up-2 medium-up-3 large-up-4">
    <?php if($cat):?>
            <div class="cell">
                <?php if( $category = SqeFunctions::get_category_list('category') ): ?>
                     <select name="cat" id="category-post" class="post-action-filter">
                         <option value="">Category</option>
                         <?php foreach($category as $item): ?>
                         
                            <?php if($item['slug'] == $_REQUEST['cat']): ?>
                                <option value="<?=$item['slug'];?>" selected><?=$item['label'];?></option>
                            <?php else: ?>
                                <option value="<?=$item['slug'];?>"><?=$item['label'];?></option>
                            <?php endif; ?>

                        <?php endforeach; ?>
                     </select>   
                <?php endif;?>
            </div>
        <?php endif;?>
        <?php if($b):?>
            <div class="cell">
                <?php if( $barristers = SqeFunctions::get_lists_id('barrister') ): ?>
                     <select name="b" id="barristers-post" class="post-action-filter">
                         <option value="">Barrister</option>
                         <?php foreach($barristers as $item): ?>
                            <?php if($item['id'] == $_REQUEST['b']): ?>
                                <option value="<?=$item['id'];?>" selected><?=$item['label'];?></option>
                            <?php else: ?>
                                <option value="<?=$item['id'];?>"><?=$item['label'];?></option>
                            <?php endif; ?>
                        <?php endforeach; ?>
                     </select>   
                <?php endif;?>
            </div>
        <?php endif;?>
        <?php if($area):?>
            <div class="cell">
                <?php if( $areas = SqeFunctions::get_lists_id('area') ): ?>
                     <select name="area" id="area-post" class="post-action-filter">
                         <option value="">Area</option>
                         <?php foreach($areas as $item): ?>
                         <?php if($item['id'] == $_REQUEST['area']): ?>
                            <option value="<?=$item['id'];?>" selected><?=$item['label'];?></option>
                         <?php else: ?>
                            <option value="<?=$item['id'];?>"><?=$item['label'];?></option>
                         <?php endif; ?>
                        <?php endforeach; ?>
                     </select>   
                <?php endif;?>
            </div>
        <?php endif;?>
        <div class="cell">
        <input class="kw-action-filter" type="text" name="kw" id="kw" value="<?=isset($_REQUEST['kw'])?$_REQUEST['kw']:'';?>" placeholder="Keywords">

        </div>
        </div>
        <!-- <div class="grid-x grid-margin-x">
            <div class="cell auto"></div>
            <div class="cell medium-2">
                <select name="order" id="order">
                    <option value="ASC" <?php echo (!is_null($_REQUEST['order']) && 'ASC'==$_REQUEST['order'])?'selected':''; ?>>ASC</option>
                    <option value="DESC" <?php echo (!is_null($_REQUEST['order']) && 'DESC'==$_REQUEST['order'])?'selected':''; ?>>DESC</option>
                </select>
            </div>
            <div class="cell medium-3">
                <input type="text" name="kw" id="kw" value="<?=isset($_REQUEST['kw'])?$_REQUEST['kw']:'';?>" placeholder="Keywords">
            </div>
        </div> -->

    </form>