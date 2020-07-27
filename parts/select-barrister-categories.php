<?php 
$args = ['taxonomy'=>'barrister_category',
		   'orderby' => 'name',
           'order' => 'ASC',
           'hide_empty'=>false ];
$barristers_category = get_terms( $args );
?>
<?php if($barristers_category): ?>
	<select name="b_cat" id="filter-barristers-category" class='select-action'>
		<option value=""><?php echo $default_option_label?:'Category' ?></option>
		<?php foreach($barristers_category as $cat): ?>
			<option value="<?=$cat->slug?>"  <?php echo isset($_REQUEST['b_cat']) && ($_REQUEST['b_cat']) == $cat->slug ? 'selected': '' ?> ><?=$cat->name;?></option>
		<?php endforeach; ?>
	</select>
<?php endif; ?>