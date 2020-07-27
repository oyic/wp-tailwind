<?php 
/**
 * Default single post
 */

if(isset($_REQUEST['mode'])):
 	switch(strtolower($_REQUEST['mode'])){
 		case 'print':
 			include('single-pdf.php');
 			break;
 		default:
 			include('single-online.php');
 		break;
 	}
 else:
 	include('single-online.php');
 endif;