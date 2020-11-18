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
<table width=30%><tr class=trbgc align=center><td>
<form method="POST" action="index.php?view=admin&admin=2&task=post_register">
<font color="#800000"><b>Enter Index Number </b></font><br><br>
<font color="#800000">HS/</font>


<?php
echo'<select size="1" name="std_y">';


for($indx=0;$indx<10;$indx++){
	$olyr=$cryr-$indx;
	echo"<option value='$olyr'>$olyr</option>";
}

echo'</select>';
?>

<font color="#800000">/</font>
	<input name="std_2" size="4">
	<input type="submit" value="Search" name="submit"><br><br>( Eg: HS/2003/15291)
<br></form></table>

	
	
