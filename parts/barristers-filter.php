<form action="" class="form-filter form" method="POST">
<div class="grid-container ">
<div class="grid-x">	
<div class="cell field-container">		
	<div class="grid-x grid-margin-x grid-padding-x">
					<?php wp_nonce_field( 'check_filter_submit', 'my_pdf_nonce_field' ); ?>
					<input type="hidden" name='action' value="filterBarrister">
					<div class="medium-3 cell">

						<?php \Emma\SqeThemeFunctions::get_template_parts_with_vars('parts/select-barrister-areas',['default_option_label'=>'Select Area']) ?>
						
					</div>
					<div class="medium-3 cell">
						<?php \Emma\SqeThemeFunctions::get_template_parts_with_vars('parts/select-barrister-categories',['default_option_label'=>'Category']) ?>
					</div>
					<div class="medium-3 cell">
						<select name="orderby" id="barristers-order" class='radio-action'>
							<option value="">Order by:</option>
							<option value="menu_order">Menu order</option>
							<option value="surname">Surname</option>
						</select>
					</div>
					<div class="medium-3 cell">
						<input type="text" name="key" placeholder="search" class='input-action' id='filter-barristers-keyword' >
					</div>
					
				
	</div>
</div>
</div>
</div>

</form>