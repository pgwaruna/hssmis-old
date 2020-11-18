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
		
	
<table><tr class=trbgc align=center><td><br>	
<form method="POST" action="index.php?view=admin&admin=3&task=confirm">
<font color="#800000">Index Number :</font>&nbsp;
<font color="#800000">HS/</font>
<?php
echo'<select size="1" name="year_2">';
for($indx=0;$indx<10;$indx++){
	$olyr=$cryr-$indx;
	echo"<option value='$olyr'>$olyr</option>";
}



echo'</select>';
?>



<font color="#800000">/</font>
	<span id="number1">
	<input name="student_3" size="4">&nbsp; 
	<span class="textfieldRequiredMsg"><font size="-1"> Enter a index Number</font></span>
	<span class="textfieldInvalidFormatMsg"><font size="-1">Invalid format</font></span>
	</span>
	<font color="#800000">&nbsp;</font><input type="submit" value="Find" name="submit">
</form>
</table>
	
	
