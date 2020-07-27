<?php
 switch($type)
 {
 	case 'barritser': 
 		$color="green";
 		break;
 	case 'arbiter':
 		$color=red;
 		break;
 	default:
 		$color="blue";
 }
$pdf_header = '
<table width=100" style="background:'.$color.'">
	<tr>
		<td>1</td>
		<td>2</td>
		<td>3</td>
	</tr>
</table>';