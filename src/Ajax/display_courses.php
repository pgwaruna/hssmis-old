<?php

	$dept=$_GET['dept'];
	$sgp=$_GET['sgp'];
     include '../admin/config.php';
     $con2_a=mysql_connect($host,$user,$pass)or die("Unable to connect Database");
     mysql_select_db($db);

if($sgp=="showgp"){


if(($dept=="lecture")||($dept=="tute")){
echo"Group<br>";
echo'<select size="1" name="swgrp" id="swgrp" >';
echo'<option value="nogrp" selected >No Group</option>';
echo'</select>';
										}
else{
echo"Enter Expt. NO<br><input type='text' name='exptno' id='exptno' size=10><br>";
echo"Group<br>";
echo'<select size="5" name="swgrp" id="swgrp" >';
echo'<option value="nogrp" selected >No Group</option>';
for($i=A;$i<Z;$i++){
	echo"<option value='$i'>$i</option>";

					}


echo'</select>';

		}

}
else{

require_once('../classes/globalClass.php');	
$k=new settings();
$semi=$k->getSemister();

$query1="SELECT code FROM courseunit WHERE department ='$dept' and ((semister='$semi')||(semister=3)) and availability=1 order by code";
$prev1=mysql_query($query1);
	

echo '<select size="7" name="dept_courses" id="dept_courses" onchange="displayLid()">';
while($iddata1=mysql_fetch_array($prev1)){

echo '<option value="'.$iddata1['code'].'">'.strtoupper($iddata1['code']).'</option>';
					
}
echo '</select>';

}












//sleep(1);
?>
