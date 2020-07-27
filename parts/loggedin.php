<?php

/* Get user info. */
global $current_user, $wp_roles;
$firstnaame = get_the_author_meta('first_name', $current_user->ID);
$lastname = get_the_author_meta('last_name', $current_user->ID);

if (!(is_user_logged_in())): ?>
	<div class="grid-container">
	    <div class="grid-x grid-padding-x">
	        <div class="callout alert small-12 cell">
	            <p>Sorry!  You need to be logged in to see this page.</p>
	        </div>
	    </div>
	</div>
<?php
else:?>
	<div class="grid-container">
	<div class="grid-x grid-padding-x">
		<div class="small-12 cell loggedin text-right">Logged in as <?php echo $current_user->display_name; ?> | <a href="/members-area/profile/">Edit my profile</a> | <a href="/members-area/edit/">Edit my firm</a></div>
	</div>
</div>
<?php 
endif;
?>

