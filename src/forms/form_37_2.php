<?php
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
<table border="0">
	<tr class="trbgc">
		<td align="center">
<form method="POST" action='./index.php?view=admin&admin=37&task=eregister&blk=gnrg'>
	<font size="2" color="#FF0000">&nbsp;&nbsp; </font>
	<font color="#800000">&nbsp;Index Number :</font>&nbsp;
	<font color="#800000">HS/</font>

<?php
echo'<select size="1" name="std_y">';
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
	<input type="text" name="std_n" size="4">&nbsp;
	<span class="textfieldRequiredMsg"><font size="-1"> Enter a index Number</font></span>
	<span class="textfieldInvalidFormatMsg"><font size="-1">Invalid format</font></span>
	</span>

<font color="#FF0000"><center>(Ex: HS/2016/15291) </center></span></font></td>
<tr class="trbgc"><td align="center">	
<select name="regflt">
	<option value="old" selected>Previous Registration</option>
	<option value="current" >Current Registration</option>
</select>


	<input type="submit" value="Submit" name="submit37"></form> <br>
	



</tr>
</table>


</div>



































<!--
	
<form method="POST" action="index.php?view=admin&admin=37&task=eregister">
<font color="#800000">Index Number :</font>&nbsp;
<font color="#800000">SC/</font><select size="1" name="std_y5">
<option value="2007">2007</option>
<option value="2008">2008</option>
<option value="2009">2009</option>
<option value="2010">2010</option>
<option value="2011">2011</option>
</select><font color="#800000">/</font>
	<input name="std_5" size="4">
	<input type="submit" value="Find" name="submit5">	( Ex: SC/2008/7541)
<br><br></form>

-->	
	
