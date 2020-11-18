<div align="center">
<table border="0"  cellspacing="1" class="bgc">
	<tr>
		<td>
<form method="POST" action="index.php?view=admin&admin=46&task=spviewsum">
	<font size="2" color="#FF0000">&nbsp;&nbsp; </font><font color="#800000">
	Stream&nbsp; :</font> 
	<select size="1" name="stream_3">



<?php
$quegetspstrem="select distinct(stream) from student";
$qugetspstrem=mysql_query($quegetspstrem);
while($qgetspstrem=mysql_fetch_array($qugetspstrem)){
	$getspstrem=$qgetspstrem['stream'];


if(($getspstrem!="phy")&&($getspstrem!="bio")&&($getspstrem!="bcs")){
	$divspsub=explode("(",$getspstrem);

	$getspsub=$divspsub[1];

		$divgetsub=explode("_sp",$getspsub);
		$getsub=$divgetsub[0];

	$serchvar=$getspstrem."/".$getsub;

echo"<option value='$serchvar'>".ucfirst($getsub)." Special Degree Students</option>";
}
}

?>

</select> &nbsp; <font color="#800000">&nbsp; Level :</font> 
	<select size="1" name="level_3">
	<option value="1" selected>One</option>
	<option value="2">Two</option>
	
	<option value="0">Recently Pass Out</option>

</select> &nbsp;&nbsp;&nbsp;&nbsp; <input type="submit" value="Search" name="submit">
</p>
</form>

		<p>&nbsp;</td>
	</tr>
</table>


</div>
