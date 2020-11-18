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

}
?>
<div align="center">
<table border="0" cellspacing="1" class="bgc">
	<tr>
		<td>
<form method="POST" action="forms/mentor.php?task=viewinf&bkbtn=null">
	<font size="2" color="#FF0000">&nbsp;&nbsp; </font>
	<font color="#800000">&nbsp;Index Number :</font>&nbsp;
	<font color="#800000">HS/</font>

<?php
echo'<select size="1" name="year_8_5">';

for($indx=0;$indx<10;$indx++){
	$olyr=$cryr-$indx;
	echo"<option value='$olyr'>$olyr</option>";
}

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
	(<span style="font-size: 10pt"> Ex: HS/2003/15291) </center></span></font></form></td>
	</tr>
</table>


</div>



