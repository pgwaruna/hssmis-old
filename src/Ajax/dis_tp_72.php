<?php

	$ptype=$_GET['ptype'];

if($ptype=="student"){

	echo"<select size='2' name='elvcostpy'>";
		echo'<option value="theory" selected=selected >Theory</option>';
		echo'<option value="practical">Practical</option>';
	echo"</select>";
		}
?>
