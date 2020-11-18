<?php
include './admin/config.php';
mysql_connect($host,$user,$pass)or die("Unable to connect Database");
mysql_select_db($db);
$quebtyear="select * from acc_year where current='1'";
$qubtyear=mysql_query($quebtyear);
while($qbtyear=mysql_fetch_array($qubtyear)){
$btyear=$qbtyear['acedemic_year'];
$btyr=explode("_",$btyear);

$nxyr=$btyr[1];
$cryr=$btyr[0];
$olyr1=$cryr-1;
$olyr2=$cryr-2;
$olyr3=$cryr-3;
$olyr4=$cryr-4;
$olyr5=$cryr-5;
}
?>
<div align="center">
<table border="0" cellspacing="1" class="bgc">
	<tr>
		<td>
<form method="POST" action="index.php?view=admin&admin=43&task=printonerek">
	<font size="2" color="#FF0000">&nbsp;&nbsp; </font>
	<font color="#800000">&nbsp;Index Number :</font>&nbsp;
	<font color="#800000">SC/</font>

<?php
echo'<select size="1" name="year_8_5">';
echo"<option value='$olyr5'>$olyr5</option>";
echo"<option value='$olyr4'>$olyr4</option>";
echo"<option value='$olyr3'>$olyr3</option>";
echo"<option value='$olyr2'>$olyr2</option>";
echo"<option value='$olyr1'>$olyr1</option>";
echo"<option value='$cryr'>$cryr</option>";
echo"<option value='$nxyr'>$nxyr</option>";


echo'</select>';
?>

<font color="#800000">/</font>
	<span id="number1">
	<input type="text" name="index_8_5" size="4">&nbsp;
	<span class="textfieldRequiredMsg"><font size="-1"> Enter a index Number</font></span>
	<span class="textfieldInvalidFormatMsg"><font size="-1">Invalid format</font></span>
	</span>
	<input type="submit" value="Submit" name="submit"> <br>
	<font color="#FF0000"><center>
	(<span style="font-size: 10pt"> Ex: SC/2003/5291) </center></span></font></form></td>
	</tr>
</table>


</div>



